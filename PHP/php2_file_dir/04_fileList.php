
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文件列表</title>
    <style>
        th{
            font-size: 20px;
        }
    </style>
</head>
<body>
<?php
if (isset($_GET["path"])){
    $path = $_GET["path"];
}else{
    $path = ".";

}
?>
<table border="1" cellpadding="10">
    <th>文件名</th>
    <th>文件大小</th>
    <th>创建时间</th>
    <th>操作</th>
    <?php
    $files = scandir($path);
    for ($i = 0; $i < count($files); $i++){
        echo "<tr>";
        echo "<td>";
        $url = $path."/".$files[$i];
        if (is_dir($url)){
            echo "<a href='04_fileList.php?path={$url}'>$files[$i]</a>";
        }else{
            echo $files[$i];
        }
        echo "</td>";
        echo "<td>";
        //@为抑止符,阻止错误信息在前端显示出来
            $size = @filesize($files[$i]);
        //保留几位小数,第二参数保留的位数
            $size = number_format($size/1024,2);
            echo $size;
        echo "kb</td>";
        echo "<td>";
            date_default_timezone_set("PRC");
            $cTime = @filectime($files[$i]);
        //时间格式
            echo date("H:i:s",$cTime);
        echo "</td>";
        echo "<td>";
            echo "<a href='#'>删除</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>