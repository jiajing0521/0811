/**
 * Created by dllo on 16/12/2.
 */

(function (angular) {
    angular.module("163App",["163App.home","163App.live","163App.topic"]);



    //底部导航样式切换
    $(".nav-row div").on("click",function () {
        $(".nav-row div").each(function () {
            $(this).removeClass("nav-active");
        });
        $(this).addClass("nav-active");
    });
})(angular);


