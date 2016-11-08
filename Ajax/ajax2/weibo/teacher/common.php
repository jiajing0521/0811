<?php 
    header("Content-type:text/html;charset=utf-8");
	date_default_timezone_set('PRC');
	
	mysql_connect("localhost","root","");
	mysql_select_db("0503");
	
	mysql_query("set names utf8"); 
	define("PAGE_SIZE", 5); 
?>
