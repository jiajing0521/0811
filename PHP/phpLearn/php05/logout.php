<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/11
 * Time: 10:26
 */

//清除session:
session_start();
unset($_SESSION['username']);

//跳转到登录界面:
header('location:http://localhost/phpLearn/php05/login.php');