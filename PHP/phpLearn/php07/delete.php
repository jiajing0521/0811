<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/15
 * Time: 11:22
 */

include "init.php";

checkLogin();

if (!empty($_GET))
{
    $id = $_GET['id'];
    $sql = "DELETE FROM news WHERE id = $id";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        //界面的跳转:
        header('location:'.BASE_URL.'index.php');
    }
    else
    {
        die('删除失败');
    }
}