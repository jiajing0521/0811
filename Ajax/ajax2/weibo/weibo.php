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
		ul,li{
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
			padding: 10px 0 10px 0;
			width: 450px;
			height: 150px;
		}
		.active{
			color: yellow;
		}
		.text{
			padding-bottom: 110px;
		}
		.time{
			/*margin-top: 110px;*/
			padding-left: 100px;
			font-size: 14px;
			color: #8c8c8c;
		}
		.time .lkct{
			padding-left: 10px;
			padding-right: 10px;
		}
		.lk, .del{
			cursor: pointer;
		}
		.del{
			color: blue;
		}
	</style>
	<script type="text/javascript" src="../jquery-2.2.3.min.js"></script>
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
				//连接DB
				require_once "DB_CONNECT.php";
				$result = $pdo->query("SELECT * FROM weibo ORDER BY time DESC LIMIT 5");
				$arr = $result->fetchAll(PDO::FETCH_ASSOC);

				for ($i = 0; $i < count($arr); $i++){
					echo "<li class='list'>";
					//显示内容
						echo "<p class='text' style='text-align: left; text-indent: 2em'>";
						echo $arr[$i]["content"];
						echo "</p>";
						//显示时间

						date_default_timezone_set("PRC");
						$time = $arr[$i]["time"];

						echo "<p class='time' name='{$time}'>";
							echo date("发表于 Y-m-d H时i分 ",$time);
							//点赞
							echo "<span class='like lk' name='liked'> 赞👍 ";
								echo "<span class='lkCount lkct'>";
								echo $arr[$i]["liked"];
								echo "</span>";
							echo "</span>";

							//踩
							echo "<span class='unlike lk' name='unlike'> 踩 👎 ";
								echo "<span class='unlkCount lkct'>";
								echo $arr[$i]["unlike"];
								echo "</span>";
							echo "</span>";
							echo "<span class='del' name='{$time}'>";
								echo "删除";
							echo "</span>";

						echo "</p>";

					echo "</li>";
				}
				?>
			</ul>
			<div id="page">

			</div>
		</div>
	</div>
<script type="text/javascript">

//点击发布..........
//参数
//content
//time
//返回值{err:0(成功)，count:count+1}/{err:1(失败),msg:"加载失败"}
$("#submit").on("click",function () {
    console.log($("#content").val());
	if($("#content").val() == ""){
		alert("请输入内容！！！");
	}else{
		var contentVal = $("#content").val();

		$.post("weibo_dbAction.php",{content:contentVal},function (data) {
			var obj = JSON.parse(data);
			if(obj.err == 0){
                addLi($("#content").val(),obj.time);
                $("#content").val("");
			}else{
				alert(obj.msg);
			}
		})
	}

});
//在DOM中添加一个li
function addLi(content,time) {
    var li = $("<li></li>");
    li.html("<p class='text' style='text-align: left; text-indent: 2em'>"+content+"</p>" +
        "<p class='time' name='{$time}'>"+time +
        "<span class='like lk' name='liked'> 赞👍 " +
        "<span class='lkCount lkct'>0</span>" +
        "</span>" +
        "<span class='like lk' name='liked'> 踩👎 " +
        "<span class='lkCount lkct'>0</span>" +
        "</span>" +
        "<span class='del' name='{$time}'>删除</span>" +
        "</p>");
    $("ul#weibo").prepend(li);
    var height = li.height();
    li.height(0);
    li.animate({
        height: height
    })
}

//点赞或点踩
//参数
//type
//count
//time
//返回值{err:0(成功)，count:count+1}/{err:1(失败),msg:"加载失败"}
$(".lk").on("click",function () {
	var typeVal = $(this).attr("name");
	var countVal = $(this).children().html();
	var timeVal = $(this).parents(".time").attr("name");
	console.log("html="+typeVal,countVal,timeVal);
	var _this = $(this);
	$.post("weibo_dbAction.php",{type: typeVal,count:countVal,time:timeVal},function (data) {

        console.log(data);
		var obj = JSON.parse(data);
		if(obj.err == 0){
			_this.children().html(obj.count);
		}else{
			alert(obj.msg);
		}
	})
});

//点击删除.........
//参数
//time
//返回值{err:0(成功)，msg:"删除成功"}/{err:1(失败),msg:"加载失败"}
$(".del").on("click",function () {
	var timeVal = $(this).parents(".time").attr("name");

    var _this = $(this);
	$.post("weibo_dbAction.php",{time:timeVal},function (data) {

		var obj = JSON.parse(data);
		if(obj.err == 0){
			_this.parents("li").remove();
			alert(obj.msg);
		}else{
			alert(obj.msg);
		}
	})
})


</script>
</body>
</html>
