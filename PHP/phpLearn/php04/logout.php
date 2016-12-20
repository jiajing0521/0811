<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/10
 * Time: 17:06
 */

//退出登录,清除session:
session_start();
//错误方法:这样会使username的这个key值依然保留在session中,只是值变为了'';
//$_SESSION['username'] = '';

//正确方法:
unset($_SESSION['username']);


//跳回登录界面:
header('location:http://localhost/phpLearn/php04/login.php');





