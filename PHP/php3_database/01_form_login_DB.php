<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/31
 * Time: 下午4:01
 */
header("Content-type:text/html;charset=utf-8");

$mysql = mysql_connect("localhost","root","");
if ($mysql){
    echo "数据库连接成功";
}else{
    die("连接失败");
}
echo "<br>";
$db = mysql_select_db("0811");
if ($db){
    echo "连接0811成功";
}else{
    die("失败");
}
echo "<br>";

mysql_query("set names utf8");

$type = $_POST["type"];
$username = $_POST["username"];
$password = $_POST["password"];

if(@$type = $_POST["type"]){
    switch ($type){
        case "登录":
            $sql = "SELECT * FROM username WHERE username = '{$username}' AND password = '{$password}'";
            $result = mysql_query($sql);
            var_dump($result);
            if (mysql_num_rows($result) > 0){
                echo "登录成功";
            }else{
                echo "登录失败";
            }
            break;
        case "注册":
            $sql = "SELECT * FROM username WHERE username = '{$username}'";
            $result = mysql_query($sql);
            if (mysql_num_rows($result) > 0){
                echo "该用户已存在";
            }else{
                $sql = "INSERT INTO username (id,username,password) VALUES (NULL,'{$username}','{$password}')";
                mysql_query($sql);
                if (mysql_insert_id() > 0){
                    echo "注册成功";
                }
            }
            break;
        default:
            die("输入错误");
            break;
    }
}else{
    die("请输入用户名密码");
}
//关闭数据库
mysql_close();