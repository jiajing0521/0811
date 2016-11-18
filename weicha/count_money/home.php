
<?php

//定义微信appid常量

//定义微信appid常量
define("APPID","wx3d459d680bfe616d");
define("APPSECRET","2f2f4871417acd8dac8f9f1820b4449d");

//https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3d459d680bfe616d&redirect_uri=http://wangjj.applinzi.com/count_money/home.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect
//1.连接数据库
$pdo = new PDO("mysql:host=".SAE_MYSQL_HOST_M.";port=".SAE_MYSQL_PORT.";dbname=".SAE_MYSQL_DB.";",SAE_MYSQL_USER,SAE_MYSQL_PASS);
$pdo->exec("set names utf8");
//返回授权code
$code = $_GET["code"];

//echo $code;
//2.获取token和openid
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code={$code}&grant_type=authorization_code";

$result = httpGet($url);

$arr = json_decode($result,true);
$token = $arr["access_token"];
$openid = $arr["openid"];

//3.拉取用户信息(需scope为 snsapi_userinfo)
$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}&lang=zh_CN";
$result = httpGet($url);
$userInfoArr = json_decode($result,true);
$nickname = $userInfoArr["nickname"];
$headImg = $userInfoArr["headimgurl"];

//4.检验用户是否存在
$newFlag = false;
$result = $pdo->query("SELECT * FROM game_user WHERE openid = '{$openid}'");
$game_useArr = $result->fetchAll(PDO::FETCH_ASSOC);
//query函数的返回值有两种情况,正常查询返回一个对象obj,如果SQL语句有问题返回false
if ($result){
    $count = $result->rowCount();
    $id = $game_useArr[0]["id"];
    $name = $game_useArr[0]["name"];
    $tel = $game_useArr[0]["tel"];
    $scores = $game_useArr[0]["scores"];
    //如果存在
    if ($count > 0){
        //已录入信息
        if ($name!="" && $tel!=""){
            //获取用户信息

        //未录入信息
        }else{
            $newFlag = true;
        }
        //如果不存在
    }else{
        $countInsert = $pdo->exec("INSERT INTO game_user (id,openid,headImg,nickname,scores) VALUE (NULL,'{$openid}','{$headImg}','{$nickname}','0')");
        if ($countInsert > 0){
            $newFlag = true;
        }else{
            echo "新用户".$nickname.",登录失败";
        }
    }
}else{
    die( "请检查sql语句");
}

//**********************************************
function httpGet($url) {
    //网络扩展库,初始化
    $curl = curl_init();
    //结果返回设置
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //超时设置
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    //验证token, 本地可以注释掉, 上线必须打开
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    //调用请求
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}

function httpPost ($data,$url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $tmpInfo = curl_exec($ch);
    if (curl_errno($ch)) {
        return curl_error($ch);
    }
    curl_close($ch);
    return $tmpInfo;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/gamestart.css">
    <link rel="stylesheet" href="css/gameOver.css">
    <script src="js/zepto.min.js" type="text/javascript"></script>
    <script src="js/zepto.touch.js" type="text/javascript"></script>
    <title>home</title>

</head>
<body>
<div class="wrap">
    <img src="img/img1/挑战.png" alt="" class="text1">
    <img src="img/img1/数钱速度.png" alt="" class="text2">
    <img src="img/img1/开始游戏.png" alt="" class="startBtn">
    <img src="img/img1/小手.png" alt="" class="startPoint">
    <div class="btnBg">
        <img src="img/img1/数钱榜.png" alt="" class="btn1 btn0"><img class="btn2 btn0" src="img/img1/活动规则.png" alt=""><img class="btn3 btn0" src="img/img1/活动奖品.png" alt=""><img class="btn4 btn0" src="img/img1/奖券使用说明.png" alt="">
    </div>
    <div class="userInfo hiddenInfo">
        <img src="img/img1/资料关闭btn.png" class="close" alt="">
        <div class="fillInfo">
            <input type="text" placeholder="姓名" name="username" id="username">
            <input type="text" placeholder="电话" name="tel" id="tel">

            <img src="img/img1/提交.png" alt="" id="sbm">
        </div>
    </div>
    <div class="gameRull hiddenInfo">
        <img src="img/img1/资料关闭btn.png" class="close" alt="">
        <div class="textRull">
        </div>
    </div>

    <div class="gameAward hiddenInfo">
        <img src="img/img1/资料关闭btn.png" class="close" alt="">
        <div class="textAward">
        </div>
    </div>

    <div class="money_list hiddenInfo">
        <img src="img/img1/资料关闭btn.png" class="close" alt="">
        <div class="text_money_list">
        </div>
    </div>

    <div class="explain hiddenInfo">
        <img src="img/img1/资料关闭btn.png" class="close" alt="">
        <div class="text_explain">
        </div>
    </div>
    <div class="content2">
        <div class="textImg">
            <img src="img/img2/文案1.png" alt="">
        </div>
        <div class="timeImg">
<!--            <img src="img/img2/分数时间.png" alt="">-->
            <p class="score1 scores">0</p>
            <p class="score2 scores">0</p>
            <p class="score3 scores">0</p>
            <p class="time">20</p>
        </div>
        <div class="handImg">
            <img src="img/img2/数钱手.png" alt="">
        </div>
        <div class="moneyBig"></div>
    </div>
    <div class="content3">
        <p class="gameScores">￥888</p>
        <p class="gameWords">你太客气了，这不是你的挑战极限吧</p>
        <div class="gameText">
            <span class="topText">我的辉煌战绩: </span>
            <span class="topScores">￥999</span>
            <span class="nowText">当前排名：</span>
            <span class="nowOrder">62位</span>
        </div>
        <div class="again abtn">
            <img src="img/img3/再来一次btn.png" alt="">
        </div>
        <div class="share abtn">
            <img src="img/img3/分享btn.png" alt="">
        </div>
        <img src="img/img3/Сmn.png" alt="" class="cmn">
    </div>
    <div class="content4">
        <img src="img/img3/分享.png" alt="" class="shareImg">
    </div>
</div>

<script type="text/javascript">
    var gmScores = 0;
    var score1 = 0;
    var score2 = 0;
    var score3 = 0;
    var gameTime = 10;
    var timer;
    var timer1;
    var timer2;
    var scoreFlag = false;
    var highScores = 0;
    var range = 0;
    $(function () {

        //**********点击游戏开始
        $(".startBtn").on("touchstart",function () {

            //+++++++++判断新用户
            <?php
            if ($newFlag){
            ?>
            console.log("未录入姓名电话");
            $(".userInfo").css({
                display : "block"
            });

            //***********点击提交并开始游戏
            $("#sbm").on("touchstart",function () {
                //1.弹出信息录入，如果没有输入，则弹出提示框
                if($("#username").val() == "" || $("#tel").val() == ""){
                    alert("请输入信息后开始游戏");
                //2.如果有输入，点击提交，向后台数据库提交数据，更新姓名和电话
                }else{
                    $.ajax({
                        url:"api.php",
                        type:"post",
                        data:{
                            type: "submit",
                            openid: "<?php echo $openid;?>",
                            name: $("#username").val(),
                            tel: $("#tel").val()
                        },
                        dataType: "json",
                        success: function (data) {
                            //2.1更新成功后，
                            if (data.err == 0){

                                //2.1.1样式修改

                                $(".userInfo").css({
                                    display : "none"
                                });

                                $(".wrap").css({
                                    background : "url('img/img2/bg1.png') no-repeat",
                                    backgroundSize : "100% 100%"
                                });
                                $(".wrap").children().css({
                                    display : "none"
                                });
                                $(".content2").css({
                                    display: "block"
                                });

                                //2.1.2游戏监听
                                //获取最高分数
                                highScores = data.scores;
                                eventTimer();


                                //游戏文案轮播
                                var imgCount = 1;
                                clearInterval(timer2);
                                timer2 = setInterval(function () {
                                    imgCount++;
                                    if (imgCount == 4){
                                        imgCount = 1;
                                    }
                                    $(".textImg img").attr("src","img/img2/文案"+imgCount+".png");
                                },3000);
                            //更新失败
                            }else{
                                console.log(data.msg);
                            }
                        }
                    });
                }
            });
            //+++++++++判断旧用户
            <?php
            }else{
            ?>
            console.log("已录入姓名电话");

            //2.2.1样式修改

            $(".wrap").css({
                background : "url('img/img2/bg1.png') no-repeat",
                backgroundSize : "100% 100%"
            });
            $(".wrap").children().css({
                display : "none"
            });
            $(".content2").css({
                display: "block"
            });
            //2.2.2游戏监听
            //获取最高分数
            highScores = <?php echo $scores?>;
            eventTimer();

            //游戏文案轮播
            var imgCount = 1;
            timer2 = setInterval(function () {
                imgCount++;
                if (imgCount == 4){
                    imgCount = 1;
                }
                $(".textImg img").attr("src","img/img2/文案"+imgCount+".png");
            },5000);
            <?php
            }
            ?>

        });

        //游戏监听，时间监控
        function eventTimer() {
            clearInterval(timer);
            timer = setInterval(function () {
                gameTime--;
                $(".time").html(gameTime);

                //时间停止后，游戏结束
                if (gameTime == 0){
                    clearInterval(timer);
                    $(".gameScores").html("￥"+gmScores);


                    //向后台请求数据，看最高成绩和排名
                    //如果本次得分没有大于最高成绩，则正常输出
                    if (gmScores <= highScores){
                        $(".topScores").html("￥"+highScores);
                    //如果本次得分大于最高成绩，则更新数据库
                    }else {
                        $(".topScores").html("￥"+gmScores);
                        highScores = gmScores;

                        //更新数据库中最高分数
                        $.ajax({
                            url:"api.php",
                            type:"post",
                            data:{
                                type: "newScores",
                                openid: "<?php echo $openid;?>",
                                highScores: highScores
                            },
                            dataType: "json",
                            success: function (data) {
                                //2.1更新成功后，
                                if (data.err == 0){
                                    console.log(data.id);
                                }else{
                                    console.log(data.msg);
                                }
                            }
                        });
                    }
                    //排名
                    $.ajax({
                        url:"api.php",
                        type:"post",
                        data:{
                            type: "range",
                            openid: "<?php echo $openid;?>",
                            highScores: highScores
                        },
                        dataType: "json",
                        success: function (data) {
                            //2.1更新成功后，
                            if (data.err == 0){
                                range = data.range;
                                console.log(data.range);
                            }else{
                                console.log(data.msg);
                            }
                            $(".nowOrder").html(range+"位");
                        }
                    });

                    gameOver();

                }
            },1000);
        }

        function gameOver() {
            //初始时间和分数
            gameTime = 0;
            score1 = 0;
            score2 = 0;
            score3 = 0;
            gmScores = 0;
            $(".score1").html(score1);
            $(".score2").html(score2);
            $(".score3").html(score3);
            $(".moneySmall").remove();

            //修改样式
            $(".wrap").css({
                background : "url('img/img3/bg.png') no-repeat",
                backgroundSize : "100% 100%"
            });
            $(".content2").css({
                display: "none"
            });
            $(".content3").css({
                display: "block"
            });
            $(".btnBg").css({
                display: "block"
            })
        }
        //再次开始
        $(".again").on("touchstart",function () {
            gameTime = 10;

            //修改样式
            $(".wrap").css({
                background : "url('img/img2/bg1.png') no-repeat",
                backgroundSize : "100% 100%"
            });
            $(".content3").css({
                display: "none"
            });
            $(".content2").css({
                display: "block"
            });
            $(".btnBg").css({
                display: "none"
            });

            //游戏监听
            eventTimer();
        });

        //滑动数钱
        $(".moneyBig").swipeUp(function () {
            $(".moneySmall").remove();
            $(".handImg").css({
                display:"none"
            });

            var newMoney = $("<img src='img/img2/mn3.gif'>");
            $(".content2").append(newMoney);
            newMoney.attr("class","moneySmall");

            score3++;
            gmScores++;
            if (score3 >= 10){
                score3 = 0;
                score2++;
            }
            if (score2 >= 10){
                score2 = 0;
                score1++;
            }
            $(".score1").html(score1);
            $(".score2").html(score2);
            $(".score3").html(score3);
        });


        //分享按钮
        $(".share").on("touchstart",function () {
            $(".content4").css({
                display: "block"
            });
            $(".content4").on("touchstart",function () {
                $(this).css({
                    display: "none"
                });
            })

        });

        //数钱榜按钮
        $(".btn1").on("touchstart",function () {

            $(".money_list").css({
                display : "block"
            });

            $.ajax({
                url:"api.php",
                type:"post",
                data:{
                    type: "range_list"
                },
                dataType: "json",
                success: function (data) {
                    //2.1更新成功后，
                    if (data.err == 0){

                        for (var i = 0; i < data.count; i++){
                            var itemArr = data["item"][i];
                            var newLi = $("<li class='lis'></li>");
                            var newImg = $("<img class='headImg'>");
                            var newNm = $("<span></span>");
                            var newSc = $("<span class='newSc'></span>");
                            newImg.attr("src",itemArr.headImg);
                            newNm.html(itemArr.nickname+" ");
                            newSc.html(" "+itemArr.scores + "分");
                            $(".text_money_list").append(newLi);
//                            newLi.append(newImg);
                            newLi.append(newNm);
                            newLi.append(newSc);

                        }
                        
                    }else{
                        console.log(data.msg);
                    }
                    $(".nowOrder").html(range+"位");
                }
            });


        });

        //活动规则按钮
        $(".btn2").on("touchstart",function () {

            $(".gameRull").css({
                display : "block"
            })

        });
        //活动奖品按钮
        $(".btn3").on("touchstart",function () {

            $(".gameAward").css({
                display : "block"
            })

        });
        //使用说明按钮
        $(".btn4").on("touchstart",function () {

            $(".explain").css({
                display : "block"
            })

        });
        //关闭按钮
        $(".close").on("touchstart",function () {
            $(".text_money_list").empty();
            $(".userInfo").css({
                display : "none"
            });
            $(".money_list").css({
                display : "none"
            });
            $(".gameRull").css({
                display : "none"
            });
            $(".gameAward").css({
                display : "none"
            })
            $(".explain").css({
                display : "none"
            })
        });

        //阻止手机的touchmove默认事件，防止页面可以拖动
        document.addEventListener("touchmove",function (e) {
            var e = e||window.event;
            e.preventDefault();
        },false);

    })
</script>
<?php
require_once "jssdk.php";
//$jssdk = new JSSDK("wx2b0a7e0a08e762ce", "fab2d6c17a2f0e6fcc6144e040f3ce90");
$jssdk = new JSSDK("wx3d459d680bfe616d", "2f2f4871417acd8dac8f9f1820b4449d");
$signPackage = $jssdk->GetSignPackage();
?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    wx.config({
        debug: true,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            "onMenuShareTimeline",
            "onMenuShareAppMessage"
        ]
    });

    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: '数钱游戏', // 分享标题
            link: 'http://wangjj.applinzi.com/count_money/home.php', // 分享链接
            imgUrl: 'http://img1.imgtn.bdimg.com/it/u=4125761048,2667572205&fm=21&gp=0.jpg', // 分享图标
            success: function () {

            },
            cancel: function () {
            }
        });

        wx.onMenuShareAppMessage({
            title: '数钱游戏', // 分享标题
            desc: '首次开发微信游戏', // 分享描述
            link: 'http://wangjj.applinzi.com/count_money/home.php', // 分享链接
            imgUrl: 'http://img1.imgtn.bdimg.com/it/u=4125761048,2667572205&fm=21&gp=0.jpg', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

    });
</script>
</body>
</html>
