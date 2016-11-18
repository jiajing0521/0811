<?php
/**
 * Created by PhpStorm.
 * User: dingjz
 * Date: 16/8/23
 * Time: 下午2:40
 */

$files = scandir("img");
$types = ["jpg", "png", "gif", "jpeg"];
//print_r($files);
$arr = array();
foreach ($files as $file) {
    if (is_file("img/".$file)){

        $name = explode(".", $file);
        if (in_array($name[1], $types)){

            $arr["{$name[0]}"] = "img/".$file;
        }


    }
}
echo json_encode($arr);