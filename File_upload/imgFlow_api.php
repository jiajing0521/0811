<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/14
 * Time: 上午11:20
 */

//url:img_api.php
//type:get
//data:{start:1}每次图片的开始位置
//return：{"count":4,"imgs":[{id:XX,path:XXX/xx.jpg},"xx.jpg"]}

if (isset($_GET["start"])){
    $start = $_GET["start"];
    $pdo = new PDO("mysql:host=localhost;dbname=0811","root","");
    $result = $pdo->query("SELECT * FROM imgupload LIMIT {$start},4");
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["count"=>$result->rowCount(),"imgs"=>$rows]);
}