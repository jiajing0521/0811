<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/16
 * Time: 上午10:17
 */

//程序的入口 -> 唯一入口 -> 单入口

//controller 的路径:
define('CONTROLLER_PATH','protected/controller/');
//lib 的路径:
define('MODEL_PATH', 'protected/lib/');
//templates 的路径:
define('VIEW_PATH', 'protected/templates/');

include (MODEL_PATH.'init.php');

// $c : 表示想访问的controller子文件夹
$c = !empty($_GET['c']) ? $_GET['c'] : 'admin';
// $a : 表示去到子文件夹想操作的位置:
$a = !empty($_GET['a']) ? $_GET['a'] : 'index';
// $admin : 是否是管理员
$admin = !empty($_GET['admin']) ? $_GET['admin'] : 0;

if ($admin) {
    // 是管理员身份
    include(CONTROLLER_PATH.'admin/'.$c.'/'.$a.'.php');
} else {
    // 不是管理员身份
    include(CONTROLLER_PATH.'user/'.$c.'/'.$a.'.php');
}


//http://localhost/php/php08/index.php?c=admin $ a = add, admin=1