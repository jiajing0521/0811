<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx3d459d680bfe616d", "2f2f4871417acd8dac8f9f1820b4449d");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <title>嘉静的测试订阅号</title>
</head>
<body>
  <button id="btn">选择图片</button>
</body>

<!--*******步骤二:引入JS文件-->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>

  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */

//  *******步骤三:通过config接口注入权限验证配置
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
        "onMenuShareTimeline",//分享到朋友圈******附录二中的参数粘贴
        "openLocation",//使用微信内置地图查看位置接口
        "getLocation",//获取地理位置接口
        "chooseImage"//拍照或从手机相册中选图接口
//        "previewImage"//预览图片接口
//        "uploadImage"//上传图片接口
    ]
  });

//  *******步骤四：通过ready接口处理成功验证
  wx.ready(function () {
    // 在这里调用 API
    //*****获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
    wx.onMenuShareTimeline({

      title: '我想静静,别问我静静是谁', // 分享标题

      link: 'http://www.baidu.com', // 分享链接

      imgUrl: 'http://imgsrc.baidu.com/forum/w%3D580/sign=2055538182cb39dbc1c0675ee01709a7/0f95c3fdfc0392452b19d6648494a4c27c1e258c.jpg', // 分享图标

      success: function () {

        // 用户确认分享后执行的回调函数
        alert("分享成功!!!");

      },

      cancel: function () {

        // 用户取消分享后执行的回调函数
        alert("为什么取消了???");

      }

    });
    //获取地理位置接口

    wx.getLocation({

      type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'

      success: function (res) {

        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90

        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。

        var speed = res.speed; // 速度，以米/每秒计

        var accuracy = res.accuracy; // 位置精度

        //使用微信内置地图查看位置接口
        wx.openLocation({

          latitude: latitude, // 纬度，浮点数，范围为90 ~ -90

          longitude: longitude, // 经度，浮点数，范围为180 ~ -180。

          name: '幸福之家', // 位置名

          address: '高新园区中铁诺德滨海花园', // 地址详情说明

          scale: 1, // 地图缩放级别,整形值,范围从1~28。默认为最大

          infoUrl: 'http://www.baidu.com' // 在查看位置界面底部显示的超链接,可点击跳转

        });
      }

    });

  });

  var btn = document.getElementById("btn");
  btn.addEventListener("touchstart",function () {
    //拍照或从手机相册中选图接口
    wx.chooseImage({

      count: 5, // 默认9

      sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有

      sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有

      success: function (res) {

        var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片

        for (var i = 0; i < localIds.length; i++) {
          var img = document.createElement("img");
          img.src = localIds[i];
          document.body.appendChild(img);
        }
      }
    })

  },false);

</script>
</html>
