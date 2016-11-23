/**
 * Created by dllo on 16/11/22.
 */
process.stdout.write("hello\n");
process.stdout.write("嘉静");

// process.stdin.setEncoding('utf8');
//模拟用户登录
var users={
    "jk":"money",
    "admin":"123456"
};
//保存输入的用户名
var username = '';
var errIndex = 3;
process.stdout.write("请输入您的用户名：");
//对象key的数组
// console.log(Object.keys(users));
//监听用户输入事件
process.stdin.on("data",function (input) {
    // console.log(`##${input.toString()}##`)
    //回车也算输入的一个内容，所以用trim函数把\n去掉
    input = input.toString().trim();
    //判断用户名匹配与否
    if (username.length > 0){
        //用户名输入正确，接下来输入密码
        var password = users[username];
        if (input === password){
            process.stdout.write("登录成功");
            process.exit();
        }else{
            errIndex--;
            if (errIndex > 0){
                process.stdout.write(`密码错误，请重新输入(还可以输入${errIndex}次)：`);
            }else{
                process.stdout.write("密码错误，次数已用完，登录失败");
                process.exit();
            }
        }
    }else{
        //输入的用户名不存在或第一次没有用户名，需要输入用户名
        if (Object.keys(users).indexOf(input)==-1){
            process.stdout.write("该用户名不存在,请输入正确的用户名:");
            username = '';
        }else{
            username = input;

            process.stdout.write("请输入您的密码：");
        }
    }

});