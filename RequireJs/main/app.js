/**
 * Created by dllo on 16/12/13.
 */
require.config({
    //指定路径作为加载模块的根目录
    baseUrl:"./main/lib"
});
//遵循AMD规范
//nodeJS遵循CommonJS规范
//seaJS遵循CMD规范
require(["jquery","module1","module2","module3"],function ($, m1, m2,m3) {
    alert(m1.name);
    alert(m2.age);
    m3.a();
});