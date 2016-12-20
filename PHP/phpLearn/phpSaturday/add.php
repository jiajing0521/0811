<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/14
 * Time: 16:53
 */
include "init.php";

checkLogin();

$name = $_POST['name'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];

if (!empty($name) && !empty($gender) && !empty($birthday))
{
    $sql = "INSERT INTO humans (name, gender, birthday) VALUES ('$name', '$gender', '$birthday')";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        //界面跳转到index.php
        header('location:'.BASE_URL.'index.php');
    }
    else
    {
        die('插入失败');
    }
}









