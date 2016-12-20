<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/16
 * Time: 上午11:30
 */

checkFunc();

if (!empty($_GET)){
    $id = $_GET['id'];
//    $sql = "DELETE FROM news WHERE id = $id";
//    $query = mysqli_query($link, $sql);
    $result = deleteFunc('news', "id=$id");

    if ($result) {
        // 界面的跳转
        header('location:'.BASE_URL.'index.php?c=news&a=index&admin=1');
    } else {
        die('删除失败');
    }
}