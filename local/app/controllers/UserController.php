<?php
use DataProviders\IUserDataProvider;

use ViewModels\LoginModel;
use \Infrastructure\Common;
use \Infrastructure\Constants;
use \ViewModels\SessionHelper;
use Illuminate\Support\Facades\Session;
use ViewModels\ServiceRequest;
use ViewModels\ServiceResponse;


class UserController extends BaseController {

	function __construct(IUserDataProvider $userDataProvider){
		$this->DataProvider = $userDataProvider;
	}
	
	public function getAddUser($encryptedUserID  = 0)
    {
        $isEditMode = false;
        if ($encryptedUserID) {
            $isEditMode = true;
        }
        if ($isEditMode) {
            $decryptUserID = Common::getEncryptDecryptValue('decrypt', $encryptedUserID);
            $userID = Common::getExplodeValue($decryptUserID, Constants::$QueryStringUserID);
        } else {
            $userID = 0;
        }
        $serviceResponse = $this->DataProvider->getUserDetail($userID);
        return View::make('adduser',(array)$serviceResponse->Data);
	}

    public function postSaveUser(){
        $serviceRequest = $this->GetObjectFromJsonRequest(Input::json()->all());
        $serviceResponse = $this->DataProvider->SaveUser($serviceRequest->Data);
        return $this->GetJsonResponse($serviceResponse);
    }


	/*Start Region Dev_Vishal*/

	public function getUserList(){
        $searchModelResponse = $this->DataProvider->getSearchModelForUserList();
        $model = new stdClass();
        $model->ListModel = $searchModelResponse->Data;
		return View::make('userlist',(array)$model);
	}

	//For Get Pagination HTML File
	public function getPagination(){
		return View::make('dirPagination');
	}

	public function postUserList(){

        $serviceRequest = $this->GetObjectFromJsonRequest(Input::json()->all());
        $serviceResponse = $this->DataProvider->getUserInfoList($serviceRequest->Data);

        if (!empty($serviceResponse->Data->Items)){
            foreach ($serviceResponse->Data->Items as $userDetails) {
                $encryptedUserID = Constants::$QueryStringUserID . '=' . $userDetails->UserID;
                $userDetails->EncryptedUserID = Common::getEncryptDecryptID('encrypt', $encryptedUserID);
            }
        }
		return $this->GetJsonResponse($serviceResponse);
	}

	/*Stop Region Dev_Vishal*/
   
}