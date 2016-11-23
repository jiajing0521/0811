/**
 *
 * Created by dllo on 16/11/22.
 */
console.log("开始执行");
console.time("a");
var x = 1;
x++;
console.log(x);
setInterval(function () {
    console.log("JK,good luck to you !");
},1000);
setTimeout(function () {
    for (var i = 0; i < 10000000000; i++){

    }
},0);

console.log(x);
console.log("执行结束");
console.timeEnd("a");