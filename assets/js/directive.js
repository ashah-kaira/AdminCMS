app.directive('datepicker', function () {
    return {
        restrict: 'A',
        scope: {
            ngDateval: "=",
            ngMaxdate: "="
        },
        link: function (scope, element, attrs) {
            console.log("Datepicker linked");
            $(element).datetimepicker(
                {
                    format: 'MM/DD/YYYY',
                    maxDate: scope.ngMaxdate
                }
            );

            $(element).on("dp.change", function (e) {
                //scope.ngDateval = "2015/01/01";
                if (e.date) {
                    scope.ngDateval = e.date.format();
                } else {
                    scope.ngDateval = null;
                }
                if (!scope.$root.$$phase) {
                    scope.$apply();
                }
            });

            scope.$watch('ngMaxdate', function (value, oldvalue) {
                if (value != null && new Date(value) != 'Invalid Date') {
                    $(element).data("DateTimePicker").maxDate(value);
                }
                else {
                    $(element).data("DateTimePicker").maxDate(false);
                }
            });

            scope.$watch(attrs.datepicker, function (value, oldvalue) {
                $(element).data("DateTimePicker").date(new Date(value));
            });

            if (scope.ngDateval) {
                $(element).data("DateTimePicker").date(new Date(scope.ngDateval));
            }

        }
    };
});

app.directive('datetimepicker', function () {
    return {
        restrict: 'A',
        scope: {
            ngDateval: "=",
            ngMaxdate: "=",
            ngMindate: "="
        },
        link: function (scope, element, attrs) {
            console.log("Datepicker linked");
            $(element).datetimepicker(
                {
                    format: 'MM/DD/YYYY HH:mm'
                    //maxDate: scope.ngMaxdate
                }
            );
            $(element).on("dp.change", function (e) {
                if (e.date) {
                    var date = new Date(e.date.format());
                    scope.ngDateval = date;
                } else {
                    scope.ngDateval = null;
                }
                if (!scope.$root.$$phase) {
                    scope.$apply();
                }
            });

            scope.$watch('ngMindate', function (value, oldvalue) {
                if (value != null && new Date(value) != 'Invalid Date') {
                    $(element).data("DateTimePicker").minDate(value);
                }
                else {
                    $(element).data("DateTimePicker").minDate(false);
                }
            });
            scope.$watch('ngMaxdate', function (value, oldvalue) {
                if (value != null && new Date(value) != 'Invalid Date') {
                    $(element).data("DateTimePicker").maxDate(value);
                }
                else {
                    $(element).data("DateTimePicker").maxDate(false);
                }
            });

            scope.$watch(attrs.datepicker, function (value, oldvalue) {
                $(element).data("DateTimePicker").date(new Date(value));
            });

            if (scope.ngDateval) {
                //scope.ngDateval.setDate((new Date()).getDate());
                //scope.ngDateval.setMonth((new Date()).getMonth());
                //scope.ngDateval.setFullYear((new Date()).getFullYear());

                $(element).data("DateTimePicker").date(  new Date( moment(scope.ngDateval,'YYYY-MM-DD hh:mm:ss')));
            }

        }
    };
});

app.directive('nxEqualEx', function() {
    return {
        require: 'ngModel',
        link: function (scope, elem, attrs, model) {
            if (!attrs.nxEqualEx) {
                console.error('nxEqualEx expects a model as an argument!');
                return;
            }
            scope.$watch(attrs.nxEqualEx, function (value) {
                // Only compare values if the second ctrl has a value.
                if (model.$viewValue !== undefined && model.$viewValue !== '') {
                    model.$setValidity('nxEqualEx', value === model.$viewValue);
                }
            });
            model.$parsers.push(function (value) {
                // Mute the nxEqual error if the second ctrl is empty.
                if (value === undefined || value === '') {
                    model.$setValidity('nxEqualEx', true);
                    return value;
                }
                var isValid = value === scope.$eval(attrs.nxEqualEx);
                model.$setValidity('nxEqualEx', isValid);
                return value;
            });
        }
    };
});

var PagerModule = function (sortIndex) {

    var $scope = this;
    $scope.getDataCallback = function () {
        alert(window.NotImplementedGetDataCallbackFunction);
    };
    $scope.currentPage = 1;
    $scope.pageSize = window.PageSize ? window.PageSize : 10;
    $scope.totalRecords = 0;
    $scope.sortIndex = sortIndex;
    $scope.sortDirection = "ASC";
    $scope.pageChanged = function (newPage) {
        $scope.currentPage = newPage;
        $scope.getDataCallback();
    };

    $scope.TotalPages = function() {
        return parseInt($scope.totalRecords / $scope.pageSize) + 1;
    };

    //-----------------------------------------CODE FOR SORT-------------------------------------------
    //$scope.predicate = predicate; // coulumn name

    $scope.reverse = true; // asc and desc
    $scope.sortColumn = function (newPredicate) {
        $scope.reverse = ($scope.sortIndex === newPredicate) ? !$scope.reverse : false;
        //$scope.predicate = newPredicate;
        $scope.sortIndex = newPredicate != undefined ? newPredicate : sortIndex;
        $scope.sortDirection = $scope.reverse === true ? "DESC" : "ASC";
        $scope.getDataCallback();
    };
    //-----------------------------------------End CODE FOR SORT-------------------------------------------
};
