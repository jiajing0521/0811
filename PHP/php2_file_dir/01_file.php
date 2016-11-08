<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/28
 * Time: 上午9:04
 */

header("Content-type:text/html;charset=utf-8");

//第二个参数是文件的打开模式
//r只读,
//w写入并且覆盖,
//a在文件末尾追加写入
$file = fopen("1.txt","r");

/**r 	只读。在文件的开头开始。
r+ 	读/写。在文件的开头开始。
w 	只写。打开并清空文件的内容；如果文件不存在，则创建新文件。
w+ 	读/写。打开并清空文件的内容；如果文件不存在，则创建新文件。
a 	追加。打开并向文件末尾进行写操作，如果文件不存在，则创建新文件。
a+ 	读/追加。通过向文件末尾写内容，来保持文件内容。
x 	只写。创建新文件。如果文件已存在，则返回 FALSE 和一个错误。
x+ 	读/写。创建新文件。如果文件已存在，则返回 FALSE 和一个错误。
 */

//根据长度读取文件内容,一个汉字3个字节,数字字母符号一个字节,继续上一个fread的位置接着读
//echo fread($file,6);
//echo "<br>";
//filesize()获取文件的大小
//echo fread($file,filesize("1.txt"))

//按行读取
//echo fgets($file);
//echo fgets($file);

while($row = fgets($file)){
    echo $row;
    echo "<br>";
}

//关闭文件,操作完成记得关闭,避免对下一次读入造成影响
fclose($file);

echo file_get_contents("1.txt");
//可以获取远程服务器上的内容
echo file_get_contents("http://www.baidu.com");

//已写入的模式打开
$newFile = fopen("1.txt","w");
//直接覆盖写入,返回值是写入文本的长度
echo fwrite($newFile,"于嘉晨包子买了吗");

fclose($newFile);
//直接根据文件路径覆盖写入,不需要打开
file_put_contents("1.txt","于嘉晨说不买包子了");

//以追加模式打开,不会覆盖原文件内容

$addFile = fopen("1.txt","a");
echo fwrite($addFile,"我说帮我买一个包子呗");
fclose($addFile);

//重命名
rename("1.txt","2.txt");
//复制文件,要复制的文件,复制之后的新文件名
copy("2.txt","1.txt");
//删除文件
unlink("2.txt");


