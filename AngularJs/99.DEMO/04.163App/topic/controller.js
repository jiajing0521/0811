/**
 * Created by dllo on 16/12/2.
 */
(function (angular) {
    angular.module("163App.topic",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/topic",{
            templateUrl : "./topic/view.html",
            controller: "topicController"
        })
    }]).controller("topicController",["$scope","$http",function ($scope,$http) {

    }])
})(angular);