<?php 
namespace DataProviders;

Interface IUserDataProvider{

    /*Start Region Dev_Vishal*/
    public function getUserInfoList($userData);
    public function getSearchModelForUserList();
    /*Stop Region Dev_Vishal*/


    /*Ayushi Start*/

    public function getUserDetail($userID);

    /*Ayushi End*/

}
