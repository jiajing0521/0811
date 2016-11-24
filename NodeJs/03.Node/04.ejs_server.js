/**
 * Created by dllo on 16/11/24.
 */

const http = require("http");
const ejs = require("ejs");
const path = require("path");


http.createServer((req,res)=>{
    // var html = ejs.render("JK love <%= who %>",{
    //     who: "JJ"
    // });

    ejs.renderFile(path.join(__dirname,"./04.index.ejs"),{
        title: "NEWS",
        hello: "JK love JJ"
    },(err,data)=>{
        if (err){
            throw err;
        }
        res.write(data);
    });
    res.end();
}).listen(8889);
