var app = angular.module("App", ["ngLoadingSpinner","angularUtils.directives.dirPagination"]);

app.config(function(paginationTemplateProvider){
    paginationTemplateProvider.setPath('dirPagination'); // Set dir-pagination blade or html file path
});
