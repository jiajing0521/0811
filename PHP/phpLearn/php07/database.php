<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/15
 * Time: 09:27
 */

$link = mysqli_connect('localhost', 'root', '123456', 'blue') or die('数据路连接失败');
mysqli_select_db($link, 'blue');
mysqli_query($link, 'set names utf8');


$data = array(
    'title' => '一男子爆料',
    'content' => '一名18岁的男孩20年前遭暗杀',
);

//$result = insertFunc('test', $data);//测试插入
//$result = updateFunc('news', $data, 'id = 25');//修改测试
//$result = deleteFunc('news', 'id = 22');//删除测试
$result = selectFunc('news', '1');//测试查询

if ($result)
{
    print_r($result);
}
else
{
    echo '失败';
}

/*
 * 插入数据:
 * */
function insertFunc($table, $data = array())
{
    $keyString = '';
    $valueString = '';

    foreach ($data as $key => $value)
    {
        $keyString .= ','.$key;
        $valueString .= ',\''.$value.'\'';
    }
    $keyString = substr($keyString, 1);
    $valueString = substr($valueString, 1);

    $sql = "INSERT INTO $table ($keyString) VALUES ($valueString)";

//    echo $sql;exit();

    $query = mysqli_query($GLOBALS['link'], $sql);
    if ($query)
    {
        return true;
    }
    else
    {
        return false;
    }
}

/*
 * 修改数据:
 * */
function updateFunc($table, $data = array(), $condition)
{
    $updateString = '';

    foreach ($data as $key => $value)
    {
        $str = ','.$key.'=\''.$value.'\'';
        $updateString .= $str;
    }
    //截取开头的逗号:
    $updateString = substr($updateString, 1);

    $sql = "UPDATE $table SET $updateString WHERE $condition";
    $query = mysqli_query($GLOBALS['link'], $sql);
    if ($query)
    {
        return true;
    }
    else
    {
        return false;
    }

}

/*
 * 删除
 * */
function deleteFunc($table, $condition)
{
    $sql = "DELETE FROM $table WHERE $condition";
    $query = mysqli_query($GLOBALS['link'], $sql);
    if ($query) {
        return true;
    }
    else
    {
        return false;
    }
}

/*
 * 查询数据
 * */
function selectFunc($table, $condition)
{
    $sql = "SELECT * FROM $table WHERE $condition";
    $query = mysqli_query($GLOBALS['link'], $sql);
    $resultArray = array();
    if ($query)
    {
        while ($row = mysqli_fetch_assoc($query))
        {
            $resultArray[] = $row;
        }
        return $resultArray;//成功,返回结果集数组
    }
    else
    {
        return $resultArray;//失败,返回空数组
    }
}








