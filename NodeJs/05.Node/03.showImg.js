/**
 * Created by dllo on 16/11/25.
 */
const express = require("express");
const path = require("path");
const ejs = require("ejs");
const mysql = require("mysql");

const app = express();

//连接数据库
var connect = mysql.createConnection({
    host:"localhost",
    user: "root",
    password: "",
    database: "0811"
});
connect.connect();

//设置模板引擎
app.set("view engine", "ejs");

//主页图片展示：：：地址栏输入/
app.get("/",(req,res)=>{
    connect.query("SELECT * FROM imgupload",(err,rows,field)=>{
        if (err){
            throw err;
        }
        res.render(path.join(__dirname,"views/img.ejs"),{
            images: rows
        })
    })
});

//图片单独展示
app.get("/image/:id",(req,res)=>{
    connect.query("SELECT * FROM imgupload WHERE id = "+req.params.id,(err,rows,field)=>{
        if (err){
            throw err;
        }
        res.render(path.join(__dirname,"views/detail.ejs"),{
            image: rows[0]
        })
    });
});
app.listen(8080);