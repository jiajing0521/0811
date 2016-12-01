/**
 * Created by dllo on 16/12/1.
 */
//------------------即将上映--------------------
//自执行函数
//里面的变量不会影响全局
(function (angular) {
    //启用严格模式
    "use strict";

    angular.module("douban.coming_soon",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/coming_soon",{
            templateUrl: "./coming_soon/view.html"
        })
    }])

})(angular);