<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>Title</title>
    <style>
        *{
            margin: 0;
            padding:0;
        }
        html,body{
            width: 100%;
            height: 100%;
        }
        #all0{
            width: 100%;
            height: 100%;
            background-image: url(img/第一页背景.png);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            /*text-align: center;*/
            position: relative;
            top: 0;
            left: 0;
            /*display: none;*/
        }
        #img0{
            width: 95.55555%;
            height: 30.26087%;
            transition: all 1s;
            position: absolute;
            left: 100%;
            top: 7%;
        }
        #img1{
            width: 51.80555%;
            height: 7.130435%;
            position: absolute;
            left: 110%;
            top: 27%;
        }
        #img2{
            width: 60.8333%;
            height: 4.869565%;
            position: absolute;
            left: -70%;
            top: 35%;
        }
        #img3{
            position: absolute;
            bottom: 20%;
            left: 10%;
            width: 79.3055%;
            height: 9.652174%;
            opacity: 0;
        }
        #img4{
            position: absolute;
            bottom: 18%;
            left: 42%;
            width: 17.63888%;
            height: 2.086957%;
            opacity: 0;
        }
        #all1{
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            position: absolute;
            top: 0;
            left: 0;
            display: none;
        }
        #img5{
            position: absolute;
            top: 10%;
            left: 9%;
            width: 85.2777%;
            height: 63.478261%;
        }
        #cha{
            width: 9%;
            height: 5%;
            /*background-color: red;*/
            border-radius: 100px;
            position: absolute;
            top: 25%;
            right: 7%;
        }
        #all2{
            width: 100%;
            height: 100%;
            background-image: url(img/第二页背景图.png);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            position: relative;
            top: 0;
            left: 0;
            display: none;
        }
        #img6{
            width: 79.3055%;
            height: 9.652174%;
            position: absolute;
            bottom: 40%;
            left: 10%;
        }
        /*--------------------------------这个看看吧!!------------------------------*/
        #allGameyu{
            width: 100%;
            height: 100%;
            display: none;
        }
        /*-------------------------------------非于嘉晨版本删掉-------------------------------------*/
        #allGameyu input{
            width: 100%;
            height: 10%;
            border: 3px solid black;
        }
        /*-----------------------------------------------------------------------------------------*/
        #all3{
            width: 100%;
            height: 100%;
            background-image: url(img/第三背景.png);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            display: none;
        }
        #all3 img{
            width: 79.3055%;
            height: 9.652174%;
        }
        #img7{
            position: absolute;
            bottom: 17%;
            left: 10%;
        }
        #img8{
            position: absolute;
            bottom: 25%;
            left: 10%;
        }
        #div0{
            width: 100%;
            height: 10%;
            color: white;
            font-size:17px;
            text-align: center;
            position: absolute;
            top: 36%;
            left: 0;
        }
        .gai{
            color: rgb(255,207,0);
        }
        #div2{
            margin-top:2% ;
        }
        #all4{
            width: 100%;
            height: 100%;
            background-image: url(img/没过关背景.png);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            display: none;
        }
        #all4 img{
            width: 79.3055%;
            height: 9.652174%;
        }
        #img9{
            position: absolute;
            bottom: 17%;
            left: 10%;
        }
        #img10{
            position: absolute;
            bottom: 25%;
            left: 10%;
        }
        #div3{
            width: 100%;
            height: 10%;
            color: white;
            font-size:17px;
            text-align: center;
            position: absolute;
            top: 36%;
            left: 0;
        }
        .gai1{
            color: rgb(255,207,0);
        }
        #all5{
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            position: absolute;
            top: 0;
            left: 0;
            display: none;
        }
        #all5 img{
            width: 85.2777%;
            height: 83.478261%;
            position: absolute;
            top: 2%;
            left: 10%;
        }
        #cha1{
            width: 9%;
            height: 6%;
            border-radius: 100px;
            /*background-color: red;*/
            position: absolute;
            top: 15.9%;
            right: 6%;
        }
        #all6{
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            position: absolute;
            top: 0;
            left: 0;
            display: none;
        }
        #all6 img{
            width: 73.05555%;
            height: 58.34785%;
            position: absolute;
            top: 3%;
            right: 10%;
        }
    </style>
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
<div id="allGameyu">
    <input type="button" name="" id="input0" value="过关" />
    <input type="button" name="" id="input1" value="没过关" />
</div>
<div id="all3">
    <img id="img7" src="img/查看排行榜啊.png" alt="" />
    <img id="img8" src="img/邀请导师啊.png" alt="" />
    <div id="div0">
        <div id="div1">
            <span>你共闯过了</span>
            <span class="gai">53</span>
            <span>个障碍物</span>
        </div>
        <div id="div2">
            <span>胜出全国</span>
            <span class="gai">70%</span>
            <span>的玩家</span>
        </div>
    </div>
</div>
<div id="all4">
    <img id="img9" src="img/再来一次.png" alt="" />
    <img id="img10" src="img/查看排行榜q1.png" alt="" />
    <div id="div3">
        <div id="div4">
            <span>你共闯过了</span>
            <span class="gai1">3</span>
            <span>个障碍物</span>
        </div>
        <div id="div5">
            <span>胜出全国</span>
            <span class="gai1">7%</span>
            <span>的玩家</span>
        </div>
    </div>
</div>
<div id="all5">
    <img src="img/查看排行榜q.png" alt="" />
    <div id="cha1"></div>
</div>
<div id="all6">
    <img src="img/分享.png"/>
</div>
<script src="js/jquery-2.2.3.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    //第一页
    $("#img0").animate({left:"2%"},1);
    $("#img1").animate({left:"40%"},790);
    $("#img2").animate({left:"24%"},900);
    $("#img3").animate({opacity:1},1000);
    $("#img4").animate({opacity:1},3000);
    $("#img4").on("click",function(){
        $("#all1").css("display","block");
    })
    $("#cha").on("click",function(){
        $("#all1").css("display","none");
    })
    $("#img3").on("click",function(){
        $("#all0").css("display","none");
        $("#all2").css("display","block");
    })
    $("#img6").on("click",function(){
        $("#all2").css("display","none");
        $("#allGameyu").css("display","block");
    })
    //	---------------游戏的input跳转----------------
    $("#input0").on("click",function(){
        $("#allGameyu").css("display","none");
        $("#all3").css("display","block");
    })
    $("#input1").on("click",function(){
        $("#allGameyu").css("display","none");
        $("#all4").css("display","block");
    })
    //	----------------------------------------------
    $("#img9").on("click",function(){
        $("#all4").css("display","none");
        $("#allGameyu").css("display","block");
    })
    $("#img10").on("click",function(){
        $("#all5").css("display","block");
    })
    $("#img7").on("click",function(){
        $("#all5").css("display","block");
    })
    $("#cha1").on("click",function(){
        $("#all5").css("display","none");
    })
    $("#img8").on("click",function(){
        $("#all6").css("display","block");
    })
    //	---------------分享点击页面本身隐藏----------------
    $("#all6").on("click",function(){
        $("#all6").css("display","none");
    })
    //	--------------------------------------------------
</script>
</body>
</html>