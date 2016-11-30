<?php

session_start();
$_SESSION['username']='lee';
$_SESSION['password'] = 4343543;

//删除
unset($_SESSION['password']);

//10000为时间戳,在这个时间过期,'/'应用到所有
setcookie(session_name(),session_id(),10000,'/');
echo $_SESSION['username'];
