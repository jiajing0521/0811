<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/10/27
 * Time: 下午8:13
 */

echo " \" \$";

var_dump(0 == false);
var_dump('0' == false);
var_dump('' == false);
var_dump('null' == false);
var_dump(null == false);


echo 25+"50"+"A12"+false+true+"15abc";
echo "<br>";


for ($i = 0; $i < 5; $i++){
    for ($j = 0; $j < 2*$i + 1; $j++){
        echo "*";
    }
    echo "<br>";
}

$i = 0;
while($i < 14){
    $i++;
    if($i == 6 || $i == 9){
        continue;
    }else{
        echo $i;
    }
}
echo "<br>";

$i = 0;
do{
    $i++;
    if($i == 6 || $i == 9){
        continue;
    }else{
        echo $i;
    }
}while( $i < 14);
echo "<br>";

for ($i = 0; $i < 14; $i++){
    if($i == 6 || $i == 9){
        continue;
    }else{
        echo $i;
    }
}
echo "<br>";

$a = 10;
$b = &$a;
echo $b;//10

$b = 15;
echo $a;//15
echo "<br>";


$val_1 = "hello";
$$val_1 = "world";
echo $hello;//world
echo $val_1;//hello
echo ${$val_1};//world
echo "<br>";


$i=10;
$i++;//10
echo $i;//11
$y = $i++;//11
echo $y;//11
$y = ++$i;//13
echo $y;//13
$y += 10;//23
echo $y;
echo "<br>";


$a = "123";
$a .= 456;
echo $a;
echo "<br>";//123456

$a = 3;
$b = 4;
$c = 5;
echo $a > $b && $c>$b || $a<$c;//1
echo "<br>";

$x = 1;
++$x;//2
$y = $x++;//2
echo $y;
echo "<br>";


function abc($a,$b=10,$c=10) {
    return $a+$b+$c;
}
echo abc(10,30);
echo "<br>";

function a(&$a) {
    $a *= 10;
}
$b = 10;
a($b);
echo $b;
echo "<br>";

function fn($i){

    if ($i >= 1000){
        return 1;
    }else{
        return fn($i+5) + $i;
    }
}
echo (fn(1));
echo "<br>";

$n = 1000;
$y = 1;
for($i=1;$i<$n;$i+=5) {
    $y += $i;
}
echo $y;

function keep_val(){
    static $count = 0;
    $count++;
    echo $count;
}
keep_val();
keep_val();
keep_val();






