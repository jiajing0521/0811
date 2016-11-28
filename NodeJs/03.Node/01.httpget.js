/**
 * Created by dllo on 16/11/24.
 */
const http = require("http");
const queryString = require("querystring");

// http.get("http://www.baidu.com",(res)=>{
//    // console.log(res);
//    res.on("data",(data)=>{
//        console.log(data.toString());
//    })
// });

//对象转为字符串
// 转为u=jk&p=88
var bodyStr = queryString.stringify({
    username: "JK",
    password: "888"
});
//字符串转为对象
// 转为{name:'jk',pass:888}
queryString.parser("name=jk&pass=888");

var options = {
    hostname: "localhost",
    port: 8888,
    path: "/login_post",
    method: "POST",
    headers:{
        "Content-type": "application/x-www-form-urlencoded"
    }
};
var req = http.request(options,(res)=>{
    res.on("data",(data)=>{
        console.log(data.toString());
    });
    res.on("end",()=>{
        console.log("没了");
    })
})
req.write(bodyStr);
req.end();
// http.request();
