
<script>

    //(1) * :匹配前面子串0次或多次:
//    var str = "zoooooooo";
//    var reg = /^zo*$/;
//    var result = reg.exec(str);
//    alert(result);

    //(2) + :匹配前面子串一次或多次(但不能没有)
//    var str = "z";
//    var reg = /^zo+$/;
//    var result = reg.exec(str);
//    alert(result);

    //(3) ? :匹配前面子串零次或一次
//    var str = "z";
//    var reg = /^zo?$/;
//    var result = reg.exec(str);
//    alert(result);

    //(4) {n} : n是正整数,匹配的n次
//    var str = "13978967345";
//    var reg = /^\d{11}$/;
//    var result = reg.exec(str);
//    alert(result);

    //(5) ^ : 从字符串的开头匹配$   : 检验字符串的末尾
    //如果没有添加^和$则匹配是否包含符合规则的字符串(子串)
//    var str = "abc123";
//    var reg = /\d{3}/;
//    var result = reg.exec(str);
//    alert(result);

    //(6) {n,} : n为正整数,此时表示是要符合要求的次数(默认非贪婪)
//    var str = "abc123abc123abc";
//    var reg = /\d{3,}/;
//    var result = reg.exec(str);
//    alert(result);

    //(7) {n,m} : 最少n次,最多m次,其中n<=m
//    var str = "QASEDFAQQQQQQQ";
//    var reg = /^[A-Z]{6,10}$/;//至少6位,最多10位,并且内容只能是数字,字母的组合[A-Za-z0-9] == \w
//    var result = reg.exec(str);
//    alert(result);

    //练习1:匹配字符串满足如下规则:字符b后面包含两个连续的c
//    var str = "bcccc";
//    var reg = /bc{2,}/;
//    var result = reg.exec(str);
//    alert(result);
    //练习2:匹配字符串中全是数字
//    var str = "9876sdfawfwf54322";
//    var reg = /^\d+$/;
//    var result = reg.exec(str);
//    alert(result);

    //练习3:想匹配字符串中全为数字，并且第2位是2，第4为是4，最少是4位
//    var str = "12344567754567";
//    var reg = /^\d2\d4\d*$/;
//    var result = reg.exec(str);
//    alert(result);

    //练习4：匹配一下字符串是一个手机号码

//    var str = '15111111111';
//    var reg = /^1[3,4,5,7,8]\d{9}$/;
//    var result = reg.exec(str);
//    alert(result);

    //练习5:匹配邮箱的正则式
//    var str = "haha123_happy@163.com.cn";
//    var reg = /^\w+@[A-Za-z0-9]+\.(com|cn|net|com\.cn)$/;
//    var result = reg.exec(str);
//    alert(result);

    //练习6:匹配字符串为一个域名:  baidu.com / sina.com
//    var str = "netease.com";
//    var reg = /^[A-Za-z0-9]+\.[A-Za-z]+/;
//    var result = reg.exec(str);
//    alert(result);

    //练习7:匹配一个字符串是一个URL : http://www.baidu.com
//    var str = "https://www.baidu.com";
//    var reg = /^https?:\/\/ [A-Za-z0-9]+\.(com|cn|net)$/;
//    var result = reg.exec(str);
//    alert(result);

    //练习8:验证密码设置: 数字,字母和下划线的组合,必须在8-10位之间
//    var str = "93atHw";
//    var reg = /[a-z]+[A-Z]+[0-9]+/;
//    var reg =  /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,10}$/;
//    var result = reg.exec(str);
//    alert(result);

    // ?加在其他符号后面: (*, +, ?, {n}, {n,}, {n,m})
//    var str = "kkkkk";
//    var reg = /k+?/;//非贪婪,只打印一个k
//    var result = reg.exec(str);
//    alert(result);

    // ?:
//    var str = "destination";
//    var reg = /destinat(?:ion|e)/;
////等价于:var reg = /(destination|destinate)/;
//    var result = reg.exec(str);
//    alert(result);

    // ?= 只匹配小括号里面有的结尾
//    var str = "windows98";
//    var reg = /windows(?=2000|98|95)/;
//    var result = reg.exec(str);
//    alert(result);

    // ?! 排除小括号里面的内容,其他都符合
//    var str = "windowsVista";
//    var reg = /windows(?!2000|98|95)/;
//    var result = reg.exec(str);
//    alert(result);


    // x|y 出现两个中的一个即可
//    var str = "catch";
//    var reg = /try|catch/;
//    var result = reg.exec(str);
//    alert(result);

    // [abc] 有其中的一个就算合法:
//    var str = "awer";
//    var reg = /[abc]/;
//    var result = reg.exec(str);
//    alert(result);

    //[^abc] 有其中一个就不合法,返回那个不合法字符前面的字符串
//    var str = "wsasd";
//    var reg = /[^abc]+/;
//    var result = reg.exec(str);
//    alert(result);

    //[a-z] 有这个范围的就合法:
//    var str = "123abdefgh456";
//    var reg = /[a-z]+/;
//    var result = reg.exec(str);
//    alert(result);

    //[^a-z] 包含这个范围的就不合法
//    var str = "123abc456";
//    var reg = /[^a-z]+/;
//    var result = reg.exec(str);
//    alert(result);

    // \b 判断是否是单词的边缘:
//    var str = "my name is liming";
//    var reg = /me\b/;
//    var result = reg.exec(str);
//    alert(result);

    // \B 判断子串是否在单词的中间或开头
//    var str = "my name is liming";
//    var reg = /na\B/;
//    var result = reg.exec(str);
//    alert(result);

    // \s 匹配包含空白符(空格,翻页,回车,tab...)
//    var str = "he\n     llo";
//    var reg = /\s+/;
//    var result = reg.exec(str);
//    alert("+" + result + "+");



</script>