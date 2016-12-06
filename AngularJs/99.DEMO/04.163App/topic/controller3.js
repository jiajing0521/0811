/**
 * Created by dllo on 16/12/2.
 */
(function (angular) {
    angular.module("163App.topic1",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/topic",{
            templateUrl : "./topic/view.html",
            controller: "topicController"
        })
    }]).controller("topicController",["$scope","$http",function ($scope,$http) {
        // 第一次加载动画
        $scope.showLoading_live = true;
        //第一次加载
        var getDataFirst = true;
        if (getDataFirst){
            $http.jsonp("http://localhost/GIT_space/0811/99_DEMO/05.163api/163.php?callback=JSON_CALLBACK&type=topic&page1="+5).success(function (data) {
                $scope.showLoading_live = false;
                $scope.news = data.data.expertList;
            });
        }
        // 以后加载
        var pageIndex = 5;
        $(window).on("scroll", function(){
            var rollTop = document.body.scrollTop || document.documentElement.scrollTop;
            var nowScreenHeight = document.documentElement.clientHeight;
            var ulHeight = document.getElementsByClassName("topic-content")[0].clientHeight;
            if (rollTop > ulHeight - nowScreenHeight-70 && pageIndex<=20){
                console.log("到底了");
                $scope.showLoading_live = true;
                pageIndex += 5;
                $scope.getData(pageIndex);
            }
        });
        $scope.getData = function (pageCount) {
            getDataFirst = false;
            console.log("第几"+pageCount);
            $http.jsonp("http://localhost/GIT_space/0811/99_DEMO/05.163api/163.php?callback=JSON_CALLBACK&type=topic&page1="+pageCount).success(function (data) {
                $scope.showLoading_live = false;
                $scope.news = data.data.expertList;
            });
        };

        //导航切换效果
        $(".liveTitle p").on("click",function () {
            $(".liveTitle p").each(function () {
                $(this).removeClass("liveTitleAct");
            });
            $(this).addClass("liveTitleAct");
        });

        //加载动画
        (function ($) {
            var divs = {
                'pacman': 5
            };
            var addDivs = function(n) {
                var arr = [];
                for (i = 1; i <= n; i++) {
                    arr.push('<div></div>');
                }
                return arr;
            };
            $.fn.loaders = function() {
                return this.each(function() {
                    var elem = $(this);
                    $.each(divs, function(key, value) {
                        if (elem.hasClass(key))
                            elem.html(addDivs(value))
                    })
                });
            };
            $(function() {
                $.each(divs, function(key, value) {
                    $('.loader-inner.' + key).html(addDivs(value));
                })
            });
        }).call(window, window.$ || window.jQuery || window.Zepto);
    }])

})(angular);