<?php 
    include_once "common.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>新浪微博</title>
<style>
* { padding: 0; margin: 0; }
li { list-style: none; }
body { background: #f9f9f9; font-size: 14px; }

#box { width: 450px; padding: 10px; border: 1px solid #ccc; background: #f4f4f4; margin: 10px auto; }
#fill_in { margin-bottom: 10px; }
#fill_in li { padding: 5px 0; }
#fill_in .text { width: 380px; height: 30px; padding: 0 10px; border: 1px solid #ccc; line-height: 30px; font-size: 14px; font-family: arial; }
#fill_in textarea { width: 380px; height: 100px; line-height: 20px; padding: 5px 10px; border: 1px solid #ccc; font-size: 14px; font-family: arial; overflow: auto; vertical-align: top; }
#fill_in .btn { border: none; width: 100px; height: 30px; border: 1px solid #ccc; background: #fff; color: #666; font-size: 14px; position: relative; left: 42px; }

#message_text h3 { font-size: 14px; padding: 6px 0 4px 10px; background: #ddd; border-bottom: 1px solid #ccc; }
#message_text li { background: #f9f9f9; border-bottom: 1px solid #ccc; color: #666; overflow: hidden; }
.caozuo{ float:right;}
#message_text h3 { padding: 10px; font-size: 14px; line-height: 24px; }
#message_text p { padding: 0 10px 10px; text-indent: 28px; line-height: 20px; }
#page a{
	font-size:24px;
    margin-left: 20px;
}
#page a.active{
	color:yellow;
}
</style>
</head>

<body>
<div id="box">
    <ul id="fill_in">
        <form>
            <li>内容：<textarea id="content"></textarea></li>
            <li><input id="btn" type="button" value="提交" class="btn" /></li>
        </form>
    </ul>
    <div id="message_text">
        <ul class="list">
        	<?php 
        	    $sql = "SELECT * FROM message_board ORDER BY id DESC LIMIT ".PAGE_SIZE; 
			$result = mysql_query($sql);
			
			while($row = mysql_fetch_assoc($result)){
        	?>
        	  <li data-id="<?php echo $row["id"]; ?>">
                <p><?php 
                    echo $row["content"]; 
                ?></p>
                <p class="caozuo">
                    <span><?php 
//                      echo $row["time"]; 
						echo date("Y年m月d日 H:i:s",$row["time"]);
                    ?></span>
                    顶：<a class="ding" href="javascript:void(0);">
                    	<?php 
                    	    echo $row["ding"]; 
                    	?>
                    </a>
                    踩：<a class="cai" href="javascript:void(0);"><?php 
                        echo $row["cai"]; 
                    ?></a>
                    <a  class="re" href="javascript:void(0)">删除</a>
                </p>
            </li>  
            <?php 
				} 
            ?>
        </ul>
        <div id="page">
        		<?php 
        		    $sql = "SELECT COUNT(id) FROM message_board";
        		    $result = mysql_query($sql);
				$num = mysql_fetch_row($result)[0];
				
				$count = ceil($num/PAGE_SIZE);
				
				for ($i=0; $i < $count; $i++) { 
        		?>
        		 <a href="javascript:void(0);" class="<?php if ($i==0){echo "active";} ?>"><?php 
        		     echo $i+1; 
        		 ?></a>
        		<?php 
				} 
        		?>
        </div>
    </div>
</div>
</body>
<script src="jquery-1.12.1.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(function (){
	
	$("#btn").on("click",function (){
		
		$.ajax({
			type:"get",
			dataType:"json",
			data:{
				content:$("#content").val(),
				act:"add"	
			},
			url:"http://localhost/425/ajax2/msg_api.php",
			success:function (json){
				if (json.err==0){
					createLi(json.id,$("#content").val(),json.time,0,0);
				}
			}
		});
		
        
	});
	function addZero(s){
		if (s<10){
			return "0"+s;
		}else{
			return s;
		}
	}
	function getJsTime(s){
		var s = s*1000;
		var newDate = new Date();
		newDate.setTime(s);
		return newDate.getFullYear()+"年"+addZero((newDate.getMonth()+1))+"月"+addZero(newDate.getDate())+"日"+" "+addZero(newDate.getHours())+":"+addZero(newDate.getMinutes())+":"+addZero(newDate.getSeconds());
	}
	function createLi(id,content,time,ding,cai,chaBol){
			var liObj = $('<li data-id="'+id+'">'+
                '<p>'+content+'</p>'+
                '<p class="caozuo">'+
                    '<span>'+getJsTime(time)+'</span>'+
                    '顶：<a class="ding" href="javascript:void(0);">'+ding+'</a>&nbsp;&nbsp;'+
                    '踩：<a class="cai" href="javascript:void(0);">'+cai+'</a>&nbsp;&nbsp;&nbsp;'+
                    '<a  class="re" href="javascript:void(0)">删除</a>'+
                '</p>'+
            '</li>');
            if (chaBol){
            		$("ul.list").append(liObj);
            }else{
            		$("ul.list").prepend(liObj);
            }
	        var h = liObj.height();
	        liObj.height(0);
	        liObj.animate({
	        		height:h
	        }); 
		}
	var nowIndex = 0;
	$(document).on("click",".ding",function (event){
		
		var target = $(event.target);
		var id = target.parents("li").attr("data-id");
		$.ajax({
			dataType:"json",
			url:"http://localhost/425/ajax2/msg_api.php",
			data:{
				id:id,
				act:"ding"
			},
			success:function (json){
				
				if (json.err==0){
					var dingNum=target.html();
					dingNum++;
					target.html(dingNum);
				}
			}
		});
	});
	function getPageCount(nowIndex){
		$.ajax({
			type:"get",
			url:"http://localhost/425/ajax2/msg_api.php",
			data:{
				act:"count"
			},
			success: function (data){
				
				var json = $.parseJSON(data);
				if (json.err=="0"){
					$("#page").empty();
					//分页的a 标签
					for (var i=0; i<json.count; i++){
						var linkObj = $("<a href='javascript:void(0)'>"+(i+1)+"</a>");
						$("#page").append(linkObj);
					}
					//加class
					$("#page a").eq(nowIndex).addClass("active");
				}
			}
		});
	}
	//删除
	$(document).on("click",".re",function (event){
		var target = $(event.target);
		var targetId = target.parents("li").attr("data-id");
		var lastId = $(".list li:last").attr("data-id");
//		alert(lastId);
		$.ajax({
			type:"get",
			url:"http://localhost/425/ajax2/msg_api.php",
			data:{
				id:targetId,
				last_id:lastId,
				act:"re"
			},
			dataType:"json",
			success:function (json){
//				console.log(json);
				
				getPageCount(nowIndex);
				if (json.err=="0"){
					
					var targetLi = target.parents("li");
					targetLi.animate({height:0},function (){
						targetLi.remove();
					});
					
					if (json.id){
						createLi(json.id,json.content,json.time,json.ding,json.cai,true);
					}
				}
			}
		});
	});

    //这种方式添加后来加的元素也能添加事件,否则后来添加的事件加不上
	$(document).on("click","#page a",function (evevt){
		
		var target = $(event.target);
		var targetIndex = target.index();
		
		$.ajax({
			type:"get",
			url:"http://localhost/425/ajax2/msg_api.php",
			data:{
				start_page:targetIndex,
				act:"get_msg"
			},
			success:function (data){
				var json = $.parseJSON(data);
				if (json.err=="0"){
					//成功
					$(".list").empty();
					var arr = json.data;
					for (var i=0; i<arr.length; i++){
						
						createLi(arr[i].id,arr[i].content,arr[i].time,arr[i].ding,arr[i].cai,true);
					}
					getPageCount(targetIndex);
				}
			}
		});
	});
	
});
</script>
</html>










