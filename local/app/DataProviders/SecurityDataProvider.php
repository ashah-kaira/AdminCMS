<?php
namespace DataProviders;

namespace DataProviders;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Security\Core\User\User;
use \UserEntity;
use \ViewModels\ServiceResponse;
use \Infrastructure\Constants;
use \Infrastructure\Common;
use \stdClass;
use \DateTime;
use \DateInterval;
use \Crypt;
use \URL;
use \Mail;
use \ViewModels\SearchValueModel;
use File;
use Illuminate\Support\Facades\DB;
use RoleEntity;
use SitesEntity;

class SecurityDataProvider extends BaseDataProvider implements ISecurityDataProvider {

    /* RB Region Start */
    public function AuthenticateUser($loginModel){
        $response = new ServiceResponse();
        $authModel=new StdClass();

        $messages = array(
            'required' => trans('messages.PropertyRequired')
        );

        $validator = Validator::make((array)$loginModel, array('Email'=>'required|email','Password'=>'required'),$messages);
        $validator->setAttributeNames(UserEntity::$niceNameArray);
        if ($validator->fails()){
            $response->Message = Common::getValidationMessagesFormat($validator->messages());
            return $response;
        }

        $hashedPassword = md5($loginModel->Password);

        $loggedUserResults = $this->CallRaw('loginusers',[$loginModel->Email,$hashedPassword]);

        if(is_null($loggedUserResults)){
            $response->Message = trans('messages.ErrorOccured');
        }else{
            switch ($loggedUserResults[0]->LoginStatus) {
                case Constants::$LoginNotFound:
                    $response->Message = trans('messages.InvalidUserNamePassword');
                    break;
                case Constants::$UserStatusPending:
                    $response->Message = trans('messages.UserStatusPending');
                    $authModel->PendingUserID = intval($loggedUserResults[1][0]->PendingUserID);
                    $authModel->IsPending = Constants::$Value_True;
                    break;
                case Constants::$UserStatusDisable:
                    $response->Message = trans('messages.UserStatusDisable');
                    break;
                case Constants::$UserHaveNoRole:
                    $response->Message = trans('messages.UserHaveNoRole');
                    break;
                case Constants::$UserStatusActiveWithOneSiteAccess:
                case Constants::$UserStatusActive:
                    $userDetails = Common::getEloquentModel(new UserEntity(),$loggedUserResults[1][0]);
                    $authModel->roleList = $loggedUserResults[2];
                    Auth::login($userDetails);

                    $response->Message = trans('messages.LoginSuccess');
                    $response->IsSuccess = true;
                    break;
                case Constants::$LoginError:
                    $response->Message = trans('messages.ErrorOccured');
                    break;
            }
        }

        $authModel->redirectToChooseSite = $loggedUserResults[0]->LoginStatus == Constants::$UserStatusActive ?  Constants::$Value_True: Constants::$Value_False;
        $response->Data = $authModel;

        return $response;
    }

    public function SendVerificationEmail($userID){
        $response = new ServiceResponse();
        $verificationModel = new StdClass();

        $searchParams=Array();

        $searchValueData=new SearchValueModel();
        $searchValueData->Name="UserID";
        $searchValueData->Value=$userID;
        array_push($searchParams, $searchValueData);

        $pendingUserDetails = $this->GetEntity(new UserEntity(),$searchParams);
        $emailData = new stdClass();
        $emailData->FirstName = $pendingUserDetails->FirstName;
        $data = (array)$emailData;
        $LastSendEmail = common::SendEmail(Constants::$Email_VerificationEmail,$data, Constants::$Email_VerificationEmailSubject,$pendingUserDetails->Email, "", "");
        Common::MailsToSend($maxFailedAttempts = 0,$LastSendEmail);

        $response->IsSuccess = true;
        $verificationModel->IsPendingSuccess = Constants::$Value_True;
        $response->Data = $verificationModel;
        $response->Message = trans('messages.ForgotEmailSent');
        return $response;
    }

    /* RB Region End */
}