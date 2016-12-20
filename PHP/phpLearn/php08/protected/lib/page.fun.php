<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/16
 * Time: 上午10:01
 */

/*
 * 分页函数
 * (1)link->数据库的链接
 * (2)url ->目标逻辑页
 * (3)table ->表名
 * (4)cur_page ->当前页码
 * (5)per_page ->每页显示的行数
 * (6)page_num ->数字页码数量(除上一页,下一页,首页,尾页之外)
 * */
function getPageString($link, $url, $table, $cur_page, $per_page, $page_num = 5) {
    $floor_page = floor($page_num / 2);

    $sql = "SELECT count(*) AS total FROM $table";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($query);
    $total = $row['total'];
    $total_page = ceil($total / $per_page);

//     将来输出到html的标签
    $page = '';
    // 首页:
    $page .= '<a href="'.$url.'&p=1" class="number" title="1">首页</a>';


    $start_page = $cur_page - $floor_page;
    $end_page = $cur_page + $floor_page;
    if ($start_page < 1) {
        $start_page = 1;
        $end_page = $start_page + $page_num - 1;
    }
    if ($page_num > $total_page) {
        $start_page = 1;
        $end_page = $total_page;
    }
    if ($end_page > $total_page) {
        $start_page = $total_page - $page_num + 1;
        $end_page = $total_page;
    }
    // 上page_num页:
    $pre_page_5 = $cur_page - $page_num;
    if ($pre_page_5  > 0) {
        $page .= '<a href="'.$url.'&p='.$pre_page_5.'" class="number" title="'.$pre_page_5.'">...</a>';
    }
    // 上一页:
    if ($cur_page != 1) {
        $pre_page = $cur_page - 1;
        $page .= '<a href="'.$url.'&p='.$pre_page.'" class="number" title="'.$pre_page.'">上一页</a>';
    }
    // 页码
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $cur_page) {
            $page .= '<a href="'.$url.'&p='.$i.'" class="number current" title="'.$i.'">'.$i.'</a>';
        } else {
            $page .= '<a href="'.$url.'&p='.$i.'" class="number" title="'.$i.'">'.$i.'</a>';
        }
    }
    //下一页:
    if ($cur_page < $total_page) {
        $next_page = $cur_page + 1;
        $page .= '<a href="'.$url.'&p='.$next_page.'" class="number" title="'.$next_page.'">下一页</a>';
    }
    //下page_num页:
    $next_page_5 = $cur_page + 5;
    if ($next_page_5 <= $total_page) {
        $page .= '<a href="'.$url.'&p='.$next_page_5.'" class="number" title="'.$next_page_5.'">...</a>';
    }
    // 尾页:
    $page .= '<a href="'.$url.'&p='.$total_page.'" class="number" title="'.$total_page.'">尾页</a>';
//    echo 1;exit();
    return $page;

}