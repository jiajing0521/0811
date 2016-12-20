<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/16
 * Time: 下午5:05
 */

unset($_SESSION['username']);
header('location:'.BASE_URL.'index.php?c=admin&a=login&admin=1');