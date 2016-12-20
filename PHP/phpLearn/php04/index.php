<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/10
 * Time: 16:21
 */
//判断当前访问的用户是否已经登录:(session)
session_start();
if (empty($_SESSION['username']))
{
    //没登录:跳转到登录界面:
    header('location:http://localhost/phpLearn/php04/login.php');
}

//已经登录:



include "templates/index.php";

?>

