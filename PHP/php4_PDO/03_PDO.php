<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/1
 * Time: 下午4:05
 */
header("Content-type:text/html;charset=utf-8");
//1.通过PDO连接mysql数据库
//try 运行
//throw 抛异常
//catch 捕获异常

try{
    $pdo = new PDO("mysql:host=localhost;dbname=0811","root","");
}catch(PDOException $e){
    echo $e->getMessage();
}
$pdo->query("set names utf8");

//查
$result = $pdo->query("SELECT * FROM user");

//FET_NUM:以索引数组的形式返回结果
//FET_ASSOC:以关联数组的形式返回结果
//print_r($result->fetchAll(PDO::FETCH_NUM));
echo "<br>";
print_r($result->fetchAll(PDO::FETCH_ASSOC));
echo "<br>";
//print_r($result->fetchAll(PDO::FETCH_BOTH));

//增
//返回值是插入的行数
echo $pdo->exec("INSERT INTO user(username, password, tel) VALUES ('丁丁','123','35698')");
echo "<br>";

//改
//返回值是更新的行数
echo $pdo->exec("UPDATE user SET username='丁二' WHERE username='丁丁'");
echo "<br>";

//删
//返回值是删除的行数
echo $pdo->exec("DELETE FROM user WHERE username = '姜维2'");





