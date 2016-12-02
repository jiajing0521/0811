/**
 * Created by dllo on 16/12/2.
 */
const express = require("express");
var app = express();

app.get("/jsonp",(req,res)=>{
    // req.query是通过get来的对象
    console.log(req.query);
    //约定对象的属性名是callback实际是前端传来一个函数(http://jhfdjhfjd?callback=abc)
    var cb = req.query.callback;

    var dataStr = JSON.stringify({name:"JK",age:30});

    res.send(`${cb}(${dataStr})`);
});

app.listen(9999);