<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/3
 * Time: 下午2:38
 */

$pdo = new PDO("mysql:host=localhost;dbname=0811","root","");
$pdo->exec("set names utf8");

$result = $pdo->query("SELECT * FROM login");
$arr = $result->fetchAll(PDO::FETCH_ASSOC);

//print_r($arr);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dbList</title>
    <style>
        .text{
            position: absolute;
        }
    </style>
    <script type="text/javascript" src="../jquery-2.2.3.min.js"></script>
</head>
<body>
<table border="1">
    <th>id</th>
    <th>电话</th>
    <th>邮箱</th>
    <th>用户名</th>
    <th>密码</th>
    <?php
    for ($i = 0; $i < count($arr); $i++){
        echo "<tr>";
        foreach($arr[$i] as $item){
            echo "<td>";
            echo $item;
            echo "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
<script type="text/javascript">
    var _this = null;
    var inputText = null;
    $(document).on("dblclick","td",function () {
        $(".text").remove();
        inputText = $("<input class='text'>");
        inputText.css({
            width:$(this).innerWidth(),
            height:$(this).innerHeight(),
            left:$(this).offset().left,
            top:$(this).offset().top
        });
        $("table").append(inputText);
        inputText.val($(this).html());
        inputText.focus();
        var old = $(this).html();
        _this = $(this);
    });

    console.log($("table").has("input"));
    console.log(inputText);
    $(document).on("keydown",function (e) {
        if (inputText != null){
            var e = e || window.event;

            var typeArr = ["id","tel","email","name","password"];
            if (e.keyCode == 13){

                //url: update.php
                //method: post
                //参数: id(int),type(string),value(string)
                //返回值:{"err":0,"msg":"修改成功"}

                //找到当前点击的td的父级tr里的子级中第一个元素的内容(id中的内容)(避免删除后id变化)
                var trId = _this.parent().children().first().html();

                var inputVal = $(".text").val();
                var tdIndex = _this.index();
                $.post("update.php",{id:trId,type:typeArr[tdIndex],value:inputVal},function (data) {

                    var obj = JSON.parse(data);
                    if (obj.err == 0){
                        _this.html(inputVal);
                        alert(obj.msg);
                    }else {
                        alert(obj.msg);
                    }
                    $(".text").remove();
                });
            }
        }
    });
</script>

</body>
</html>
