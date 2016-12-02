/**
 * Created by dllo on 16/12/2.
 */
(function (angular) {
    "use strict";

    angular.module("163App.home",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/home",{
            templateUrl : "./home/view.html",
            controller : "homeController"
        })
    }]).controller("homeController",["$scope","$http",function ($scope,$http) {
        $http.jsonp("http://localhost/GIT_space/0811/99_DEMO/05.163api/163.php?callback=JSON_CALLBACK&type=home").success(function (data) {
            console.log(data);
            //大图滚动图片
            $scope.sliderImg = data.tid[0].ads;
            $scope.news = [];
            for (var i = 1; i < data.tid.length; i++){
                $scope.news.push(data.tid[i]);
            }
            console.log($scope.news);
        })
    }]);

})(angular);