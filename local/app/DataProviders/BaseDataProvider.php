<?php
namespace DataProviders;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Cookie\CookieJar;
use \ViewModels\PageModel;
use Aws\S3\S3Client;
use \stdClass;
use \Config;
use \Infrastructure\Constants;
use \Infrastructure\Common;
use \ViewModels\SearchValueModel;
use \ReflectionClass;
use File;

class BaseDataProvider
{

    public function SaveEntity($item)
    {
        $item->save();
        return $item;
    }

    public function RunQueryStatement($queryString, $queryType)
    {
        switch ($queryType) {
            case Constants::$QueryType_Select:
                return DB::select($queryString);
                break;
            case Constants::$QueryType_Update:
                return DB::update($queryString);
                break;
            case Constants::$QueryType_Insert:
                return DB::insert($queryString);
                break;
            case Constants::$QueryType_Delete:
                return DB::delete($queryString);
                break;
        }
    }

    public function DeleteEntity($item, $primaryKeyValue)
    {
        $class = $this->GetReflectionClass($item);
        $tableName = $class->getProperty('table')->getValue($item);
        $primaryKeyName = $class->getProperty('primaryKey')->getValue($item);
        DB::table($tableName)->where($primaryKeyName, $primaryKeyValue)->delete();
    }

    public function GetReflectionClass($item)
    {
        $ReflectionClass = get_class($item);
        return new ReflectionClass($ReflectionClass);
    }

    public function CustomDeleteEntity($item, $FieldKeyName, $FieldKeyValue)
    {
        $tableName = $this->GetTableNameFromReflectionClass($item);
        DB::table($tableName)->where($FieldKeyName, $FieldKeyValue)->delete();
    }

    public function GetTableNameFromReflectionClass($item)
    {
        $class = $this->GetReflectionClass($item);
        return $class->getProperty('table')->getValue($item);
    }

    public function CustomUpdateEntity($item, $FieldKeyName, $FieldKeyValue, $UpdateValueArray)
    {
        $tableName = $this->GetTableNameFromReflectionClass($item);
        DB::table($tableName)->where($FieldKeyName, $FieldKeyValue)->update($UpdateValueArray);
    }

    public function CustomMultiUpdateEntity($item, $FieldKeyName, $FieldKeyValueArray, $UpdateValueArray)
    {
        $tableName = $this->GetTableNameFromReflectionClass($item);
        DB::table($tableName)->whereIn($FieldKeyName, $FieldKeyValueArray)->update($UpdateValueArray);
    }

    public function CustomMultiUpdateEntityWithMultipleFieldsSearch($item, $searchParams, $UpdateValueArray)
    {
        $tableName = $this->GetTableNameFromReflectionClass($item);
        if (!empty($searchParams) && count($searchParams) > 0) {
            $db = DB::table($tableName);
            foreach ($searchParams as &$val) {
                $FieldKeyValue = $val->Value;
                $FieldKeyName = $val->Name;
                $db = $db->where($FieldKeyName, $FieldKeyValue);
            }

            return $db->update($UpdateValueArray);
        } else {
            return false;
        }

    }

    public function GetEntityForUpdateByPrimaryKey($item, $primaryKeyValue)
    {
        $ReflectionClass = get_class($item);
        return $ReflectionClass::find($primaryKeyValue);
    }

    public function GetEntityForUpdateByFilter($item, $searchParams)
    {
        $ReflectionClass = get_class($item);
        $isfirsttimeset = false;
        if (!empty($searchParams) && count($searchParams) > 0) {
            foreach ($searchParams as &$val) {
                $Value = $val->Value;
                $Name = $val->Name;
                if ($isfirsttimeset)
                    $ReflectionClass = $ReflectionClass->where($Name, $Value);
                else {
                    $ReflectionClass = $ReflectionClass::where($Name, $Value);
                    $isfirsttimeset = true;
                }
            }
        }
        return $ReflectionClass->first();
    }

    public function GetEntity($item, $searchParams, $sortIndex = "", $sortDirection = "", $customWhere = "")
    {
        $selectQuery = $this->GetFilterString($item, $searchParams, $sortIndex, $sortDirection, $customWhere);

        $result = DB::select($selectQuery . " LIMIT 0,1");
        if (!empty($result))
            return DB::select($selectQuery . " LIMIT 0,1")[0];

        return null;

    }

    private function GetFilterString($item, $searchParams, $sortIndex = "", $sortDirection = "", $customWhere = "", $CustomGroup = "")
    {
        return $this->GetFilterStringCommon($item, $searchParams, $sortIndex, $sortDirection, $customWhere, $CustomGroup);
    }

    private function GetFilterStringCommon($item, $searchParams, $sortIndex = "", $sortDirection = "", $customWhere = "", $CustomGroup = "", $IsMultiSort = false, $sortArray = null, $IsForCount = false)
    {
        $class = $this->GetReflectionClass($item);
        $tableName = $class->getProperty('table')->getValue($item);
        $modelPropTypes = $class->getProperty('Model_Types')->getValue($item);
        $select = ($IsForCount ? "SELECT COUNT(*) AS cnt FROM " : "SELECT * FROM ") . $tableName;
        $where = "";

        if (!empty($searchParams) && count($searchParams) > 0) {
            $where .= " WHERE 1=1";
            foreach ($searchParams as $val) {
                $Value = addslashes($val->Value);
                $Name = $val->Name;
                $CheckStartWith = $val->CheckStartWith;
                $propertyType = $modelPropTypes[$Name];
                if ($propertyType == 'string') {
                    if (!empty($CheckStartWith) && $CheckStartWith != 1)
                        $where .= " AND " . $Name . " LIKE '" . $Value . "%'";
                    else if (!empty($CheckStartWith) && $CheckStartWith)
                        $where .= " AND " . $Name . " LIKE '" . $Value . "'";
                    else
                        $where .= " AND " . $Name . " LIKE '%" . $Value . "%'";
                } else if ($propertyType == 'bool') {
                    $where .= " AND " . $Name . "=" . $Value;
                } else if ($propertyType == 'int' || $propertyType == 'long') {
                    $where .= " AND " . $Name . "=" . $Value;
                } else if ($propertyType == 'DateTime') {

                    /*
                    if (searchParam.Count(a => a.Name == val.Name) > 1)
                    {
                        $where .= " AND ((" . $Name . " BETWEEN " . searchParam.First(a => a.Name == val.Name).Value + " AND " + searchParam.Last(a => a.Name == val.Name).Value + ") OR (" + val.Name + " BETWEEN " + searchParam.Last(a => a.Name == val.Name).Value + " AND " + searchParam.First(a => a.Name == val.Name).Value + "))";
                    }
                    else
                    {
                        $where .= " AND " . $Name . "='" . $Value . "'";
                    }

                    */


                }
            }
        }

        //TODO: Check below function is working or not for customwhere.
        //$customWhere = addslashes($customWhere);
        $where .= $customWhere != "" ? empty($where) ? " WHERE (" . $customWhere . ")" : " AND (" . $customWhere . ")" : "";

        if ($CustomGroup)
            $where .= " GROUP BY  " . $CustomGroup;
        if (!$IsMultiSort && $sortIndex != "")
            $where .= " ORDER BY " . $sortIndex . " " . $sortDirection;
        else if ($IsMultiSort && !empty($sortArray) && count($sortArray) > 0) {
            $where .= " ORDER BY ";
            foreach ($sortArray as &$val) {
                $where .= $val->Index . " " . $val->Direction . ",";
            }
            $where = rtrim($where, ',');
        }
        $where = str_replace("1=1 AND", "", $where);
        $where = str_replace("1=1", "", $where);
        return $select . $where;
    }

    public function GetEntityList($item, $searchParams, $sortIndex = "", $sortDirection = "", $customWhere = "", $CustomGroup = "")
    {
        $selectQuery = $this->GetFilterString($item, $searchParams, $sortIndex, $sortDirection, $customWhere, $CustomGroup);
        return DB::select($selectQuery);
    }

    public function GetEntityListWithMultiSort($item, $searchParams, $SortArray, $customWhere = "")
    {
        $selectQuery = $this->GetFilterStringForMultiSort($item, $searchParams, $SortArray, $customWhere);

        return DB::select($selectQuery);
    }

    private function GetFilterStringForMultiSort($item, $searchParams, $sortArray, $customWhere = "", $CustomGroup = "")
    {
        return $this->GetFilterStringCommon($item, $searchParams, "", "", $customWhere, $CustomGroup, true, $sortArray);
    }

    public function GetEntityListBySP($spname, $searchParamArray = null)
    {
        $spString = GetSPString($spname, $searchParamArray);
        return DB::select($spString);
    }

    public function GetPageInStoredProcResultSet($item, $pageIndex, $pageSize, $count, $itemsList)
    {
        $pageModel = new PageModel();
        $pageModel->CurrentPage = $pageIndex;
        $pageModel->TotalItems = $count;
        $pageModel->TotalPages = $count / $pageSize;
        $pageModel->ItemsPerPage = $pageSize;

        if (($pageModel->TotalItems % $pageSize) != 0)
            $pageModel->TotalPages = $pageModel->TotalPages + 1;

        $pageModel->Items = $itemsList;
        return $pageModel;
    }

    public function RunQueryStatementWithPagination($selectQuery, $pageIndex, $pageSizeCount, $sortIndex = "", $sortDirection = "")
    {
        $selectQry = explode("FROM", $selectQuery, 2);
        if ($sortIndex != "" && $sortDirection != "")
            $selectQuery .= " ORDER BY " . $sortIndex . " " . $sortDirection;
        $TotalRecords = 0;
        if ($pageSizeCount != Constants::$AllRecords) {
            $selectQueryWithPaging = $selectQuery . " LIMIT " . ($pageIndex - 1) * $pageSizeCount . "," . $pageSizeCount . "";
            $countSelectQuery = str_replace($selectQry[0], "SELECT Count(*) as TotalItems ", $selectQuery);
            $records = DB::select($countSelectQuery);
            if(count($records) > 0)
                $TotalRecords = DB::select($countSelectQuery)[0]->TotalItems;
            else
                $TotalRecords = 0;

        } else {
            $selectQueryWithPaging = $selectQuery;
        }

        $items = DB::select($selectQueryWithPaging);
        if ($pageSizeCount == Constants::$AllRecords)
            $TotalRecords = count($items);
        $pageModel = new PageModel();
        $pageModel->CurrentPage = $pageIndex;
        $pageModel->TotalItems = $TotalRecords;
        $pageModel->ItemsPerPage = $pageSizeCount;
        $pageModel->TotalPages = ceil($pageModel->TotalItems / $pageModel->ItemsPerPage);
        $pageModel->Items = $items;
        return $pageModel;
    }

    public function GetEntityWithPaging($item, $searchParams, $pageIndex, $pageSizeCount, $sortIndex = "", $sortDirection = "", $customWhere = "", $CustomGroup = "")
    {

        $selectQuery = $this->GetFilterString($item, $searchParams, $sortIndex, $sortDirection, $customWhere, $CustomGroup);

        if ($CustomGroup) {
            $countSelectQuery = str_replace("* FROM", "Count(*) as TotalItems  FROM ( select * FROM ", $selectQuery . ") AS Items");
        } else {
            $countSelectQuery = str_replace("*", "Count(*) as TotalItems", $selectQuery);

        }

        $selectQueryWithPaging = $selectQuery . " LIMIT " . ($pageIndex - 1) * $pageSizeCount . "," . $pageSizeCount . "";
        $pageModel = new PageModel();
        $pageModel->CurrentPage = $pageIndex;
        $pageModel->TotalItems = DB::select($countSelectQuery)[0]->TotalItems;//$selectQuery->count();
        $pageModel->ItemsPerPage = $pageSizeCount;
        $pageModel->TotalPages = ceil($pageModel->TotalItems / $pageModel->ItemsPerPage);
        $pageModel->Items = DB::select($selectQueryWithPaging);
        return $pageModel;
    }

    public function GetEntityListWithMultiSortWithPaging($item, $searchParams, $pageIndex, $pageSizeCount, $SortArray, $customWhere = "", $CustomGroup = "")
    {
        $selectQuery = $this->GetFilterStringForMultiSort($item, $searchParams, $SortArray, $customWhere, $CustomGroup);

        $countSelectQuery = str_replace("*", "Count(*) as TotalItems", $selectQuery);
        $queryData = DB::select($countSelectQuery);
        if ($queryData)
            $totalItems = $queryData[0]->TotalItems;
        else
            $totalItems = 0;
        if ($pageSizeCount == Constants::$AllRecords) {
            $pageSizeCount = $totalItems > 0 ? $totalItems : Constants::$DefaultPageSize;
        }
        $selectQueryWithPaging = $selectQuery . " LIMIT " . ($pageIndex - 1) * $pageSizeCount . "," . $pageSizeCount . "";

        $pageModel = new PageModel();
        $pageModel->CurrentPage = $pageIndex;

        $pageModel->TotalItems = $totalItems;
        $pageModel->ItemsPerPage = $pageSizeCount;
        $pageModel->TotalPages = ceil($pageModel->TotalItems / $pageModel->ItemsPerPage);
        $pageModel->Items = DB::select($selectQueryWithPaging);
        return $pageModel;
    }

    public function GetEntityWithPagingDistinctCount($item, $searchParams, $pageIndex, $pageSizeCount, $sortIndex = "", $sortDirection = "", $customWhere = "", $CustomGroup = "")
    {
        $selectQuery = $this->GetFilterString($item, $searchParams, $sortIndex, $sortDirection, $customWhere, $CustomGroup);
        $countSelectQuery = str_replace("*", "COUNT(*) TotalItems FROM (SELECT " . $CustomGroup, $selectQuery) . ') AS a';
        $selectQueryWithPaging = $selectQuery . " LIMIT " . ($pageIndex - 1) * $pageSizeCount . "," . $pageSizeCount . "";

        $pageModel = new PageModel();
        $pageModel->CurrentPage = $pageIndex;
        $pageModel->TotalItems = DB::select($countSelectQuery)[0]->TotalItems;//$selectQuery->count();
        $pageModel->ItemsPerPage = $pageSizeCount;
        $pageModel->TotalPages = ceil($pageModel->TotalItems / $pageModel->ItemsPerPage);
        $pageModel->Items = DB::select($selectQueryWithPaging);

        return $pageModel;
    }

    public function GetEntityListWithDistinctCount($item, $searchParams, $sortIndex = "", $sortDirection = "", $customWhere = "", $CustomGroup = "")
    {
        $selectQuery = $this->GetFilterString($item, $searchParams, $sortIndex, $sortDirection, $customWhere, $CustomGroup);
        $countSelectQuery = str_replace("*", "* FROM (SELECT " . $CustomGroup, $selectQuery) . ') AS a';
        return DB::select($selectQuery);
    }

    public function GetEntityCount($item, $searchParams, $sortIndex = "", $sortDirection = "", $customWhere = "")
    {
        $selectQuery = $this->GetFilterStringForCount($item, $searchParams, $sortIndex, $sortDirection, $customWhere);
        $result = DB::select($selectQuery . " LIMIT 0,1");
        return intval($result[0]->cnt);
    }

    private function GetFilterStringForCount($item, $searchParams, $sortIndex = "", $sortDirection = "", $customWhere = "", $CustomGroup = "")
    {
        return $this->GetFilterStringCommon($item, $searchParams, "", "", $customWhere, $CustomGroup, false, null, true);
    }

    public function FindOrNewEntity($entity, $columnValue)
    {
        $resultEntity = $entity::findOrNew($columnValue);
        return $resultEntity;
    }

    public function FirstOrNewEntityByKey($entity, $key, $keyValue)
    {
        $resultEntity = $entity::firstOrNew([$key => $keyValue]);
        return $resultEntity;
    }

    public function FillDataEntity($entity, $data)
    {
        $resultEntity = $entity->fill((array)$data);
        return $resultEntity;
    }

    public function GenerateGameCode($userID)
    {
        $code = $userID . uniqid(md5(microtime()));
        return $code;
    }

    private function GetSPString($spname, $searchParamsArray)
    {
        $sp = "CALL " . $spname . "(";

        for ($x = 0; $x < count($searchParamsArray); $x++) {
             $sp = $sp . " '" . addslashes($searchParamsArray[$x]) . "',";
        }
        $sp = rtrim($sp, ',');
        return $sp . ")";
    }

    /* To get multiple result data set using Stored Procedure */
    public function CallRaw($procName, $parameters = null, $isExecute = false)
    {
        $syntax = '';
        for ($i = 0; $i < count($parameters); $i++) {
            $syntax .= (!empty($syntax) ? ',' : '') . '?';
        }
        $syntax = 'CALL ' . $procName . '(' . $syntax . ');';

        $pdo = DB::connection()->getPdo();
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
        $stmt = $pdo->prepare($syntax,[\PDO::ATTR_CURSOR=>\PDO::CURSOR_SCROLL]);
        for ($i = 0; $i < count($parameters); $i++) {
            $stmt->bindValue((1 + $i), $parameters[$i]);
        }
        $exec = $stmt->execute();
        if (!$exec) return $pdo->errorInfo();
        if ($isExecute) return $exec;

        $results = [];

        do {
            try {
                $results[] = $stmt->fetchAll(\PDO::FETCH_OBJ);
            } catch (\Exception $ex) {

            }
        } while ($stmt->nextRowset());

       if (1 === count($results))
            return $results[0];
        else if( count($results) > 1)
        {
            $results[0] =  $results[0][0];
        }

        /*if( count($results) >= 1)
            $results[0] =  $results[0][0];*/

        return $results;
    }

    public function GetPageRecordsUsingSP($procName,$pageIndex,$pageSize, $parameters = null)
    {
        $items = $this->CallRaw($procName, $parameters);
        $totalItemsCount = 0;

        if (!empty($items) && count($items) > 0) {
            $totalItemsCount = $items[0]->{Constants::$TotalItemsCountColumn};
        }

        $results = new stdClass();
        $results->CurrentPage = $pageIndex;
        $results->ItemsPerPage = $pageSize;
        $results->Items = $items;
        $results->TotalItems = intval($totalItemsCount);
        return $results;
    }
}