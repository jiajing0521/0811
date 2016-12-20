<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/9
 * Time: 10:06
 */
//http://localhost/phpLearn/php03Mysql/index.php?name=Green&age=34&gender=F&birthday=1988-04-27

//接收浏览器传过来的值: GET 或  POST

$name = $_GET['name'];
$age = $_GET['age'];
$gender = $_GET['gender'];
$birthday = $_GET['birthday'];

//echo $name.$age.$gender.$birthday;exit();

$link = mysqli_connect('localhost', 'root', '123456', 'blue') or die();
$sql = "insert into person(name, age, gender, birthday) VALUES ('$name', $age, '$gender', '$birthday')";
//echo $sql;exit();

$result = mysqli_query($link, $sql);



//mysqli_fetch_row()是去结果集取出一行信息,作为索引数组返回
//while ($row = mysqli_fetch_row($result))
//{
//    echo '<br>';
//    print_r($row);
//}

//while ($row = mysqli_fetch_assoc($result))
//{
//    echo '<br>';
//    print_r($row);
//}


//释放资源:
mysqli_free_result($result);

//关闭数据库连接:
mysqli_close($link);
















