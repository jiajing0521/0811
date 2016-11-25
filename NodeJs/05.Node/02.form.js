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
// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: false }));

//解析post发送的body 的请求体的格式2的第三方模块
// parse application/json
app.use(bodyParser.json());

//设置静态目录，这个目录下的文件直接通过路径即可访问，不需要单独写路径，
// 为一个由express提供的中间件
app.use(express.static("static"));

app.get("/form",(req,res)=>{
   //针对ejs模板的render,参数一：模板路径，参数二：返回给模板的对象
   res.render(path.join(__dirname,"views/form.ejs"),{});
});

app.post("/form",(req,res)=>{
   console.log(req.body);
   // res.send("收到");
   res.json(req.body);
});

app.get("/p:id",(req,res)=>{
   res.send(req.params.id);
});
app.listen(8080);