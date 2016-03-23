app.controller("UserListController",function($scope,$http){

    $scope.UserListURL = baseUrl+'/getuserlist'; // For URL
    $scope.EditUserURL = baseUrl+'/add/';

    $scope.UserList = []; //Define a blank Array

    $scope.ListModel = $.parseJSON($("#ListModel").val());

    $scope.ListPager = new PagerModule("LastName");//create a variable Listpager and set sortIndex userID by default into PagerModule function
    $scope.UserInfoList = function(){ //Create a new UserListInfo function
        var pagermodel = { //Define and bind all value related to pagination,sorting and searching
            SearchParams: $scope.ListModel.backSearchModel,
            PageSize: $scope.ListPager.pageSize,
            PageIndex: $scope.ListPager.currentPage,
            SortIndex: $scope.ListPager.sortIndex,
            SortDirection: $scope.ListPager.sortDirection
        };
        var postData = {};
        postData.Data = $scope.UserList;
        var jsonData = angular.toJson({Data:pagermodel});//default data bind with pagermodel
        AngularAjaxCall($http, $scope.UserListURL, jsonData, 'POST', 'json', 'application/json').success(function (response) {
            if (response.IsSuccess) {
                $scope.UserList = response.Data.Items; //bind all data into UserList
                $scope.ListPager.totalRecords = response.Data.TotalItems; //bind total records into ListPager.totalRecords
            }
        });
    };

    //For search records
    $scope.SearchUserRecords = function () {
        CopyProperties($scope.ListModel.frontSearchModel, $scope.ListModel.backSearchModel);
        $scope.ListPager.currentPage = 1;
        $scope.UserInfoList();
    };

    $scope.ListPager.getDataCallback = $scope.UserInfoList; // call function UserInfoList

    $scope.ListPager.getDataCallback(); // call getDataCallback function

    /* For Edit User Link set*/
    $scope.EditUser = function(Data) {
        location.href =  $scope.EditUserURL+Data.EncryptedUserID;
    }

});