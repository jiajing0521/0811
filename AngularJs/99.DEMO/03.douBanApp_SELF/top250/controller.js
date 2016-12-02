/**
 * Created by dllo on 16/12/1.
 */
//------------------TOP250--------------------
//自执行函数
//里面的变量不会影响全局
(function (angular) {
    //启用严格模式
    "use strict";

    angular.module("douban.top250",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/top250",{
            templateUrl: "./top250/view.html",
            controller: "top250Controller"
        })
    }]).controller("top250Controller",["$scope","$http",function ($scope,$http) {
        $http.get("./data_top250.json").success(function (data) {
            console.log(data.subjects);
            $scope.movies = data.subjects;
            $scope.total = data.total;
            $scope.count = data.count;
            $scope.pages = [];
            for (var i = 0; i < Math.ceil(data.total/data.count); i++){
                $scope.pages.push(i+1);
            }
            console.log($scope.pages);
        })
    }])

})(angular);