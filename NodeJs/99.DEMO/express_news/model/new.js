/**
 * Created by dllo on 16/11/28.
 */
const mysql = require("mysql");

var connect = mysql.createConnection({
    host:"localhost",
    port: 3306,
    user: "root",
    password: "",
    database: "0811"
});
connect.connect();

//在模块内部，可以省略module关键字

//从数据库中查找所有数据，给主页显示
exports.selectAllNews = (callback) =>{
    connect.query("SELECT * FROM express_news ORDER BY time DESC",(err,rows,field)=>{
        callback(err,rows);
    })
};

//根据id查找具体某一条数据，pv加1
exports.updatePvById = (id,callback) => {
    connect.query(`UPDATE express_news SET pv=pv+1 WHERE id = ${id}`,(err,field)=>{
        callback(err,field.affectedRows)
    });
};
//根据id查找具体某一条数据，给detail页显示
exports.selectNewById = (id,callback) =>{
    connect.query(`SELECT * FROM express_news WHERE id = ${id}`,(err,rows,field)=>{
            callback(err,rows[0]);
    })
};

//上传一条新闻
exports.uploadNew = (newObj,callback) =>{
    connect.query(`INSERT INTO express_news (title,content,imgpath) VALUE ('${newObj.title}','${newObj.content}','${newObj.imgpath}')`,(err,field)=>{
        callback(err,field.affectedRows);
    })
};


