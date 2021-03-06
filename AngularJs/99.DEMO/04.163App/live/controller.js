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

        $scope.showLoading_live = true;

        $http.jsonp("http://localhost/GIT_space/0811/99_DEMO/05.163api/163.php?callback=JSON_CALLBACK&type=live").success(function (data) {
            $scope.showLoading_live = false;
            $scope.news = data.live_review;
        });

        $(".liveTitle p").on("click",function () {
            console.log(123);
            $(".liveTitle p").each(function () {
                $(this).removeClass("liveTitleAct");
            });
            $(this).addClass("liveTitleAct");
        });

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