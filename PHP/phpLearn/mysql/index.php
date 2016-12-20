
<?php
//验证登录:

session_start();
if (empty($_SESSION['username']))
{
    //不存在则返回登录界面:
    header('location:http://localhost/phpLearn/mysql/login.php');
}

$link = mysqli_connect('localhost', 'root', '123456', '0922_test') or die('数据库连接失败');
mysqli_select_db($link,'0922_test');


$per_page = 3;//每页个数
$cur_page = !empty($_GET['p']) ? $_GET['p'] : 1;
$offset = ($cur_page - 1) * $per_page;
$sql = "select * from news ORDER BY id DESC limit $offset,$per_page";
$query = mysqli_query($link, $sql);
$result = array();
if ($query)
{
    while ($row = mysqli_fetch_assoc($query))
    {
        $result[] = $row;
    }
}
$page = getPage($link, 'news', 'index.php', $cur_page, $per_page, 5);
viewFun('templates/index', array(
    'result' => $result,
    'page' => $page
));






//分页显示
#cur_page表示当前是第几页
#per_page表示每页显示的新闻数量
#$page_num 表示显示页标的个数,默认五个
function getPage($link, $table, $url, $cur_page, $per_page, $page_num)
{
    $floor_page = floor($page_num / 2);

    //查询数据库数据总数:
    $sql = "select count(*) as total from $table";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($query);
    $total = $row['total'];//数据总数
    $total_page = ceil($total / $per_page);//总页数

    //起始页和结束页:
    $start_page = $cur_page - $floor_page;//开始页
    $end_page = $cur_page + $floor_page;//结束页

    if ($start_page < 1)
    {
        $start_page = 1;//开始页不能小于1
        $end_page = $page_num;//结束页为每页总数
    }
    if ($end_page > $total_page)
    {
        $start_page = $total_page - $page_num + 1;
        $end_page = $total_page;
    }
    if ($total_page < $page_num)
    {
        $start_page = 1;
        $end_page = $total_page;//固定这些页
    }
    //得到页码:
    $page = '';
//首页:
    $page .= '<a href="'.$url.'?p=1" class="number" title="1">首页</a>';

//上一页:
    if ($cur_page != 1)
    {
        $pre_page = $cur_page - 1;
        $page .= '<a href="'.$url.'?p='.$pre_page.'" class="number" title="'.$pre_page.'">上一页</a>';
    }
//上五页
    $pre_page_5 = $cur_page - $page_num;
    if ($pre_page_5 > 0)
    {
        $page .= '<a href="'.$url.'?p='.$pre_page_5.'" class="number" title="'.$pre_page_5.'">上五页</a>';
    }
//中部页码部分
    for ($i = $start_page; $i <= $end_page; $i++)
    {
        if ($i == $cur_page)
        {
            $page .= '<a href="'.$url.'?p='.$i.'" class = "number current">'.$i.'</a>';
        }
        else
        {
            $page .= '<a href="'.$url.'?p='.$i.'" class = "number">'.$i.'</a>';
        }
    }
//下五页
    $next_page_5 = $cur_page + $page_num;
    if ($next_page_5 <= $total_page)
    {
        $page .= '<a href="'.$url.'?p='.$next_page_5.'" class="number" title="'.$next_page_5.'">下五页</a>';
    }

//下一页:
    if ($cur_page != $total_page)
    {
        $next_page = $cur_page + 1;
        $page .= '<a href="'.$url.'?p='.$next_page.'" class = "number">下一页</a>';
    }

//尾页:
    $page .= '<a href="'.$url.'?p='.$total_page.'" class = "number">尾页</a>';

    return $page;
}


//include "templates/index.php";


function viewFun($view, $data = array())
{
//    foreach ($data as $key=>$value)
//    {
//        //key就是变量名,value就是相关值
//        $$key = $value; //假设$key = 'result',那么$$key就是$result, 相当于动态声明一个变量
//    }
    extract($data);
    include "$view.php";
}
