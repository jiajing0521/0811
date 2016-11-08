<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/4
 * Time: 下午4:21
 */

$cb = $_GET["cb"];
$data = '{"name":"李威","length":"0.2","IQ":"0.5"}';

//调用
echo "{$cb}({$data})";

