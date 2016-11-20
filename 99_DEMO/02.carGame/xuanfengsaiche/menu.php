<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/17
 * Time: 下午2:28
 */

require_once "get_safe_token.php";

$token = get_safe_token();

$data = '{
    "button": [
        {
            "type": "view",
            "name": "旋风赛车",
            "url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3d459d680bfe616d&redirect_uri=http://wangjjsvn.applinzi.com/xuanfengsaiche/index.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
        },
        {
            "type": "view",
            "name": "我要抽奖",
            "url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3d459d680bfe616d&redirect_uri=http://wangjjsvn.applinzi.com/xuanfengsaiche/lottery.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
        },
        {
            "name": "其他菜单",
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
                    "type": "view",
                    "name": "我要抽奖",
                    "url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3d459d680bfe616d&redirect_uri=http://wangjjsvn.applinzi.com/xuanfengsaiche/lottery.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
                }
            ]
        }
    ]
}';
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}";

httpPost($data,$url);