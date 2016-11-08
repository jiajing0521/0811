<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/28
 * Time: 上午10:41
 */

header("Content-type:text/html;charset=utf-8");
//显示隐藏文件
//defaults write com.apple.finder AppleShowAllFiles -boolean false; killall Finder

//打开目录
$dir = opendir(".");
//依次读取目录下的内容
echo readdir($dir);
echo "<br>";

echo readdir($dir);//.当前目录
echo readdir($dir);//..上层目录
echo readdir($dir);//当前目录文件1,按ascII码排序显示
echo readdir($dir);//当前目录文件2,按ascII码排序显示

while ($file = readdir($dir)){
    echo $file;
    echo "<br>";
}
//关闭目录
closedir($dir);

//以数组的形式返回目录下的文件
print_r(scandir("."));
echo "<br>";

print_r(scandir(".."));
//创建文件夹
mkdir("ascfd");
//删除文件夹,如果文件夹不为空,删除不了
rmdir("a");
//输入的路径是否是文件夹
is_dir("a");


function removeDir($path){
    //1.判断路径是文件还是文件夹
    //1.1如果是文件夹,需要处理文件夹内的内容
    if (is_dir($path)){
        //2.判断文件夹下是否有内容,如果有继续处理
        $arr = scandir($path);
        if (count($arr) > 2){
            //遍历文件夹下的所有内容,每一个文件都要进行当前相同的操作,调用递归函数
            for ($i = 2; $i < count($arr); $i++){
                //每一次遍历得到的是文件名,需要拼接路径
                $url = $path."/".$arr[$i];
                removeDir($url);
            }
            rmdir($path);
            //2.1如果没有直接删除文件夹
        }else{
            rmdir($path);
        }
    //1.2如果是文件,直接删除
    }else{
        unlink($path);
    }
}

//removeDir("a");

//设置时区
date_default_timezone_set("PRC");

//获取文件创建的时间,返回值是距1970/1/1的秒数
$cTime = filectime("1.txt");
//时间格式
echo date("Y年-m-d 时间H:i:s",$cTime);
//当前的时间戳
$current = time();
echo date("H:i",$current);

