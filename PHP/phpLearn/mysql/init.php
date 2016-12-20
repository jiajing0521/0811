<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/13
 * Time: 23:37
 */

$link = mysqli_connect('localhost', 'root', '123456', '0922_test') or die('数据库连接失败');
mysqli_select_db($link,'0922_test');
mysqli_query($link, 'set names utf8');

session_start();

define('BASE_URL', 'http://localhost/phpLearn/mysql/');

function checkLogin()
{
    if (empty($_SESSION['username']))
    {
        header('location:'.BASE_URL.'login.php');
    }
}

###视图加载:
function viewFunc($view, $data = array())
{
    extract($data);
    include "$view.php";
}