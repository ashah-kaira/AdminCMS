<?php namespace ViewModels;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Session;
use \stdClass;

class SessionHelper
{

    public static function setUserSiteList($UserSiteList){
        Session::put('UserSite',$UserSiteList);
    }

    public static function getUserSiteList(){
        return Session::get('UserSite');
    }




    public static function setRoleID($RoleID){
        Session::put('RoleID',$RoleID);
    }

    public static function getRoleID(){
        return 	Session::get('RoleID');
    }

    public static function setCompanyName($CompanyName){
        Session::put('CompanyName',$CompanyName);
    }

    public static function getCompanyName(){
        return 	Session::get('CompanyName');
    }


    public static function forgetUserProjectList(){
        return Session::forget('UserProjects');
    }

    public static function setRedirectURL($RedirectURL){
        Session::put('RedirectURL',$RedirectURL);
    }

    public static function getRedirectURL(){
        return 	Session::get('RedirectURL');
    }

    public static function RemoveSessionForgetURL(){
        return  Session::forget('RedirectURL');
    }

    public static function SessionFlush(){
        Session::flush();
    }
}
?>