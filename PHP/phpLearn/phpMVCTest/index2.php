<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/15
 * Time: 21:26
 */


define('CONTROLLER_PATH', 'protected/controller');
define('VIEW_PATH', 'protected/templates');
define('MODEL_PATH', 'protected/lib');

$c = !empty($_GET['c']) ? $_GET['c'] : 'admin';
$a = !empty($_GET['a']) ? $_GET['a'] : 'index';
$admin = !empty($_GET['admin']) ? $_GET['admin'] : 0;

include(MODEL_PATH.'init.php');

if ($admin)
{
    include(CONTROLLER_PATH.'admin/'.$c.'/'.$a.'.php');
}
else
{
    include(CONTROLLER_PATH.$c.'/'.$a.'.php');
}