<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/3
 * Time: 上午9:34
 */


//url : login.php
//method : post
//参数 : user(string): 用户名, pwd(string): 密码
//返回值: {"err": 0, "headImg":"xx.img"}
//err:0成功,1失败

header("Content-type:text/html;charset=utf-8");

//常量,后面不可改变
define("HOST_NAME","localhost");
define("DB_NAME","0811");

if(isset($_POST["user"])&&isset($_POST["pwd"])){
    $user = $_POST["user"];
    $pwd = $_POST["pwd"];

    $pdo = new PDO("mysql:host=".HOST_NAME.";dbname=".DB_NAME.";","root","");
    $pdo->exec("set names utf8");

    $result = $pdo->query("SELECT * FROM loginAjax WHERE username = '{$user}' AND password = '{$pwd}'");
    $arr = $result->fetchAll(PDO::FETCH_ASSOC);
    if (count($arr) > 0){
        $row = $arr[0];
        $headImg = $row["headImg"];
        echo json_encode(array("err"=>0,"headImg"=>$headImg));
    }else{
        echo '{"err":1,"msg":"用户未找到"}';
    }

}