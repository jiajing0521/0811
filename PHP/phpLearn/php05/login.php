<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/11
 * Time: 09:26
 */
include('database.php');


if ($_POST) //或者  !empty($_POST)
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($password))
    {
        //链接数据库:
        $link = mysqli_connect($hostAddress, $dbUser, $dbPassword, $dbName) or die('数据库连接失败');
        mysqli_select_db($link, $dbName);
        $sql = "select * from admin WHERE username = '$username' AND password = '".md5($password)."'";
        $query = mysqli_query($link, $sql);
        if ($query)
        {
            $row = mysqli_fetch_assoc($query);
            if ($row['username'])
            {
                //用户名存入session:
                session_start();
                $_SESSION['username'] = $username;
                //跳转界面:
                header('location:http://localhost/phpLearn/php05/index.php');
            }
        }

    }
}
//导入视图部分
include "templates/login.php";









