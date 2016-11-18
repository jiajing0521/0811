<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/11
 * Time: 上午10:32
 */

//1.连接数据库
$pdo = new PDO("mysql:host=".SAE_MYSQL_HOST_M.";port=".SAE_MYSQL_PORT.";dbname=".SAE_MYSQL_DB.";",SAE_MYSQL_USER,SAE_MYSQL_PASS);
$pdo->exec("set names utf8");

if (isset($_POST["type"])){
    $type = $_POST["type"];
    switch ($type){
        case "submit":
            $name = $_POST["name"];
            $tel = $_POST["tel"];
            $openid = $_POST["openid"];
            $count = $pdo->exec("UPDATE game_user SET name = '{$name}', tel = '{$tel}' WHERE openid = '{$openid}'");
            //最后插入的id
            $id = $pdo->lastInsertId();
            if ($count > 0){
                echo json_encode(array("err"=>0,"id"=>$id,"scores"=>"0"));
            }else{
                echo ('{"err":1, "msg": "submit更新失败,请检查SQL语句"}');
            }
            break;
        case "range":
            $openid = $_POST["openid"];
            $highScores = $_POST["highScores"];
            $result = $pdo->query("SELECT count(id) FROM game_user WHERE scores>= '{$highScores}' ");
            $countArr= $result->fetchAll(PDO::FETCH_ASSOC);
            //强制转成数值型
            $counts =  (int)$countArr[0]["count(id)"];
            if ($counts > 0){
                echo json_encode(array("err"=>0,"range"=>$counts));
            }else{
                echo ('{"err":1, "msg": "排名查询失败"}');
            }

            break;
        case "newScores":
            $openid = $_POST["openid"];
            $highScores = $_POST["highScores"];
            $count = $pdo->exec("UPDATE game_user SET scores = '{$highScores}' WHERE openid = '{$openid}'");
            //最后插入的id
            $id = $pdo->lastInsertId();
            if ($count > 0){
                echo json_encode(array("err"=>0,"id"=>$id));
            }else{
                echo ('{"err":1, "msg": "submit更新失败,请检查SQL语句"}');
            }
            break;
        case "range_list":
            $result = $pdo->query("SELECT * FROM game_user ORDER BY scores DESC LIMIT 5");
            $arr = $result->fetchAll(PDO::FETCH_ASSOC);

            $str = json_encode($arr);

            if (count($arr) > 0){
                echo '{"err":0,"msg":"更新成功","count": '.count($arr).',"item":'.$str.'}';
            }else{
                echo '{"err":1,"msg":"更新失败"}';
            }

            break;
        default:
            die('{"err":1, "msg": "type参数错误"}');
            break;
    }
}