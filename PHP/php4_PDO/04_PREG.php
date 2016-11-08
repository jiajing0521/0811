<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/1
 * Time: 下午4:42
 */
header("Content-type:text/html;charset=utf-8");

preg_match("/\d+/","DLH160811abc123",$arr);
print_r($arr);
echo "<br>";

//match_all就是js里的g,全局查找
preg_match_all("/\d+/","DLH160811abc123",$arr);
print_r($arr);
echo "<br>";

//()子字符串
preg_match_all("/0(8)11/","DLH160811abc123",$arr);
print_r($arr);
//.匹配除了\n以外的任意内容
//通过()可以获取一个子表达式,并且这个子表达式可以被向后引用,通过\1,\2获取子表达式,在php中时\\1
preg_match_all("/(['|\"]).+\\1/","abc'豪哥'pa123\"李威\"",$arr);
print_r($arr);
echo "<br>";

//正向肯定预查(?=xx),表示如果后面的内容是XX的话,就匹配到,并且匹配到的结果不包括xx
//反向肯定预查(?<=xx),表示如果前面是xx的话,匹配并且不包含xx,js不支持反向预查
$str = "DLH160811DLA160921DLS160000";
preg_match_all("/(?<=DL)\w(?=\d+)/",$str,$arr);
print_r($arr);
