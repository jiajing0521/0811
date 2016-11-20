<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
	</head>
	<body>
		<nav class="nav navbar-inverse navbar-fixed-top" style="filter:alpha(Opacity=90);-moz-opacity:0.9;opacity: 0.9" role="navigation">
   	<div class="container">
	   		<div class="navbar-header">
	   	     <a href="#" class="navbar-brand">
	   	        <span class="glyphicon glyphicon-road"></span> <strong>囧途课堂</strong>
	   	     </a>
	   		</div>
	
		   	<ul class="nav navbar-nav">
		   			<li class="active"><a href="#">首页</a></li>
		   			<li><a href="#">囧文</a></li>
		   			<li><a href="#">文章</a></li>
		   	</ul>
	   		<div class="navbar-form navbar-right">
	   			<div class="form-group">	
		   			<div class="input-group">
		   				<input type="text" class="form-control" placeholder="搜索文章、教师或课程"  />
		   				<div class="input-group-btn">
		   					<button class="btn btn-block"><span class="glyphicon glyphicon-search"></span></button>
		   				</div>
		   			</div>	
	   			</div>
	   			<div class="form-group" style="padding-left: 10px; margin: 0px 12px;">
		   			<a href="#" style="color: #D2D2D2;">登录</a>
		   			<span  style="color: #D2D2D2;padding-left: 5px;">|</span>
		   			<a href="#" style="color: #D2D2D2;padding-left: 5px;">注册</a>
	   			</div>
	   		</div>	
   	  </div>
   </nav> 
   <div style="height: 60px;"></div>
		<div class="container-fluid">
			<div class="col-md-9">
				<div class="list-group">
					<?php for($i=0;$i<10;$i++):?>
					<div class="list-group-item" style="border: 0;">
						<a href="#" style="color: #0F0F0F;"><h4>【神秘客315特别策划】哪家航空公司最让你泪流满面<?php echo $i;?></h4></a>
						<p class="text-muted">
							<small>发布时间:2015-2-11</small>	
							<small class="pull-right">
								点击量:<span class="badge">20</span>
							</small>
						</p>
						<p class="text-muted">
							从2014年12个月投诉率平均值来看，从高到低依次是东方航空、中国国航、南方航空和海南航空。
		海航2月份投诉率创造了四大航最高点。2月恰似去年春节客运高峰期，海航抗压能力有点差哦。
		从投诉率波动来看，海南航空、南方航空投诉率波动较大；国际航空、东方航空投诉率波动较小
						</p>
						<p>
						  <span class="badge">率波动</span>	<span class="badge">国际航空</span>	<span class="badge">海南航空</span>	
						</p>
					</div>
					<div style="border: 1px dashed #ddd;"></div>
					<?php endfor;?>
					<div class="text-center">
						<ul class="pagination">
							<li><a href="#">&laquo;</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">&raquo;</a></li>
						</ul>
					</div>
					
				</div>
			</div>
		</div>
	</body>
</html>