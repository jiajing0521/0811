<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/21
 * Time: 15:27
 */
include "database.php";
require_once('class.phpmailer.php');
require_once("class.smtp.php");

if (!empty($_POST))
{
//    print_r($_POST);exit();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $hobby = $_POST['hobby'];//数组
    $city = $_POST['city'];
    $hobbyString = '';
    foreach ($hobby as $value)
    {
        $hobbyString .= $value.' ';
    }
    $link = mysqli_connect($hostAddress, $dbUser, $dbPassword, $dbName) or die('数据库连接失败');
    $sql = "INSERT INTO user (username, password, email, phone, gender, hobby, city) VALUES ('$username', '".md5($password)."', '$email', '$phone', 'F', '$hobbyString', '$city');";
    $query = mysqli_query($link, $sql);
    if ($query)
    {
//        //成功发送验证邮箱链接:
//        $mail = new PHPMailer();
//        $mail->IsSMTP();//设置使用smtp发送
//        $mail->SMTPAuth = true;//开始smtp认证
//        $mail->Host = 'smtp.qq.com';
//        $mail->Username = '3147671737';
//        $mail->Password = '84261530a++';
//        //内容信息:
//        $mail->IsHTML(true);
//        $mail->CharSet = "UTF-8";
//        $mail->From = "3147671737@qq.com";
//        $mail->FromName = "lee";
//        $mail->Subject = "PHP邮件测试";
//        $mail->MsgHTML('<h1>哈哈</h1>');

//        mb_send_mail($email,'激活账号', "点击链接激活账号<a href='http://localhost/phpLearn/php10/test.php'>点击</a>");
//        echo '<script>alert("注册成功")</script>';
//        try{
//            $mail = new PHPMailer(true);
//            $mail->IsSMTP();
//            $mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
//            $mail->SMTPAuth   = true;                  //开启认证
//            $mail->Port       = 25;
//            $mail->Host       = "smtp.qq.com";
//            $mail->Username   = "3147671737@qq.com";
//            $mail->Password   = "84261530a++";
//            //$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
//            $mail->AddReplyTo("3147671737@qq.com","mckee");//回复地址
//            $mail->From       = "3147671737@qq.com";
//            $mail->FromName   = "lee";
//            $to = "496347267@qq.com";
//            $mail->AddAddress($to);
//            $mail->Subject  = "测试标题";
//            $mail->Body = "点击链接激活账号<a href='http://localhost/phpLearn/php10/test.php'>点击</a>";
//            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
//            $mail->WordWrap   = 80; // 设置每行字符串的长度
//            //$mail->AddAttachment("f:/test.png");  //可以添加附件
//            $mail->IsHTML(true);
//            $mail->Send();
//        }
//        catch (phpmailerException $e)
//        {
//            echo "邮件发送失败：".$e->errorMessage();
//        }







    }
    else
    {
        echo '<script>alert("注册失败")</script>';
    }
}



$result = array();
if (!empty($_GET))
{
    $username = $_GET['username'];
    //验证用户名是否已存在:
    $link = mysqli_connect($hostAddress, $dbUser, $dbPassword, $dbName) or die('数据库连接失败');
    $sql = "select * from user WHERE username = '$username'";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_row($query);
    if ($row[0])
    {
        //存在
        $result = array(
            'flag' => 1
        );
    }
    else
    {
        //不存在
        $result = array(
            'flag' => 0
        );
    }
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']))
{
    echo json_encode($result);
}
else
{
    include "checkNameTemplate.php";
}




















