<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/7
 * Time: 下午3:59
 */

header("Content-type:text/html;charset=utf-8");

//微信测试公众号配置获取access token
//公众号调用各接口

//通过这个函数也可以向其他的服务器发送请求,但是只能使用get请求,
//而且不能设置,所以微信推荐使用下面两种方式
//echo file_get_contents("http://baidu.com");

//从网页http://mp.weixin.qq.com/debug/cgi-bin/sandboxinfo?action=showinfo&t=sandbox/index
//测试号信息 获取

//定义微信appid常量
define("APPID","wxc16e8da1393b8d53");

//定义微信appsecret常量
define("APPSECRET","c957f437bf89e92610dfe7476b410526");


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

//获取access_token,这个token是接下来使用的凭证,量小时自动过期,每次重新请求,上一个token会自动失效,每天调用上限2000次
//步骤如下:
//复制http://mp.weixin.qq.com/wiki/14/9f9c82c1af308e3b14ba9b973f99a8ba.html下的http请求方式: GET
//测试号管理网页
//appID wx3d459d680bfe616d
//appsecret 2f2f4871417acd8dac8f9f1820b4449d

//echo httpGet("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx3d459d680bfe616d&secret=2f2f4871417acd8dac8f9f1820b4449d");

//获取开门的钥匙,获取token封装函数
function get_token(){
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
    $result = httpGet($url);
    //字符串转为关联数组,
    //第二个参数true不写的话,转为对象,true为关联数组
    $arr = json_decode($result,true);
    return $arr["access_token"];

}

//作业
//因为请求到的token有次数限制,每次的token两小时后过期,
//每次获取token时,先去数据库里去取,如果数据库中存在,
//取出来检查是否过期,如果没过期,正常使用,重新请求
//echo get_token();

$pdo = new PDO("mysql:host=localhost;dbname=0811","root","");
$pdo->exec("set names utf8");

date_default_timezone_set("PRC");

$result = $pdo->query("SELECT * FROM wxtoken ORDER BY time DESC LIMIT 1");
$arr = $result->fetchAll(PDO::FETCH_ASSOC);

//如果存在数据,检查数据库中token是否过期
if (count($arr)>0){
    $db_token = $arr[0]["token"];
    $db_time = $arr[0]["time"];
    $time = time();

    //如果过期
    if ($time - $db_time > 7200){
        $token = get_token();
        $count = $pdo->exec("UPDATE wxtoken SET token = '{$token}', time = '{$time}' WHERE token = '{$db_token}' ");
        if ($count > 0){
            echo "更新成功,最新token是:".$token;
        }else{
            echo "更新失败";
        }

    //如果未过期
    }else{
        echo "未过期,数据库中token是:".$db_token;
    }

//如果不存在数据,新添加最新获取的token
}else{
    $token = get_token();
    $time = time();
    $count = $pdo->exec("INSERT INTO wxtoken (id,token,time) VALUE (NULL,'{$token}','{$time}')");
    if ($count > 0){
        echo "插入成功,最新token是:".$token;
    }else{
        echo "插入失败";
    }
}



//获取微信ip列表
//http://mp.weixin.qq.com/wiki/4/41ef0843d6e108cf6b5649480207561c.html
//没什么卵用,可以判断收到的消息是否是微信的ip服务器发来的
//function get_ip_list(){
//    $token = get_token();
//    $url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token={$token}";
//    $result = httpGet($url);
//
//    $arr = json_decode($result,true);
//    return $arr["ip_list"];
//}
//print_r(get_ip_list());

//通过openid 获取用户信息
//http://mp.weixin.qq.com/wiki/1/8a5ce6257f1d3b2afb20f83e72b72ce9.html
//返回结果
//{
//    "subscribe": 1,
//    "openid": "o6_bmjrPTlm6_2sgVt7hMZOPfL2M",
//    "nickname": "Band",
//    "sex": 1,
//    "language": "zh_CN",
//    "city": "广州",
//    "province": "广东",
//    "country": "中国",
//    "headimgurl":    "http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/0",
//   "subscribe_time": 1382694957,
//   "unionid": " o6_bmasdasdsad6_2sgVt7hMZOPfL"
//   "remark": "",
//   "groupid": 0
//}

//参数说明
//参数 	说明
//subscribe 	用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号，拉取不到其余信息。
//openid 	用户的标识，对当前公众号唯一
//nickname 	用户的昵称
//sex 	用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
//city 	用户所在城市
//country 	用户所在国家
//province 	用户所在省份
//language 	用户的语言，简体中文为zh_CN
//headimgurl 	用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。
//subscribe_time 	用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间
//unionid 	只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。详见：获取用户个人信息（UnionID机制）
//remark 	公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注
//groupid 	用户所在的分组ID

//function get_user_info(){
//    $token = get_token();
//    $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$token}&openid=owb36wMtNozedSrZ0xkl4zv559Tc&lang=zh_CN";
//
//    $result = httpGet($url);
//    $arr = json_decode($result,true);
//    return $arr;
//}
//$user_info = get_user_info();
//$imgUrl = $user_info["headimgurl"];
//
//echo "<img src='{$imgUrl}'>";



