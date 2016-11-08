<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/31
 * Time: 下午5:47
 */

header("Content-type:text/html;charset=utf-8");

mysql_connect("localhost","root","");
mysql_select_db("0811");
mysql_query("set names utf8");


if (isset($_GET["type"])){
    $type = $_GET["type"];
}
if (isset($_GET["email"])){
    $email = $_GET["email"];
}
if (isset($_GET["username"])){
    $username = $_GET["username"];
}
if (isset($_GET["tel"])){
    $tel = $_GET["tel"];
}
if (isset($_GET["password"])){
    $password = $_GET["password"];
}

switch ($type){
    case "登录":
        $sql = "SELECT * FROM login WHERE password = '{$password}' AND (tel = '{$username}' OR email = '{$username}' OR name = '{$username}')";
        $result = mysql_query($sql);
        $row = mysql_fetch_assoc($result);
        $str = json_encode($row);
        $nickName = $row["name"];

        if (mysql_num_rows($result) > 0){
//            echo $str;
            echo '{"returnCode" : 1, "message" : "恭喜你,登录成功", "name" : "'.$nickName.'" }';
        }else{
            echo '{"returnCode" : 0, "message" : "登录失败,请重新登录"}';
        }
        break;
    case "注册":
        //查重
        $sql = "SELECT * FROM login WHERE tel = '{$tel}' OR name = '{$username}' OR email = '{$email}'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result) > 0){
            echo '{"returnCode" : 0, "message" : "注册失败,该用户已存在,请重新注册"}';
        }else{
            $sql = "INSERT INTO login (id,tel,email,name,password) VALUES (NULL,'{$tel}','{$email}','{$username}','{$password}')";
            mysql_query($sql);
            if (mysql_insert_id() > 0){
                echo '{"returnCode" : 1, "message" : "恭喜你,注册成功", "back": "<a href=\'06_emailLogin.html\'>去登录</a>"}';
            }else{
                echo '{"returnCode" : 0, "message" : "注册失败,请重新注册"}';
            }
        }
        break;
    default:
        die("输入错误");
        break;
}
mysql_close();



