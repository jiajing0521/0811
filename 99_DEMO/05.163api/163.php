<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/12/2
 * Time: 下午3:54
 */
header("Content-type:text/html;charset=utf-8");

//主页接口 http://c.m.163.com/recommend/getSubDocPic?from=toutiao

//直播: http://data.live.126.net/livechannel/previewlist.json

//话题 http://c.m.163.com/newstopic/list/expert/5aSn6L%2Be/0-10.html

function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    //验证token, 本地可以注释掉, 上线必须打开
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}

if (isset($_GET["callback"]) && isset($_GET["type"])){
    $cb = $_GET["callback"];
    $type = $_GET["type"];

    switch ($type){
        //主页接口
        case "home":
            $result = httpGet("http://c.m.163.com/recommend/getSubDocPic?from=toutiao");
            echo "{$cb}({$result})";
            break;
        //直播接口
        case "live":
            $result = httpGet("http://data.live.126.net/livechannel/previewlist.json");
            echo "{$cb}({$result})";
            break;
        //话题接口
        case "topic":
            $page1 = $_GET["page1"];
            $result = httpGet("http://c.m.163.com/newstopic/list/expert/5aSn6L%2Be/0-{$page1}.html");
            echo "{$cb}({$result})";
            break;
        default :
            echo $cb.'{"err":1,"msg":"参数错误"}';
            break;
    }
}


