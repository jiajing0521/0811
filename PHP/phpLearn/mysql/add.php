<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/13
 * Time: 23:58
 */

include "init.php";

checkLogin();

if (!empty($_POST['title']) && !empty($_POST['content']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO news(title, content, mtime, image, category_id) VALUES ('$title', '$content', 2133221, 'http://baidu.jpg', 123)";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
        header('location:'.BASE_URL.'index.php');
    }
}