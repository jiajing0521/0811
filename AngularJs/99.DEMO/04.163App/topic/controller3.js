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
        var winH = $(window).height(); //页面可视区域高度
        // $(document).ready(function(){
        // $(window).on("scroll", function(e){
        //     var pageH = $(document.body).height();
        //     var scrollT = $(window).scrollTop(); //滚动条top
        //     // var aa = (pageH - winH - scrollT) / winH;
        //         if (scrollT >= pageH - pageH) {
        //             console.log("到底了");
        //             pageIndex += 5;
        //             $scope.getData(pageIndex);
        //         }
        //     });
        // });
        //判断是否到达底部
        var timer = null;
        clearInterval(timer);
        timer = setInterval(function(){
            //获取当前滑动纵向偏移量
            var rollTop = document.body.scrollTop || document.documentElement.scrollTop;
            //获取当前页面的高度
            var nowScreenHeight = document.documentElement.clientHeight;
            //获取body的总高度
            var bodyHeight = document.body.clientHeight;
            console.log("滚动="+rollTop,"页面="+$(window).height(),"总="+bodyHeight);
            if(rollTop > bodyHeight - nowScreenHeight){
                console.log("到底了");
                            pageIndex += 5;
                            $scope.getData(pageIndex);
                //如果清除定时器的话，则只显示一次
            }
        },100)
        $scope.getData = function (pageCount) {
            getDataFirst = false;
            console.log(pageCount);
            $http.jsonp("http://localhost/GIT_space/0811/99_DEMO/05.163api/163.php?callback=JSON_CALLBACK&type=topic&page1="+pageCount).success(function (data) {
                $scope.showLoading_live = false;
                $scope.news = data.data.expertList;
            });
        };

        //导航切换效果
        $(".liveTitle p").on("click",function () {
            console.log(123);
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