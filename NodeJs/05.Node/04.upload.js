/**
 * Created by dllo on 16/11/25.
 */
const express = require("express");
const formidable = require("formidable");
const fs = require("fs");
const path = require("path");

var app = express();

app.use(express.static("static"));

app.post("/up",(req,res)=>{
    //初始化
    var form = new formidable.IncomingForm();
    //设置上传文件的临时存放目录
    form.uploadDir = "upload_temp";

    //解析表单内容
    form.parse(req,(err,field,files)=>{
        if (err){
            throw err;
        }
        console.log(field);
        console.log(files);
        //文件命名（时间戳+后缀名）
        var imgName = new Date().getTime()+path.extname(files["img"]["name"]);
        fs.rename(files["img"]["path"],`static/${imgName}`,(err)=>{
            if (err){
                throw err;
            }
            res.send("上传成功")
        });
        // res.writeHead(200, {'content-type': 'text/plain'});
        // res.write('received upload:\n\n');
        // res.end(util.inspect({fields: fields, files: files}));
    })
});

app.listen(9999);