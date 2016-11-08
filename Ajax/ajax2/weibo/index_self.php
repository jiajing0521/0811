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
			margin: 10px auto;
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
			resize: none;
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
			color: red;
		}
		.remove{
			padding-right: 20px;
			cursor: pointer;
		}
		.right{
			float: right;
			font-size: 14px;
			color: #8c8c8c;;
		}
		li p{
			padding-top: 15px;
		}
		li span{
			margin-left: 10px;
			cursor: pointer;
		}
		li p a{
			padding:0 0 0 10px;
			text-decoration: none;
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
				//页面刷新时,从DB中选出的5条显示出来,每条创建一个li
				for ($i = 0; $i < count($arr); $i++){
					$row = $arr[$i];
					//创建li标签,保存id为data-id作为以后识别条件
					echo "<li data-id={$row['id']}>";
					$content = $row["content"];
					//创建p标签装内容
					echo "<p class='text'>{$content}</p>";
					//获取时间,并且格式转换
					$time = $row["time"];
					$time = date("Y-m-d H:i",$time);
					//..创建p标签装时间
					//..创建span标签 装赞 class=lkAct用来点击事件 name-type用来以后获取DB修改识别条件,加创建a标签装数值
					//..创建span标签 装踩 class=lkAct用来点击事件 name-type用来以后获取DB修改识别条件,加创建a标签装数值
					//..创建a标签 装删除 class=remove用来设置样式和点击事件
					echo "<p class='right'>{$time} <span class='lkAct' name-type='liked'> 赞👍<a href='javascript:void(0)'>{$row['liked']}</a></span><span class='lkAct' name-type='unlike'>踩👎<a href='javascript:void(0)'>{$row['unlike']}</a></span><a class='remove' href='javascript:void(0)'>❎</a></p>";

				}
				?>

<!--				下面是另一种书写格式-->
<!--				<p>-->
<!--					<span>--><?php //echo $time;?><!--</span>-->
<!--					<span>赞</span>-->
<!--					<a href="##">--><?php //echo $row["praise"];?><!--</a>-->
<!--					<span>踩</span>-->
<!--					<a href="#">--><?php //echo $row["down"];?><!--</a>-->
<!--				</p>-->

			</ul>
			<div id="page">
				<?php
				//页面刷新时,分页
				getPage();
				function getPage(){
					global $count;
					global $pdo;
					//获取数据库总件数
					$count = $pdo->query("SELECT count(id) FROM weibo");
					$countArr= $count->fetchAll(PDO::FETCH_ASSOC);
					//强制转成数值型
					$counts =  (int)$countArr[0]["count(id)"];
					//对5取余,如果等于零,除以5取整数,为最终的总页数
					if ($counts%5==0){
						$pages = $counts/5;
					//如果不等于零,除以5后向上取整,为最终的总页数
					}else{
						$pages = ceil($counts/5);
					}
					//for循环输出a标签
					for ($i = 0;$i < $pages; $i++){
						$page = $i+1;
						//page-id用来向后台传值,最为LIMIT基数
						echo "<a href='javascript:void(0)' page-id=".$i." style='padding: 5px;'>";
						//赋值从1开始
						echo $page;
						echo "</a>";
					}
				}
				?>
			</div>
		</div>
	</div>
<script src="../jquery-2.2.3.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {
		//1........点击发布
		//接口:api.php
		//method:post
		//参数;{type: "submit", content: "hgskh"}
		//返回值:{"err": 0, "time":"2016-11/3 00:00"}
		$("#submit").on("click",function () {

			//如果文本框没有内容,禁止提交
			if ($("#content").val() == ""){
			    alert("请输入内容!!!");
			}else{
				$.ajax({
					url: "api_self.php",
					type: "post",
					data: {
						type: "submit",
						//文本框的值
						content: $("#content").val()
					},
					//返回值类型,不写默认是普通字符串,如果写"json"的话,返回值自动转成js对象
					dataType: "json",
					success: function (data) {
						if (data.err == 0){
							//添加一个li,参数:1.文本框内容2.时间3.数据id4.赞数5.踩数6.插入位置(0:从前插1:从后插)
							addLi($("#content").val(),data.time,data.id,0,0,0);
							//如果本页有5个以上li,则删除最后一个li
							if ($("#weibo li").length > 5){
								//删除最后一个li,动画效果
								$("#weibo li:last-child").animate({
									height: 0
								},function () {
									//动画回调函数,删除最后一个li
									$("#weibo li:last-child").remove();
								});
							}
							//清空输入空内容
							$("#content").val("");
						}else{
							console.log(data,msg);
						}
					}
				})
			}
			//更新分页
			updatePage();
		});
		
		//2.......点击删除
		$(document).on("click",".remove",function () {

			var that = this;

			$.ajax({
				url:"api_self.php",
				type:"post",
				data: {
					type: "remove",
					//获取当前元素的父级li的data-id值,用来后台识别条件
					id: $(this).parents("li").attr("data-id"),
					//获取当前的页脚下标,用来后台删除后,作为LIMIT参数来重新加载5条数据,
					pageID: $("a[class=active]").attr("page-id")
				},
				dataType: "json",
				success: function (data) {
					console.log(data);
					if (data.err == 0){
						//删除当前li,动画效果
					    $(that).parents("li").animate({
							height: 0
						},function () {
							//删除当前元素所在的父级li
							$(that).parents("li").remove();
							//清空ul
							$("#weibo").empty();
							//重新添加后台返回的5条数据
							for (var i = 0; i < data.count; i++){
								var itemArr = data["item"][i];
								console.log(itemArr);
								//调用添加里函数:参数:1.文本框内容2.时间3.数据id4.赞数5.踩数6.插入位置(0:从前插1:从后插)
								//从后插入原因:从后返回的数据是时间倒序显示,for循环从0开始,所以从后插入,每次比前一次时间靠前
								addLi(itemArr.content,itemArr.time,itemArr.id,itemArr.liked,itemArr.unlike,1);
							}
						});
					}else{
						console.log(data.msg);
					}
				}
			});
			//更新分页
			updatePage();
		});
		
		//3.......点击分页
		//默认第一页为active
		$("#page a").eq(0).attr("class","active");
		$(document).on("click","#page a",function () {
			//tab切换,点击的页码高亮显示
			$("#page a").attr("class","");
			$(this).attr("class","active");
			var that = this;
			$.ajax({
				url:"api_self.php",
				type:"post",
				data: {
					type: "pageUpdate",
					//获取当前的页脚下标,用来后台删除后,作为LIMIT参数来重新加载5条数据,
					pageID: $(this).attr("page-id")
				},
				dataType: "json",
				success: function (data) {
					console.log(data);
					if (data.err == 0){
						//清空ul
						$("#weibo").empty();
						//for循环输出后台返回的数据
						for (var i = 0; i < data.count; i++){
							var itemArr = data["item"][i];
							console.log(itemArr);
							//调用添加里函数:参数:1.文本框内容2.时间3.数据id4.赞数5.踩数6.插入位置(0:从前插1:从后插)
							addLi(itemArr.content,itemArr.time,itemArr.id,itemArr.liked,itemArr.unlike,1);
						}
					}else{
						console.log(data.msg);
					}
				}
			})
		});

		//4.......点击点赞或踩
		$(document).on("click",".lkAct",function () {
			//获取点击对象
			var that = this;
			$.ajax({
				url:"api_self.php",
				type: "post",
				data: {
					type: "lkAct",
					//获取点击对象的父级li的data-id属性值作为筛选条件
					id: $(this).parents("li").attr("data-id"),
					//获取点击的是liked或unlike属性名作为更新的字段名
					lkType: $(this).attr("name-type"),
					//获取点击对象的子级a标签的数值作为更新的值
					lkValue: $(this).children("a").html()
				},
				dataType: "json",
				success: function (data) {
					console.log(data);
					if (data.err == 0){
						//显示当前点击的对象数值+1
					    $(that).children("a").html(data.lkValue);
					}else{
						console.log(data.msg);
					}
				}
			})
		});


		//函数.......在DOM中添加一个li
		function addLi(content,time,id,liked,unlike,pos) {
			var li = $("<li></li>");
			//给新生成的li加data-id属性,作为条件用来识别数据库中的第几条,
			li.attr("data-id",id);
			//添加p标签,内容为后台返回的content
			//添加p标签,内容为时间
			//..创建span标签 装赞 class=lkAct用来点击事件 name-type用来以后获取DB修改识别条件,加创建a标签装数值
			//..创建span标签 装踩 class=lkAct用来点击事件 name-type用来以后获取DB修改识别条件,加创建a标签装数值
			//..创建a标签 装删除 class=remove用来设置样式和点击事件
			li.html("<p class='text'>"+content+"</p>" +
				"<p class='right'>" +
				"<span>"+time+" </span>" +
				"<span class='lkAct' name-type='liked'> 赞👍<a href='javascript:void(0)'>"+liked+"</a></span>" +
				"<span class='lkAct' name-type='unlike'>踩👎<a href='javascript:void(0)'>"+unlike+"</a></span>" +
				"<a class='remove' href='javascript:void(0)'>❎</a>"+
				"</p>");
			//pos为0,从前插入,动画效果
			if (pos == 0){
				$("ul#weibo").prepend(li);
				var height = li.height();
				li.height(0);
				li.animate({
					height: height
				})
			//pos为1,从后插入
			}else{
				$("ul#weibo").append(li);
			}
		}

		//更新分页
		function updatePage() {
			//获取active的标签
			var activePage = $("a[class=active]").index();
			$("#page").empty();
			//获取数据库总件数
			$.post("api_self.php",{"type":"getCount"},function (data) {
				var obj = JSON.parse(data);
				console.log(obj);

				//for循环输出a标签
				for (var i = 0; i < obj["pages"]; i++){
					var page = i+1;
					//page-id用来向后台传值,最为LIMIT基数
					var aPage = $("<a href='javascript:void(0)' style='padding: 5px;'></a>");
					aPage.attr("page-id",i);
					//赋值从1开始
					aPage.html(page);
					$("#page").append(aPage);
				}
				//默认第一页为active
				$("#page a").eq(activePage).attr("class","active");
			});
		}


	})
</script>
</body>
</html>
