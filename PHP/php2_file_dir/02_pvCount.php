<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/28
 * Time: 上午10:00
 */

//读取文件
//$pvFile = fopen("pv.txt","r");
//如果文件长度不为0,则取出文件内容,加1运算
//如果文件长度为0,则证明没有打开过,赋值为1
//if (filesize("pv.txt")){
//    $txt = fread($pvFile,filesize("pv.txt"));
//    $txt++;
//}else{
//    $txt = 1;
//}
//关闭文件
//fclose($pvFile);
//
//$pvFile = fopen("pv.txt","w");
//fwrite($pvFile,$txt);
//fclose($pvFile);
//echo file_get_contents("pv.txt");

//老师方法
//$count = file_get_contents("pv.txt");
//if (!$count){
//    file_put_contents("pv.txt","1");
//}else{
//    $count++;
//    file_put_contents("pv.txt",$count);
//}
//echo file_get_contents("pv.txt");

//老师方法
$count = file_get_contents("pv.txt");
if (!filesize("pv.txt")){
    file_put_contents("pv.txt","1");
}else{
    $count++;
    file_put_contents("pv.txt",$count);
}
echo file_get_contents("pv.txt");