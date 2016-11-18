<?php
$pdo = new PDO("mysql:host=".SAE_MYSQL_HOST_M.";port=".SAE_MYSQL_PORT.";dbname=".SAE_MYSQL_DB.";",SAE_MYSQL_USER,SAE_MYSQL_PASS);
$pdo->exec("set names utf8");

$openid = $_GET["openid"];
$nickname = $_GET["nickname"];

//查询总玩家数
$result = $pdo->query("SELECT count(id) FROM xuanfengsaiche");
$totalArr = $result->fetchAll(PDO::FETCH_ASSOC);
//强制转成数值型
$total =  (int)$totalArr[0]["count(id)"];

//查询玩家分数
$result = $pdo->query("SELECT * FROM xuanfengsaiche WHERE openid = '{$openid}'");
$arr = $result->fetchAll(PDO::FETCH_ASSOC);
$dbScore = $arr[0]["score"];

//玩家排名查询
$result = $pdo->query("SELECT count(id) FROM xuanfengsaiche WHERE score>= '{$dbScore}'");
$playerArr = $result->fetchAll(PDO::FETCH_ASSOC);
//强制转成数值型
$playerCount =  (int)$playerArr[0]["count(id)"];
$per = floor(($total-$playerCount+1)/$total*100);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="css/share.css">
    <title>旋风赛车</title>
</head>
<body>
<div id="wrap0">
    <div id="wdiv0">
        <p id="wp0">你的好友<span id="wspan0" style="margin: 0 2%;"><?php echo $nickname;?></span></p>
        <p id="wp1" style="font-size: 30px;">邀请你做TA的导师</p>
    </div>
    <div id="wdiv1">
        <div id="wdiv2">
            <span>闯过了</span>
            <span class="wgai"><?php echo $dbScore;?></span>
            <span>个障碍物</span>
        </div>
        <div id="wdiv3">
            <span>胜出全国</span>
            <span class="wgai"><?php echo $per;?>%</span>
            <span>的玩家</span>
        </div>
    </div>
    <img id="wimg0" src="img/不错呦晋级.png" alt="" />
    <img id="wimg1" src="img/你丫太差了.png" alt="" />
</div>
<div id="wrap1">
    <div id="wdiv4">
        <span id="wgai1"><?php echo $nickname;?></span>
        <span id="wspan1">拜谢你</span>
    </div>
    <img id="wimg2" src="img/我也要挑战.png"/>
</div>
<script src="js/jquery-2.2.3.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">

    //点击晋级
    $("#wimg0").on("touchstart",function(){
        $("#wrap0").css("display","none");
        $("#wrap1").css("display","block");
        $.ajax({
            type:"post",
            url:"index_api.php",
            data:{
                type: "promotion",
                openid: "<?php echo $openid?>",
                typename: "promotion"
            },
            dataType:"json",
            success:function(data){
                console.log(data.msg);
            }
        });
    });
    //点击太差了
    $("#wimg1").on("touchstart",function(){
        $("#wrap0").css("display","none");
        $("#wrap1").css("display","block");
        $.ajax({
            type:"post",
            url:"index_api.php",
            data:{
                type: "promotion",
                openid: "<?php echo $openid?>",
                typename: "bad"
            },
            dataType:"json",
            success:function(data){
                console.log(data.msg);
            }
        });
    });
    $("#wimg2").on("touchstart",function(){
        window.location.assign("https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3d459d680bfe616d&redirect_uri=http://wangjjsvn.applinzi.com/xuanfengsaiche/index.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
    });
</script>
</body>
</html>