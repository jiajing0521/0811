<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/14
 * Time: 17:12
 */
include "init.php";

checkLogin();

$id = $_GET['id'];
if (!empty($id))
{
    $sql = "DELETE FROM humans WHERE id=$id";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        //删除成功:跳转界面
        header('location:'.BASE_URL.'index.php');
    }
    else
    {
        die('删除失败');
    }
}