<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/jquery-2.2.3.min.js" type="text/javascript"></script>
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
            <p class="textRullTittle">活动规则</p>
            <p class="textRullCtx">
                1、每人有多次游戏机会，但成绩只能提交一次，而且提交之后不能更改！
                <br>
                2、提交成绩时要提供姓名及手机号码作为兑奖凭证，因用户本人未在规定时间内提供正确的手机号码造成的奖品损失，由用户个人承担。
                <br>
                3、活动时间为2016年5月11日-5月19日24:00,活动结束后将在“雾灵山庄”微信公布中奖名单。
                <br>
                4、活动规则：系统将根据大家提交的成绩。按照由多到少的规则进行排行。排名第1的网友将获得一等奖，排名第2-第21位的网友将分获二等奖，以此类推。
                <br>
                5、奖品的发放:活动结束后，将由工作人员与您取得联系，并将相应的卡卷编号，发送到您提供的手机号码上。
            </p>
<!--            一等奖一人:价值1488元7号楼一晚豪华标间，免费房券一张，并可向康体项目三折优惠。-->
<!--            二等奖二十人:100元订房代金券每人一张，并可享康体项目四折优惠。-->
<!--            三等奖五十人：五十元，订房代金券每人一张，并可享康体项目五折优惠。-->
<!--            奖品的有效期:2016年5月20日至6月15日，（周五、周六及法定节假日不可用）-->
        </div>
    </div>

    <div class="gameAward hiddenInfo">
        <img src="img/img1/资料关闭btn.png" class="close" alt="">
        <div class="textAward">
            <p class="textAwardTittle">活动奖品</p>
            <p class="textAwardCtx">
                一等奖一人:价值1488元7号楼一晚豪华标间，免费房券一张，并可向康体项目三折优惠。
                <br>
                二等奖二十人:100元订房代金券每人一张，并可享康体项目四折优惠。
                <br>
                三等奖五十人：五十元，订房代金券每人一张，并可享康体项目五折优惠。
                <br>
                奖品的有效期:2016年5月20日至6月15日，（周五、周六及法定节假日不可用）
            </p>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {

        //小手的动画
        setInterval(function () {
            $(".startPoint").animate({
                opacity: 1
            },1000,function () {
                $(this).css({
                    opacity: 0
                })
            });
        },1000);
//        function startPointMove() {
//            $(".startPoint").animate({
//                opacity: 1
//            },1000,function () {
//                $(this).css({
//                    opacity: 0
//                })
//            });
//            setTimeout(startPointMove(),2000);
//        }
//        startPointMove();

        //点击游戏开始
        $(".startBtn").on("touchstart",function () {

            $(".userInfo").css({
                display : "block"
            })

        })
        $(".close").on("touchstart",function () {
            $(".userInfo").css({
                display : "none"
            })
        })
        $(".btn2").on("touchstart",function () {

            $(".gameRull").css({
                display : "block"
            })

        })
        $(".btn3").on("touchstart",function () {

            $(".gameAward").css({
                display : "block"
            })

        })






    })
</script>
</body>
</html>
