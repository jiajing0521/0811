/**
 * Created by dllo on 16/11/23.
 */
const path = require("path");

console.log(__dirname);
console.log(__filename);

//获取一个完整路径中的文件名，第二个参数可以去后缀
console.log(path.basename(__filename));
console.log(path.basename(__filename,".js"));

console.log(path.dirname(__filename));

//获取后缀名
console.log(path.extname(__filename));

console.log(path.join(__dirname,"../01.Node_stdin_out_require_process_package","/bao","/test1.js"));

//判断是不是绝对路径
console.log(path.isAbsolute("../node1"));//false
console.log(path.isAbsolute(__filename));//true

//把路径字符串转成一个对象
console.log(path.parse(__filename));

//把一个parse路径对象转成字符串
var pathObj = path.parse(__filename);
console.log(path.format(pathObj));

//从参数一的路径到参数二的路径的相对路径
console.log(path.relative("../01.Node_stdin_out_require_process_package/bao/test.js","../01.Node_stdin_out_require_process_package/"));

//判断操作系统，posix 是Unix, win32是windows
console.log(path == path.win32);//false
console.log(path == path.posix);//true