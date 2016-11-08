<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/1
 * Time: 上午11:14
 */

//PDO::query() 主要是用于有记录结果返回的操作，特别是SELECT操作
//PDO::exec() 主要是针对没有结果集合返回的操作，如INSERT、UPDATE等操作
//PDO::lastInsertId() 返回上次插入操作，主键列类型是自增的最后的自增ID
//PDOStatement::fetch() 是用来获取一条记录
//PDOStatement::fetchAll() 是获取所有记录集到一个中

header("Content-type:text/html;charset=utf8");
//1.链接数据库
$mysql=new PDO("mysql:host=localhost;dbname=0811","root","");
if($mysql){
    echo "数据库链接成功";
}else{
    die("链接失败");
}

//2.显示中文
$mysql->query("set names utf8");

//3.查
$sql = "SELECT * FROM user WHERE username = '于嘉晨'";
$result = $mysql->query($sql);
//setAttribute() 方法是设置部分属性
//PDO::CASE_LOWER -- 强制列名是小写
//PDO::CASE_NATURAL -- 列名按照原始的方式
//PDO::CASE_UPPER -- 强制列名为大写
//
//我们使用setFetchMode方法来设置获取结果集的返回值的类型，同样类型还有：
//
//PDO::FETCH_ASSOC-- 关联数组形式
//PDO::FETCH_NUM -- 数字索引数组形式
//PDO::FETCH_BOTH -- 两者数组形式都有，这是缺省的
//PDO::FETCH_OBJ -- 按照对象的形式
$result->setFetchMode(PDO::FETCH_ASSOC);
var_dump($result->setFetchMode(PDO::FETCH_ASSOC));
echo "<br>";
echo "<br>";
echo "<br>";

while($row = $result->fetch()){
    print_r($row);
    echo "<br>";
}

//4.增

//$sql = "INSERT INTO user (username,password,tel) VALUES ('姜维1','123','12345678910')";
//$count = $mysql->exec($sql);
//$lastID = $mysql->lastInsertId($sql);
//echo $count;
//echo "<br>";
//echo $lastID;

//5.改
//$sql = "UPDATE user SET username = '姜维' WHERE username = '姜维1'";
//$count = $mysql->exec($sql);
//echo $count;
//echo "<br>";

//6.删
//$sql = "DELETE FROM user WHERE username = '姜维'";
//$count = $mysql->exec($sql);
//echo $count;
//echo "<br>";
