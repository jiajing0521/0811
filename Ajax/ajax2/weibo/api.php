<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/4
 * Time: 上午11:01
 */

require_once "DB_CONNECT.php";

//点击发布
//接口:api.php
//method:post
//参数;{type: "submit", content: "hgskh"}
//type的值:submit是提交一条新的,liked是点赞,unlike是踩,remove是删除
//返回值:{"err": 0, "time":"2016-11/3 00:00"}

if (isset($_POST["type"])){
    $type = $_POST["type"];
    switch ($type){
        case "submit":
            $content = $_POST["content"];
            $time = time();
            $date = date("Y-m-d H:i");
            $count = $pdo->exec("INSERT INTO weibo (id,content,time,liked,unlike) VALUE (NULL,'{$content}','{$time}',0,0)");
            //最后插入的id
            $id = $pdo->lastInsertId();
            if ($count > 0){
                echo json_encode(array("err"=>0,"time"=>$date,"id"=>$id));
            }else{
                echo ('{"err":1, "msg": "插入失败,请检查SQL语句"}');
            }
            break;
        case "liked":
            break;
        case "unlike":
            break;
        case "remove":
            $id = $_POST["id"];
            $count = $pdo->exec("DELETE FROM weibo WHERE id = {$id}");
            if($count > 0){
                echo '{"err":0,"msg":"删除成功"}';
            }else{
                echo '{"err":1,"msg":"删除失败"}';
            }
            break;
        default:
            die('{"err":1, "msg": "type参数错误"}');
            break;
    }
}

