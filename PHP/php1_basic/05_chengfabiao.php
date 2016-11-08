<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>九九乘法表</title>
    <style>
        td,tr{
            border: 1px solid black;
        }
    </style>
</head>
<body>

<table>
<?php

//自己版
//for ($i = 1; $i < 10; $i++){
//    echo "<tr>";
//    for ($j = 1; $j <= $i; $j++){
//        echo "<td>". "$j*$i = ". $i*$j. "</td>";
//    }
//    echo "</tr>";
//}
//老师版
for ($i = 1; $i < 10; $i++){
    echo "<tr>";
    for ($j=1;$j<=$i;$j++){
        echo "<td>";
        $result = $i*$j;
        echo "{$j}*{$i}={$result}";
        echo "</td>";
    }
    echo "</tr>";
}

?>
</table>
</body>
</html>