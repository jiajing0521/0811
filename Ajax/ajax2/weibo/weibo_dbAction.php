<?php

//连接DB
require_once "DB_CONNECT.php";
date_default_timezone_set("PRC");

//点击发布
if(isset($_POST["content"])){
//content
//time	

	$content = $_POST["content"];
	$time = time();
	$date = date("发表于 Y-m-d H时i分 ",$time);

	$row = $pdo->exec("INSERT INTO weibo (content,time,liked,unlike) VALUE ('{$content}','{$time}',0,0)");

	if($row > 0){
		echo json_encode(array("err"=>0,"time"=>$date,"msg"=>"发布成功"));
	}else{
		echo '{"err": 1,"msg":"加载失败"}';
	}
}

//点赞点踩
else if(isset($_POST["type"])&&isset($_POST["count"])&&isset($_POST["time"])){
//参数
//type
//count
//time
//返回值{err:0(成功)，count:count+1}
	$type = $_POST["type"];
	$count = $_POST["count"]+1;
	$time = $_POST["time"];
//echo 11111111111;
//	echo $count;
//	$sql = "UPDATE weibo SET {$type} = $count WHERE time = '{$time}'";
//	echo $sql;
	$row = $pdo->exec("UPDATE weibo SET {$type} = $count WHERE time = '{$time}'");

	if($row > 0){
		echo '{"err": 0,"count":'.$count.'}';
	}else{
		echo '{"err": 1,"msg":"加载失败"}';
	}
}

//点击删除
else if(isset($_POST["time"])){
//参数
//time
//返回值{err:0(成功)，msg:"删除成功"}/{err:1(失败),msg:"加载失败"}
	$time = $_POST["time"];
	
	$row = $pdo->exec("DELETE FROM weibo WHERE time = '{$time}'");
	
	if($row > 0){
		echo '{"err": 0,"msg":"加载成功"}';
	}else{
		echo '{"err": 1,"msg":"加载失败"}';
	}
}



