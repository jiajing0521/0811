/**
 * Created by dllo on 16/11/23.
 */
const http = require("http");
const fs = require("fs");
const path = require("path");
const url = require("url");
const queryString = require("querystring");

var server = http.createServer((req,res) => {
    //获取路径并解析
    var urlObj = url.parse(req.url,true);
    switch (urlObj.pathname){
        case "/06.form_login.html":
            var result = fs.readFileSync(path.join(__dirname,"./06.form_login.html"),"utf8");
            res.writeHead(200,{
                "Content-type":"text/html;charset=utf-8"
            });
            res.write(result);
            res.end();
            break;
        case "/login":
            var queryObj = urlObj.query;
            res.writeHead(200,{
                "Content-type":"text/html;charset=utf-8"
            });
            if (queryObj.username == "JK" && queryObj.password == "888"){
                res.write("success");
            }else{
                res.write("error")
            }
            res.end();
            break;
        case "/06.form_post.html":
            var result = fs.readFileSync(path.join(__dirname,"./06.form_post.html"),"utf8");
            res.writeHead(200,{
                "Content-type":"text/html;charset=utf-8"
            });
            res.write(result);
            res.end();
            break;
        case "/login_post":
            //使用post访问服务器的时候，request会响应data事件，
            // 所以需要通过req.on("data",fun)来绑定data事件，
            // 获取前端通过post传过来的数据
            req.on("data",function (data) {
                var dataObj = queryString.parse(data.toString());
                res.writeHead(200,{
                    "Content-type":"text/html;charset=utf-8"
                });
                if (dataObj.username == "JK" && dataObj.password == "888"){
                    res.write("登录成功");
                }else{
                    res.write("用户名或密码错误");
                }
                res.end();
            });
            //post发送数据结束后触发end事件
            // req.on("end",function (data) {
            //     console.log("结束了");
            // });
            break;
        default:
            break;
    }

}).listen(8888);
