<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/16
 * Time: 下午2:48
 */

if (!empty($_POST)) {

    $username = $_POST['username'];
    $password = $_POST['password'];

//    $username = $_GET['username'];
//    $password = $_GET['password'];

    $condition = "username='$username' AND password='".md5($password)."'";
    $result = selectFunc('admin',$condition);
    if ($result) {
        // 存储session
        $_SESSION['username'] = $username;
        // 跳转到(新闻)主页:
//        header('location:'.BASE_URL.CONTROLLER_PATH.'admin/news/index.php');
        //单接口跳转:
        header('location:'.BASE_URL.'index.php?c=news&a=index&admin=1');
    } else {
        echo "登录失败";
    }
}
//加载视图
include(VIEW_PATH.'admin/admin/login.php');