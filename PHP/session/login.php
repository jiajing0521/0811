
<?php
//使用session必须要在开头start
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
if (isset($_SESSION['username'])&&isset($_SESSION['password'])){ ?>

    <h2><?php echo $_SESSION["username"]?></h2>
    <a href="login_api.php?type=cancle">注销</a>
    
<?php
} else{
?>

<form action="login_api.php" method="post">
    用户名:<input type="text" name="username">
    密  码:<input type="text" name="password">
    <input type="submit" value="登录">
</form>
    
<?php
}
?>

</body>
</html>