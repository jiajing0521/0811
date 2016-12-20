<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/15
 * Time: 09:20
 */

include 'init.php';

if (!empty($_POST))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '".md5($password)."'";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        //存储session:
        $_SESSION['username'] = $username;
        //跳转界面到首页:
        header('location:'.BASE_URL.'index.php');
    }
    else
    {
        die('登录失败');
    }
}


include('templates/login.php');









