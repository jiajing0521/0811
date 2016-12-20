<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/15
 * Time: 14:40
 */

include "init.php";



$dataArray = array();
if (!empty($_GET))
{
    $id = $_GET['id'];
    $sql = "SELECT * FROM news WHERE id = $id";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        $dataArray = mysqli_fetch_assoc($query);
    }
}

if (!empty($_POST))
{
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_POST['id'];

    $sql = "UPDATE news SET title = '$title', content = '$content' WHERE id = $id";
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

include "templates/update.php";













