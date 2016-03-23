<?php 
namespace DataProviders;

Interface ISecurityDataProvider {

    public function AuthenticateUser($loginModel);
    public function SendVerificationEmail($userID);
}
