/**
 * Created by dllo on 16/11/22.
 */
// COMMONJS
//     引入系统的模块
var fs = require("fs");
var http = require("http");
//     引入自己写的模块
//Node中引入模块有3种方式
// 1.通过路径直接引入
var per = require("./bao/test");
var _1 = require("./bao/test1");
// 2.把模块放在node_modules目录下，通过文件夹的名字引入
// 在模块文件夹下的package.json中设置main属性来指定模块中的入口文件
var mokuai = require("mokuai")
// 3.把模块放在node_modules目录下，通过文件夹的名字引入
// 在模块文件夹下，入口文件，命名为index.js，不需要package.json
var mokuai2 = require("mokuai2");

var result = fs.readFileSync("01.hello.js","utf8");
console.log(result);
http.createServer(function (request,response) {
    response.end("你好");
}).listen(8080);

per.kiss();
console.log(per.name);
var result = _1(8);
console.log(result);
console.log(mokuai.name);
console.log(mokuai2.name);
console.log(module.paths);