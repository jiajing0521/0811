<?php

//类的声明:
class student{
    //属性:
    //public : 类的内部和外部都可以访问
    //private : 只允许类的内部访问
    //protected : 本类及其子类可以访问
    public $name = '';
    public $age = 10;
    public $gender = 'M';
    private $weight = 65.9;
    private $creditCardPWD = '111111';
    private $height = 180.3;
    protected $firstName = 'Smith';
    protected $lastName = 'scott';
    protected $nickName = 'Blue Fly New East';

    //方法:
    function study(){
        echo '我就是爱学习,根本停不下来';
    }
    function introduce(){
        echo '我是'.$this->name;
        $this->study();//嵌套调用
        //this 相当于 self(当前对象)
    }
}

//创建类的实例(对象)
//$stu = new student;
//$stu->name = '鞠盈富';
//$stu->gender = 'F';
//$stu->age = 18;
//$stu->introduce();

//类的继承:
class person{
    public $name = '';
    public $age = 10;
    public $address = '大连';
    protected $card = '123456';
    protected $money = 99;
    private $height = 178.4;
    function work($job){
        echo '我的职业是'.$job;
    }
}
class programmer extends person {

    function sayHi(){
        echo $this->money;
    }

    //重写了父类的方法,再次调用将走这个方法
    function work($job)
    {
        //调用父类方法,使用parent或者类名
        parent::work('入殓师');
        echo '我是子类重写后的work,谁也别阻止我';
    }
}

//$pro = new programmer;
//$pro->sayHi();
//echo '<br>';
//$pro->work('网警');



//接口:interface
interface lists{
    //只写方法的声明,不需要实现,具体的实现由想要实现这个接口的类去完成.
    function sum();
    function add();
    function average();
    function minus();
}
//myImplement类必须实现接口lists里的方法,类似签了一个协议.
class myImplement implements lists {
    function sum()
    {
        echo '寻龙分金看缠山';
    }
    function add()
    {
        echo '一缠山是一重关';
    }
    function average()
    {
        echo '当中若有八重锁';
    }
    function minus()
    {
        echo '定有王侯居此间';
    }
}

//$test = new myImplement;
//$test->sum();
//echo '<br>';
//$test->add();
//echo '<br>';
//$test->average();
//echo '<br>';
//$test->minus();


//静态变量:
class Car{
    static $flag = 123;
    function sayHi(){
        echo static::$flag;
    }
}
class childCar extends Car {
    static $flag = 456;
    function num(){
        echo static::$flag;
    }
}

//$car = new Car;
//$car->sayHi();
//$child = new childCar;
//$child->num();


//内存精髓:引用计数+写时复制


//常量:
//(1)
define('PI', '3.1415927');
//(2)
class film{
    const firstDate = '2016-11-15';
    function printNumber()
    {
        echo film::firstDate.'<br>';
    }
}

//$movie = new film;
//$movie->printNumber();
////常量在外界可以通过类名访问:
//echo film::firstDate;

//PHP特征方法:
trait Writer{
    function copyPages(){
        echo '天下文章一大抄';
    }
}
class Sport{
    use Writer;
    //我想在run方法里使用copyPages方法:
    function run(){
        $this->copyPages();
    }
}
class Bank{
    use Writer;
    function report(){
        $this->copyPages();
    }
}

//$s = new Sport();
//$b = new Bank();
//$s->run();
//$b->report();

//抽象类:
abstract class Picture{
    //抽象方法:
    abstract function sun();
}

class modernPic extends Picture{
    function sun()
    {
        echo '我是被modernPic实现的抽象方法,以前我虚无缥缈,现在我有了自己的实现,就像你现在看到的这句话,来自我的实现部分';
    }
}

//$pic = new modernPic();
//$pic->sun();

//多继承?

class A{
    public $name = '123';
    function a(){
        echo '我是a';
    }
}
class B{
    public $hobby = '456';
    function b(){
        echo '我是b';
    }
}

    





