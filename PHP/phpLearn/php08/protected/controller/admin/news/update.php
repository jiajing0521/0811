<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/16
 * Time: 上午11:31
 */

checkFunc();



$dataArray = array();
if (!empty($_GET['id'])){
    $id = $_GET['id'];
//    $sql = "SELECT * FROM news WHERE id = $id";
//    $query = mysqli_query($link, $sql);
//    if ($query) {
//        $dataArray = mysqli_fetch_assoc($query);
//    }
    // 返回的数组只有一个元素,这个唯一的元素才是页面需要的,所以要取出来
    $dataArray = selectFunc('news', "id=$id")[0];
//    print_r($dataArray);exit();
    viewFunc(VIEW_PATH.'admin/news/update',$dataArray);
}

if (!empty($_POST)){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_POST['id'];

//    $sql = "UPDATE news SET title='$title', content='$content' WHERE id=$id";
//
//    $query = mysqli_query($link, $sql);

    $data = array(
        'title' => $title,
        'content' => $content,
    );

    $result = updateFunc('news',$data,"id=$id");
    if ($result) {
        header('location:'.BASE_URL.'index.php?c=news&a=index&admin=1');
    } else {
        die('修改失败');
    }
}

