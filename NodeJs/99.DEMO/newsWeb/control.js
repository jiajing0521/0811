/**
 * Created by dllo on 16/11/25.
 */
const express = require("express");
const ejs = require("ejs");
const mysql = require("mysql");
const fs = require("fs");
const path = require("path");
const formidable = require("formidable");

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
//解析post发送的body 的请求体的格式2的第三方模块
// parse application/json
// app.use(bodyParser.json());
//解析post发送的body 的请求体的格式1的第三方模块
// parse application/x-www-form-urlencoded
// app.use(bodyParser.urlencoded({ extended: false }));

//home
app.get("/",(req,res)=>{
	connect.query("SELECT * FROM news ORDER BY time DESC LIMIT 5",(err,rows,field)=>{
		if(err){
			throw err;
		}
		res.render(path.join(__dirname,"views/body_home.ejs"),{
			news:rows
		});
        // res.render(path.join(__dirname,"views/home.ejs"),{
         //    news:rows
        // });
	})
});

//detail
app.get("/detail/:id",(req,res)=>{
	connect.query("SELECT * FROM news WHERE id = "+req.params.id,(err,rows,field)=>{
		if(err){
			throw err;
		}
		res.render(path.join(__dirname,"views/detail.ejs"),{
			newList: rows[0]
		})
	})
});

///upload
app.get("/upload",(req,res)=>{
	res.render(path.join(__dirname,"views/upload.ejs"),{})
});

//update
app.post("/",(req,res)=>{
    //初始化
    var form = new formidable.IncomingForm();
    //解析表单内容
    form.parse(req,(err,field,files)=>{
        if (err){
            throw err;
        }
        console.log(field);
        console.log(files);
        //文件命名（时间戳+后缀名）
        var imgName = new Date().getTime()+path.extname(files["img"]["name"]);
        // fs.rename(files["img"]["path"],`static/${imgName}`,(err)=>{
        //     if (err){
        //         throw err;
        //     }
        //     res.send("上传成功")
        // });
        // res.writeHead(200, {'content-type': 'text/plain'});
        // res.write('received upload:\n\n');
        // res.end(util.inspect({fields: fields, files: files}));
    })
    console.log(req.body);
    // res.json(req.body);
    // connect.query("SELECT * FROM news ORDER BY time DESC LIMIT 5",(err,rows,field)=>{
    //     if(err){
    //         throw err;
    //     }
    //     // res.render(path.join(__dirname,"views/body_home.ejs"),{
    //     // 	news:rows
    //     // });
    //     res.render(path.join(__dirname,"views/home.ejs"),{
    //         news:rows
    //     });
    // })
});

app.listen(8888);