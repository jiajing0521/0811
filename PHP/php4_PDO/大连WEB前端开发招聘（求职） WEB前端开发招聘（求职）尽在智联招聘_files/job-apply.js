//反馈通D期C端修改
try{
    ZPIDC.ns("ZPIDC.applyjob");
}catch(e){
    ZPIDC = {applyjob : {}};
}
//反馈通弹出窗口对象
ZPIDC.applyjob.feedbackPopup = {
    createPopup : function(){
        var popup_html = '<div class="feedbackBox"><h3>如有面试通知，马上提醒我</h3>' +
            '<p class="addP">仅向对我感兴趣的企业开放联系方式</p>' +
            '<div class="feeLast"><a href="#" class="openFeedback" onclick="dyweTrackEvent(\'turnOnDialog\',\'clickOK\')">接受面试通知</a>' +
            '<span class="close" onclick="dyweTrackEvent(\'turnOnDialog\',\'clickCancle\')">不用通知我，让简历石沉大海吧</span>' +
            '</div></div><div class="fullBg"></div>';
        return popup_html;
    },
    showMask : function(){
        // 计算遮罩层大小
        var documentHeight = $(document).height();
        var documentWidth = $(document).width();
        $(".fullBg").css({"width":documentWidth,"height":documentHeight,'display': 'block','opacity':'0.5'});
    },
    showFeedbackBox : function(nextFun){
        var feedbackBox = $('.feedbackBox');
        if(feedbackBox.length == 0){
            var str_popup = this.createPopup();
            $('body').append(str_popup);
        }else{
            feedbackBox.show();
        }
        $(".feedbackBox .close").unbind().click(function(){
            $(".feedbackBox,.fullBg").fadeOut(0);
            typeof nextFun == 'function' ? nextFun() : '';
        });
        $(".openFeedback").unbind().click(function(){
            /*发送开通反馈通请求*/
            $.ajax({
                type : 'get',
                dataType : 'jsonp',
                url : 'http://i.zhaopin.com/feedback/api/set'
            });
            $(".feedbackBox,.fullBg").fadeOut(200);
            setTimeout(function(){typeof nextFun == 'function' ? nextFun() : '';}, 200);
        });
        /*显示遮罩*/
        this.showMask();
    }
};
/*窗口大小变化时调整遮罩的大小*/
try{
    $(window).resize(function(){
        if($('.fullBg').is(':visible')){
            $('.fullBg').css({width : $(window).width(), height : $(document).height()});
        }
        if($('.divMask').is(':visible')){
            $('.divMask').css({width : $(window).width(), height : $(document).height()});
        }
    });
}catch(e){

}
//反馈通入口
ZPIDC.applyjob.feedBackInter = function(nextFun){
    //去掉反馈通提示弹窗，默认都设置为反馈通用户
    jQuery.cookie('JSfeedback','y',{domain : '.zhaopin.com',path:'/'});
    /*去掉反馈通提醒开通弹窗*/
    //try{
    //    /*从cookie中取到的JSfeedback的值可能是null（没发送过请求）、y（已开通反馈通）、n（未开通反馈通，但提示窗口已显示了三次）、
    //    0（未开通反馈通，提示窗口没有显示过）、1（未开通反馈通，提示窗口显示过1次）、2（未开通反馈通，提示窗口显示过2次）*/
    //    var feedBackTipTimes = jQuery.cookie('JSfeedback');
    //    //jQuery.cookie('JSpUserInfo')或jQuery.cookie('JSsUserInfo')如果有值，说明用户已登录
    //    if(feedBackTipTimes == null && (jQuery.cookie('JSpUserInfo') || jQuery.cookie('JSsUserInfo'))){
    //        /*发送请求查看以显示的次数或者是否已开通反馈通*/
    //        $.ajax({
    //            type : 'get',
    //            url : 'http://i.zhaopin.com/feedback/api/get',
    //            dataType : 'jsonp',
    //            success : function(data){
    //                /*开通了反馈通或已经显示了3次弹窗后都不再显示弹窗，返回的data的值0一次都没显示，
    //                1显示了一次，2显示了两次，'N'显示了三次，'Y'已开通反馈通，-10等用户没有登陆等*/
    //                if(data == 0 || data == 1 || data == 2){
    //                    dyweTrackEvent("turnOnDialog","loadDialog");/*监控*/
    //                    ZPIDC.applyjob.feedbackPopup.showFeedbackBox(nextFun);
    //                    /*发送请求修改cookies的值*/
    //                    $.ajax({
    //                        type : 'get',
    //                        dataType : 'jsonp',
    //                        url : 'http://i.zhaopin.com/feedback/api/SetNumber?n=' + (++data)
    //                    });
    //                }else{
    //                    typeof nextFun == 'function' ? nextFun() : '';
    //                }
    //            },
    //            error: function(){
    //                typeof nextFun == 'function' ? nextFun() : '';
    //            }
    //        });
    //    }else if((feedBackTipTimes == 0 || feedBackTipTimes == 1 ||feedBackTipTimes == 2) && (jQuery.cookie('JSpUserInfo') || jQuery.cookie('JSsUserInfo'))){
    //        dyweTrackEvent("turnOnDialog","loadDialog");/*监控*/
    //        ZPIDC.applyjob.feedbackPopup.showFeedbackBox(nextFun);
    //        /*发送请求修改cookies的值*/
    //        $.ajax({
    //            type : 'get',
    //            dataType : 'jsonp',
    //            url : 'http://i.zhaopin.com/feedback/api/SetNumber?n=' + (++feedBackTipTimes)
    //        });
    //    }else{
    //        typeof nextFun == 'function' ? nextFun() : '';
    //    }
    //}catch(e){
        typeof nextFun == 'function' ? nextFun() : '';
    //}
};
//反馈通二维码
ZPIDC.applyjob.feedBackWeiXin = function(opt){
    //0是未绑定,1是绑定
    var tipedTimes = jQuery.cookie('JSweixinNum')* 1, endCall = opt && (typeof opt.afterClose == 'function') ? opt.afterClose : '';
    //如果提示超过3次，也不弹出框
    if(tipedTimes < 3){
        //从后端接口取数，判断是否是微信绑定
        jQuery.ajax({
            url : 'http://i.zhaopin.com/MessageCenter/api/IsBindWeiXin',
            dataType : 'jsonp',
            success : function(data){
                if(data == '0'){
                    showWindow();
                    jQuery.cookie('JSweixinNum',++tipedTimes,{domain : '.zhaopin.com',path:'/'})
                }else if(endCall){
                    endCall();
                }
            }
        });
    }else{
        if(typeof opt.otherOpt == 'function'){
            opt.otherOpt();
        }
    }
    function showWindow(){
        var bodyTpl =  '<div class="Delivery_success_popdiv_conleft fl">'+
            '<img src="http://i.zhaopin.com/MessageCenter/api/WeiXin" width="180" height="180" title="扫一扫" alt="扫一扫">'+
            '</div><div class="Delivery_success_popdiv_conright fr">'+
            '<p><span class="">微信扫一扫</span></p>'+
            '<p class="lin37"><font>第一时间</font>接收<font color="#ff6600">面试通知!</font></p><p class="lin37">不再错过任何机会哦。</p></div>';
        var feedBackWeiXin = new ZPIDC.dialog({
            title:  '关注智联招聘，企业反馈及时达',
            containerid: "window_result_dialog",
            width: 600,
            height: 340,
            isMask: true,
            headerHeight : 80,
            containerCls : 'Delivery_success_popdiv',
            headCls : 'Delivery_success_popdiv_title',
            bodyCls : 'Delivery_success_popdiv_content clearfix',
            footCls : null,
            onMove : function(){
                endCall && endCall();
            }
        });
        feedBackWeiXin.optionBody(bodyTpl);
    }
};
/*20150831 最佳雇主在简历中心加弹框 liuhuili 第二次修改 20160728*/
ZPIDC.applyjob.showBestPop = function(){
    var rn = $('#FistResumeNumber').val(),//JS028250711R90250024000
        vs = $('#FistResumeVersion').val();//1
    var bcTimes = jQuery.cookie("BestCompany") * 1; 
    if(bcTimes < 3){
        $.ajax({
            type : "get",
            url : "http://i.zhaopin.com/Home/GetBestCompany?ResumeNumber=" + rn + "&version=" + vs,
            success : function(data){
                if(data.length != 0){
                        jQuery.cookie('BestCompany',++bcTimes,{domain : '.zhaopin.com',path:'/'})
                    dyweTrackEvent("bestTab","bestExposure"); //监控
                    var str = '';
                    for(var i = 0, len = data.length; i < len; i++){
                        var temp = data[i].Time;
                        temp = temp.indexOf('至今') != -1 ? temp : temp + '年';
                            str += '<p class="best_company"><a onclick="dyweTrackEvent(\'bestcompany\',\'bestclick\')" href="http://best.zhaopin.com/#/company/' + encodeURIComponent(data[i].CompanyName) + '" target="_blank">' + data[i].CompanyName + '<span>'  + temp + '</span></a></p>';
                    }
                    var bestHtml = '<div class="best_pop"><div class="best_pop_top"><a href="#"></a></div><div class="best_pop_cont">' +
                            '<div class="best_company_box">' + str +'</div><div class="best_pop_bottom"></div></div>';
                    var bestCompany = new ZPIDC.dialog({
                        width:602,
                        height:"auto",
                        isMask:true
                    });
                    bestCompany.optionBody(bestHtml);
                    $(".best_pop_top a").bind("click",function(){
                        $("#window_container,.global-mask-container").remove();
                    });
                }
            }
        });
    }
};
/*$(document).ready(function(){
    setTimeout(function(){
        $(".popup_close,#popupClose,.popupConfirmBtn:contains('关闭')").bind("click",function(){
            //isI 是否是i站点的首页，因为反馈通的弹框在很多地方都有，但是简历编号和版本只有i首页才有
            var isI = !!($('#FistResumeNumber').val() && $('#FistResumeVersion').val());
            isI ? ZPIDC.applyjob.showBestPop() : "";
        })
	},1000)
});*/
//简历置顶推广弹窗
/*
* 对象参数opt其中的属性：extNum表示简历扩展编号、verNum表示简历版本号
* */
ZPIDC.applyjob.resumeTopDialog = function(opt){
    if(!jQuery.cookie('resumeTopFlag')){
        jQuery.ajax({
            type : 'get',
            url : 'http://i.zhaopin.com/Order/OrderManager/Between24hour',
            dataType : 'jsonp',
            success : function(data1){
                if(data1 && (!data1.IsBuy || data1.IsBetween24)){
                    jQuery.ajax({
                        type : 'get',
                        url : 'http://i.zhaopin.com/Order/OrderManager/GetProducts',
                        dataType : 'jsonp',
                        success : function(data2){
                            jQuery.ajax({
                                type : 'get',
                                url : 'http://i.zhaopin.com/Order/OrderManager/GetViewedTimes?resumeNumber=' + opt.extNum + '&version=' + opt.verNum,
                                dataType : 'jsonp',
                                success : function(data3){
                                    if(data3 && data2.length > 0){
                                        var resTopDlgHtm = '<div class="dialog_add noSaleDia" style="display:none;"><span class="close"><img src="http://img01.zpin.net.cn/2014/c/img/resumeCenter/close.png" alt="关闭按钮"> </span> <h3 class="entH setH">简历置顶</h3> <div class="noSaleMain" style="display: block;">';
                                        if(!data1.IsBuy){//未购买的提醒文字
                                            resTopDlgHtm += '<p class="saleP">昨天简历被查看<span>' + data3.Viewed + '</span>次，输给了<span>' + data3.DefeatPercent + ' %</span>的人，建议购买简历置顶服务。</p>';
                                        }else if(data1.IsBetween24){//购买的简历置顶24小时内过期的提醒文字
                                            resTopDlgHtm += '<p class="saleP">你正在使用简历置顶服务，昨天简历被查看了<span>' + data3.Viewed + '</span>次，打败了<span>' + data3.DefeatPercent + ' %</span>的人，续费简历置顶服务后继续保持领先。</p>';
                                        }
                                        resTopDlgHtm += '<div class="noSaleCon"><h5>购买简历置顶服务：</h5><ul class="noSaleCole">';
                                        for(var i = 0; i < data2.length; i++){
                                            var oneData = data2[i];
                                            resTopDlgHtm += '<li>' + (oneData.PIsRecommend == 1 ? '<i class="iconRecommend">推荐</i><h6>' + oneData.PRecommendText +'</h6>' : '') + '<span>' + oneData.PName + '</span><p>预计被查看次数</p><span>+' + oneData.PDescribe + ' </span><a ' +
                                                'target="_blank" onclick="dyweTrackEvent(\'luMYrefreshPop\',\'clickPricebcd5a9\')" href="http://i.zhaopin.com/Order/OrderManager/CreatOrderAndToPay?pointId=&serviceId=' + oneData.ServiceId + '&extid=' + opt.extNum + '&version=' + opt.verNum + '&resumeTitle=&orderTitle=' + oneData.PName +
                                                '&orderDesp=' + oneData.PName + '&joinpoint=Refresh&clickpoint=Refresh&plat=PC&productId=' + oneData.Pid +'" class="btnYellowRule">' + oneData.ProductCutoff +' 元</a>' + (oneData.PPrice ? '<em>' + oneData.PPrice +' 元</em>' : '')+'</li>';
                                        }
                                        resTopDlgHtm += '</ul><span class="noSaleBot">* 提升简历质量，会更大幅度增加被查看次数</span></div></div></div>';
                                        var $reTopDlg = jQuery(resTopDlgHtm), $doc = jQuery(document), $win = jQuery(window);
                                        $reTopDlg.appendTo('body');
                                        var topOffset = ($win.height() - $reTopDlg.height())/ 2, leftOffset = ($win.width() - $reTopDlg.width())/2;
                                        $reTopDlg.css({top: $doc.scrollTop() + (topOffset > 0 ? topOffset : 0), left: $doc.scrollLeft() + (leftOffset > 0 ? leftOffset : 0) , display:'block'});
                                        jQuery('<div class="fullBg"></div>').css({'width':$win.width(),'height':$doc.height(),'display': 'block'}).appendTo('body');//遮罩
                                        jQuery.cookie('resumeTopFlag', 1,{domain : '.zhaopin.com',path:'/',expires:1});
                                        $reTopDlg.find('.close,.btnYellowRule').click(function(){//关闭按钮
                                            $('.dialog_add,.fullBg').fadeOut(200, function(){$(this).remove()});
                                        });
                                    }
                                }
                            });
                        }
                    });
                }
            }
        });
    }
};

