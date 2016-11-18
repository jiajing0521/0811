<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/8
 * Time: 下午4:31
 */

//第一步
//1...在微信测试号网页上,网页授权获取用户基本信息,填写自己的网址wangjj.applinzi.com
//2...https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140842&token=&lang=zh_CN
//3...复制下列url 更改appid 自己的测试号appid redirect_uri 本文件url
//每次应该在地址栏输入这个链接
//意思是,点击下面这个链接后,跳转到微信确认授权页面,点击授权后,微信会返回当前用户的code信息(数组),appid是将要跳转到的订阅号,
//redirect_uri,是回调的地址,确认后跳转到那个界面,在这个里面可以得到code

//https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3d459d680bfe616d&redirect_uri=http://wangjj.applinzi.com/callback.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect

//定义微信appid常量
define("APPID","wx3d459d680bfe616d");

//定义微信appsecret常量
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
//通过code换取网页授权access_token
//用返回的code,通过接口
//首先请注意，这里通过code换取的是一个特殊的网页授权access_token,与基础支持中的access_token（该access_token用于调用其他接口）不同。
$code = $_GET["code"];


$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code={$code}&grant_type=authorization_code";

$result = httpGet($url);
//echo $result;

$arr = json_decode($result,true);
$token = $arr["access_token"];
$openid = $arr["openid"];

//第四步：拉取用户信息(需scope为 snsapi_userinfo)
//
//第四步 复制
$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}&lang=zh_CN";
$result = httpGet($url);
$arr = json_decode($result,true);
$headimgurl = $arr["headimgurl"];
echo "<img src='{$headimgurl}' style='width: 300px; height: 300px'>";
echo "<br>";


//**************************************
//连接SAE的MySQL
//http://sae.sina.com.cn/?m=phpinfo&app_id=wangjj&ver=1
//MySQL主库域名 SAE_MYSQL_HOST_M
//MySQL端口 SAE_MYSQL_PORT
//MySQL数据库名 SAE_MYSQL_DB
//MySQL用户名 SAE_MYSQL_USER
//MySQL密码 SAE_MYSQL_PASS

$pdo = new PDO("mysql:host=".SAE_MYSQL_HOST_M.";port=".SAE_MYSQL_PORT.";dbname=".SAE_MYSQL_DB.";",SAE_MYSQL_USER,SAE_MYSQL_PASS);
$pdo->exec("set names utf8");

//把通过网页授权进入的微信用户信息保存到数据库中
//用户通过点击连接进来后,保存用户信息到数据库user中

//查重
//1.检查数据库中有没有该用户(openid为唯一标识)
$result = $pdo->query("SELECT * FROM user WHERE openid = '{$openid}'");


//query函数的返回值有两种情况,正常查询返回一个对象obj,如果SQL语句有问题返回false
if ($result){
    //查询返回数据的行数
    $count = $result->rowCount();
    //获取用户信息
    $nickname = $arr["nickname"];
    $headImg = $arr["headimgurl"];
    $sex = $arr["sex"];
    $city = $arr["city"];
    //如果存在
    if ($count > 0){
        echo "老用户".$nickname.",登录成功";
    //如果不存在
    }else{
        $countInsert = $pdo->exec("INSERT INTO user (id,openid,nickname,sex,headimg,city) VALUE (NULL,'{$openid}','{$nickname}',{$sex},'{$headImg}','{$city}')");
        if ($countInsert > 0){
            echo "新用户".$nickname.",登录成功";
        }else{
            echo "新用户".$nickname.",登录失败";
        }
    }
}else{
    echo "请检查sql语句";
}

