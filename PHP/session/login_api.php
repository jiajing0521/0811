<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/30
 * Time: 下午2:54
 */

session_start();

//注销
if (isset($_GET["type"])){
    if ($_GET["type"] == "cancle"){
        setcookie(session_name(),session_id(),10000,"/");
        //重定向
        header("Location: login.php");
    }
}
//登录
if (isset($_POST["username"]) && isset($_POST["password"])){
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["password"] = $_POST["password"];
    //重定向
    header("Location: login.php");
}