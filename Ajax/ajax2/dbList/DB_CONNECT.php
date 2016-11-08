<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/3
 * Time: 下午4:01
 */

//require_once "DB_CONNECT.php";

$pdo = new PDO("mysql:host=localhost;dbname=0811","root","");
$pdo->exec("set names utf8");

date_default_timezone_set("PRC");