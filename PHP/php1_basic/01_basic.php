<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/26
 * Time: 下午4:11
 */

header("Content-type:text/html;charset=utf-8");


//PHP 脚本可以放在文档中的任何位置。
//PHP 脚本以 <?php 开始，以 '?>' 结束：
//PHP 中的每个代码行都必须以分号结束。分号是一种分隔符，用于把指令集区分开来。


//变量名开头必须是$，命名规范数字字母下划线，数字不能开头
$a = 0;#这也是注释

//数据类型
//1.int
$b = 10;
echo gettype($b);
echo "<br>";

//2.float
$pi = 3.1415926;
echo gettype($pi);
echo "<br>";

//3.boolean
$yes = true;
echo gettype($yes);
echo "<br>";

//4.null

//5.string
$str = "hello php";
echo gettype($str);
echo "<br>";
//在php中，双引号中的变量会被解析，为了安全，变量用{}包起来
echo "Wjj,{$str},hihi";//Wjj,hello php,hihi
echo "<br>";
//单引号，就和js中的引号一样，解析为纯字符串
echo '{$str}';//{$str}
echo "<br>";

//php ,用来字符串拼接
echo "嘉静"."说："."你好";//嘉静说：你好
echo "<br>";


//+号只能用来做运算，不能用来做拼接，true=1，
//字符串会从前往后找数字，到第一个非数字字符找数字，
//到第一个非数字字符结束，进行计算
echo  $b+$yes;//11
echo "<br>";

echo  $b+"12a";//22
echo "<br>";
echo  $b+"a12a";//10
echo "<br>";
echo  $b+"a1a2a";//10
echo "<br>";


//5.array 数组
//php中数组有两种：
//（1）.和js中的数组相同，叫做索引数组
$arr = [1,2,3];
//print_r是用来打印数组的
print_r($arr);//Array ( [0] => 1 [1] => 2 [2] => 3 )
echo "<br>";
//var_dump打印变量的详细信息
var_dump($arr);//array(3) { [0]=> int(1) [1]=> int(2) [2]=> int(3) }
echo "<br>";

//(2).和js中的对象类似，以键值对的形式出现，叫做关联数组
$arr1 = ["name"=>"张三","age"=>20,"爱好"=>"刘晟鑫"];
print_r($arr1);
echo "<br>";
echo $arr1["name"];
echo "<br>";

for ($i = 0; $i < count($arr); $i++){
    echo $arr[$i];
    echo "<br>";
}

//和js中forin不同的是，前面是要遍历的数组，中间用空格，后面是数组中的value（js中时key）
foreach ($arr1 as $value){
    echo $value;
    echo "<br>";
}

//as 后面可以放两个变量，$key=>$value
foreach ($arr1 as $key=>$value){
    echo $key."的值是".$value;
    echo "<br>";

}

//资源类型
$file = fopen("01_basic.php","r");
var_dump($file);

?>
