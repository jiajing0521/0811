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
            templateUrl: "./top250/view.html"
        })
    }])

})(angular);