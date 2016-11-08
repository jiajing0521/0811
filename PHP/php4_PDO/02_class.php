<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/1
 * Time: 下午2:41
 */

header("Content-type:text/html;charset=utf-8");

//1....声明一个Person类
class Person {

    //4....类中的常量声明之后不可改变;在外部用Person::num访问,不需要实例化
    const num = 20;
    //5....类中的静态变量,通过类可以直接访问,不需要实例化
    public static $a = 30;
    //6....类中的静态方法,通过类可以直接访问,不需要实例化
    static function sayHello(){
        echo "hello";
    }


    //属性的可见度
    //公开的,在类的外部可以访问
    public $name = "刘晟鑫";
    //受保护的,只在本类和子类中可以访问,外界无法访问
    protected $age = 20;
    //私有的,只在本类中可以访问,子类和外界都无法访问
    private $sex = "女";

    public function sayHi(){
        echo "(｡･∀･)ﾉﾞ嗨";
        echo "<br>";
        //$this表示当前的对象
        //在类的外部如果要获取受保护的或私有的属性,只能通过方法得到
        echo $this->sex;
        echo "<br>";
    }
}

//2....实例一个$per对象
$per = new Person();
//2.1.获取对象的属性
echo $per->name;
echo "<br>";
//2.2.调用对象的方法
$per->sayHi();

//3....子类,继承于上面的Person类
//继承了父类的公有的和受保护的属性和方法
class Man extends Person {

    function getAge(){
//3.4获取子类继承的属性(受保护的)
        echo $this->age;
        echo "<br>";
    }
}

//3.1子类
$man = new Man();
//3.2获取子类继承的属性(公开的)
echo $man->name;
echo "<br>";
//3.3调用子类继承的方法
echo $man->sayHi();
//3.3调用子类本身的方法
$man->getAge();
//4.1访问类中的常量
echo Person::num;
//5.1访问类中的静态变量
echo Person::$a;
//6.1调用类中的静态方法
Person::sayHello();