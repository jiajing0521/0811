/**
 * Created by dllo on 16/11/24.
 */
const http = require("http");
const mysql = require("mysql");
const ejs = require("ejs");
const path = require("path");

var connect = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "0811"
});
connect.connect();

var server = http.createServer((req,res)=>{
    connect.query("SELECT * FROM user ",(err,rows,fields)=>{
        if (err){
            throw err;
        }
        // res.writeHead(200,{
        //     "Content-type":"text/html;charset=utf-8"
        // });
        // rows.forEach((item)=>{
        //     res.write("<li style='list-style: none'>"+item.username+"</li>");
        // });
        ejs.renderFile(path.join(__dirname,"./04.index.ejs"),{
            title: "数据库user用户名",
            users: rows
        },(err,data)=>{
           if (err){
               throw err;
           }
           res.write(data);
           res.end();
        });
    })
});
server.listen(8888);