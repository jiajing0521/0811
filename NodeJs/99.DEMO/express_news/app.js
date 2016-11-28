/**
 * Created by dllo on 16/11/28.
 */
const express = require("express");
const ejs = require("ejs");
const path = require("path");

//引入路由控制器
const router = require("./controller/router");

var app = express();

//设置静态文件路径
app.use(express.static("public"));

//设置模板引擎
app.set("view engine", "ejs");
//设置模板所在路径
// 参数一：views
// 参数二：模板所在路径
app.set("views","views");

// 主页
app.get("/",router.showAll);

// 跳转到详情页
app.get("/detail/:id",router.showDetail);

// 跳转到上传页面
app.get("/upload",router.showUpload);

// 点击提交按钮，上传form表单
app.post("/upload",router.formSubmit);

app.listen(8080);

