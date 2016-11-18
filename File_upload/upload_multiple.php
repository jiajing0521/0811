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

if (isset($_FILES["file"])){

    $pdo = new PDO("mysql:host=localhost;dbname=0811","root","");

    $file = $_FILES["file"];
    $types = ["image/png","image/jpeg","image/jpg","image/gif"];

    for ($i = 0;$i < count($file["type"]);$i++){
        $typeArr = $file["type"];
        $tmpArr = $file["tmp_name"];
        $nameArr = $file["name"];
        if (in_array($typeArr[$i],$types)){
            if (is_uploaded_file($tmpArr[$i])){
                $name = time().$nameArr[$i];
                //md5() 函数计算字符串的 MD5 散列。
                //md5() 函数使用 RSA 数据安全，包括 MD5 报文摘要算法。
                //来自 RFC 1321 的解释 - MD5 报文摘要算法：
                //MD5 报文摘要算法将任意长度的信息作为输入值，
                //并将其换算成一个 128 位长度的"指纹信息"或"报文摘要"值来代表这个输入值，
                //并以换算后的值作为结果。MD5 算法主要是为数字签名应用程序而设计的；
                //在这个数字签名应用程序中，较大的文件将在加密
                //（这里的加密过程是通过在一个密码系统下[如：RSA]的公开密钥下设置私有密钥而完成的）之前以一种安全的方式进行压缩。
                $path = "img1/".md5($name).".".substr($typeArr[$i],6);
                if (move_uploaded_file($tmpArr[$i],$path)){
                    echo "上传成功";
                    $url = "http://localhost".pathinfo($_SERVER["REQUEST_URI"])["dirname"]."/".$path;
                    $pdo->exec("INSERT INTO imgupload (id,path) VALUE (NULL,'{$url}')");
                }else{
                    echo "上传失败";
                };
            }
        }
    }

}else{
    echo "上传的格式不对";
}