/**
 * Created by dllo on 16/11/25.
 */
const express = require("express");

//初始化express应用
const app = express();

// send包括了write和end
app.get("/",(req,res)=>{
    res.send("这是app.get请求的结果");
});
app.post("/",(req,res)=>{
    res.send("这是app.post请求的结果")
});

app.all("/all",(req,res)=>{
    res.send("这是app.all请求得结果")
});




app.listen(8080);