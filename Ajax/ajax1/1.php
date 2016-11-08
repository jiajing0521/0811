<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/2
 * Time: 上午10:31
 */

header("Content-type:text/html;charset=utf-8");

if (isset($_GET["username"]) && isset($_GET["password"])){
    $username = $_GET["username"];
    $password = $_GET["password"];

    if ($username == "豪哥" && $password == "123"){
        echo 1;
    }else {
        echo 0;
    }
}

if (isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "豪哥" && $password == "123"){
        echo 1;
        //重定向
//        header("Location:03_ajax_fengzhuang.html");
    }else {
        echo 0;
    }
}