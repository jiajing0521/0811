<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/15
 * Time: 09:40
 */
include "init.php";

unset($_SESSION['username']);

header('location:'.BASE_URL.'login.php');