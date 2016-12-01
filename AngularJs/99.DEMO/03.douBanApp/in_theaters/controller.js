/**
 * Created by dllo on 16/12/1.
 */

//------------------正在热映--------------------
//自执行函数
//里面的变量不会影响全局
(function (angular) {
    //启用严格模式
    "use strict";

    angular.module("douban.in_theaters",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/in_theaters",{
            templateUrl: "./in_theaters/view.html",
            controller: "in_theatersController"
        })
    }]).controller("in_theatersController",["$scope","$http",function ($scope,$http) {
        $http.get("./data.json").success(function (data) {
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