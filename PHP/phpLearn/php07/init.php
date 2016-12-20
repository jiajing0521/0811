<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/15
 * Time: 09:21
 */

include 'database.php';

/*
 * 开启session
 * */
session_start();

/*
 * 定义根目录路径
 * */
define('BASE_URL', 'http://localhost/phpLearn/php07/');

/*
 * 检测登录
 * */
function checkLogin()
{
    if (empty($_SESSION['username']))
    {
        //没登录,跳转到登录界面:
        header('location:'.BASE_URL.'login.php');
    }
}












