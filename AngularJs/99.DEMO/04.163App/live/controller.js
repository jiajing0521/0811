/**
 * Created by dllo on 16/12/2.
 */
(function (angular) {
    angular.module("163App.live",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/live",{
            templateUrl: "./live/view.html",
            controller: "liveController"
        })
    }]).controller("liveController",["$scope","$http",function ($scope,$http) {

    }])
})(angular);