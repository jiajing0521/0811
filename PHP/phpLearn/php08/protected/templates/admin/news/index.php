<div class="content-box">
            <!-- Start Content Box -->
            <div class="content-box-header">
                <h3>Content box</h3>
                <ul class="content-box-tabs">
                    <li><a href="#tab1" class="default-tab">Table</a></li>
                    <!-- href must be unique and match the id of target div -->
                    <li><a href="#tab2">Forms</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <!-- End .content-box-header -->
            <div class="content-box-content">
                <div class="tab-content default-tab" id="tab1">
                    <!-- This is the target div. id must match the href of this div's tab -->
                    <div class="notification attention png_bg"> <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                        <div> This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross. </div>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>
                                <input class="check-all" type="checkbox" />
                            </th>
                            <th>id</th>
                            <th>title</th>
                            <th>content</th>
                            <th>publishTime</th>
                            <th>set</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="bulk-actions align-left">
                                    <select name="dropdown">
                                        <option value="option1">Choose an action...</option>
                                        <option value="option2">Edit</option>
                                        <option value="option3">Delete</option>
                                    </select>
                                    <a class="button" href="#">Apply to selected</a> </div>
                                <div class="pagination" id="pageContentDiv">
                                    <?php echo $page;?>
                                </div>
                                <!-- End .pagination -->
                                <div class="clear"></div>
                            </td>
                        </tr>
                        </tfoot>
                        <tbody id="contentTbody">

                        <?php foreach ($result as $key => $value):?>

                        <tr>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td><?php echo $value['id'];?></td>
                            <td><?php echo $value['title'];?></td>
                            <td><?php echo $value['content'];?></td>
                            <td><?php echo $value['publishTime'];?></td>
                            <td>
                                <!-- Icons -->
                                <a href="<?php echo BASE_URL.'index.php?c=news&a=update&admin=1&id='.$value['id']?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
                                <a href="<?php echo BASE_URL.'index.php?c=news&a=delete&admin=1&id='.$value['id']?>" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a>  </td>
                        </tr>

                        <?php endforeach;?>

                        </tbody>
                    </table>
                </div>
                <!-- End #tab1 -->
                <div class="tab-content" id="tab2">
                    <form action="<?php echo BASE_URL.'index.php?c=news&a=add&admin=1'?>" method="post">
                        <fieldset>
                            <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <p>
                                <label>标题</label>
                                <input class="text-input small-input" type="text" id="small-input" name="title" />
                                <br />
                                <small>请输入标题</small> </p>

                            <p>
                                <label>内容</label>
                                <textarea class="text-input textarea wysiwyg" id="textarea" name="content" cols="79" rows="15"></textarea>
                            </p>
                            <p>
                                <input class="button" type="submit" value="Submit" />
                            </p>
                        </fieldset>
                        <div class="clear"></div>
                        <!-- End .clear -->
                    </form>
                </div>
                <!-- End #tab2 -->
            </div>
            <!-- End .content-box-content -->
        </div>
        <!-- End .content-box -->

<!-- 实现局部刷新的代码: -->

    <script>
        //找到触发翻页/刷新的控件----> 本工程里是<a>
         $('#pageContentDiv a').live('click', function () {

             //获取目的链接:
             var url = $(this).attr('href');
             $.ajax({
                type : "GET",//请求方式
                url : url,
                 //                data : "name=zhang&age=15"//数据
                 dataType : 'json',
                 success : function (json) {
                     var l = '';
                     for(var i=0; i < json.result.length; i++)
                     {
                         l += '<tr>';
                         l += '  <td><input type="checkbox" /></td>';
                         l += '  <td>'+json.result[i].id+'</td>';
                         l += '  <td><a href="#" title="title">'+json.result[i].title+'</a></td>';
                         l += '  <td>'+json.result[i].content+'</td>';
                         l += '  <td>'+json.result[i].publishTime+'</td>';
                         l += '  <td>';
                         l += '    <a href="index.php?c=news&a=update&admin=1&id='+json.result[i].id+'" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>';
                         l += '   <a href="index.php?c=news&a=delete&admin=1&id='+json.result[i].id+'" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a>';
                         l += '   </td>';
                         l += '</tr>';
                     }
                     //更新内容区域的html标签:
                     $('#contentTbody').html(l);
                     //更新页码html:
                     $('#pageContentDiv').html(json.page);
                 }
             });
             return false;
         });

    </script>













