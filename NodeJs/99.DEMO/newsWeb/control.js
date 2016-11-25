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

//连接数据库
var connect = mysql.createConnection({
    host:"localhost",
    user: "root",
    password: "",
    database: "0811"
});
connect.connect();

//设置模板引擎
app.set("view engine","ejs");
// 设置模板路径
app.set("views","./views");
app.use(express.static("static"));

//home
app.get("/",(req,res)=>{
	connect.query("SELECT * FROM news ORDER BY time LIMIT 5",(err,rows,field)=>{
		if(err){
			throw err;
		}
		res.render(path.join(__dirname,"views/home.ejs"),{
			news:rows
		});
	})
});

//detail
app.get("/detail/:id",(req,res)=>{
	connect.query(`SELECT * FROM news WHERE id = ${res.params.id}`,(err,rows,fiels)=>{
		if(err){
			throw err;
		}
		res.render(path.join(__dirname,"views/detail.ejs"),{
			new: row[0]
		})
	})
});

///upload
app.post("/upload",(req,res)=>{
	res.render(path.join(__dirname,"views/upload.ejs"),{
			
		})
})

app.listen(8888);