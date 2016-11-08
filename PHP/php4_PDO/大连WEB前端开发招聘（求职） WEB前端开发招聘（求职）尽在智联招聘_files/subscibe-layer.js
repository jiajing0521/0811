$(document).ready(function () {

    //  职位免费阅读入口初始化
    subscibe_layer.init_free_interface();

    //  免费职位定于弹出层初始化
    subscibe_layer.init_free_read_job_info();
});

//  弹出层的命名空间
var subscibe_layer = {};

//  IE 实现Placeholder功能
subscibe_layer.isPlaceholder = function () { var input = document.createElement('input'); return 'placeholder' in input; }
//  免费职位订阅弹出层初始化
subscibe_layer.init_free_read_job_info = function () {
    //  定义邮件校验函数
    var email = emailTemp = new MZ_REG.formEle(true, "email", null, "randomNews_email", ['请输入正确的邮件格式', '', '请输入Email！', 'Email地址长度不能超过100位！', '请输入正确的邮件格式', '', '', ''], 0);
    $("#email").get(0).onfocus = $("#ident_code").get(0).onfocus = function () {
        $(this).parent().get(0).className = 'inputText1 span_input inputText1b';
    }
    $("#email").get(0).onblur = function () {
        email.o = this;
        email.fnBlur();
        if (email.checkData(this) == "0") {
            $(this).parent().get(0).className = 'inputText1 span_input inputTexts';
            $("#randomNews_email").html("");
        } else {
            $(this).parent().get(0).className = 'inputText1 span_input inputTexte';
        }
    }
    if (!subscibe_layer.isPlaceholder()) {
        var email1 = $("[id*='email']");
        var trimre = /^\S|\S$/;
        var placeHolderChange = function (jqdom, defaultValue) {
            var defaultValue = defaultValue || "";
            $(jqdom.get(1)).focus(function () {
                $(jqdom.get(1)).hide();
                $(jqdom.get(0)).show();
                $(jqdom.get(0)).focus();
            });
            $(jqdom.get(0)).blur(function () {
                value = this.value.replace(trimre, "");
                if (value == "" || value == defaultValue) {
                    $(jqdom.get(1)).show();
                    $(jqdom.get(0)).hide();
                }
            });
        }
        placeHolderChange(email1, '如：abc@163.com');
    };
    $(".job_read_header i").bind("click", function () {
        $("#id_job_read_container").hide();
    });
}
//  免费职位订阅入口按钮初始化
subscibe_layer.init_free_interface = function () {
    var host = $("#free_read_job");

    host.bind("click", function () {
        var JSpUserInfo = $.cookie("JSpUserInfo");
        var JSsUserInfo = $.cookie("JSsUserInfo");
        if ((JSpUserInfo && JSpUserInfo.trim().length > 0) || (JSsUserInfo && JSsUserInfo.trim().length > 0)) {//用户已经登录
            host.attr({ "href": host.attr("src"), "target": "_blank" });
            recordOutboundLink(this, 'soujoblist', 'loginjobalert');
            return true;
        }
        host.attr({ "href": "javascript:void(0);", "target": "" });
        recordOutboundLink(this, 'soujoblist', 'nologinjobalert');
	$(".input_submit").unbind('click');
	$(".input_submit").bind('click',subscibe);
        //$(".input_submit").attr({ 'onclick' : "subscibe();" });

	var obj = $(".ico_dy_new").parent();
        var top_read = obj.offset().top+ obj.height() - 104;
        var left_read = obj.width()- $("#id_job_read_container").width()  - 19 ;        
        if($("#geo_addr").get(0)){
            obj = $(".ico_dy_new");
            top_read = obj.offset().top + 29;
            left_read = obj.offset().left - 295  ;
        }
        $("#id_job_read_container").css({
            top : top_read,
            left : left_read
        });  
     

        $("#id_job_read_container").show();
        if (!subscibe_layer.isPlaceholder()) {
            var email1 = $("[id*='email']");
            $(email1.get(0)).css({ display: "none" });
            $(email1.get(1)).css({ display: "" });
            $(email1.get(1)).val("如：abc@163.com");
        }
        $("#email").parent().get(0).className = 'inputText1 span_input';
        $("#randomNews_email").html("");
        $("#ident_code").parent().get(0).className = 'inputText1 span_input';
        $("#randomNews_indent").html("");
        $("#email").val("");
        $("#ident_code").val("");
        ident_image_load();
        $(".input_submit").html('订阅<img class="submit_waiting" src="../images/bookjob/loading.gif" />');
    });
    //  点击查询条件的时候，弹出层位置变化滑动
    $(".slideUp").bind("click", function () {
        function slip() {
            var obj = $(".ico_dy_new").parent()
            var top1 = obj.offset().top;
            var left1 = obj.offset().left;

            $("#id_job_read_container").animate({
                top: top1 + obj.height() - 104,
                left: obj.width() - $("#id_job_read_container").width() - 19
            }, 1000, 'swing')
        }
        setTimeout(slip, 400)
    });

}