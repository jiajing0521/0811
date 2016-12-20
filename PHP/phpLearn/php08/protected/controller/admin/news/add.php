<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/16
 * Time: 上午11:30
 */

checkFunc();

if (!empty($_POST)){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $data = array(
        'title' => $title,
        'content' => $content
    );

    $result = insertFunc('news', $data);

//    $sql = "INSERT INTO news (title, content, publishTime) VALUES ('$title', '$content', current_time)";
//    $query = mysqli_query($link, $sql);
    if ($result) {
        // 跳转到首页:
        header('location:'.BASE_URL.'index.php?c=news&a=index&admin=1');
    } else {
        die('插入失败');
    }

}
