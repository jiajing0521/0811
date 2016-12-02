/**
 * Created by dllo on 16/12/1.
 */

//------------------正在热映--------------------
//自执行函数
//里面的变量不会影响全局
//window参数:$http.jsonp返回的fn(data)是全局作用域,会在全局中寻找fn函数
//但是,我们为了模块化,fn是在子模块中声明的,找不到fn函数会报错(fn未定义),所以要window.fn0
(function (angular,window) {
    //启用严格模式
    "use strict";

    angular.module("douban.in_theaters",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/in_theaters/:page",{
            templateUrl: "./in_theaters/view.html",
            controller: "in_theatersController"
        })
    }]).controller("in_theatersController",["$scope","$http","$routeParams","$route",function ($scope,$http,$routeParams,$route) {
        // $http.get("./data.json").success(function (data) {
        //     $scope.subjects = data.subjects;
        //     $scope.title = data.title;
        // });
        //显示加载动画
        $scope.showLoading = true;
        //每一页数据条数
        var perCount = 10;
        //总页数
        $scope.totalPageCount = 0;
        //当前页数,根据url地址的参数设置
        $scope.currentPage = parseInt($routeParams.page);
        console.log($scope.currentPage);
        $scope.goWhere = function (page) {
            console.log(page);
            $scope.currentPage = page;
            //更新地址栏的url
            $route.updateParams({
                page: page
            })

        };
        window.fn = function (data) {
            console.log("fnfnfnfnfn:"+data);
            $scope.showLoading = false;
            // console.log(data);
            $scope.subjects = data.subjects;
            $scope.title = data.title;
            //向上取整
            $scope.totalPageCount = Math.ceil(data.total/perCount);
        };

        $http.jsonp("http://api.douban.com/v2/movie/in_theaters?callback=fn&start="+($scope.currentPage-1)*perCount+"&count="+perCount);
    }])

})(angular,window);


