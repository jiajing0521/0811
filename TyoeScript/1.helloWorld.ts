/**
 * Created by dllo on 16/12/15.
 */
//白鹭引擎和ES6.2是用这个语言写的
var name = "JK";
//声明时 需要类型,在内置终端点击编辑刷新后,查看编辑后的js文件
var age: number = 20;

function test(num:number,str:string) :string{
    return str+num;
}
console.log(test(520,"JJ"));

class Person {
    private sex;
    public name: string;
    //设置初始值,可以理解为实例化时传参
    constructor(name:string,sex: string){
        this.name = name;
        this.sex = sex;
    }
    //静态方法,即类方法,不需要实例对象就可以调用的方法
    static sayHi(){
        console.log("hi");
    }
    sayHello(){
        console.log(`我的名字叫${this.name},我的性别是${this.sex}`);
    }
}
Person.sayHi();

var per = new Person("JK","男");
per.sayHello();

//枚举类型:在前后传数据时,方便,默认spring为0,从0开始,也可以定义spring=2,则从2开始
enum Season {spring,summer,autumn,winter}

function testEnum(season: Season){
    console.log(season);
}

testEnum(Season.autumn);