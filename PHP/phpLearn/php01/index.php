<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/7
 * Time: 11:05
 */
    /*
     * 一.数据类型
     * */
    //(1)布尔类型
//    $num = false;
//    echo is_bool($num);//判断一个变量是否是布尔类型
    //(2)整型
//    $age = 35;
//    echo $age + 10;
//    echo "<br>";//php中可以添加html标签
//    echo is_int($age);
    //(3)浮点类型
//    $weight = 89.5;
//    echo $weight;
    //(4)字符串
//    $string = 'i am ';
//    $name = 'james';
////    echo $string.$name;//.是字符串拼接符号
//    $address = 'USA';
//    echo "$address";//双引号会解析变量内容,单引号则原样输出
    //(5)数组
//      $arr = array(1, 3, 5, 7, 9);
//      $result = array(
//          'name' => '张三',
//          'age' => 18,
//          'gender'=> $arr
//      );//在php里数组也能充当字典的作用  key->value模式
////      print_r($result);
//        echo json_encode($result);

    /*
     * 二.输出语句
     * */
    //(1)echo
    //(2)print
//    $name = 'jerry';
//    print $name;
    //(3)print_r()
    //(4)var_dump
//    $arr = array(1, 3, 2, 5);
//    var_dump($arr);
    //(5)var_export()
//    echo "<br>";
//    var_export($arr);

//备注: 最常用的是echo 和 print_r()

    /*
     * 三.变量的变量
     * */
//    $number = 'music';
//    $$number = 'sport';
//    echo $music;

    /*
     * 四.变量命名规范
     * */
//    $echo = 'i am echo';
//    echo $echo;//这种方法不推荐!


    /*
     * 五.分支语句
     * */
    //(1)传统if
//    if (10 > 5)
//    {
//        echo "success";
//    }
    //(2)if-else组合形式
//    if (10 < 5)
//    {
//        echo 'success';
//    }
//    else
//    {
//        echo 'failed';
//    }
    //(3)特有if形式
//    $result = true;
//    if ($result):
//        echo 'is true';
//    else:
//        echo 'is false';
//    endif;
    //(4)switch传统形式:
//    $num = 1;
//    switch ($num)
//    {
//        case 1:echo '春天';break;
//        case 2:echo '夏天';break;
//        case 3:echo '秋天';break;
//        case 4:echo '冬天';break;
//        default:echo '我也不知道!';
//    }
    //(5)switch特有形式:
//    $num = 6;
//    switch ($num):
//        case 1:echo '春天';break;
//        case 2:echo '夏天';break;
//        case 3:echo '秋天';break;
//        case 4:echo '冬天';break;
//        default:echo '我也不知道!';
//    endswitch;

    /*
     * 六.循环语句:
     * */
    //(1)while循环传统形式:
//    $i = 0;
//    while ($i < 10)
//    {
//        echo $i.'<br>';
//        $i++;//循环变量的自增/自减
//    }
    //(2)while 特有形式:
//    $i = 100;
//    while ($i < 1000):
//        $a = (int)($i / 100);
//        $b = (int)($i / 10 % 10);
//        $c = (int)($i % 10);
//        if ($a * $a * $a + $b * $b * $b + $c * $c * $c == $i)
//        {
//            echo $i.'<br>';
//        }
//        $i++;
//    endwhile;
    //(3)do-while:至少执行一次
//    $i = 100;
//    do
//    {
//        echo $i.'<br>';
//        $i++;
//    }while($i < 1000);

    //(4)for循环:
//    for ($i = 0; $i < 100; $i++)
//    {
//        if ((int)($i % 5) == 0)
//        {
//            echo $i.'<br>';
//        }
//    }

    //(5)for新形式:
//    for ($i = 10; $i > 0; $i--):
//        echo $i.'<br>';
//    endfor;

    //****break 和  continue的使用:

//    for ($i = 0; $i < 10; $i++)
//    {
//        for ($j = 0; $j < 10; $j++)
//        {
//            if ($j == 5)
//            {
//                break 2; // 数字表示跳出几层循环!!!
//            }
//            else
//            {
//                echo $j;
//            }
//        }
//        echo '<br>';
//    }
//
//    echo '结束了两个循环';


    //continue:
//    for ($i = 0; $i < 20; $i++)
//    {
//        for ($j = 0; $j < 20; $j++)
//        {
//            for ($k = 0; $k < 20; $k++)
//            {
//                continue 3;
//            }
//        }
//        echo $i.'<br>';
//    }

    /*
     * 八.字符串:
     * */
    //(1)单引号只能转义 \ 和 '
//    $str = '\\';
//    echo $str;
    //(2)双引号
//    $str = "\" \r 123";
//    $message = 'I\'ve been here for several years';
//    echo $str;
    //(3)打印字符串:
//    $str = 'hello str';
//    printf("%s", $str{4});
    //(4)常用函数:
    $str = '100';
    echo strtolower($str); //全部小写
    echo '<br>';
    echo strtoupper($str); //全部大写
    echo '<br>';
    echo ucfirst($str); //首次母大写
    echo '<br>';
    echo ucwords($str); //每个单词首字母都大写
    echo '<br>';
    $str2 = 100;
    if ($str == $str2)
    {
        echo '相同:内容相同即可';
    }
    else
    {
        echo '不同:彻底不同';
    }
    echo '<br>';
    if ($str === $str2)
    {
        echo '相等:内容和类型都相同!';
    }
    else
    {
        echo '不相等:内容或类型不同!';
    }

    echo '<br>';
    $string1 = 'abc';
    $string2 = 'abc';
    echo strcmp($string1, $string2);
// 1代表string1 大于 string2
// -1代表小于
//  0代表等于

    if ($string1 >= $string2)
    {
        echo $string1.'大于等于'.$string2;
    }
    else
    {
        echo $string2.'大于'.$string1;
    }

    echo '<br>';

    $string3 = '123abc456';
    echo substr($string3, 2, 3);//从下表2开始截取3个字符

    echo '<br>';
    $string4 = '123abc456abc789abc';
    echo substr_count($string4, 'abc');//子串在大字符串中出现的次数

    echo '<br>';
    echo strrev($string4);//将字符串翻转

    echo '<br>';
    $string5 = 'good boy';
    echo substr_replace($string5, 'girl', 5, 3);
    echo '<br>';
    echo substr_replace($string5, '', 5);//无插入的删除
    echo '<br>';
    echo substr_replace($string5, 'kind ', 5, 0);//无删除的插入
    echo '<br>';
    echo substr_replace($string5, 'a ', 0, 0);
    echo '<br>';
    echo substr_replace($string5, 'gu', -3, 2);

    echo '<br>';
    echo str_repeat('_.-.', 50);














