<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script src="../ajax2/jquery-2.2.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
    //network->clear->地址栏随意输入一个字母->network中的js文件打开->HEADERS->URL复制
    function fn(data) {
        console.log(data);
    }
</script>
<!--<script src="http://nssug.baidu.com/?cb=fn&ie=utf-8&wd=c&prod=image&t=0.4496444453595214&_=1478246765585" type="text/javascript"></script>-->
<script src="http://localhost/0811/Ajax/ajax3/jsonp_moni.php?cb=fn" type="text/javascript">

</script>
</body>
</html>