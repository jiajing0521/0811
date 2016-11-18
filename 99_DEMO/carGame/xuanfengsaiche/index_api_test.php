<?php
//连接数据库
//$pdo = new PDO("mysql:host=".SAE_MYSQL_HOST_M.";port=".SAE_MYSQL_PORT.";dbname=".SAE_MYSQL_DB.";",SAE_MYSQL_USER,SAE_MYSQL_PASS);
$pdo = new PDO("mysql:host=localhost;dbname=0811","root","");

$pdo->exec("set names utf8");


//$pdo = new PDO("mysql:host=localhost;dbname=0811","root","");
//$pdo->exec("set names utf8");

if(isset($_POST["type"])){
	$type = $_POST["type"];
	switch ($type) {
        //获取排名
		case 'getRangking':

            $openid = $_POST["openid"];
		    $gameScore = $_POST["gameScore"];
		    //排行查询
			$result = $pdo->query("SELECT * FROM xuanfengsaiche ORDER BY score DESC LIMIT 9");
			$count = $result->rowCount();
			$arr = $result->fetchAll(PDO::FETCH_ASSOC);
            //玩家排名查询
            $result = $pdo->query("SELECT count(id) FROM xuanfengsaiche WHERE score>= '{$gameScore}'");
            $playerArr = $result->fetchAll(PDO::FETCH_ASSOC);
            //强制转成数值型
            $playerCount =  (int)$playerArr[0]["count(id)"];
            //玩家信息查询
            $result = $pdo->query("SELECT * FROM xuanfengsaiche WHERE openid = '{$openid}'");
            $playerArr1 = $result->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(["err"=>0, "listCount"=>$count,"items"=>$arr,"playerCount"=>$playerCount,"playerItems"=>$playerArr1]);
			break;
        //保存分数
        case 'setGameScore':
            $gameScore = $_POST["gameScore"];
            $openid = $_POST["openid"];

            //查询总玩家数
            $result = $pdo->query("SELECT count(id) FROM xuanfengsaiche");
            $totalArr = $result->fetchAll(PDO::FETCH_ASSOC);
            //强制转成数值型
            $total =  (int)$totalArr[0]["count(id)"];

            //玩家排名查询
            $result = $pdo->query("SELECT count(id) FROM xuanfengsaiche WHERE score>= '{$gameScore}'");
            $playerArr = $result->fetchAll(PDO::FETCH_ASSOC);
            //强制转成数值型
            $playerCount =  (int)$playerArr[0]["count(id)"];
            $per = round(($total-$playerCount+1)/$total*100);

            //查询玩家分数
            $result = $pdo->query("SELECT * FROM xuanfengsaiche WHERE openid = '{$openid}'");
            $arr = $result->fetchAll(PDO::FETCH_ASSOC);
            $dbScore = $arr[0]["score"];
            //没有超过最高分
            if ($dbScore >= $gameScore){
                echo json_encode(["err"=>"没有超过最高分","per"=>$per]);
            //超过最高分,更新数据库
            }else{
                $count = $pdo->exec("UPDATE xuanfengsaiche SET score = '{$gameScore}' WHERE openid = '{$openid}'");
                echo json_encode(["err"=>"超过最高分,更新数据库","per"=>$per]);
            }
            break;
        //点击晋级
        case 'promotion':
            $openid = $_POST["openid"];
            $typename = $_POST["typename"];

            //查询玩家分数
            $count = $pdo->exec("UPDATE xuanfengsaiche SET {$typename} = {$typename}+1 WHERE openid = '{$openid}'");

            if ($count > 0){
                echo json_encode(["err"=>0,"msg"=>"更新成功"]);
            }else{
                $count = $pdo->exec("UPDATE xuanfengsaiche SET score = '{$gameScore}' WHERE openid = '{$openid}'");
                echo json_encode(["err"=>1,"msg"=>"更新失败"]);
            }
            break;
        //点击提交获奖信息成功
        case "submit":
            $name = $_POST["name"];
            $tel = $_POST["tel"];
            $openid = $_POST["openid"];
            $address = $_POST["address"];
            $typename = $_POST["typename"];
            $count = $pdo->exec("UPDATE xuanfengsaiche SET name = '{$name}', tel = '{$tel}',address = '{$address}',type = '{$typename}'WHERE openid = '{$openid}'");

            if ($count > 0){
                echo json_encode(array("err"=>0));
            }else{
                echo ('{"err":1, "msg": "submit更新失败,请检查SQL语句"}');
            }
            break;
		default:
			echo "type错误";
			break;
	}
}else{
	die("请进入主页面");
};


