/**
 * Created by dllo on 16/11/23.
 */
const http = require("http");
const fs = require("fs");
const path = require("path");
const url = require("url");

var server = http.createServer(function (request,response) {
    // console.log(request.url);
    // 把请求的url解析成一个对象，参数二：如果是true的话，会吧get请求的参数解析成对象（?xx=xx）=>(xx:xx)
    var urlObj = url.parse(request.url,true);
    console.log(urlObj);
    if (urlObj.pathname == "/"){
        response.end("root");
    }else if (urlObj.pathname == "/a.html"){
        var query = urlObj.query;
        //转字符串
        response.write(JSON.stringify(query));
        response.end("a.html");
    }else{
        // 200是状态码:成功
        response.writeHead(200,{"Content-type":"text/plain"});
        var result = fs.readFileSync(path.join(__dirname,"05.http_test.html"),"utf8");
        response.write(result);
        response.end();
    }
    // if (request.url == "/"){
    //     response.end("root");
    // }else if (request.url == "/a.html"){
    //     response.end("a.html");
    // }else{
    //     // 200是状态码:成功
    //     response.writeHead(200,{"Content-type":"text/plain"});
    //     var result = fs.readFileSync(path.join(__dirname,"05.http_test.html"),"utf8");
    //     response.write(result);
    //     response.end();
    // }
});
// 范围0-65535
server.listen(8080);
