<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/1
 * Time: 下午5:45
 */

header("Content-type:text/html;charset=utf-8");

$str = file_get_contents("站酷 (ZCOOL) - 设计师互动平台.html");
//echo $str;

preg_match_all("/<a.+st_n=\"index_main_title\".+>(.+)<\/a>/",$str,$arr);
print_r($arr);