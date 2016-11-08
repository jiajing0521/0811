/**
 * 系统遮罩层
 * @param cfg
 * @constructor
 */
ZPIDC.Layer = function(cfg){
    var me = this;
    ZPIDC.copy(me,{
        _layer : undefined,
        _elem : undefined,
        promptTitle : '处理中.请稍后...'
    });
    ZPIDC.ifCopy(me,cfg);
    me.promptDom = '<span>'+me.promptTitle+'</span>';
};
ZPIDC.Layer.prototype = {
    loadMask : function(scope){
        var me = this;
        scope = scope || document.body;
        me.createMask($(me.promptDom),scope);
    },
    unLoadMask : function(){
        var me = this;
        if(me._elem != undefined)
            me._elem.hide().remove();
        me.remLayer(me);
    },
    remLayer: function(){
        var me = this;
        if(me._layer != undefined)me._layer.remove();
        if(me._elem != undefined)me._elem.hide();
        me._layer = undefined;
        me._elem = undefined;
    },
    addLayer: function(element,cssCfg){
        var me = this;
        var client = me.scollPosition(),
            _cssCfg = cssCfg || {},
            $element = $(element),
            $body = $(document.body);
        //需要先放入到body里，要不然juqery找不到$element的宽度
        me._elem = $element.appendTo($body);
        me.setLayerContentCss($element,_cssCfg,client);
        me._layer = $(document.createElement("div"));
        me.setLayerContainerCss(_cssCfg,client).appendTo($body);
        if(!cssCfg){
            me.setLayerResize();
        }
    } ,
    setLayerContentCss : function(contentEle,cssCfg,client){
        var content_css = cssCfg.content_css || 'global-mask-content',
            content_coor = cssCfg.content_coor || {
                display: 'block',
                left: client.left + (client.vwidth - contentEle.width()) / 2 +"px",
                top: client.top + (client.vheight - contentEle.height()) / 3 + "px"
            };
        contentEle.css(content_coor).addClass(content_css);
        return contentEle;
    },
    setLayerContainerCss : function(cssCfg,client){
        var me = this,cssCfg = cssCfg || {};
        if(!(me && me._layer)){return ;}
        if(!client){
            client = me.scollPosition();
        }
        var container_css = cssCfg.container_css || 'global-mask-container',
            container_coor = cssCfg.container_coor || {
                width: client.width + "px",
                height: client.height + "px"
            };
        me._layer.css(container_coor).addClass(container_css);
        return me._layer;
    },
    createMask : function(el,scope){
        var me = this;
        var _postion = me.getScopeXY(scope);
        if(scope == document.body){
            me.addLayer(el.addClass('part-mask-content'));
        }else{
            me.addLayer(el,{
                content_css:'part-mask-content',
                container_css:'part-mask-container',
                content_coor:{
                    display: 'block',
                    left: _postion.left + (_postion.inWidth - 315)/2 + 'px',
                    top: _postion.top + _postion.inHeight * 0.4 + 'px'
                },
                container_coor:{
                    left: _postion.left + 'px',
                    top: _postion.top + 'px',
                    width: _postion.inWidth + "px",
                    height: _postion.inHeight + 50 + "px"
                }
            });
        }
    },
    getScopeXY : function(scope){
        var $scope = $(scope);
        var _xy = $scope.offset() || {left : 0,top : 0};
        _xy.inHeight = $scope.innerHeight();
        _xy.inWidth = $scope.innerWidth();
        return _xy;
    },
    scollPosition: function() {
        var t, l, w, h ,vw , vh,
            dde=document.documentElement,
            db = document.body,
            $body = $(db),
            $window = $(window);
        if (dde && dde.scrollTop) {
            t = dde.scrollTop;
            l = dde.scrollLeft;
            w = dde.scrollWidth;
            h = dde.scrollHeight;
        } else if (db) {
            t = db.scrollTop;
            l = db.scrollLeft;
            w = db.scrollWidth;
            h = db.scrollHeight;
        }
        vw = $window.width() == 0 ? ($body.outerWidth(true) ? $body.outerWidth(true) : $body.width()) : ($window.outerWidth(true) ? $window.outerWidth(true) : $window.width()) ;
        vh = $window.height() == 0 ? ($body.outerHeight(true) ? $body.outerHeight(true) : $body.height()) : ($window.outerHeight(true) ? $window.outerHeight(true) : $window.height()) ;
        w = w > vw? w : vw;
        h = h > vh? h : vh;
        return { top: t, left: l, width: w, height: h ,vwidth: vw, vheight: vh};
    },
    setLayerResize : function(){
        var me = this;
        $(window).bind('resize',function(){
            me.setLayerContainerCss();
        }).bind('scroll',function(){
            me.setLayerContainerCss();
        });

    }
};
/**
 * 遮罩的对外接口
 * @type {{loadingMask: , unLoadingMask: }}
 */
ZPIDC.Mask = {
    loadingMask : function(promptTitle, scope){
        var scope = scope || document.body,
        _mask = new ZPIDC.Layer({
            promptTitle : promptTitle || '加载中.请稍后...'
        });
        _mask.loadMask(scope);
        $(scope).data('_mask',_mask);
    },
    unLoadingMask : function(scope){
        var scope = scope || document.body,
        _mask = $(scope).data('_mask');
        if(_mask){
            $(scope).data('_mask',null);
            _mask.unLoadMask();
        }
    }
};
/**
 * 系统弹出窗口
 * @param cfg
 * @constructor
 */
ZPIDC.window = function () {
    var me = this;
    ZPIDC.copy(me,{
        containerid:'window_container',
        containerCls : null,
        headCls : null,
        bodyCls : null,
        footCls : null,
        title: null,
        width: null,
        height: null,
        autoHeight : true,
        headerHeight : 50,
        footerHeight : 50,
        maskLoading : new ZPIDC.Layer({promptTitle : '加载中.请稍后...'}),
        maskLayer : new ZPIDC.Layer(),
        haveMask : true,
        cls: null,
        left: 0,
        top: 0,
        body: null,
        foot: "",
        backdrop: true,
        close: true,
        buttonsCfg : {
            cls : 'rd_btn rd_btn_110 fwb mr20',
            text : "确认",
            container :'<a href="javascript:;"></a>',
            callback : function(){}
        },
        buttons: [/*示例{cls : "rd_btn rd_btn_110 fwb mr20",container :'<a href="#"></a>',text : "确定",callback : function(){}},{cls : "cancel_text",container :'<a href="#"></a>',text : "取消",callback : function(){}}*/],
        cont: 'body',
        addtype: 'append',
        beforeClose : function(){},
        genHtml : function(){},
        onMove : function () {}
    });
    me.factory = {
        'Container':'<div id='+me.containerid+' class="'+(me.containerCls || "popup_box")+'"></div>',
            'Header':'<h5 id="popup_header" class="'+(me.headCls)+'"></h5>',
            'Body':'<div id="popup_body" class="'+(me.bodyCls || "popup_cont")+'"></div>',
            'Footer': '<div id="popup_footer" class="'+(me.footCls || "popup_bottom")+'"></div>'
    };
    me.createButtons = function(){
        if(me.buttons && me.buttons.length > 0){
            var tpls = [];
            var callBack = function(fun){
                if(typeof fun == 'function'){
                    return function(){
                        if(fun() == false){
                            return false;
                        }
                        me.onclose();
                    };
                }else{
                    return function(){
                        me.onclose();
                    };
                }
            };
            for(var step = 0,len = me.buttons.length;step < len;step++){
                var botton =  me.buttons[step];
                var text = botton.text || me.buttonsCfg.text;
                var cls = botton.cls || me.buttonsCfg.cls;
                var jqButton = $(botton.container || me.buttonsCfg.container);
                if(typeof botton.callback == 'function'){
                    jqButton.callback = botton.callback;
                }

                jqButton.addClass(botton.cls || me.buttonsCfg.cls).text(text)
                try{
                    jqButton.on('click',callBack(jqButton.callback));
                }catch(e){
                    jqButton.bind('click',callBack(jqButton.callback));
                }
                tpls.push(jqButton);
            }
            me["option"+"Footer"](tpls,"Footer");
        }else{
            $('#popup_footer').remove();
        }
    };
    me.onclose = function () {
        if(me.maskLoading){
            me.maskLoading.unLoadMask();
        }
        me.beforeClose.apply(me, arguments);
        $("#" + me.containerid).hide().remove();
        me.maskLayer.remLayer();
        me.onMove();
    };
    (function(){
        for(var key in me.factory){
            //get/set
            me["option"+key] = function(content,factor){
                var factor = factor || 'Body';
                factor = factor.zUpperFirstCase();
                if(content){
                    me[factor].html(content);
                    //me.Container.css({top : ($(window).height() - me.Container.height())/3 + $(document).scrollTop()});
                    if(factor == 'Body'){
                        me.maskLoading.unLoadMask();
                        me.maskLoading = null;
                    }
                }else{
                    return me[factor];
                }
            };
            me["gen"+key] = function(factor){
                var temp = me.factory[factor];
                me[factor] = $(temp);
                if(me[factor.toLowerCase()+"Height"]){
                    me[factor].height(me[factor.toLowerCase()+"Height"]);
                }
                if(me[factor.toLowerCase()+"Width"]){
                    me[factor].width(me[factor.toLowerCase()+"Width"]);
                }
            };
        }
    })();
    me.oninit = function () {
        var factory = ['Container','Header','Body','Footer'];
        for(var step = 0,len = factory.length;step < len;step++){
            var factor = factory[step];
            me["gen"+factor](factor);
            if(factor != "Container" && me['Container'] instanceof jQuery){
                me['Container'].append(me[factor]);
            }
        }
        $("body").append(me.Container.hide());
        me.Container.width(me.width);
    	if(me.height && typeof me.height * 1 == 'number'){
    		if(me.buttons && me.buttons.length > 0){
                $('#popup_body').height(me.height - me.headerHeight - me.footerHeight);
            }else{
                $('#popup_body').height(me.height - me.headerHeight);
            }
    	}else if(me.height == 'auto'){
    		me.Container.height('auto');
    	}
        me.Container.width(me.width);
	setTimeout(function(){
            me.maskLayer.addLayer(me.Container);
        },10);
        //me.maskLayer.addLayer(me.Container);
    };
    me.oninit();
};
ZPIDC.dialog = function(cfg){
    var me = this;
    ZPIDC.extend(me,ZPIDC.window,cfg);
    me.maskLoading.loadMask($('#popup_body'));
    var init = function(){
        if(me.title){
            var content = '<span class="fr popup_close"></span>'+me.title;
            me["option"+"Header"](content,"Header");
            if(me.close){
                $('#popup_header .popup_close').bind('click',me.onclose);
            }else{
                $('#popup_header .popup_close').hide();
            }
        }
        me.createButtons();
    }
    init();
};
