<?php

$link = mysqli_connect('localhost', 'root', '123456', 'blue') or die('数据库连接失败');






//这部分是post数据处理部分:
if (!empty($_POST))
{
    //获取信息:
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $hobby = "";
    foreach ($_POST['hobby'] as $value)
    {
        $hobby .= $value.' ';
    }

    $sql = "INSERT INTO user (username, password, email, phone, gender, hobby, city) VALUES ('$username', '".md5($password)."', '$email', '$phone', '$gender', '$hobby', '$city')";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        echo '<script>alert("注册成功")</script>';
    }
    else
    {
        echo '<script>alert("注册失败")</script>';
    }
}


$result = array();
if (!empty($_GET))
{
    $username = $_GET['username'];
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_row($query);
    if ($row[0])
    {
        //已存在这个用户名
        $result = array(
            'flag' => 1,
        );
    }
    else
    {
        //这个用户名不存在,可以进行注册
        $result = array(
            'flag' => 0,
        );
    }
}


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']))
{
    echo json_encode($result);
}
else
{
    //视图部分:
    include "registTemplate.php";
}
