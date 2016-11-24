/**
 * Created by dllo on 16/11/23.
 */

const fs = require("fs");
const path = require("path");
//文件监听
// 参数一：路径
// 参数二：对象，用来设置监听的时间间隔
// 参数三：回调函数，两个参数，参数一：变化后的stat对象，参数二：变化前的stat对象
fs.watchFile(path.join(__dirname, "./write.txt"), {interval: 100}, function (curr,prev) {
    console.log(curr);
    console.log(prev);
});