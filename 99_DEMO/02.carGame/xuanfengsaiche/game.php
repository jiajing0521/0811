<?php
//require_once "jssdk.php";
//$jssdk = new JSSDK("wx3d459d680bfe616d", "2f2f4871417acd8dac8f9f1820b4449d");
//$signPackage = $jssdk->GetSignPackage();
//?>
<?php
////第一步
//
////https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3d459d680bfe616d&redirect_uri=http://wangjjsvn.applinzi.com/xuanfengsaiche/index.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect
//
////定义微信appid常量,appsecret常量
//define("APPID","wx3d459d680bfe616d");
//define("APPSECRET","2f2f4871417acd8dac8f9f1820b4449d");
//
////第二步 请求方法 复制地址
//$code = $_GET["code"];
//$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code={$code}&grant_type=authorization_code";
//$result = httpGet($url);
//$arr = json_decode($result,true);
//$token = $arr["access_token"];
//$openid = $arr["openid"];
////第三步：拉取用户信息(需scope为 snsapi_userinfo)
//$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}&lang=zh_CN";
//$result = httpGet($url);
//$arr = json_decode($result,true);
////第四步：连接数据库
//$pdo = new PDO("mysql:host=".SAE_MYSQL_HOST_M.";port=".SAE_MYSQL_PORT.";dbname=".SAE_MYSQL_DB.";",SAE_MYSQL_USER,SAE_MYSQL_PASS);
$pdo = new PDO("mysql:host=localhost;dbname=0811","root","");
$pdo->exec("set names utf8");

$openid = "test";

//查重
//1.检查数据库中有没有该用户(openid为唯一标识)
$result = $pdo->query("SELECT * FROM xuanfengsaiche WHERE openid = '{$openid}'");
$arr = $result->fetchAll(PDO::FETCH_ASSOC)[0];
if ($result){
    $count = $result->rowCount();
    //获取用户信息
    $nickname = $arr["nickname"];
    //如果存在
    if ($count > 0){
//        echo "老用户".$nickname.",登录成功";
        //如果不存在
    }else{
        $countInsert = $pdo->exec("INSERT INTO xuanfengsaiche (id,openid,nickname,score) VALUE (NULL,'{$openid}','{$nickname}',0)");
        if ($countInsert > 0){
//            echo "新用户".$nickname.",登录成功";
        }else{
//            echo "新用户".$nickname.",登录失败";
        }
    }
}else{
    echo "请检查sql语句";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="css/index.css">
    <title>旋风赛车</title>
</head>
<body>
<div id="all0">
    <img id="img0" src="img/第一页第一排字.png" alt="">
    <img id="img1" src="img/第一页第二排字.png" alt="">
    <img id="img2" src="img/第一页第三排字.png" alt="">
    <img id="img3" src="img/我要挑战.png" alt="">
    <img id="img4" src="img/游戏规则.png" alt="">
</div>
<div id="all1">
    <img id="img5" src="img/游戏规则点击后啊.png" alt="" />
    <div id="cha"></div>
</div>
<div id="all2">
    <img id="img6" src="img/开始游戏.png" alt="" />
</div>
<div id="all3">
    <img id="img7" class="showRanking" src="img/查看排行榜q1.png" alt="" />
    <img id="img8" src="img/邀请导师啊.png" alt="" />
    <div id="div0">
        <div id="div1">
            <span>你共闯过了</span>
            <span class="gai gamescoreText">53</span>
            <span>个障碍物</span>
        </div>
        <div id="div2">
            <span>胜出全国</span>
            <span class="gai passPer">70%</span>
            <span>的玩家</span>
        </div>
    </div>
</div>
<div id="all4">
    <img id="img9" src="img/再来一次.png" alt="" />
    <img id="img10" class="showRanking" src="img/查看排行榜q1.png" alt="" />
    <div id="div3">
        <div id="div4">
            <span>你共闯过了</span>
            <span class="gai1 gamescoreText">3</span>
            <span>个障碍物</span>
        </div>
        <div id="div5">
            <span>胜出全国</span>
            <span class="gai1 passPer">7%</span>
            <span>的玩家</span>
        </div>
    </div>
</div>
<div id="all5">
    <img src="img/排行榜1.png" alt="" />
    <div id="cha1"></div>
    <ul class="ranking"></ul>
</div>
<div id="all6">
    <img src="img/分享.png"/>
</div>
<div id="allGame">
    <canvas id="canvas" width="500" height="500">
        低版本浏览器不支持
    </canvas>

    <!--计时器-->
    <div class="timerClock">
        <p class="timerClockP">
            <span class="score1">0</span>:<span class="score2">0</span>:<span class="score3">30</span>
        </p>
    </div>
    <!--起跑线-->
    <img src="img/starting_line.png" alt="" class="starting_line">
    <img src="img/light0.png" alt="" class="light">
<!--    <img src="img/READY.png" alt="" class="ready">-->

    <img src="img/timerClock.png" alt="" >

</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="js/loading.js" type="text/javascript"></script>
<script src="js/jquery-2.2.3.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");

    var gameScores = 0;
    var per = 0;

    canvas.width = document.documentElement.clientWidth;
    canvas.height = document.documentElement.clientHeight;

    function main(imgobj) {

        /************主角车*************/
        var car = {
            img: imgobj.car0,
            w: canvas.width*0.1416666,
            h: canvas.height*0.1721739,
            x: canvas.width*0.430555,
            y: canvas.height*0.607

        };
        car.draw = function () {
            if (addSpeed){
                this.img = imgobj.car1;
                this.h = canvas.height*0.2130434;
            }else {
                this.img = imgobj.car0;
                this.h = canvas.height*0.1721739;
            }
            ctx.drawImage(this.img,this.x,this.y,this.w,this.h);
        };

        /************加速器*************/
        var speedBtn = {
            img: imgobj.speedBtn1,
            w: canvas.width*0.16111111,
            h: canvas.height*0.1791304,
            x: canvas.width*0.8138888,
            y: canvas.height*0.7495652

        };
        speedBtn.draw = function () {
            if (addSpeed){
                this.img = imgobj.speedBtn2;
                this.h = canvas.height*0.147826;
            }else {
                this.img = imgobj.speedBtn1;
                this.h = canvas.height*0.1791304;
            }
            ctx.drawImage(this.img,this.x,this.y,this.w,this.h);
        };

        /************障碍物*************/
        function Roadblock () {
            this.img = imgobj.roadblock;
            this.w = canvas.width*0.0847222;
            this.h = canvas.height*0.0626087;
            this.x = rand(canvas.width*0.0944444,canvas.width-this.w-canvas.width*0.0944444*2);
            this.y = -this.h;
            if (addSpeed){
                if (changeSpeed <= maxSpeed){
                    changeSpeed += 0.05;
                }
                this.speed = changeSpeed;
            }else{
                if (changeSpeed >= minSpeed){
                    changeSpeed -= 0.2;
                }
                this.speed = changeSpeed;
            }
            this.score = 1;
        };
        Roadblock.prototype.draw = function(){
            ctx.drawImage(this.img,this.x,this.y,this.w,this.h);
        };
        Roadblock.prototype.move = function () {
            this.y += this.speed;
        };
        Roadblock.prototype.roadblockPos = function(){
            while (true) {
                var x = rand(canvas.width * 0.0944444, canvas.width - this.w - canvas.width * 0.0944444*2);
                this.x = x;
                var y = -this.h;
                for (var i = 0; i < roadcars.length; i++) {
                    var position = roadcars[i];
//                    if (this.x+this.w >= position.x-10 && this.x<= position.x + position.w + 10 && this.y+this.h >= position.y - 10 && this.y >= position.y + position.h + 10) {
                    if(checkP(this,position)){
                        break;
                    }
                }
                if (i == roadcars.length) {
                    this.x = x;
                    this.y = y;
                    break;
                }
            }
        };
        Roadblock.prototype.canClear = function () {
            return this.y >= canvas.height;
        };
        var roadblocks = [];

        /************障碍车*************/
        function Roadcar () {
            this.img = imgobj.roadcar0;
            this.w = canvas.width*0.1333333;
            this.h = canvas.height*0.1860869;
            this.x = rand(canvas.width*0.0944444,canvas.width-this.w-canvas.width*0.0944444);
            this.y = -this.h;
            if (addSpeed){
                if (changeSpeed <= maxSpeed){
                    changeSpeed += 0.05;
                }
                this.speed = changeSpeed;
            }else{
                if (changeSpeed >= minSpeed){
                    changeSpeed -= 0.2;
                }
                this.speed = changeSpeed;
            }
            this.score = 5;
        };
        Roadcar.prototype.draw = function(){
            ctx.drawImage(this.img,this.x,this.y,this.w,this.h);
        };
        Roadcar.prototype.move = function () {
//            this.y += this.speed;
            this.y += changeSpeed;
        };
        Roadcar.prototype.roadcarPos = function(){
            while (true) {
                var x = rand(canvas.width * 0.0944444, canvas.width - this.w - canvas.width * 0.0944444*2);
                this.x = x;
                var y = -this.h;
                for (var i = 0; i < roadblocks.length; i++) {
                    var position = roadblocks[i];

//                    if (this.x+this.w >= position.x-10 && this.x<= position.x + position.w + 10 && this.y+this.h >= position.y - 10 && this.y >= position.y + position.h + 10) {
                      if (checkP(position,this)){
                          console.log("break");
                          break;
                      }

                }
                if (i == roadblocks.length) {
                    this.x = x;
                    this.y = y;
                    console.log("adsa");
                    break;
                }
            }
        };
        Roadcar.prototype.canClear = function () {
            return this.y >= canvas.height;
        };
        var roadcars = [];

        function rand(min,max) {
            return Math.floor(Math.random()*(max + 1 -min) + min);
        }

        //****************碰撞检测*****************
        function checkP(obj1, obj2) {
            //x轴方向最小距离
            var disX = obj1.w/2 + obj2.w/2;
            //y轴
            var disY = obj1.h/2 + obj2.h/2;

            //两个矩形x轴方向实际的中心距
            var realX = Math.abs((obj1.x + obj1.w/2) - (obj2.x + obj2.w/2));
            //y轴
            var realY = Math.abs((obj1.y + obj1.h/2) - (obj2.y + obj2.h/2));

            if (realX <= disX && realY <= disY) {
                return true;
            }else {
                return false;
            }
        }

        /************画布运动*************/
        var moveY = 0;
        var lightCount = 0;
        var timerClocks = 30;
        var time = 0;
        var addSpeed = false;
        var speedCount = 0;
        var changeSpeed = 3;
        var maxSpeed = 6;
        var minSpeed = 3;
        var gameOver = false;

        //倒计时红绿灯
        function timerLight() {
            if (lightCount < 3){
                $(".light").attr("src","img/light"+lightCount+".png");
                setTimeout(timerLight,1000);
                lightCount++;
            }else {
                $(".light").css({display:"none"});
                $(".starting_line").css({display:"none"});
                $(".ready").css({display:"none"});
                timerClock();
            }
        }
        timerLight();

        //计时器
        function timerClock() {
            $(".score3").html(timerClocks);
            if (timerClocks > 0 && gameOver == false){
                setTimeout(timerClock,1000);
            }else {
                gameOver = true;
            }
            timerClocks--;
        }

        function run() {
            //清空画布
            ctx.clearRect(0,0,canvas.width,canvas.height);

            //1.背景图运动
            time++;
            if (time >= 270){
                if (addSpeed){
                    if (changeSpeed <= maxSpeed){
                        changeSpeed += 0.05;
                    }
                    moveY += changeSpeed;
                }else{
                    if (changeSpeed >= minSpeed){
                        changeSpeed -= 0.05;
                    }
                    moveY += changeSpeed;
                }
                if (moveY >= canvas.height){
                    moveY=0;
                }
                ctx.drawImage(imgobj.racing,0,-canvas.height+moveY,canvas.width,canvas.height);
                ctx.drawImage(imgobj.racing,0,moveY,canvas.width,canvas.height);
            }else{

                ctx.drawImage(imgobj.racing,0,0,canvas.width,canvas.height);
            }
            //终点线
            if (gameOver){
                ctx.drawImage(imgobj.startingline,canvas.width*0.0916666,canvas.height*0.5252173,canvas.width*0.83333333,canvas.height*0.08);
//                roadblocks = [];
//                roadcars = [];
            }

            //2.主角车
            car.draw();
            //3.障碍物
            if (time >= 300 && time <= 2700) {
                if (time%93 == 0) {
                    var roadblock = new Roadblock();
                    roadblock.roadblockPos();
                    roadblocks.push(roadblock);
                }
            }

            for (var i = 0; i < roadblocks.length; i++) {
                var roadblock = roadblocks[i];

                roadblock.speed = changeSpeed;

                roadblock.draw();
                roadblock.move();
                if (roadblock.canClear()){
                    roadblocks.splice(i,1);
                    i--;
//                    gameScores += roadblock.score;
                }
            }

            //4.障碍车
            if (time >= 300 && time <= 2700) {
                if (time%153 == 0) {
                    var roadcar = new Roadcar();
                    roadcar.roadcarPos();
                    roadcars.push(roadcar);
                }
            }
            for (var i = 0; i < roadcars.length; i++) {
                var roadcar = roadcars[i];
                roadcar.speed = changeSpeed;
                roadcar.move();
                if(time%463 == 0){
                    roadcar.img = imgobj.roadcar2;
                    roadcar.w = canvas.width*0.175;
                    roadcar.h = canvas.height*0.1860869;
                }

                roadcar.draw();
                if (roadcar.canClear()){
                    roadcars.splice(i,1);
                    i--;
//                    gameScores += roadcar.score;
                }
            }
            //5.加速器
            speedBtn.draw();

            //6.左右控制按钮
            ctx.drawImage(imgobj.btn_left,canvas.width*0.2152777,canvas.height*0.777391,canvas.width*0.2152777,canvas.height*0.1347826);
            ctx.drawImage(imgobj.btn_right,canvas.width*0.5722222,canvas.height*0.777391,canvas.width*0.2152777,canvas.height*0.1347826);

            //6.碰撞检测
//            for (var i = 0; i < roadcars.length; i++){
//                if (checkP(roadcars[i],car)){
//                    gameOver = true;
//                }else
//                if (roadcars[i].y >= car.y + car.h && roadcars[i].y <= car.y + car.h + 5 ){
//                    gameScores += roadcars[i].score;
//                }
//            }
//
//            for (var i = 0; i < roadblocks.length; i++){
//                if (checkP(roadblocks[i],car)){
//                    gameOver = true;
//                }else
//                if (roadblocks[i].y >= car.y + car.h && roadblocks[i].y <= car.y + car.h + 5){
//                    gameScores += roadblocks[i].score;
//                }
//            }


            if (gameOver == false){
                setTimeout(run,10);
//                window.requestAnimationFrame(run);
                console.log(gameScores);
            }else{
                //游戏结束，如果分数大于等于50分
                if (gameScores >= 50){
                    $("#allGame").css("display","none");
                    $("#all3").css("display","block");
                    //游戏结束，如果分数小于50分
                }else{
                    $("#allGame").css("display","none");
                    $("#all4").css("display","block");
                }
                $(".gamescoreText").html(gameScores);
                //保存玩家游戏分数
                $.ajax({
                    type:"post",
                    url:"index_api_test.php",
                    data:{
                        type: "setGameScore",
//                        openid: "<?php //echo $openid?>//",
                        openid: "test",
                        gameScore: gameScores
                    },
                    dataType:"json",
                    success:function(data){
                        per = data.per;
                        $(".passPer").html(data.per+"%");
                    }
                });
            }
        }
        run();

        //游戏再开始
        function reRun() {
            moveY = 0;
            lightCount = 0;
            timerClocks = 30;
            time = 0;
            addSpeed = false;
            speedCount = 0;
            gameOver = false;
            gameScores = 0;
            roadcars = [];
            roadblocks = [];

            ctx.clearRect(0,0,canvas.width,canvas.height);
            ctx.drawImage(imgobj.racing,0,0,canvas.width,canvas.height);
            car.x = canvas.width*0.430555;
            car.y = canvas.height*0.607;
            car.draw();
            speedBtn.draw();
            ctx.drawImage(imgobj.btn_left,canvas.width*0.2152777,canvas.height*0.777391,canvas.width*0.2152777,canvas.height*0.1347826);
            ctx.drawImage(imgobj.btn_right,canvas.width*0.5722222,canvas.height*0.777391,canvas.width*0.2152777,canvas.height*0.1347826);

            $(".score3").html(timerClocks);
            $(".light").css({display:"block"});
            $(".starting_line").css({display:"block"});
            $(".ready").css({display:"block"});

            timerLight();
            run();
        }
        $("#img9").on("touchstart",function () {
            reRun();
        });

        //点击左右控制按钮
        var leftTimer,rightTimer;
        document.addEventListener("touchstart",function (e) {
            var e = e.touches[0];
            var X = e.clientX;
            var Y = e.clientY;
            //判断是否点击到
            if ((X >= canvas.width*0.2152777 && X <= (canvas.width*0.2152777+canvas.width*0.2152777)) && (Y >= canvas.height*0.777391 && Y <= (canvas.height*0.777391+canvas.height*0.1347826))){
                clearInterval(leftTimer);
                leftTimer = setInterval(function () {
                    //判断屏幕边界
                    if (car.x <=canvas.width*0.085 ){
                        clearInterval(rightTimer);
                        clearInterval(leftTimer);
                        car.x = canvas.width*0.085;
                    }else{
                        car.x = car.x - 1;
                    }
                },1);
            } if ((X >= canvas.width*0.5722222 && X <= (canvas.width*0.5722222+canvas.width*0.2152777)) && (Y >= canvas.height*0.777391 && Y <= (canvas.height*0.777391+canvas.height*0.1347826))){
                clearInterval(rightTimer);
                rightTimer = setInterval(function () {
                    //判断屏幕边界
                    if (car.x >= canvas.width - car.w - canvas.width*0.085 ){
//                        clearInterval(rightTimer);
//                        clearInterval(leftTimer);
                        car.x = canvas.width - car.w - canvas.width*0.085 ;
                    }else{
                        car.x = car.x + 1;
                    }

                },1);
            }
        });
        document.addEventListener("touchend",function (e) {
            var t = e.changedTouches[0];
            clearInterval(rightTimer);
            clearInterval(leftTimer);
        });

        //点击加速控制按钮
        document.addEventListener("touchstart",function (e) {
            var e = e.touches[0];
            var X = e.clientX;
            var Y = e.clientY;
            //判断是否点击到
            if ((X >= canvas.width*0.8138888 && X <= (canvas.width*0.8138888+canvas.width*0.175)) && (Y >= canvas.height*0.7495652 && Y <= (canvas.height*0.7495652+canvas.height*0.1617391))){
                if (speedCount%2 == 0){
                    addSpeed = true;
                }else {
                    addSpeed = false;
                }
                speedCount++;
            }
        });
    }

    //阻止手机的touchmove默认事件，防止页面可以拖动
    document.addEventListener("touchmove",function (e) {
        var e = e || window.event;
        e.preventDefault();
    },false);

</script>

<script type="text/javascript">
    //第一页
    $("#img0").animate({left:"2%"},1);
    $("#img1").animate({left:"40%"},790);
    $("#img2").animate({left:"24%"},900);
    $("#img3").animate({opacity:1},1000);
    $("#img4").animate({opacity:1},3000);
    $("#img4").on("touchstart",function(){
        $("#all1").css("display","block");
    });
    $("#cha").on("touchstart",function(){
        $("#all1").css("display","none");
    });
    $("#img3").on("touchstart",function(){
        $("#all0").css("display","none");
        $("#all2").css("display","block");
    });

    //	---------------游戏的开始跳转----------------
    $("#img6").on("touchstart",function(){
        $("#all2").css("display","none");
        $("#allGame").css("display","block");
        loading({"racing":"img/racing.png","speedBtn0":"img/speedBtn0.png","speedBtn1":"img/speedBtn1.png","speedBtn2":"img/speedBtn2.png",
                "btn_right":"img/btn_right.png","btn_left":"img/btn_left.png","car0":"img/car0.png","car1":"img/car1.png",
                "light0":"img/light0.png","light1":"img/light1.png","light2":"img/light2.png","timerClock":"img/timerClock.png",
                "startingline":"img/starting_line.png","roadblock":"img/roadblock.png","roadcar0":"img/roadcar0.png","roadcar1":"img/roadcar1.png",
                "roadcar2":"img/roadcar2.png"},
            function(a) {
            },main
        );
    });
    $("#img9").on("touchstart",function(){
        $("#all4").css("display","none");
        $("#allGame").css("display","block");
    });
    $("#img10").on("touchstart",function(){
        $("#all5").css("display","block");
    });
    $("#img7").on("touchstart",function(){
        $("#all5").css("display","block");
    });
    $("#cha1").on("touchstart",function(){
        $("#all5").css("display","none");
    });
    $("#img8").on("touchstart",function(){
        $("#all6").css("display","block");
    });
    //	---------------分享点击页面本身隐藏----------------
    $("#all6").on("touchstart",function(){
        $("#all6").css("display","none");
    });

    //------------------排行榜---------------------------
    $(".showRanking").on("touchstart",function () {
        $.ajax({
            type:"post",
            url:"index_api_test.php",
            data:{
                type: "getRangking",
//                openid: "<?php //echo $openid?>//",
                openid: "test",
                gameScore: gameScores
            },
            dataType:"json",
            success:function(data){
                if (data.err == 0){
                    var listCount = data.listCount;
                    var items = data.items;
                    var playerCount = data.playerCount;
                    var playerItems = data.playerItems;
                    createEle(listCount,items,playerCount,playerItems);
                }
            }
        });
    });
    function createEle(listCount,items,playerCount,playerItems) {
        var ownLi = $("<li class='rankinglist'></li>");
        var ownRanking = $("<span class='rankings'></span>");
        ownRanking.html(playerCount);
        var ownNickname = $("<span class='rankingnickname'></span>");
        ownNickname.html(playerItems[0].nickname);
        var ownScore = $("<span class='rankingscore'></span>");
        ownScore.html(gameScores);
        ownLi.append(ownRanking);
        ownLi.append(ownNickname);
        ownLi.append(ownScore);
        $(".ranking").append(ownLi);
        ownLi.css({color:"orange"});

        for (var i = 0; i < listCount; i++){
            var newLi = $("<li class='rankinglist'></li>");
            var newRanking = $("<span class='rankings'></span>");
            newRanking.html(i+1);
            var newNickname = $("<span class='rankingnickname'></span>");
            newNickname.html(items[i].nickname);
            var newScore = $("<span class='rankingscore'></span>");
            newScore.html(items[i].score);

            newLi.append(newRanking);
            newLi.append(newNickname);
            newLi.append(newScore);
            $(".ranking").append(newLi);
        }

    }
    $("#cha1").on("touchstart",function () {
        $("#all5 .ranking").empty();
    })
</script>

</body>
</html>