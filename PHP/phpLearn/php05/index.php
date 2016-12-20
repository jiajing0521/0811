<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/11
 * Time: 10:16
 */
include "database.php";

//判断登录状态:
session_start();//开启session
if (empty($_SESSION['username']))
{
    //跳转到登录界面:
    header('location:http://localhost/phpLearn/php05/login.php');
}

//显示新闻:从数据库查询相关新闻

//链接数据库:
$link = mysqli_connect($hostAddress, $dbUser, $dbPassword, $dbName) or die('数据库连接失败');
mysqli_select_db($link, $dbName);
mysqli_query($link,'set names utf8');

//每页新闻的条数:
$per_page = 3;
//当前页码
$cur_page = !empty($_GET['p']) ? $_GET['p'] : 1;
//查询时的起始位置
$offset = ($cur_page - 1) * $per_page;
//构造查询语句:
$sql = "SELECT * FROM news ORDER BY id DESC LIMIT $offset,$per_page";
$query = mysqli_query($link, $sql);
$result = array();
if ($query)
{
    while ($row = mysqli_fetch_assoc($query))
    {
        $result[] = $row;//将每条新闻依次添加到数组中
    }
}

//构造页码部分的html语句-->使用<a>标签组合而成:
$pageString = getPage($link, 'index.php', $cur_page, $per_page, 5);


//将数据显示到<table>标签中
viewFunc($pageString, $result);


//include "templates/index.php";

/*
 * 视图部分
 * $data -> 当前要显示的新闻
 *
 * */
function viewFunc($pageString ,$data = array())
{

//    foreach ($data as $key => $value)
//    {
//        $$key = $value;
//    }

//    extract($data);

    include "templates/index.php";
}

/*
 * 构造页码显示部分HTML语句
 * */
function getPage($link, $url, $cur_page, $per_page, $page_num = 5)
{
    //计算当前页码和起始页与结束页的差值:
    $floor_num = floor($page_num / 2);

    //计算总页数:
    $sql = "SELECT count(*) AS total FROM news";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($query);
    $total = $row['total'];
    //ceil是向上取整 : ceil(3.1) = 4;
    $total_page = ceil($total / $per_page);

   //构造HTML字符串:
    $pageStr = '';
    //首页:
    $pageStr .= '<a href="'.$url.'?p=1" class="number" title="1">首页</a>';
    //所有页码:
    for ($i = 1; $i <= $total_page; $i++)
    {
        if ($i == $cur_page)
        {
            $pageStr .= '<a href="'.$url.'?p='.$i.'" class="number current" title = "'.$i.'">'.$i.'</a>';
        }
        else
        {
            $pageStr .= '<a href="'.$url.'?p='.$i.'" class="number" title = "'.$i.'">'.$i.'</a>';;
        }
    }

    //尾页:
    $pageStr .= '<a href="'.$url.'?p='.$total_page.'" class="number" title="'.$total_page.'">尾页</a>';


    return $pageStr;

}
