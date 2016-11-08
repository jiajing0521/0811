<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/2
 * Time: 下午3:48
 */

header("Content-type:text/html;charset=utf-8");

//echo '{"a":1,"b":2,"name":"大燕尾"}';

//把关联数组转成json字符串
$arr = array("name" => "刘晟鑫","hobby"=>"豪","age"=>30);
//echo json_encode($arr);


//把json字符串转为关联数组,第二个参数true不填的话,转为对象
$str = '{"name":"熊阿维","sex":"女"}';
//true为返回关联数组,不填返回php对象
$assocArr = json_decode($str,true);
print_r($assocArr);