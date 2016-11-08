<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/3
 * Time: 下午3:41
 */

//url: update.php
//method: post
//参数: id(int),type(string),value(string)
//返回值:{"err":0,"msg":"修改成功"}




if (isset($_POST["id"])&&isset($_POST["type"])&&isset($_POST["value"])){
    $id = $_POST["id"];
    $type = $_POST["type"];
    $value = $_POST["value"];

    //连接DB(引入)如果引入的文件有错,报警告,程序继续走,一般使用它
    require_once "DB_CONNECT.php";
    //如果引入的文件有错,程序停止
//    include_once "DB_CONNECT.php";

    $count = $pdo->exec("UPDATE login SET {$type} = '{$value}' WHERE id = '{$id}' ");
    if ($count > 0){
        echo '{"err":0,"msg":"修改成功"}';
    }else{
        echo '{"err":1,"msg":"未修改"}';
    }

}

