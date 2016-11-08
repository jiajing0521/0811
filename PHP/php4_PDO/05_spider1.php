<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/1
 * Time: 下午6:52
 */

header("Content-type:text/html;charset=utf-8");

$str = file_get_contents("大连WEB前端开发招聘（求职） WEB前端开发招聘（求职）尽在智联招聘.html");

preg_match_all("/<a.+onclick=\"submitLog.+\">(.+)<\/a>/",$str,$arr);
//print_r($arr);

for ($i = 0;$i< count($arr[1]);$i++){
    $arr1 = $arr[1];
    echo $arr1[$i];
    echo "<br>";
}
for ($i = 0;$i< count($arr[0]);$i++){
    echo $arr[0][$i];
    echo "<br>";
}