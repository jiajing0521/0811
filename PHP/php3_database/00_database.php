<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/31
 * Time: 上午10:48
 */

header("Content-type:text/html;charset=utf-8");

//1.连接数据库
//主机名，用户名，密码
$mysql = mysql_connect("localhost","root","");
if ($mysql){
    echo "数据库连接成功";
}else{
    die("连接失败");
}
//2.选择使用哪一个库
$db = mysql_select_db("0811");
if ($db){
    echo "连接0811成功";
}else{
    die("失败");
}
echo "<br>";

//设置显示中文
mysql_query("set names utf8");

//3.sql语句,查找user表中的所有字段
//$sql = "SELECT * FROM user";
//返回值是resource类型
//$result = mysql_query($sql);
//var_dump($result);
//echo "<br>";

//返回值是数组类型,每次只能取一条数据,所以While循环来获取所有的行
//$row = mysql_fetch_row($result);
//print_r($row);
//echo "<br>";
//返回索引数组
//while ($row = mysql_fetch_row($result)){
//    print_r($row);
//    echo "<br>";
//}

//返回关联数组
//while ($row = mysql_fetch_assoc($result)){
//    print_r($row);
//    echo "<br>";
//}
//返回对象类型
//while ($row = mysql_fetch_object($result)){
//    print_r($row);
//    echo "<br>";
//}

//where 条件 AND OR NOT
//$sql = "SELECT * FROM user WHERE username = '豪哥'";
//$sql = "SELECT * FROM user WHERE id<3 AND username = '刘晟鑫'";
//$sql = "SELECT * FROM user WHERE id<3 OR username = '刘晟鑫'";
//$sql = "SELECT * FROM user WHERE id<3 AND NOT username  = '刘晟鑫'";
//$sql = "SELECT * FROM user WHERE NOT username  = '刘晟鑫'";

//外部传入$username,$password
//$sql = "SELECT * FROM user WHERE username  = '{$username}' AND password = '{$password}'";

//LIMIT 限制获取的个数
$sql = "SELECT * FROM user LIMIT 2";

//排序
//ORDER BY 通过哪个字段排序
// DESC 倒序
// ASC 正序
$sql = "SELECT * FROM user ORDER BY tel DESC ";
//几种选择放在一起写 先写条件,然后排序,最后限制数量
$sql = "SELECT * FROM user WHERE id < 3 ORDER BY password ASC LIMIT 1";
$result = mysql_query($sql);

//只获取结果的行数
echo mysql_num_rows($result);
echo "<br>";

while ($row = mysql_fetch_assoc($result)){
    print_r($row);
    echo "<br>";
}


//添加
//可以添加一行或多行
$sql = "INSERT INTO user (id,username,password,tel) VALUES (NULL, '李威', '521521', '521521521'),(NULL ,'于嘉晨','250250','123456')";
mysql_query($sql);
//插入成功后,返回插入那一行的id
echo mysql_insert_id();
echo "<br>";


//修改
$sql = "UPDATE user SET username = '大眼威' WHERE id = 7";
mysql_query($sql);
//更新后,返回更新的行数
echo mysql_affected_rows();
echo "<br>";


//删除
$sql = "DELETE FROM user WHERE id = 10";
mysql_query($sql);
echo mysql_affected_rows();
echo "<br>";
//关闭数据库
mysql_close();



