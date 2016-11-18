<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/27
 * Time: 上午9:31
 */

header("Content-type:text/html;charset=utf-8");
//定界符
$str = <<<EOF
PHP,
早上好
<br>
准备好了吗
EOF;

echo $str;
echo "<br>";

//获取字符串的长度
echo strlen($str);//37
echo "<br>";

//字符串比较（按位置比较）
echo strcmp("bf","z");
echo "<br>";

//重复，第一个参数：要重复的字符串内容
//      第二个参数：重复的次数
echo str_repeat("a",20);
echo "<br>";

//替换
//第一个参数：要替换的字符串中的内容
//第二个参数：替换之后的内容
//第三个参数: 从哪个字符串中替换
echo str_replace("P","哈","ghjklP");
echo "<br>";

//忽略大小写的替换
echo str_ireplace("A","o哈哈","abc");
echo "<br>";

//删除前后空格
echo "/".trim("  gjwi   r   j glk r ")."/";
echo "<br>";

//第二个参数是一个隐藏参数，默认是空格，内容是要删除首尾的内容
echo trim("豪哥豪哥今天豪哥还干刘晟鑫吗","豪哥");
echo "<br>";

//l/r删除左/右的空格
echo "/".ltrim("  abc ")."/";
echo "<br>";

echo "/".rtrim("  abc ")."/";
echo "<br>";

//把字符串根据某个字符分割成数组
print_r(explode("_","a_b_c_d"));
echo "<br>";

//strpos() 函数用于在字符串内查找一个字符或一段指定的文本。
//如果在字符串中找到匹配，该函数会返回第一个匹配的字符位置。如果未找到匹配，则返回 FALSE。
echo strpos("Hello world!","world");

//把数组转换成字符串，
//第一个参数为转换时把元素拼接的内容，可以不写，默认为空
echo implode("=",[1,2,3]);
echo "<br>";

//完整输出html标签，不被浏览器解析
echo htmlspecialchars("<br>");

//判断一个变量是否有值
var_dump(isset($str));
var_dump(isset($a));
echo "<br>";

//删除变量的值
$a = 20;
unset($a);
echo $a;
echo "<br>";

//变量的变量
$a = "hello";
$$a = "world";
$$$a = "world1";
echo $$hello;
echo "<br>";

//相当于给变量加了一个别名，操作的是同一个变量的内容
$c = 20;
$d = &$c;
$d = 50;
echo $c;//$c和$d完全一样
echo "<br>";

//数组的两种初始化方法
$arr = [1,2,3];
$arr = array(1,2,3);
$arr = array("name"=>"豪哥","age"=>20);

//array_shift()
array_push($arr,"爱好");
$arr["爱好"] = "破冰";
print_r($arr);
//判断数组中是否有该元素
//in_array(元素, 数组)

//sort() - 对数组进行升序排列
//    rsort() - 对数组进行降序排列
//    asort() - 根据关联数组的值，对数组进行升序排列
//    ksort() - 根据关联数组的键，对数组进行升序排列
//    arsort() - 根据关联数组的值，对数组进行降序排列
//    krsort() - 根据关联数组的键，对数组进行降序排列

