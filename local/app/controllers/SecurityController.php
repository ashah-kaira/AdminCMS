<?php
use DataProviders\ISecurityDataProvider;
use \ViewModels\SessionHelper;
use ViewModels\LoginModel;
use ViewModels\ServiceResponse;
use \Infrastructure\Common;
use \Infrastructure\Constants;

class SecurityController extends BaseController  {

	function __construct(ISecurityDataProvider $securityDataProvider){
		$this->securityDataProvider = $securityDataProvider;
	}

    /* RB Region Start */
    public function getUnauthorized(){
        if(!Auth::check()) {
            Auth::logout();
            return Redirect::to('login')->with('SessionExpired',trans('messages.SessionExpired'));
        }
        return View::make('errors.unauthorized');
    }



    public function getLogin(){
        if(!Auth::check()){
            $roleID = SessionHelper::getRoleID();
            if(empty($roleID))
                return View::make('security.login',(array)Session::get('SessionExpired'));
            else {
                return View::make('security.login');
            }
        }
        else{
            return  Redirect::to('dashboard');
        }
    }
    public function getChooseSite(){
        return View::make('security.choosesite');
    }

    public function postAuthenticate(){
        $serviceRequest = $this->GetObjectFromJsonRequest(Input::json()->all());
        $serviceResponse = $this->securityDataProvider->AuthenticateUser($serviceRequest->Data);

        if (!empty($serviceResponse->Data->roleList)) {
            foreach ($serviceResponse->Data->roleList as $key => $siteValue) {
                $EncryptSiteID = Constants::$QueryStringSiteID . '=' . $siteValue->SiteID;
                $siteValue->EncryptSiteID = Common::getEncryptDecryptID('encrypt', $EncryptSiteID);
            }
        }

        if (!empty($serviceResponse->Data->roleList)) {
            SessionHelper::setUserSiteList($serviceResponse->Data->roleList);
        }

        $userLoginChecked = Auth::User();
        if(!empty($userLoginChecked)) {
            $sessionCheckURL = SessionHelper::getRedirectURL();
            if(!empty($sessionCheckURL)){
                $serviceResponse->redirectURL = $sessionCheckURL;
            }else{
                if($serviceResponse->Data->redirectToChooseSite == Constants::$Value_True){
                    $serviceResponse->redirectURL = URL::to('/') . '/choosesite';
                }else{
                    $serviceResponse->redirectURL = URL::to('/') . '/dashboard/'.$serviceResponse->Data->roleList[0]->EncryptSiteID;
                }
            }
        }
        return $this->GetJsonResponse($serviceResponse);
    }

    public function postSendVerificationEmail(){
        $serviceRequest = $this->GetObjectFromJsonRequest(Input::json()->all());
        $serviceResponse = $this->securityDataProvider->SendVerificationEmail($serviceRequest->Data);
        return $this->GetJsonResponse($serviceResponse);
    }
    

    public function getLogout(){
        Auth::logout();
        SessionHelper::SessionFlush();
        return Redirect::to('login');
    }

    public function  getSendforgotpassword(){
        if(!Auth::check()){
            return View::make('security.sendforgotpassword');
        }
        else{
            return  Redirect::to('dashboard');
        }
    }
    /* Rb Region End*/

    

}