<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/27
 * Time: 下午3:50
 */

//100元。每天花一半，几天能花完（1元以下结束）,分别用for，while实现


function day($j){
    $day=0;
    for ($i = 1; $i < $j; $i *= 2){
        $day++;
    }
    return $day;
}

echo day(100);
echo "<br>";

function fn($j){
    $i = 1;
    $day = 0;
    while($i < $j){
        $i*=2;
        $day++;
    }
    return $day;
}
echo fn(100);
echo "<br>";

function fn1($j){
    static $day = 0;
    if ($j<1){
        return $day;
    }else{
        $day++;
        return fn1($j/2);
    }
}
echo fn1(100);