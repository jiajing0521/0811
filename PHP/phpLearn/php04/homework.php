<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/10
 * Time: 09:53
 */
include "database.php";

$link = mysqli_connect($hostAddress, $dbUser, $dbPassword, $dbName) or die('数据库连接失败');
//选择数据库
mysqli_select_db($link, $dbName);
//sql语句
$sql = "select * from student";
//执行sql语句:
$query = mysqli_query($link, $sql);

if ($query)
{
    $stuArray = array();//创建一个空数组,准备存放学生数据
    while ($row = mysqli_fetch_assoc($query))
    {
        //将$row添加到数组的最后面
        $stuArray[] = $row;
    }
//    print_r($stuArray);
    $result = array(
        'status' => 'success',
        'list' => $stuArray
    );
    echo json_encode($result);
}
else
{
    $result = array(
        'status' => 'failed',
        'message' => '信息获取失败'
    );
    echo json_encode($result);
}



