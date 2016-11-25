/**
 * Created by dllo on 16/11/25.
 */
const express = require("express");
const ejs = require("ejs");
const mysql = require("mysql");
const fs = require("fs");
const path = require("path");
const bodyParser = require("body-parser");

const app = express();

//设置模板引擎
app.set("view engine","ejs");
// 设置模板路径
app.set("views","./views");
app.use(express.static("static"));

app.get("/",(req,res)=>{
    res.render(path.join(__dirname,"views/home.ejs"),{});
});

app.listen(8888);