<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/15
 * Time: 上午9:28
 */

$link = mysqli_connect('127.0.0.1','root','123456','blue') or die('数据库连接失败');
mysqli_select_db($link, 'blue');
mysqli_query($link, 'set names utf8');



//$data = array(
//    'title' => '一男子爆料',
//    'content' => '一名18岁的男孩20年前遭暗杀',
//    'publishTime' => '1998-04-12'
//);

// 测试插入
//$result = insertFunc('test', $data);

// 测试修改
//$result = updateFunc('news', $data, 'id=25');

// 测试删除
//$result = deleteFunc('news', 'id=22');

//$result = selectFunc('news','1');
//if ($result) {
//    print_r($result);
//} else {
//    echo '失败';
//}

//updateFunc('test', $data);


/*
 * 插入数据:
 * */
function insertFunc($table, $data = array()){

    $keyString = '';
    $valueSrting = '';

    foreach ($data as $key => $value) {
        $keyString = $keyString.$key.',';
        $valueSrting = $valueSrting.'\''.$value.'\''.',';

    }
    $keyString = substr($keyString, 0, strlen($keyString) - 1);
    $valueSrting = substr($valueSrting, 0, strlen($valueSrting) - 1);

    $sql = "INSERT INTO $table($keyString)VALUES($valueSrting)";
//    echo $sql;exit();
    $query = mysqli_query($GLOBALS['link'], $sql);
    if ($query) {
        return true;
    } else {
        return false;
    }
}

/*
 * 修改数据:
 * */
function updateFunc($table,$data = array(), $condition){

    $updateString = '';

    foreach ($data as $key => $value) {
        $updateString = $updateString.$key."='".$value."',";
    }
    $updateString = substr($updateString, 0, strlen($updateString) - 1);

    $sql = "UPDATE $table SET $updateString WHERE $condition";

    $query = mysqli_query($GLOBALS['link'], $sql);
    if ($query) {
        return true;
    } else {
        return false;
    }
}

/*
 * 删除
 * */
function deleteFunc($table, $condition){
    $sql = "DELETE FROM $table WHERE $condition";
    $query = mysqli_query($GLOBALS['link'],$sql);
    if ($query) {
        return true;
    } else {
        return false;
    }
}

/*
 * 查询数据
 * */
function selectFunc($table, $condition){
    $sql = "SELECT * FROM $table WHERE $condition";
    $query = mysqli_query($GLOBALS['link'], $sql);
    $resultArray = array();
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)){
            $resultArray[] = $row;
        }
        return $resultArray;//成功,返回结果集数组
    } else {
        return $resultArray;//失败,返回空数组
    }
}
