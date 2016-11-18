<?php
//定义微信appid常量,appsecret常量
define("APPID","wx3d459d680bfe616d");
define("APPSECRET","2f2f4871417acd8dac8f9f1820b4449d");
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
//第二步 请求方法 复制地址
$code = $_GET["code"];
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code={$code}&grant_type=authorization_code";
$result = httpGet($url);
$arr = json_decode($result,true);
$token = $arr["access_token"];
$openid = $arr["openid"];
//第三步：拉取用户信息(需scope为 snsapi_userinfo)
$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}&lang=zh_CN";
$result = httpGet($url);
$arr = json_decode($result,true);
//第四步：连接数据库
$pdo = new PDO("mysql:host=".SAE_MYSQL_HOST_M.";port=".SAE_MYSQL_PORT.";dbname=".SAE_MYSQL_DB.";",SAE_MYSQL_USER,SAE_MYSQL_PASS);
$pdo->exec("set names utf8");

//$openid = "owb36wMtNozedSrZ0xkl4zv559Tc";
$result = $pdo->query("SELECT * FROM xuanfengsaiche WHERE openid = '{$openid}'");
if ($result){
    $count = $result->rowCount();
    if ($count > 0){
        $arr = $result->fetchAll(PDO::FETCH_ASSOC);
        $promotion = $arr[0]["promotion"];
        $bad = $arr[0]["bad"];
        $score = $arr[0]["score"];

    }else{
        echo "<div class='errDiv'><p class='err'>还没有参加过游戏，点击再玩一次加入游戏</p></div>";
        $noUser = true;
    }
}else{
    echo "请检查sql语句";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="css/lottery.css">
    <title>旋风赛车</title>
</head>
<body>
<div id="content0">
    <div id="cdiv0">
        （&nbsp;已有
        <span id="cgai"></span> 位导师选择&nbsp;&nbsp; "你丫太差啦"&nbsp;&nbsp;）
    </div>
    <img id="cimg0" src="img/在玩一次GO.png" alt="" />
    <img id="cimg1" src="img/邀请其他好友.png" alt="" />
</div>
<div id="content1">
    <img id="cimg2" src="img/马上抽奖GO.png" alt="" />
</div>
<div id="content2">
    <img id="cimg3" src="img/再玩一次GO.png" alt="" />
</div>
<div id="content3">
    <img id="cimg4" src="img/转盘啊.png" />
    <img id="cimg5" src="img/按钮.png" />
    <div id="che"></div>
</div>
<div id="content4">
    <img id="cimg6" src="img/星尚假期套票.png" />
    <img id="cimg7" src="img/填写信息.png" />
</div>
<div id="content5">
    <img id="cimg8" src="img/领奖信息.png" />
    <img id="cimg9" src="img/填好了.png" />
    <div id="cdiv1">
        <div id="cdiv2">
            <span id="cspan0">姓名</span>
            <input id="cinput0" type="text" />
        </div>
        <div id="cdiv3">
            <span id="cspan1">电话</span>
            <input id="cinput1" type="text" />
        </div>
        <div id="cdiv3">
            <span id="cspan1">住址</span>
            <select name="province" id="province" style="margin-left: 1%;"></select>
            <select name="city" id="city" style="margin-left: 2%;"></select>
            <br />
            <input id="cinput2" type="text" />
        </div>
    </div>
</div>
<div id="content6">
    <img src="img/成功提交.png"/>
</div>
<script src="js/jquery-2.2.3.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $("#cimg0").on("touchstart", function() {
        //再玩一次GO
        window.location.assign("https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3d459d680bfe616d&redirect_uri=http://wangjjsvn.applinzi.com/xuanfengsaiche/index.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect")
    });
    $("#cimg1").on("touchstart", function() {
        //邀请其他好友
        console.log("邀请其他好友");
    });
    $("#cimg2").on("touchstart", function() {
        $("#content1").css("display", "none");
        $("#content3").css("display", "block");
    });
    $("#cimg3").on("touchstart", function() {
        //再玩一次GO
        window.location.assign("https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3d459d680bfe616d&redirect_uri=http://wangjjsvn.applinzi.com/xuanfengsaiche/index.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect")
    });

    $("#cimg9").on("touchstart", function() {
        if($("#cinput0").val() == "" || $("#cinput1").val() == "" || $("#cinput2").val() == "") {
            alert("请输入完整信息");
        } else {
            var a = /^13\d{9}$/;
            var b = /^15\d{9}$/;
            var d = /^18\d{9}$/;
            var c = /^([\u4e00-\u9fa5]){2,5}$/;
            if(a.test($("#cinput1").val())||b.test($("#cinput1").val())||d.test($("#cinput1").val())){
                if(c.test($("#cinput0").val())){
                    $.ajax({
                        url:"index_api.php",
                        type:"post",
                        data:{
                            type: "submit",
                            openid: "<?php echo $openid;?>",
                            name: $("#cinput0").val(),
                            tel: $("#cinput1").val(),
                            address:$("#province").val()+"-"+$("#city").val()+"-"+$("#cinput2").val(),
                            typename:leixingText
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.err == 0){
                                console.log("提交成功");
                            }else{
                                console.log("提交失败");
                            }
                        }
                    });
                    $("#content6").css("display", "block");
                    $("#content5").css("display", "none");
                }else {
                    alert("请填写正确的姓名");
                    $("#content6").css("display", "none");
                    $("#content5").css("display", "block");
                }

            }else {
                alert("请填写正确手机号吗");
                $("#content6").css("display", "none");
                $("#content5").css("display", "block");
            }

        }
    });

    $("#cimg7").on("touchstart", function() {
        console.log($("#cimg7").attr("src"));
        if($("#cimg7").attr("src") == "img/再来一次go.png") {
            //转盘转到谢谢参与，点再来一次时候
            $("#content5").css("display", "none");
            $("#content4").css("display", "block");
        } else {
            $("#content5").css("display", "block");
            $("#content4").css("display", "none");
        }
    });

    function rand(min, max) {
        return Math.floor(Math.random() * (max + 1 - min) + min);
    }
    var leixingText = "";
    var timer;
    $("#cimg5").on("touchstart", function() {
        var a = rand(-100, -50) * 30;
        $("#che").css("transform", "rotateZ(" + a + "deg)");
        $("#cimg5").off();
        timer = setTimeout(function() {
            while(a < -360) {
                a += 360;
            };
            if(a < 0 && a >= -360 / 12) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/林志颖.png");
                leixingText = "林志颖";
            } else if((a < -360 / 12) && a >= -360 / 12 * 2) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/星尚假期套票.png");
                leixingText = "星尚假期套票";
            } else if((a < -360 / 12 * 2) && a >= -360 / 12 * 3) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/星悦套票.png");
                leixingText = "星悦套票";
            } else if((a < -360 / 12 * 3) && a >= -360 / 12 * 4) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/海景房.png");
                leixingText = "海景房";
            } else if((a < -360 / 12 * 4) && a >= -360 / 12 * 5) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/没中奖.png");
                $("#cimg7").attr("src", "img/再来一次go.png");
                $("#cimg7").css("bottom", "20%");
                leixingText = "没中奖";
            } else if((a < -360 / 12 * 5) && a >= -360 / 12 * 6) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/海洋温泉门票.png");
                leixingText = "海洋温泉门票";
            } else if((a < -360 / 12 * 6) && a >= -360 / 12 * 7) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/明星海报.png");
                leixingText = "明星海报";
            } else if((a < -360 / 12 * 7) && a >= -360 / 12 * 8) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/没中奖.png");
                $("#cimg7").attr("src", "img/再来一次go.png");
                $("#cimg7").css("bottom", "20%");
                leixingText = "没中奖";
            } else if((a < -360 / 12 * 8) && a >= -360 / 12 * 9) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/神秘岛门票.png");
                leixingText = "神秘岛门票";
            } else if((a < -360 / 12 * 9) && a >= -360 / 12 * 10) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/梦幻剧场.png");
                leixingText = "梦幻剧场";
            } else if((a < -360 / 12 * 10) && a >= -360 / 12 * 11) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/没中奖.png");
                $("#cimg7").attr("src", "img/再来一次go.png");
                $("#cimg7").css("bottom", "20%");
                leixingText = "没中奖";
            } else if((a < -360 / 12 * 11) && a >= -360 / 12 * 12) {
                $("#content4").css("display", "block");
                $("#cimg6").attr("src", "img/海泉湾公仔.png");
                leixingText = "海泉湾公仔";
            }
        }, 8000)
    });

    var json = {
        "北京": ["西城", "东城", "崇文", "宣武", "朝阳", "海淀", "丰台", "石景山", "门头沟", "房山", "通州", "顺义", "大兴", "昌平", "平谷", "怀柔", "密云", "延庆"],
        "天津": ["青羊", "河东", "河西", "南开", "河北", "红桥", "塘沽", "汉沽", "大港", "东丽", "西青", "北辰", "津南", "武清", "宝坻", "静海", "宁河", "蓟县", "开发区"],
        "河北": ["石家庄", "秦皇岛", "廊坊", "保定", "邯郸", "唐山", "邢台", "衡水", "张家口", "承德", "沧州", "衡水"],
        "山西": ["太原", "大同", "长治", "晋中", "阳泉", "朔州", "运城", "临汾"],
        "内蒙古": ["呼和浩特", "赤峰", "通辽", "锡林郭勒", "兴安"],
        "辽宁": ["大连", "沈阳", "鞍山", "抚顺", "营口", "锦州", "丹东", "朝阳", "辽阳", "阜新", "铁岭", "盘锦", "本溪", "葫芦岛"],
        "吉林": ["长春", "吉林", "四平", "辽源", "通化", "延吉", "白城", "辽源", "松原", "临江", "珲春"],
        "黑龙江": ["哈尔滨", "齐齐哈尔", "大庆", "牡丹江", "鹤岗", "佳木斯", "绥化"],
        "上海": ["浦东", "杨浦", "徐汇", "静安", "卢湾", "黄浦", "普陀", "闸北", "虹口", "长宁", "宝山", "闵行", "嘉定", "金山", "松江", "青浦", "崇明", "奉贤", "南汇"],
        "江苏": ["南京", "苏州", "无锡", "常州", "扬州", "徐州", "南通", "镇江", "泰州", "淮安", "连云港", "宿迁", "盐城", "淮阴", "沐阳", "张家港"],
        "浙江": ["杭州", "金华", "宁波", "温州", "嘉兴", "绍兴", "丽水", "湖州", "台州", "舟山", "衢州"],
        "安徽": ["合肥", "马鞍山", "蚌埠", "黄山", "芜湖", "淮南", "铜陵", "阜阳", "宣城", "安庆"],
        "福建": ["福州", "厦门", "泉州", "漳州", "南平", "龙岩", "莆田", "三明", "宁德"],
        "江西": ["南昌", "景德镇", "上饶", "萍乡", "九江", "吉安", "宜春", "鹰潭", "新余", "赣州"],
        "山东": ["青岛", "济南", "淄博", "烟台", "泰安", "临沂", "日照", "德州", "威海", "东营", "荷泽", "济宁", "潍坊", "枣庄", "聊城"],
        "河南": ["郑州", "洛阳", "开封", "平顶山", "濮阳", "安阳", "许昌", "南阳", "信阳", "周口", "新乡", "焦作", "三门峡", "商丘"],
        "湖北": ["武汉", "襄樊", "孝感", "十堰", "荆州", "黄石", "宜昌", "黄冈", "恩施", "鄂州", "江汉", "随枣", "荆沙", "咸宁"],
        "湖南": ["长沙", "湘潭", "岳阳", "株洲", "怀化", "永州", "益阳", "张家界", "常德", "衡阳", "湘西", "邵阳", "娄底", "郴州"],
        "广东": ["广州", "深圳", "东莞", "佛山", "珠海", "汕头", "韶关", "江门", "梅州", "揭阳", "中山", "河源", "惠州", "茂名", "湛江", "阳江", "潮州", "云浮", "汕尾", "潮阳", "肇庆", "顺德", "清远"],
        "广西": ["南宁", "桂林", "柳州", "梧州", "来宾", "贵港", "玉林", "贺州"],
        "海南": ["海口", "三亚"],
        "重庆": ["渝中", "大渡口", "江北", "沙坪坝", "九龙坡", "南岸", "北碚", "万盛", "双桥", "渝北", "巴南", "万州", "涪陵", "黔江", "长寿"],
        "四川": ["成都", "达州", "南充", "乐山", "绵阳", "德阳", "内江", "遂宁", "宜宾", "巴中", "自贡", "康定", "攀枝花"],
        "贵州": ["贵阳", "遵义", "安顺", "黔西南", "都匀"],
        "云南": ["昆明", "丽江", "昭通", "玉溪", "临沧", "文山", "红河", "楚雄", "大理"],
        "西藏": ["拉萨", "林芝", "日喀则", "昌都"],
        "陕西": ["西安", "咸阳", "延安", "汉中", "榆林", "商南", "略阳", "宜君", "麟游", "白河"],
        "甘肃": ["兰州", "金昌", "天水", "武威", "张掖", "平凉", "酒泉"],
        "青海": ["黄南", "海南", "西宁", "海东", "海西", "海北", "果洛", "玉树"],
        "宁夏": ["银川", "吴忠"],
        "新疆": ["乌鲁木齐", "哈密", "喀什", "巴音郭楞", "昌吉", "伊犁", "阿勒泰", "克拉玛依", "博尔塔拉"],
        "香港": ["中西区", "湾仔区", "东区", "南区", "九龙-油尖旺区", "九龙-深水埗区", "九龙-九龙城区", "九龙-黄大仙区", "九龙-观塘区", "新界-北区", "新界-大埔区", "新界-沙田区", "新界-西贡区", "新界-荃湾区", "新界-屯门区", "新界-元朗区", "新界-葵青区", "新界-离岛区"],
        "澳门": ["花地玛堂区", "圣安多尼堂区", "大堂区", "望德堂区", "风顺堂区", "嘉模堂区", "圣方济各堂区", "路氹城"]
    };

    for(var i = 0; i < json["北京"].length; i++) {
        var cityOptions = document.createElement("option");
        cityOptions.innerHTML = json["北京"][i];
        $("#city").append(cityOptions);
    }
    for(var prop in json) {
        var proOptions = document.createElement("option");
        proOptions.innerHTML = prop;
        $("#province").append(proOptions);
    }
    $("#province").on("change", function() {
        $("#city").empty();
        var item = $(this).val();
        for(var i = 0; i < json[item].length; i++) {
            var cityOptions = document.createElement("option");
            cityOptions.innerHTML = json[item][i];
            $("#city").append(cityOptions);
        }
    });
    $(".errDiv").on("touchstart",function () {
        $(".errDiv").css({display:"none"});
    })
</script>
<script type="text/javascript">

    //------------没有超过50分或者没有参加过游戏---------------
    <?php
    if ($score < 100 || $noUser == true){
    ?>
    $("#content2").css({display:"block"});
    <?php
    //---------------------没有被点过晋级---------------------
    }else if ( $promotion <= 0 ){
    ?>
    $("#content0").css({display:"block"});
    $("#cgai").html(<?php echo $bad;?>);
    //---------------------至少一人点击过晋级---------------------
    <?php } else if($promotion > 0){?>
    $("#content1").css({display:"block"});
    <?php };?>
</script>
</body>

</html>