/**
 * Created by dllo on 16/12/15.
 */
//白鹭引擎和ES6.2是用这个语言写的
var name = "JK";
//声明时 需要类型,在内置终端点击编辑刷新后,查看编辑后的js文件
var age = 20;
function test(num, str) {
    return str + num;
}
console.log(test(520, "JJ"));
var Person = (function () {
    //设置初始值,可以理解为实例化时传参
    function Person(name, sex) {
        this.name = name;
        this.sex = sex;
    }
    //静态方法,即类方法,不需要实例对象就可以调用的方法
    Person.sayHi = function () {
        console.log("hi");
    };
    Person.prototype.sayHello = function () {
        console.log("\u6211\u7684\u540D\u5B57\u53EB" + this.name + ",\u6211\u7684\u6027\u522B\u662F" + this.sex);
    };
    return Person;
}());
Person.sayHi();
var per = new Person("JK", "男");
per.sayHello();
//枚举类型:在前后传数据时,方便,默认spring为0,从0开始,也可以定义spring=2,则从2开始
var Season;
(function (Season) {
    Season[Season["spring"] = 0] = "spring";
    Season[Season["summer"] = 1] = "summer";
    Season[Season["autumn"] = 2] = "autumn";
    Season[Season["winter"] = 3] = "winter";
})(Season || (Season = {}));
function testEnum(season) {
    console.log(season);
}
testEnum(Season.autumn);
//# sourceMappingURL=1.helloWorld.js.map