<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 16/11/4
 * Time: 上午11:01
 */

require_once "DB_CONNECT.php";


//type的值:submit是提交发布操作,lkAtc是点赞或踩操作,pageUpdate是分页操作,remove是删除操作,getCount是获取数据库总件数

if (isset($_POST["type"])){
    $type = $_POST["type"];
    switch ($type){

        //点击发布
        //method:post
        //参数;{type: "submit", content: "hgskh"}
        //返回值:{"err": 0, "time":"2016-11/3 00:00"}
        case "submit":
            //获取前端传的参数内容
            $content = $_POST["content"];
            //获取当前时间,并转换格式,用来更新数据库,并返给前端显示
            $time = time();
            $date = date("Y-m-d H:i",$time);
            //执行向数据库参入一条
            $count = $pdo->exec("INSERT INTO weibo (id,content,time,liked,unlike) VALUE (NULL,'{$content}','{$time}',0,0)");
            //最后插入的id,用来返给前端的li的属性data-id
            $id = $pdo->lastInsertId();
            if ($count > 0){
                echo json_encode(array("err"=>0,"time"=>$date,"id"=>$id));
            }else{
                echo ('{"err":1, "msg": "插入失败,请检查SQL语句"}');
            }
            break;
        case "lkAct":

            //点击点赞或点踩
            //method:post
            //参数;{type: "submit", id: "data-id",lkType:liked/unlike,lkValue:5222}
            //获取更新数据的id
            $id = $_POST["id"];
            //选中的点赞或点踩,liked/unlike
            $lkType = $_POST["lkType"];
            //点赞或踩的数值 +1后进行DB更新,并返回前端显示
            $lkValue = $_POST["lkValue"]+1;

            //执行向数据库更新语句
            $sql = "UPDATE weibo SET {$lkType} = '{$lkValue}' WHERE id = '{$id}' ";
            $count = $pdo->exec($sql);

            if ($count > 0){
                echo '{"err":0,"msg":"更新成功","lkValue":"'.$lkValue.'"}';
            }else{
                echo '{"err":1,"msg":"更新失败"}';
            }

            break;
        case "pageUpdate":

            //点击分页
            //method:post
            //参数;{type: "pageUpdate", pageID: 0/1~4...}

            //获取当前点击的pageID
            $pageID = $_POST["pageID"];
            //LIMIT起始位置 id*5
            $start = $pageID*5;

            $sql = "SELECT * FROM weibo ORDER BY time DESC LIMIT {$start}, 5";
            $result = $pdo->query($sql);
            $arr = $result->fetchAll(PDO::FETCH_ASSOC);

            //更新返回数据的时间格式
            for ($i = 0; $i < count($arr); $i++){
                $date = $arr[$i]["time"];
                $arr[$i]["time"] = date("Y-m-d H:i",$date);
            }
            $str = json_encode($arr);

            if (count($arr) > 0){
                echo '{"err":0,"msg":"更新成功","count": '.count($arr).',"item":'.$str.'}';
            }else{
                echo '{"err":1,"msg":"更新失败"}';
            }

            break;
        case "remove":

            //点击删除
            //method:post
            //参数;{type: "remove", id: data-id, pageID: 0/1~4...}

            //获取删除数据的id
            $id = $_POST["id"];
            $count = $pdo->exec("DELETE FROM weibo WHERE id = {$id}");

            if($count > 0){
                //获取当前的页脚下标
                $pageID = $_POST["pageID"];
                //LIMIT起始位置 id*5
                $start = $pageID*5;

                $sql = "SELECT * FROM weibo ORDER BY time DESC LIMIT {$start}, 5";
                $result = $pdo->query($sql);
                $arr = $result->fetchAll(PDO::FETCH_ASSOC);

                //更新返回数据的时间格式
                for ($i = 0; $i < count($arr); $i++){
                    $date = $arr[$i]["time"];
                    $arr[$i]["time"] = date("Y-m-d H:i",$date);
                }
                $str = json_encode($arr);

                echo '{"err":0,"msg":"删除成功","count": '.count($arr).',"item":'.$str.'}';

            }else{
                echo '{"err":1,"msg":"删除失败"}';
            }
            break;
        case "getCount":

            //每次点击添加或者删除,都应该更新一下数据库总件数,返回前端重新显示页脚下标
            $count = $pdo->query("SELECT count(id) FROM weibo");
            $countArr= $count->fetchAll(PDO::FETCH_ASSOC);
            //强制转成数值型
            $counts =  (int)$countArr[0]["count(id)"];
            //对5取余,如果等于零,除以5取整数,为最终的总页数
            if ($counts%5==0){
                $pages = $counts/5;
                //如果不等于零,除以5后向上取整,为最终的总页数,返回给前端
            }else{
                $pages = ceil($counts/5);
            }
            if ($pages > 0){
                echo '{"err":0,"msg":"获取成功","pages":'.$pages.'}';
            }else{
                echo '{"err":1,"msg":"获取失败"}';
            }
            break;
        default:
            die('{"err":1, "msg": "type参数错误"}');
            break;
    }
}

