<?php

include "init.php";
/*
 * 检测登录情况
 * */
checkLogin();


/*
 *  根据当前页码,显示新闻:
 * */
$cur_page = !empty($_GET['p']) ? $_GET['p'] : 1;
$per_page = 3;//每页的信息行数
$offset = ($cur_page - 1) * $per_page;//sql查询的起始位置
$sql = "SELECT * FROM humans ORDER BY id DESC LIMIT $offset,$per_page";
$query = mysqli_query($link, $sql);
$result = array();
if ($query)
{
    while ($row = mysqli_fetch_assoc($query))
    {
        $result[] = $row;
    }
}

$pageString = getPageString($link, 'index.php', 'humans', $cur_page, $per_page, 5);


include "templates/index.php";


/*
 * 构造页码的函数:上一页,下一页,首页,尾页,上n页,下n页
 * $link : 数据库的链接标识
 * $url : a标签链接的共同地址(不带有参数的)
 * $table : 数据的表名
 * $cur_page : 当前选中的页码
 * $per_page : 每页显示的数据行数
 * $page_num : 显示的数字页码个数
 * */

function getPageString($link, $url, $table,  $cur_page, $per_page,$page_num = 5)
{
    $floor_page = floor($page_num / 2);

    $sql = "SELECT COUNT(*) AS total FROM $table";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($query);
    $total = $row['total'];
    $total_page = ceil($total / $per_page);

    //将来输出到html的标签
    $page = '';
    //首页:
    $page .= '<a href="'.$url.'?p=1" class="number" title="1">首页</a>';

    $start_page = $cur_page - $floor_page;
    $end_page = $cur_page + $floor_page;
    if ($start_page < 1)
    {
        $start_page = 1;
        $end_page = $page_num;
    }
    if ($end_page > $total_page)
    {
        $start_page = $total_page - $page_num + 1;
        $end_page = $total_page;
    }
    //上page_num页:
    $pre_page_5 = $cur_page - $page_num;
    if ($pre_page_5 > 0)
    {
        $page .= '<a href="'.$url.'?p='.$pre_page_5.'" class="number" title="'.$pre_page_5.'">...</a>';
    }

    //上一页:
    if ($cur_page != 1)
    {
        $pre_page = $cur_page - 1;
        $page .= '<a href="'.$url.'?p='.$pre_page.'" class="number" title="'.$pre_page.'">上一页</a>';
    }
    //页码部分:
    for ($i = $start_page; $i <= $end_page; $i++)
    {
        if ($i == $cur_page)
        {
            $page .= '<a href="'.$url.'?p='.$i.'" class="number current" title="'.$i.'">'.$i.'</a>';
        }
        else
        {
            $page .= '<a href="'.$url.'?p='.$i.'" class ="number" title="'.$i.'">'.$i.'</a>';
        }
    }
    //下一页:
    if ($cur_page < $total_page)
    {
        $next_page = $cur_page + 1;
        $page .= '<a href="'.$url.'?p='.$next_page.'" class="number" title="'.$next_page.'">下一页</a>';
    }
    //下page_num页
    $next_page_5 = $cur_page + $page_num;
    if ($next_page_5 <= $total_page)
    {
        $page .= '<a href="'.$url.'?p='.$next_page_5.'" class="number" title="'.$next_page_5.'">...</a>';
    }
    //尾页:
    $page .= '<a href="'.$url.'?p='.$total_page.'" class="number" title="'.$total_page.'">尾页</a>';
    return $page;
}




