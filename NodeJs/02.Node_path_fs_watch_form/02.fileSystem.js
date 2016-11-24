/**
 *
 * Created by dllo on 16/11/23.
 */

const fs = require("fs");
const path = require("path");
//同步读取文件,参数一：路径，参数二：编码方式（一般是utf8）
var result = fs.readFileSync(path.join(__dirname,"../01.Node_stdin_out_require_process_package/01.hello.js"),"utf8");
console.log(result);

var err = new Error("这是一个错误");
// console.log(error);
//抛异常，程序不允许继续进行
// throw err;

console.log("开始读取");
// 异步读取文件,参数一：路径，参数二：编码方式（一般是utf8）,参数三：回调函数(错误优先)
fs.readFile(path.join(__dirname,"../01.Node_stdin_out_require_process_package/01.hello.js"),"utf8",(err,data)=>{
    if (err){
        throw err;
    }else{
        console.log(data);
    }
    console.log("我觉得在这才读取结束了！！");
});
console.log("读取结束了吗？");

// 异步获取stat对象
fs.stat(path.join(__dirname,"../01.Node_stdin_out_require_process_package/01.hello.js"),(err,stat)=>{
    if (err){
        throw err;
    }
    console.log(stat);
    // stat对象，可以判断当前的文件是不是file，dir
    console.log(stat.isFile());
    console.log(stat.isDirectory());
});
//同步获取stat对象
// fs.statSync();

// 写入文件,覆盖式的写入，文件没有的话会创建
// 异步写入
fs.writeFile(path.join(__dirname,"./write.txt"),"这是异步写入的","utf8",(err,data)=>{
    if (err){
        throw err;
    }
});
// 同步写入
fs.writeFileSync(path.join(__dirname,"./write.txt"),"这是同步写入的","utf8");