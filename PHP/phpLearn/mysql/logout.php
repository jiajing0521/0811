<?php

session_start();

unset($_SESSION['username']);

//毁灭所有session
//session_destroy();

header('location:http://localhost/phpLearn/mysql/login.php');