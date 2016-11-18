<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/14
 * Time: 上午9:35
 */
header("Content-type:text/html;charset=utf-8");

//print_r($_SERVER);
//print_r(pathinfo($_SERVER["REQUEST_URI"]));
//获取从前端上传的文件
print_r($_FILES);

//上传一个文件
if (isset($_FILES["file"])){

    $pdo = new PDO("mysql:host=localhost;dbname=0811","root","");


    $file = $_FILES["file"];
    //允许上传的文件格式
    $types = ["image/png","image/jpeg","image/jpg","image/gif"];

    //判断上传的文件格式是否在数组里，即文件是不是图片
    if (in_array($file["type"], $types)){
        //判断文件是不是刚才上传得到的
        if (is_uploaded_file($file["tmp_name"])){
            $path = "img/".time().".".substr($file["type"],6);

            echo $path;
            //从临时路径移动到img目录
            if (move_uploaded_file($file["tmp_name"],$path)){
                echo "上传成功";
                //处理图片url
                $url = "http://localhost".pathinfo($_SERVER["REQUEST_URI"])["dirname"]."/".$path;
                $pdo->exec("INSERT INTO imgupload (id,path) VALUE (NULL,'{$url}')");
            }else{
                echo "上传失败";
            };
        }
    }else{
        echo "上传的格式不对";
    }

}


