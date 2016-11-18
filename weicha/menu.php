<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/8
 * Time: 下午8:54
 */
//这是测试号的
//定义微信appid常量
define("APPID","wx3d459d680bfe616d");

//定义微信appsecret常量
define("APPSECRET","2f2f4871417acd8dac8f9f1820b4449d");

//这是普通号的
//定义微信appid常量
//定义微信appsecret常量
//define("APPID","wxc16e8da1393b8d53");
//define("APPSECRET","c957f437bf89e92610dfe7476b410526");

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

//获取开门的钥匙,获取token封装函数
function get_token(){
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
    $result = httpGet($url);
    //字符串转为关联数组,
    //第二个参数true不写的话,转为对象,true为关联数组
    $arr = json_decode($result,true);
    return $arr["access_token"];

}
//因为请求到的token有次数限制,每次的token两小时后过期,
//每次获取token时,先去数据库里去取,如果数据库中存在,
//取出来检查是否过期,如果没过期,正常使用,重新请求


//为防止获取token次数达到上限,把token保存到数据库

//连接数据库
$pdo = new PDO("mysql:host=localhost;dbname=0811","root","");
$pdo->exec("set names utf8");
//设置时区
date_default_timezone_set("PRC");
function get_safe_token(){
    //全局变量
    global $pdo;
    //1.检查数据库中有没有
    $result = $pdo->query("SELECT * FROM wxtoken");
    $arr = $result->fetchAll(PDO::FETCH_ASSOC);

    //2.有的话,检查是否过期
    if (count($arr) > 0){
        $row = $arr[0];
        $oldTime = $row["time"];
        $currentTime = time();
        //2.1超过两个小时,token已经过期
        if ($currentTime - $oldTime >= 7200){
            $newToken = get_token();
            $pdo->exec("UPDATE wxtoken SET token = '{$newToken}',time = '{$currentTime}'");
            return $newToken;
            //2.2有效token
        }else{
            return $row["token"];
        }

        //3.没有的话,插入一条
    }else{
        //3.1请求一个token,获取当前时间(单位秒)
        $token= get_token();
        $time = time();
        $pdo->exec("INSERT INTO wxtoken (id,token,time) VALUE (NULL,'{$token}','{$time}')");
        return $token;
    }

}

$token = get_safe_token();

$data = '{
    "button": [
        {
            "type": "click",
            "name": "好想告诉你",
            "key": "V1001_TODAY_MUSIC"
        },
        {
            "name": "视频菜单",
            "sub_button": [
                {
                    "type": "view",
                    "name": "搜索",
                    "url": "http://www.soso.com/"
                },
                {
                    "type": "view",
                    "name": "视频",
                    "url": "http://v.qq.com/"
                },
                {
                    "type": "click",
                    "name": "赞一下我们",
                    "key": "V1001_GOOD"
                }
            ]
        }
    ]
}';
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}";

httpPost($data,$url);