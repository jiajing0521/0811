<?php

/*
 * 常用操作的初始化 :
 * (1)数据库的链接:
 * (2)检测用户是否登录
 * (3)界面的跳转函数
 * */

include "database.php";

$link = mysqli_connect($hostAddress, $dbUser, $dbPassword, $dbName) or die('数据库连接失败');
mysqli_select_db($link, $dbName);
mysqli_query($link, 'set names utf8');

/*
 * 开启session
 * */
session_start();

/*
 * 声明一个关于根目录的全局变量:
 * */
define('BASE_URL', 'http://localhost/phpLearn/phpSaturday/');

/*
 * 检测用户是否登录函数:
 * */
function checkLogin()
{
    if (empty($_SESSION['username']))
    {
        /*
         * 跳转到登录界面:
         * */
        header('location:'.BASE_URL.'login.php');
    }
}









