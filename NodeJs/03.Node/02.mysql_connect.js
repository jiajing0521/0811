/**
 * Created by dllo on 16/11/24.
 */

const mysql      = require('mysql');
var connection = mysql.createConnection({
    host     : "localhost",
    port     : 3306,
    user     : "root",
    password : "",
    database : "0811"
});
//执行连接数据库
connection.connect();
// sql语句
// connection.query("SELECT * FROM user", (err, rows, fields) => {
//     if (err) {
//         throw err;
//     }
//     console.log(typeof rows);//object
//     console.log(rows);
//     console.log(rows[0]);
//     console.log(rows[0]["tel"]);
//     // console.log(fields);
// });

connection.query("INSERT INTO user (id,username,password,tel) VALUE (NULL,'JK','888','13888888888')",(err,fields)=>{
    if (err){
        throw err;
    }
    console.log(fields);
    // 以下是返回值
    // OkPacket {
    // fieldCount: 0,
    //     affectedRows: 1,
    //     insertId: 30,
    //     serverStatus: 2,
    //     warningCount: 0,
    //     message: '',
    //     protocol41: true,
    //     changedRows: 0 }
});
//断开连接
connection.end();