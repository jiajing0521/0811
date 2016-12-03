/**
 * Created by dllo on 16/12/2.
 */
(function (angular) {
    "use strict";

    angular.module("163App.home",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/home",{
            templateUrl : "./home/view.html",
            controller : "homeController"
        }).otherwise({
            redirectTo:"/home"
        })
    }]).controller("homeController",["$scope","$http",function ($scope,$http) {
        $('.carousel').carousel({
            interval: 2000
        });
        //显示加载动画
        $scope.showLoading = true;
        $http.jsonp("http://localhost/GIT_space/0811/99_DEMO/05.163api/163.php?callback=JSON_CALLBACK&type=home").success(function (data) {
            console.log(data);
            $scope.showLoading = false;
            //大图滚动图片
            $scope.sliderImg = data.tid[0].ads;
            $scope.news = [];
            for (var i = 1; i < data.tid.length; i++){
                $scope.news.push(data.tid[i]);
            }
            console.log($scope.news[0].title);
        });

        $(".toutiao li").on("click",function () {
            console.log(123);
            $(".toutiao li").each(function () {
                $(this).removeClass("toutiaoActive");
            });
            $(this).addClass("toutiaoActive");
        });

    }]);

})(angular);