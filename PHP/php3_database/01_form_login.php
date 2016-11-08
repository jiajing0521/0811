<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/31
 * Time: 上午9:09
 */

header("Content-type:text/html;charset=utf-8");

//print_r($_POST);
@$type = $_POST["type"];
if(@$type = $_POST["type"]){
    switch ($type){
        case "登录":
            //1.取出本地保存的用户名密码获取文件内容
            @$content = file_get_contents("user.txt");
            if (!$content){
                die("输入错误");
            }else{
                //2.通过/n切割字符串,得到数组
                $arr = explode("\n",$content);
                //3.遍历数组,查看每一个是否有匹配的
                for ($i = 0; $i < count($arr); $i++){
                    //4.通过|切割字符串,得到数组$user[0]为用户名,$user[1]为密码
                    //username|password==>[username,password]
                    $user = explode("|",$arr[$i]);
                    //5.获取前端输入的用户名密码
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    //6.判断
                    if ($username == $user[0] && $password == $user[1]){
                        echo "登录成功";
                        break;
                    }
                }
                //如果for循环结束,说明登录失败
                if ($i == count($arr)){
                    echo "登录失败";
                }
            }
            break;
        case "注册":
            $file = fopen("user.txt","a");
            $username = $_POST["username"];
            $password = $_POST["password"];
            $text = file_get_contents("user.txt");
            $arr = explode("\n",$text);
            for ($i = 0; $i < count($arr); $i++){
                $user = explode("|",$arr[$i]);
                if ($username == $user[0]){
                    echo "用户名重复";
                    fclose($file);
                    break;
                }
            }
            //如果for循环结束,说明登录失败
            if ($i == count($arr)){
                //username|password
                //按照上面的格式写入文本
                fwrite($file,$username."|".$password."\n");
                fclose($file);
                echo "注册成功";
            }
            break;
        default:
            //后面的代码不再执行,程序直接终止die（）；
            die("输入错误");
            break;
    }
}else{
    die("请输入用户名密码");
}