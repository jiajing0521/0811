<?php

//1....连接数据库
require_once "DB_CONNECT.php";
//2....显示五条,按时间倒序排列
$result = $pdo->query("SELECT * FROM weibo ORDER BY time DESC LIMIT 5");

$arr = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>微博</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;	
		}
		.wrap{
			width: 500px;
			margin: 0 auto;
			background-color: #f9f9f9;
			border: 1px solid black;
			text-align: center;
			padding: 10px;
		}
		li{
			list-style: none;
		}
		#name{
			width: 400px;
			height: 23px;
			font-size: 1rem;
		}
		textarea{
			width: 400px;
			border: 1px solid rgb(204,204,204);
			font-size: 1rem;
			/*向上对齐, 内容两个字跟着对齐*/
			vertical-align: top;
		}
		#fill li{
			padding: 10px 0;
		}
		#submit{
			padding: 3px 15px;
			border: 1px solid black;
			background-color: #fff;
			position: relative;
			left: -200px;
			font-size: 1rem;
		}
		h3{
			margin-top: 20px;
			text-align: left;
		}
		#weibo{
			margin: 20px auto;
			width: 90%;
			background-color: white;
		}
		#weibo li{
			border-bottom: 1px solid #ccc;
			padding: 0 0 10px 40px;
			overflow: hidden;
			text-align: left;
		}
		.active{
			color: yellow;
		}
		.right{
			float: right;
		}
	</style>
</head>
<body>
	<div class="wrap">
		<ul id="fill">
				<li>内容: <textarea name="" cols="30" rows="10" id="content"></textarea></li>
				<li><input type="button" value="提交" id="submit"></li>
		</ul>
		<div id="msg">
			<ul><h3>显示留言</h3></ul>
			<ul id="weibo">

				<?php
				for ($i = 0; $i < count($arr); $i++){
					$row = $arr[$i];
					echo "<li data-id={$row['id']}>";
					$content = $row["content"];
					echo "<p>{$content}</p>";
					$time = $row["time"];
					$time = date("Y-m-d H:i",$time);
					echo "<p class='right'>{$time}<span>赞👍<a href='javascript:void(0)'>{$row['liked']}</a></span><span>踩👎<a href='javascript:void(0)'>{$row['unlike']}</a></span><a class='remove' href='javascript:void(0)'>删除</a></p>";

				}
				?>

<!--				<p>-->
<!--					<span>--><?php //echo $time;?><!--</span>-->
<!--					<span>赞</span>-->
<!--					<a href="##">--><?php //echo $row["praise"];?><!--</a>-->
<!--					<span>踩</span>-->
<!--					<a href="#">--><?php //echo $row["down"];?><!--</a>-->
<!--				</p>-->

			</ul>
			<div id="page">

			</div>
		</div>
	</div>
<script src="../jquery-2.2.3.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {
		//点击发布
		//接口:api.php
		//method:post
		//参数;{type: "submit", content: "hgskh"}
		//返回值:{"err": 0, "time":"2016-11/3 00:00"}
		$("#submit").on("click",function () {

			$.ajax({
				url: "api.php",
				type: "post",
				data: {
					type: "submit",
					content: $("#content").val()
				},
				//返回值类型,不写默认是普通字符串,如果写"json"的话,返回值自动转成js对象
				dataType: "json",
				success: function (data) {
					if (data.err == 0){
					    addLi($("#content").val(),data.time,data.id);
					}else{
						console.log(data,msg);
					}
				}
			})
		});

		//在DOM中添加一个li
		function addLi(content,time,id) {
			var li = $("<li></li>");
			li.attr("data-id",id);
			li.html("<p>"+content+"</p>" +
				"<p class='right'>" +
				"<span>"+time+"</span>" +
				"<span>赞👍<a href='javascript:void(0)'>0</a></span>" +
				"<span>踩👎<a href='javascript:void(0)'>0</a></span>" +
				"<a class='remove' href='javascript:void(0)'>删除</a>"+
				"</p>");
			$("ul#weibo").prepend(li);
			var height = li.height();
			li.height(0);
			li.animate({
				height: height
			})
		}
console.log($("li a:first-of-type"));
		//删除
		$(document).on("click",".remove",function () {

			var that = this;

			$.ajax({
				url:"api.php",
				type:"post",
				data: {
					type: "remove",
					id: $(this).parents("li").attr("data-id")
				},
				dataType: "json",
				success: function (data) {
					console.log(data);
					if (data.err == 0){
					    $(that).parents("li").animate({
							height: 0
						},function () {
							$(that).parents("li").remove();
						});
					}else{
						console.log(data.msg);
					}
				}
			})
		})






	})
</script>
</body>
</html>
