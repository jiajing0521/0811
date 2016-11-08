<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/27
 * Time: 上午11:14
 */

function max3($a,$b,$c){
    return ($a>$b?$a:$b)>$c?($a>$b?$a:$b):$c;
}
echo max3(1,5,9);

//全局变量
$a = 50;
//在php中，全部变量在函数中不能直接使用，使用的话，需要在函数内部用global声明
function xx(){
    global $a;
    echo $a;
};
xx();

//匿名函数
$a = function (){

};
$a();

//函数作为参数
$nArr=array_map(function ($value){
    return $value + 10;
},[1,2,3]);

print_r($nArr);


//递归函数
//求一个数的阶乘 5！=5*4*3*2*1
function jiecheng ($num){
    if ($num==1){
        return 1;
    }else{
        return jiecheng($num-1)*$num;
    }
}
echo jiecheng(5);

//静态变量，只初始化一次，接下来会在原来基础上修改
//每次调用该函数时，该变量将会保留着函数前一次被调用时的值。

//注释：该变量仍然是函数的局部变量。
static $x=20;
$x += 10;
function test(){
    static $a = 10;
    return ++$a;
}
echo test();//11
echo test();//12
echo test();//13

//默认参数，声明时，给参数赋值，调用时不传参则为默认值，传参使用传入值
function add($a,$b=10){
    return $a+$b;
}
echo add(5);
echo add(5,3);
echo "<br>";


$str1 = null;
$str2 = false;
if ($str1==$str2){
    echo '相等';
}else{
    echo '不相等';
}






