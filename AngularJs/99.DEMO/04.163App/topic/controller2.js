/**
 * Created by dllo on 16/12/2.
 */
(function (angular) {
    angular.module("163App.topic2",["ngRoute"]).config(["$routeProvider",function ($routeProvider) {
        $routeProvider.when("/topic/1",{
            templateUrl : "./topic/view1.html",
            controller: "topicController1"
        })
    }]).controller("topicController1",["$scope","$http",function ($scope,$http) {

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