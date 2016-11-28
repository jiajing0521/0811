/**
 * Created by dllo on 16/11/28.
 */
const express = require("express");

const app = express();

//get 必须严格匹配/image,后面再拼接/xx路径都不会处理
app.get("/image",(req,res)=>{
    res.send("微微一笑很倾城");
});

app.use(express.static("public"));
//  /xx后面可以继续拼接/xx
app.use("/xx",(req,res)=>{
   res.send("jk哈哈哈，88888888")
});

app.get("/name/:name",(req,res,next)=>{
    // 两个get的话，如果没有if判断，则输出下面这个第一个get，不走第二get
    // res.send(req.params.id);
    //用if进行判断，如果是字母的话，if，如果不是字母的话，else的next，就走到了下一个get学号
    if (!/\d+/.test(req.params.name)){
        res.send("我知道了，你的名字是"+req.params.name);
        //本次条件不符合，找下一个路由
    }else {
        next();
    }
});
app.get("/name/:id",(req,res,next)=>{
    if (err){
        next();
    }
    res.send("你的学号是"+req.params.id);
});

//通过use函数，不传入路径参数，可以设置404页，即以上所有路由规则都不匹配
app.use((req,res)=>{
    res.send("404");
});

app.listen(9999);