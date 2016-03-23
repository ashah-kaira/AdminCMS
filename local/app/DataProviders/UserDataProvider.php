<?php
namespace DataProviders;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Security\Core\Role\Role;
use \ViewModels\ServiceResponse;
use \ViewModels\SearchValueModel;
use \Infrastructure\Constants;
use \Infrastructure\Common;
use \stdClass;
use \DateTime;
use \DateInterval;
use \Crypt;
use \Mail;
use \Authentication;
use \UserEntity;
use \RoleEntity;
use \StatusEntity;

class UserDataProvider extends BaseDataProvider implements IUserDataProvider {
	
	public function getUserDetail($userID){
        $response = new ServiceResponse();
        $isEditMode = $userID>0;
        $model = new StdClass();
        $userModel = new StdClass();

        $result = $this->CallRaw('userdetails',[$isEditMode]);
        $userModel->RoleArray = $result[0];
        $userModel->StatusArray = $result[1];
        if($isEditMode = $userID>0)
            $userModel->UserDetails = $result[2];
        $model->UserModel = $userModel;
        $response->Data=$model;
        return $response;

    }

    public function SaveUser($userModel){
        $response = new ServiceResponse();

        $messages = array(
            'required' => trans('messages.PropertyRequired'),
            'min' => trans('messages.PropertyMin'),
            'max' => trans('messages.PropertyMax')
        );

        $userEntity = new UserEntity();
        $isEditMode = $userModel->UserID > 0;

        $validator = Validator::make((array)$userModel, $isEditMode ? $userEntity::$Add_rules : $userEntity::$Add_rules, $messages);
        $validator->setAttributeNames($userEntity::$niceNameArray);
        if ($validator->fails()) {
            $response->Message = Common::getValidationMessagesFormat($validator->messages());
            return $response;
        }

        $searchParams = array();
        $searchValueData = new SearchValueModel();
        $searchValueData->Name ="Email";
        $searchValueData->Value = Common::GetDataWithTrim($userModel->Email);
        $searchValueData->CheckStartWith = Constants::$CheckStartWith;
        array_push($searchParams, $searchValueData);

        if ($isEditMode) {
            $customWhere = "UserID NOT IN ($userModel->UserID)";
        } else {
            $customWhere = "";
        }

        $checkUniquePlan = $this->GetEntityCount($userEntity, $searchParams, "", "", $customWhere);
        if ($checkUniquePlan == 0) {

            $dateTime = date(Constants::$DefaultDateTimeFormat);
            if ($isEditMode) {
                $userEntity = $this->GetEntityForUpdateByPrimaryKey($userEntity, $userModel->UserID);

            }
            $userEntity->FirstName = Common::GetDataWithTrim($userModel->FirstName);
            $userEntity->LastName = $userModel->LastName;
            $userEntity->Email = $userModel->Email;
            $userEntity->City = $userModel->City;
            $userEntity->Gender = $userModel->Gender;

            if(isset($userModel->DOB))
                $userEntity->DOB = $userModel->DOB;

            if(isset($userModel->ActiveDateTime))
                $userEntity->ActiveDateTime = $userModel->ActiveDateTime;

            if(isset($userModel->ConfirmPassword))
                $userEntity->Password = $userModel->ConfirmPassword;

            if(isset($userModel->IsDummy))
                $userEntity->IsDummy = $userModel->IsDummy;

            if(isset($userModel->RoleID))
                $userEntity->RoleID = $userModel->RoleID;

            if (!$isEditMode) {
                $userEntity->CreatedDate = $dateTime;
            }
            $userEntity->ModifiedDate = $dateTime;

            if ($this->SaveEntity($userEntity)) {
                $response->IsSuccess = false;
            } else {
                $response->Message = trans('messages.ErrorOccured');
            }
            if (!$isEditMode) {
                $response->Message = trans('messages.UserCreationSuccess');
            } else {
                $response->Message = trans('messages.UserUpdateSuccess');
            }
        }
        else {
                $response->Message ="'". Common::GetDataWithTrim($userModel->Email)."' ".trans('messages.EmailAlreadyExist');
            }
            return $response;
    }


    /*Start Region Dev_Vishal*/

    public function getSearchModelForUserList(){
        $response = new ServiceResponse();

        $statusData = $this->GetEntityList(new StatusEntity(),array());
        $allStatus = new StatusEntity();
        $allStatus->StatusID = Constants::$AllStatusValue;
        $allStatus->Status = Constants::$AllStatusText;
        array_unshift($statusData,$allStatus);

        $roleData = $this->GetEntityList(new RoleEntity(),array());
        $allRoles = new RoleEntity();
        $allRoles->RoleID = Constants::$AllRolesValue;
        $allRoles->Role = Constants::$AllRolesText;
        array_unshift($roleData,$allRoles);

        $searchModel = new stdClass();
        $searchModel->LastName = "";
        $searchModel->Email = "";
        $searchModel->StatusID =Constants::$AllStatusValue;
        $searchModel->RoleID =Constants::$AllRolesValue;

        $model = new stdClass();

        $model->StatusLookup = $statusData;

        $model->rolesLookup = $roleData;

        $model->frontSearchModel = $searchModel;

        $model->backSearchModel = $searchModel;

        $response->Data=$model;

        return $response;
    }



    public function getUserInfoList($userData){

        $response = new ServiceResponse();
        if(empty($userData->SortIndex)){
            $userData->SortIndex = Constants::$SortIndex;
        }
        if(empty($userData->SortDirection)){
            $userData->SortDirection = Constants::$SortIndexASC;
        }
        $sortIndex = $userData->SortIndex;
        $sortDirection = $userData->SortDirection;
        $pageIndex = $userData->PageIndex;
        $pageSizeCount = $userData->PageSize = Constants::$UserPagerSize;

        $searchLastName = '';
        $searchEmail = '';
        $searchStatus = '';
        $searchRoles = '';

        if(isset($userData->SearchParams)){

            if(!empty($userData->SearchParams['LastName'])){
                $searchLastName = $userData->SearchParams['LastName'];
            }
            if(!empty($userData->SearchParams['Email'])){
                $searchEmail = $userData->SearchParams['Email'];
            }
            if(!empty($userData->SearchParams['StatusID'])){
                $searchStatus = $userData->SearchParams['StatusID'];
            }
            if(!empty($userData->SearchParams['RoleID'])){
                $searchRoles = $userData->SearchParams['RoleID'];
            }
        }

        $userList = $this->GetPageRecordsUsingSP('userlist',$pageIndex,$pageSizeCount, [$searchLastName,$searchEmail,$searchStatus,$searchRoles,$pageIndex,$pageSizeCount,$sortIndex,$sortDirection]);


        if(is_null($userList)){
            $response->Message = trans('messages.NoRecordFound');
        }else{
            $response->IsSuccess = true;
            $response->Data = $userList;
        }
        return $response;
    }

    /*Stop Region Dev_Vishal*/


}