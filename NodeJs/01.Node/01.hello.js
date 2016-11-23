/**
 * Created by dllo on 16/11/22.
 */
console.log("你好，NODEJS");
var a = 20;
console.log(a);
//console.log 与原生js里的console.log不同，是nodejs中自己定义的函数，如下：
// 标准输出
// process.stdout
// console.log = (msg) => {
//     process.stdout.write(`${msg}\n`);
// };
//ctrl+shift+r 运行
//ES6新语法=>匿名函数
var b = function (index) {
    index++;
    //返回值
    return index;
    console.log(index);
};
var c = (index) => {
    index++;
    //返回值，可以不写return
    index;
    console.log(index);
};
b(10);
c(90);
//解析变量
var x = 20;
console.log(`哈哈哈${x}`);

