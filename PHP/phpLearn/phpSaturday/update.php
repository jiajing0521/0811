<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/14
 * Time: 17:32
 */

include "init.php";

checkLogin();
/*
 * get获取原来数据
 * */


if (!empty($_GET))
{
    $id = $_GET['id'];
    $name = $_GET['name'];
    $gender = $_GET['gender'];
    $birthday = $_GET['birthday'];

    $currentData = array(
        'id' => $id,
        'name' => $name,
        'gender' => $gender,
        'birthday' => $birthday
    );



    include "templates/update.php";
}

/*
 * post获取新数据更新
 * */

if (!empty($_POST))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];

    $sql = "UPDATE humans SET name='$name',gender='$gender',birthday='$birthday' WHERE id=$id";

    $query = mysqli_query($link, $sql);
    if ($query)
    {
        header('location:'.BASE_URL.'index.php');
    }
    else
    {
        die('更新失败!');
    }

}








