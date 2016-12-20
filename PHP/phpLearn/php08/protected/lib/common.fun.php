<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/16
 * Time: 上午10:06
 */

session_start();
/*
 * 检测用户是否登录
 * */
function checkFunc() {
    if (empty($_SESSION['username'])) {
        // 跳转到登录界面:
        //header();
    }
}

/*
 * 加载视图文件方法:
 * */

function viewFunc($viewURL, $data = array()) {
    // 引入视图代码
    extract($data);

    //引入头部文件:
    include(VIEW_PATH.'admin/header.php');
    //引入对应视图文件:
    include($viewURL.'.php');
    //引入尾部文件:
    include(VIEW_PATH.'admin/footer.php');

}