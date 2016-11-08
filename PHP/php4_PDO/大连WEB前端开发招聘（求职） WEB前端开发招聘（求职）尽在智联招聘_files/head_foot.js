if (document.all){
	window.attachEvent('onload',initHeadfn);
}
else{
	window.addEventListener('load', initHeadfn,false);
}
//联系我们
function openFeedback(strTarget) {
   window.open(strTarget, "_blank", "width=1,height=1,left=100,top=60,scrollbars=0,overflow=auto,status=0");
}
var link = window.location.href;
function initHeadfn(){	
    if (typeof navIndex != 'undefined') {
        $(".all_navlist a").removeClass();
        $(".all_navlist a")[navIndex].className = "allcurrent";
    }
    $("#login_text").click(function(){
    	window.location.href = "http://passport.zhaopin.com/account/login?bkUrl=" + encodeURIComponent(link);		
    });
    //取到用户名然后赋给头部登陆后用户名
    if(cookieOperate("JSShowname")){
        var cookieVal = cookieOperate("JSShowname");
        $("#personname").html(cookieVal);
        $("#companyLogining").show();
        $("#companyLoginregin").hide();
    }
    //退出登录
    $("#personcheckout").click(function(){
        loginOut(function(){
            $("#companyLoginregin").show();
            $("#companyLogining").hide();
        })
    })

    /**
     * 全站用户退出接口，fun为退出后的回调函数
     * @param fun
     */
    function loginOut(fun){
        $.ajax({
            type: "post",
            url: "http://passport.zhaopin.com/account/logouthandler",
            dataType: "jsonp",
            success:function(data){
                var code = data.ErrorCode;
                if(typeof fun == 'function'){
                    fun(code+'');
                }
            },error: function () {
                //alert("注销失败，请重试");
            }, complete: function (XMLHttpRequest, textStatus) {
                XMLHttpRequest = null;
            }
        });
    }
    //获取或设置cookie
    function cookieOperate(name, value, options) {
        if (typeof value != 'undefined') { // name and value given, set cookie
            options = options || {};
            if (value === null) {
                value = '';
                options.expires = -1;
            }
            var expires = '';
            if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
                var date;
                if (typeof options.expires == 'number') {
                    date = new Date();
                    date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
                } else {
                    date = options.expires;
                }
                expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
            }
            // CAUTION: Needed to parenthesize options.path and options.domain
            // in the following expressions, otherwise they evaluate to undefined
            // in the packed version for some reason...
            var path = options.path ? '; path=' + (options.path) : '';
            var domain = options.domain ? '; domain=' + (options.domain) : '';
            var secure = options.secure ? '; secure' : '';
            document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
        } else { // only name given, get cookie
            var cookieValue = null;
            if (document.cookie && document.cookie != '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = jQuery.trim(cookies[i]);
                    // Does this cookie string begin with the name we want?
                    if (cookie.substring(0, name.length + 1) == (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }
    }
}
//http://img01.zhaopin.cn/2014/common/js/index_ads.js 这个js里面的内容，在老的foot文件里面，由于改版故放到现在的head_foot.js里面
function getsm() {
    return get_mcookie('urlfrom');
}
function get_mcookie(Name) {
    var search = Name + '=';
    var returnvalue = '';
    if (document.cookie.length > 0) {
        offset = document.cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = document.cookie.indexOf(';', offset);
            if (end == -1)
                end = document.cookie.length;
            returnvalue = unescape(document.cookie.substring(offset, end));
        }
    }
    if (returnvalue.length < 2)
        returnvalue = '12001997';
    return returnvalue;
}
function getRandom() {
    return Math.round(Math.random() * 10000000);
}
//cnt监控
function AdsClick(bid, cid) {
    (new Image()).src = 'http://cnt.zhaopin.com/Market/adpv.html?sid=' + bid + '&site=' + cid + '&smid=' + getsm() + '&random=' + getRandom();
}
function AdsClickRegister(bid, cid) {
    (new Image()).src = 'http://cnt.zhaopin.com/Market/adpv.html?sid=' + bid + '&site=' + cid + '&smid=' + getsm() + '&random=' + getRandom();
}
//seo统计从搜索引擎直接访问简历、投递统计
document.write('<script src="http://img07.zhaopin.cn/2014/head_foot/js/global.js"></script>')

/*syh 2016 10 31 添加*/

function setBlackStrip(){
    if (blackStripGetCookie()) {
        var blackStrip = '';
        blackStrip += '<div class="bottom_black_strip_container" style="width:100%;position:fixed;bottom:0;left:0;height:80px;z-index: 9">';
        blackStrip += '<div class="bottom_black_strip" style="width:100%;height:80px;background: #000;opacity:0.7;filter:alpha(opacity=70);"></div>'
        blackStrip += ' <div class="black_strip_container" style="position:absolute;top:0;left:0;width:990px;height:80px;z-index:5;color:#fff;">'
        blackStrip += '<span class="closed_black_strip" style="position:absolute;top:8px;right:0;cursor:pointer;"><img src="http://img00.zhaopin.cn/2014/seo/images/closed_button.png" alt=""/></span>'
        blackStrip += '<p style="line-height:80px;font-size:20px;color:#fff">'
        blackStrip += '还没找到心仪的工作？立即注册，我们会为你推荐<span style="font-size:30px;color:#fff">高薪职位</span>，坐等<span style="font-size:30px;color:#fff">工作上门</span>！'
        blackStrip += ' <a href="http://ts.zhaopin.com/jump/index.html" target="_blank" onclick="dyweTrackEvent(\'PCallPages\',\'FooterRegisterButtom\')" style="display:inline-block;width:120px;text-align: center;height:40px;line-height:40px;background: #ffe22a;color:#6a410e;text-decoration:none;vertical-align: middle;margin:-4px 0 0 65px;border-radius: 5px;font-size:18px;">10秒注册</a>'
        blackStrip += '</p>';
        blackStrip += '</div>';
        blackStrip += '</div>';
        $('body').append(blackStrip);
        $('.black_strip_container').css({
            left: (parseInt($(window).width()) - 990) / 2 + 'px'
        });
        $('.closed_black_strip').click(function () {
            $('.bottom_black_strip_container').css('display', 'none')
            blackStripSetCookie('BLACKSTRIP', 'yes',1);
            $('.layer-01').css('bottom','10px');
        });
    }
    function blackStripSetCookie(cookieName, cookieValue,cookieDayNum) {
        var date = new Date();
        //过期时间
        date.setTime(date.getTime() + (cookieDayNum*24*60*60*1000)); //保存一天
        document.cookie = cookieName + "=" + cookieValue + "; path=/;expires = " + date.toGMTString();
    }
    function blackStripGetCookie() {
        var cookieArr=['BLACKSTRIP','jssuserinfo','JSShowname'];
        var result = true;
        var myCookie = document.cookie;
        for(var i=0;i<cookieArr.length;i++){
            var storageNameNum = myCookie.indexOf(cookieArr[i] + "=");
            if (storageNameNum > -1) {
                result = false
            }
        }
        if($('.bottom_black_strip_container')){
            $('.bottom_black_strip_container').css('display', 'none');
        }
        if(!result){
            $('.layer-01').css('bottom','10px');
        }
        return result;
    }

}
var blackStripTimer=setInterval(function(){
    if(jQuery){
        clearInterval(blackStripTimer);
        setBlackStrip()
    }
},1000);

/*syh 2016 10 31 end*/
