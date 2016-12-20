<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/15
 * Time: 10:44
 */

include "init.php";

if (!empty($_POST))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO news (title, content, publishTime) VALUES ('$title', '$content', current_time)";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        //跳转到首页:
        header('location:'.BASE_URL.'index.php');
    }
    else
    {
        die('插入失败');
    }
}