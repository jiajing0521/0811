function SetCookie(name,value){
	var exp=new Date();
	document.cookie=name+'='+escape(CodeCookie(value))+' ; maxage=-1 ; path=/ ; domain=localhost';
}
//是否已经登陆
function isLogon(){
	var islogon = false;
	var allcookie = document.cookie.split('; ');
    for(var i=0;i<allcookie.length;i++){
        var cookiename = allcookie[i].split('=')[0];
        if(cookiename=='zcool_logon_new'){
            islogon = true;
        }
    }
	return islogon;
}

//下载记录
function getDownTotal()
{
	var allcookie = document.cookie.split('; ');
    for(var i=0;i<allcookie.length;i++){
		var arr = allcookie[i].split('=');
        var cookiename = arr[0];        
       if(cookiename == 'dt'){
          return decodeURI(arr[1]);
        }
    }
	return "0";
}
//得到基本信息。
function getUserInfo(){	
	
	var varUserStatus='';
	var allcookie = document.cookie.split('; ');
    for(var i=0;i<allcookie.length;i++){
		var arr = allcookie[i].split('=');
        var cookiename = arr[0];        
        if(cookiename == 'zcool_logon_new'){
          var tmpString = decodeURI(arr[1]);
		  varUserStatus = tmpString;
        }
    }
	return varUserStatus;
}
var status = '';
var userCookieUID="";			//用户uid
var userCookieLoginname="";			//用户loginname
var userCookieRealname="";		//用户昵称
var userCookieUserMail="";		//用户mail
var userCookieUserFace="";		//用户face
var userCookieUserDomain="";		//用户domain

if(isLogon()){
	status=getUserInfo();
	status.replace('?','O').replace('?','O').replace('?','O');
	try{
	    var stat = status.split("|");
	    userCookieUID = stat[0];
	    userCookieLoginname = decodeURI(stat[1]);
	    userCookieRealname = decodeURI(stat[2]);
	    userCookieUserMail = stat[3];
		userCookieUserFace = unescape(stat[4]);
		userCookieUserDomain = unescape(stat[5]);
	}catch(e){
	}
}


function dw(s){
	document.write(s);
}


function reload_status()
{
	if(isLogon()){
		status=getUserInfo();
		status.replace('?','O').replace('?','O').replace('?','O');
		try{
			var stat = status.split("|");
			userCookieUID = stat[0];
			userCookieLoginname = decodeURI(stat[1]);
			userCookieRealname = decodeURI(stat[2]);
			userCookieUserMail = stat[3];
			userCookieUserFace = unescape(stat[4]);
		}catch(e){
		}
	}

	var html = "<a href=\"/u/"+userCookieUID+"\" target=\"_blank\" class=\"b\">"+userCookieLoginname+"</a>|<a href=\"/LogOut.do?backUrl="+document.URL+"\">退出</a>|<a href=\"/my/\">我的站酷</a>|<a href=\"/u/"+userCookieUID+"/\" target=\"_blank\">我的主页</a>";
	$("#status_logon").html(html);

	get_message_count();

}

function get_message_count()
{
	$("#msg_num").html("sss");
//	$.get("/my/status_message.jsp",{t:Math.random()},function(data)
//	{
//		$("#msg_num").html($.trim(data));
//	});
}
//add by jiangchi check logon status
function checklogon(){
	if (isLogon()){
//		alert(1);
	} else {
//		alert(2);
	}
}
$(checklogon);