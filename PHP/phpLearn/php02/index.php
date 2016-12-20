<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/8
 * Time: 09:42
 */

//宏定义:
define(name, 'tom');


    /*
     * 一.数组:
     * */
    //(1)索引数组:
//    $ages = array(1, 2, 3, 4, 5);
//    print_r($ages);
    //(2)关联数组:
//    $arr = array('name' => 'jack', 'age' => 15, 'weight' => 47.34);
//    $arr2 = array('1' => 12, '2' => 23);
////    print_r($arr2);
//    echo $arr['name'];

    //(3)在数组中存储元素:
//    $stuArr[0] = 'curry';
//    print_r($stuArr);//对为定义过的数组直接赋值,系统会默认创建该数组

//    echo $teacher[1];//直接访问未初始化的数组,系统不会创建.

//    $car = ['color' => 'white', 'price' => 12.5, 'madein' => 'japan'];
//    print_r($car);

//    $days = array(1 => 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
//    print_r($days);

//    $numbers = range(10, 35);
//    $numbers2 = range(100, 50);
//    print_r($numbers2);

//    $letters = range('A', 'z');
//    $letters2 = range('z', 'a');
//    $letters3 = range('abc', 'zyx');//当range里面是两个字符串作为参数时,只取首字母作为范围
//    print_r($letters);

    //获取数组元素个数:
//    $numbers = range(23, 71);
//    echo count($numbers).'<br>'.sizeof($numbers);

    //获取所有的key,形成新数组:
//    $weekdays = array('monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5);
//    $keys = array_keys($weekdays);
////    print_r($keys);
//    //获取所有的value形成新数组:
//    $values = array_values($weekdays);
//    print_r($values);

//    $message = array('title' => 'report', 'from' => 'tim', 'to' => 'john', 'content' => 'where r u', 'received' => false);
//    if ($message['received'])
//    {
//        echo '存在这样的key';
//    }
//    else
//    {
//        echo '不存在这样的key';
//    }

    //解决以上问题:
//    if (array_key_exists('received', $message))
//    {
//        echo '存在';
//    }
//    else
//    {
//        echo '不存在';
//    }

    //数组遍历:
//    $words = array('ssd', 'pen', 'apple', 'computer');
//    for ($i = 0; $i < count($words); $i++)
//    {
//        echo $words[$i].'<br>';
//    }

//    foreach ($words as $a)
//    {
//        echo $a.'<br>';
//    }

//    $cities = array('Heilongjiang' => 'Haerbin', 'HeBei' => 'ShiJiaZhuang', 'SiChuan' => 'ChengDu', 'RiBen' => 'DongJing');
//    foreach ($cities as $key => $value)
//    {
//        echo $key.' : '.$value.'<br>';
//    }




















