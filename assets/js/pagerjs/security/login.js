app.controller('SecurityController',function($scope,$http){

    $scope.AuthenticateUserURL = baseUrl+'/authenticate';
    $scope.SendVerificationCodeURL = baseUrl+'/verification';
    $scope.RedirectURL = baseUrl+'/login';

    $scope.LoginModel = {
        Email : "",
        Password : ""
        //IsPending:""
    };

    $scope.Login = function() {
        var postData = {};
        postData.Data = $scope.LoginModel;
        var jsonData = angular.toJson(postData);
        if ($scope.loginForm.$valid) {
            AngularAjaxCall($http, $scope.AuthenticateUserURL, jsonData, 'POST', 'json', 'application/json').success(function (response) {
                if (response.IsSuccess) {
                    SetMessageForPageLoad(response.Message);
                    location.href = response.redirectURL;
                }
                else if(response.Data.IsPending != undefined && response.Data.IsPending != '' && response.Data.PendingUserID !=undefined && response.Data.PendingUserID !='' ) {
                    $scope.LoginModel.IsPending = response.Data.IsPending;
                    $scope.LoginModel.PendingUserID = response.Data.PendingUserID;
                }
                else{
                    $scope.LoginModel.IsPendingSuccess =0;
                    ShowAlertMessage(response.Message, 'error', window.ConfirmDialogSomethingWrong);

                }
            });
        }
    }


    $scope.SendVerificationEmail = function() {
        var postData = {};
        postData.Data = $scope.LoginModel.PendingUserID;
        var jsonData = angular.toJson(postData);
        if ($scope.loginForm.$valid) {
            AngularAjaxCall($http, $scope.SendVerificationCodeURL, jsonData, 'POST', 'json', 'application/json').success(function (response) {
                if (response.IsSuccess) {
                    if(response.Data.IsPendingSuccess != undefined){
                        $scope.LoginModel.IsPendingSuccess = response.Data.IsPendingSuccess;
                        $scope.LoginModel.IsPending = 0;
                    }
                }
                else {
                    ShowAlertMessage(response.Message, 'error', window.ConfirmDialogSomethingWrong);
                }
            });
        }
    }

});