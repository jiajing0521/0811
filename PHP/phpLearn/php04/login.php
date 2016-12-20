<?php

include "database.php";//引入数据库文件

    //登录逻辑的书写:
    //(1)表单提交(用户名和密码)
    //(2)进入数据库查询匹配,返回结果
    //(3)成功->跳转界面(session和cookie)   失败->提示登录失败

$username = $_POST['username'];
$password = $_POST['password'];
//用户名或密码不能为空:
if (!empty($username) && !empty($password))
{
    //进入数据库查询!
    $link = mysqli_connect($hostAddress, $dbUser, $dbPassword, $dbName) or die('数据库连接失败');
    mysqli_select_db($link, $dbName);//选择数据库


    $sql = "select * from admin WHERE username = '$username' and password = '".md5($password)."'";
//    echo $sql;exit();
    //执行sql语句:
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        $result = mysqli_fetch_assoc($query);
        if (!empty($result['username']))
        {
            //登录成功:跳转界面js方式
            //echo '<script>window.location.href = "index.php";</script>';

            //session:
            session_start();
            //将正确的username存入session(同一个域名下的网址页面会识别这个session,默认保存时间是20分钟)
            $_SESSION['username'] = $username;

            //php方式:
            header('location:http://localhost/phpLearn/php04/index.php');
        }

    }
    else
    {
        //用户名或密码错误
    }
}
else
{
//    echo '<script>alert("用户名或密码不能为空")</script>';
}

include "templates/login.php";

?>
