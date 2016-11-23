/**
 * Created by dllo on 16/11/23.
 */

const fs = require("fs");
const path = require("path");
//创建文件夹
// fs.mkdir(path.join(__dirname,"../01.Node_stdin_out_require_process_package/b"),function (err) {
//     if (err){
//         throw err;
//     }
// });
//只能删空文件夹
// fs.rmdir(path.join(__dirname,"../01.Node_stdin_out_require_process_package/b"),function (err) {
//     if (err){
//         throw err;
//     }
// });

fs.unlink(path.join(__dirname,"1.txt"),(err)=>{
    if (err){
        throw err;
    }
});