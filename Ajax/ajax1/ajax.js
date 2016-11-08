/**
 * Created by dllo on 16/11/2.
 */
function ajax(method,url,dataObj,success) {
    var xhr;
    if (window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //声明数组
    //如果是get需要把对象拼接后放在url后?+dataStr
    //如果是post需要把对象拼接后放在send里
    var dataArr = [];
    //把{a:1,b:2}-->a=1&b=2
    for (var prop in dataObj){
        //dataArr->["a=1","b=2"]
        dataArr.push(prop + "=" + dataObj[prop]);
    }
    //join函数,把数组中的元素以某个字符连接成字符串
    var dataStr = dataArr.join("&");

    if (method.toUpperCase() == "GET"){
        xhr.open(method,url+"?"+dataStr,true);
        xhr.send();
    }else if (method.toUpperCase() == "POST"){
        xhr.open(method,url,true);
        //post 必须加的,设置请求头,即告诉后台发送的内容的格式
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send(dataStr);
    }

    xhr.onreadystatechange = function () {

        if (xhr.readyState == 4){
            if (xhr.status == 200){
                success(xhr.responseText);
            }
        }

    }
}