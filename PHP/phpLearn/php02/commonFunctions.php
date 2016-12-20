<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/8
 * Time: 14:42
 */

####
#打印函数:
####
function sayHello()
{
    echo '我的第一个php函数!';
}

####
#数组求和函数
####

function sumArrayNumbers($arr)
{
    $sum = 0;
    foreach ($arr as $num)
    {
        $sum += $num;
    }
    return $sum;
}

####
#冒泡排序函数:
####
function bubbleSort($arr, $order = true)
{
    $flag = 0;
    $temp = 0;
    for ($i = 0; $i < count($arr) - 1; $i++)
    {
        $flag = 0;
        for ($j = 0; $j < count($arr) - 1 - $i; $j++)
        {
           if ($order)
           {
               if ($arr[$j] > $arr[$j + 1])
               {
                   $temp = $arr[$j];
                   $arr[$j] = $arr[$j + 1];
                   $arr[$j + 1] = $temp;
                   $flag = 1;
               }
           }
           else
           {
               if ($arr[$j] < $arr[$j + 1])
               {
                   $temp = $arr[$j];
                   $arr[$j] = $arr[$j + 1];
                   $arr[$j + 1] = $temp;
                   $flag = 1;
               }
           }
        }
        if ($flag == 0) {
            break;
        }
    }
    return $arr;
}








