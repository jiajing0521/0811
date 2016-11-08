<?php 
    /*
	 * 用于向数据库存储单条记录
	 * 提交方式：get
	 * api:http://localhost/425/ajax2/msg_api.php?content=xx&act=add
	 * 参数说明:
	 * 		content   必须    留言板的内容
	 * 		act       必须    添加，固定为act=add
	 * 返回说明：
	 * 成功的		{"id":id,time:time,"err":0}
	 * 失败的		{"err":"1","msg":"插入失败"}
	 * */ 
	 
	 /*
	  * 功能说明：顶一条记录
	  * 提交方式：get
	  * api:http://localhost/425/ajax2/msg_api.php?id=xx&act=ding
	  * 参数说明：
	  * 		id   必须   id名
	  * 		act  必须   顶
	  * 
	  * 返回说明：
	  *成功： {"err":0}  	
	  *失败： {"err":1,msg:"顶失败"}
	  * 
	  * */
	  
	  /*
	   * 功能说明：删除一条记录
	   * 请求方式：get
	   * api: http://localhost/425/ajax2/msg_api.php?id=xx&last_id=xx&act=re
	   * 参数说明：
	   * 	id       必须   id名
	   * 	last_id  必须  本页中最小id
	   * 	act      必须   re(接口的处理方式)
	   * 返回说明：
	   *	 成功： {"err":0}  	
	   * 失败： {"err":1,msg:"删除失败"}
	   * */
	   
	  /*
	   * 功能说明：分页功能
	   * api:http://localhost/425/ajax2/msg_api.php?start_page&act=get_msg
	   * 返回：
	   * 成功：{"data":[{id:xx,count,xx,},{id:xx,count}],"err":0}
	   * 失败：{err:1,"msg":"xx"}
	   * */
	 
	 include_once "common.php";
	 $act = $_GET["act"];
	 switch ($act){
	 	case "add":
			//添加
			$content = $_GET["content"];
			$time = time();
			$sql = "INSERT INTO message_board(id,content,time) VALUES(null,'{$content}','{$time}')";
			$result = mysql_query($sql);
			if (mysql_insert_id()>0){
				$arr = array("id"=>mysql_insert_id(),"time"=>$time,"err"=>0);
				
				echo json_encode($arr);
			}else{
				$arr = array("err"=>1,"msg"=>"插入失败");
				
				echo json_encode($arr);
			}
			break;
		case "ding":
			$id = $_GET["id"];
			$sql = "SELECT ding FROM message_board WHERE id={$id}";
			$result = mysql_query($sql);
			$ding = mysql_fetch_row($result)[0];
			$ding++;
			$sql = "UPDATE message_board SET ding={$ding} WHERE id={$id}";
			mysql_query($sql);
			if (mysql_affected_rows()>0){
				echo '{"err":"0"}';
			}else{
				echo '{"err":"1"}';
			}
			break;
		case "re":
			//删除
			$id = $_GET["id"];//删除对象的id
			$lastId = $_GET["last_id"];
			$sql = "DELETE FROM message_board WHERE id={$id}";
			
			mysql_query($sql);
			if (mysql_affected_rows()>0){
				$sql = "SELECT * FROM message_board WHERE id<{$lastId} ORDER BY id DESC LIMIT 1";
				$result = mysql_query($sql);
				if (mysql_num_rows($result)>0){
					$row = mysql_fetch_assoc($result);
					$row["err"]="0";
					echo json_encode($row);
				}else{
					echo '{"err": "0"}';
				}
				
			}else{
				echo '{"err":"1","msg":"删除失败"}';
			}
			break;
		case "count":
			
			$sql = "SELECT COUNT(id) FROM message_board";
			$result = mysql_query($sql);
			$count = mysql_fetch_row($result)[0];
			$pageCount = ceil($count/PAGE_SIZE);
			
			echo '{"err":"0","count":"'.$pageCount.'"}';
			break;
		case "get_msg":
			
			$startPage = $_GET["start_page"];
			$start = $startPage*PAGE_SIZE+1;
			$sql = "SELECT * FROM message_board ORDER BY id DESC LIMIT {$start},".PAGE_SIZE;
			$result = mysql_query($sql);
			$arr = array();
			while($row = mysql_fetch_assoc($result)){
				$arr[] = $row;
			}
			$resultArr = array("data"=>$arr,"err"=>"0");
			echo json_encode($resultArr);
			break;
	 }
?>