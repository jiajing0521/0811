<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/14
 * Time: 10:21
 */
include "init.php";

$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($username) && !empty($password))
{
    $sql = "SELECT * FROM admin WHERE username='$username' AND password = '".md5($password)."'";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        //用户名存入Session:
        $_SESSION['username'] = $username;
        //跳转到主页:
        header('location:'.BASE_URL.'index.php');
    }
}


include "templates/login.php";