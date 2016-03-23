var vm;
app.controller('UserController',function($scope,$http){
    vm=$scope;

    /* Redirect or Post Call URL */
    $scope.RegistrationURL = baseUrl+'/saveuser';
    $scope.RedirectURL = baseUrl + '/add';

    $scope.UserModel = $.parseJSON($("#UserModel").val());
    $scope.RoleArray = $scope.UserModel.RoleArray;
    $scope.StatusArray = $scope.UserModel.StatusArray;
    $scope.UserModel = $scope.UserModel.UserDetails;
    $scope.disabled = false;
    if($scope.UserModel == undefined)
        $scope.disabled = true;

    /* For Save Form Data */
    $scope.Save = function () {
        var postData = {};
        postData.Data = $scope.UserModel;

        var jsonData = angular.toJson(postData);
        if($scope.RegistrationForm.$valid){
            AngularAjaxCall($http, $scope.RegistrationURL, jsonData, 'POST', 'json', 'application/json').success(function (response) {
                if (response.IsSuccess) {
                    SetMessageForPageLoad(response.Message);
                    window.location.href = $scope.RedirectURL;
                } else {
                    ShowAlertMessage(response.Message, 'error', window.ConfirmDialogSomethingWrong);
                }
            });
        }
    }

});

