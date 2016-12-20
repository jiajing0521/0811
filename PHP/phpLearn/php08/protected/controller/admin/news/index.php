<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/16
 * Time: 上午11:31
 */

//新闻的逻辑首页:

checkFunc();

//checkLogin();
$per_page = 3;
$cur_page = !empty($_GET['p']) ? $_GET['p'] : 1;
$offset = ($cur_page - 1) * $per_page;
$sql = "SELECT * FROM news ORDER BY id DESC limit $offset, $per_page";
$query = mysqli_query($link, $sql);
$result = array();
if ($query){
    while ($row = mysqli_fetch_assoc($query)){
        $result[] = $row;
    }
}

/*
 * 获取构造分页部分的字符串
 * */
$pageString = getPageString($link, 'index.php?c=news&a=index&admin=1', 'news', $cur_page, $per_page, 5);

$data = array(
    'result' => $result,
    'page' => $pageString
);

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']))
{
    echo json_encode(array('result'=>$result, 'page'=> $pageString));
}
else
{
    viewFunc(VIEW_PATH.'admin/news/index', $data);
}
