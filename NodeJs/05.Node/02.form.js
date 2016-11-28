/**
 * Created by dllo on 16/11/25.
 */
const express = require("express");
const ejs = require("ejs");
const path = require("path");
//解析post发送的数据的请求体的第三方模块
const bodyParser = require("body-parser");

const app = express();

//设置模板引擎
app.set("view engine","ejs");
// 设置模板路径
// app.set("views","./views");

//解析post发送的body 的请求体的格式1的第三方模块
// form中enctype如果是 application/x-www-form-urlencoded
// 'name=jk&pass=888'=>对象
app.use(bodyParser.urlencoded({ extended: false }));

//解析post发送的body 的请求体的格式2的第三方模块
// form中enctype如果是 application/json
//'{xx:cc}'=>对象
app.use(bodyParser.json());

//设置静态目录，这个目录下的文件直接通过路径即可访问，不需要单独写路径，
// 为一个由express提供的中间件
app.use(express.static("static"));

app.get("/form",(req,res)=>{
   //针对ejs模板的render,参数一：模板路径，参数二：返回给模板的对象
   res.render(path.join(__dirname,"views/form.ejs"),{});
});

app.post("/form",(req,res)=>{
    // req.body是对象格式
   console.log(req.body);
   // res.send("收到");
    //发给前端时，应该是字符串，所以应该通过res.json(req.body)把对象转换为'{}'字符串格式
   res.json(req.body);
});

app.get("/p:id",(req,res)=>{
   res.send(req.params.id);
});
app.listen(8080);