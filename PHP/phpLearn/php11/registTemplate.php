<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <!-- jQuery -->
    <script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
    <!-- jQuery Configuration -->
    <script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
    <!-- Facebox jQuery Plugin -->
    <script type="text/javascript" src="resources/scripts/facebox.js"></script>
    <!-- jQuery WYSIWYG Plugin -->
    <script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
    <!-- jQuery Datepicker Plugin -->
    <script type="text/javascript" src="resources/scripts/jquery.datePicker.js"></script>
    <script type="text/javascript" src="resources/scripts/jquery.date.js"></script>
    <script>
        function checkInformation() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var confirm = document.getElementById('confirm').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;

            //正则表达式匹配:
            var regUsername = /^[a-zA-Z0-9]{6,10}$/;
            var regPassword = /^\w{6,10}$/;
            var regEmail = /^[A-Za-z0-9]\w*@\w+\.(com|cn|com\.cn)$/;
            var regPhone = /^1[34578]\d{9}$/;

            if(!regUsername.test(username))
            {
                alert("用户名格式错误");
                return;
            }else if(!regPassword.test(password))
            {
                alert("密码格式错误");
                return;
            }else if(confirm != password)
            {
                alert("两次密码不一致");
                return;
            }else if(!regEmail.test(email))
            {
                alert("邮箱格式错误");
                return;
            }else if(!regPhone.test(phone))
            {
                alert("手机号格式错误");
                return;
            }
            //检测是否已重名:
            checkUsername(username);

            return 1;
        }

        //检测用户是否被占用问题:
        function checkUsername(username) {

            var urlString = "regist.php?username="+username;

            $.ajax({
                type : "GET",
                url : urlString,
                dataType : 'json',
                success : function (json) {
                    if(json.flag > 0)
                    {
                        alert("用户名已存在,你不准用!");
                    }
                    else
                    {
                        //进行表单提交:
                        //(1)获取表单:
                        var form = document.getElementById('myForm');
                        form.submit();//执行提交-->通过预设好的方式post到逻辑文件
                    }
                }
            });

        }


    </script>
</head>
<body>
<fieldset style="width: 80%; margin-left: 10%">
    <legend>注册表单</legend>
    <!--注册内容的表单-->
    <form action="" method="post" id="myForm">
        <table align="center" border="1" cellspacing="5" cellpadding="10">
            <tr>
                <td>
                    用户名
                </td>
                <td>
                    <input type="text" name="username" id="username"><small>数字和字母的组合,6-10位</small>
                </td>
            </tr>

            <tr>
                <td>
                    密码
                </td>
                <td>
                    <input type="password" name="password" id="password"><small>数字,字母或下划线的组合,6-10位</small>
                </td>
            </tr>

            <tr>
                <td>
                    确认密码
                </td>
                <td>
                    <input type="password" name="confirm" id="confirm">
                </td>
            </tr>

            <tr>
                <td>
                    邮箱
                </td>
                <td>
                    <input type="text" name="email" id="email"><small>请输入您的常用邮箱</small>
                </td>
            </tr>

            <tr>
                <td>
                    手机号
                </td>
                <td>
                    <input type="text" name="phone" id="phone"><small>请输入您的手机号</small>
                </td>
            </tr>

            <tr>
                <td>
                    性别
                </td>
                <td>
                    <input type="radio" name="gender" id="man" value="M" checked>男
                    <input type="radio" name="gender" id="woman" value="F">女
                    <input type="radio" name="gender" id="other" value="O">未知
                </td>
            </tr>


            <tr>
                <td>
                    爱好
                </td>
                <td>
                    <input type="checkbox" name="hobby[]" id="C" value="C">C语言
                    <input type="checkbox" name="hobby[]" id="Java" value="Java">Java
                    <input type="checkbox" name="hobby[]" id="Game" value="Game">网游
                    <input type="checkbox" name="hobby[]" id="Sport" value="Sport">健身
                    <input type="checkbox" name="hobby[]" id="Learning" value="Learning" checked>学习
                </td>
            </tr>

            <tr>
                <td>
                    城市
                </td>
                <td>
                    <select id="city" name="city">
                        <option value="dl">大连</option>
                        <option value="as">鞍山</option>
                        <option value="tl">铁岭</option>
                        <option value="sy">沈阳</option>
                        <option value="yk">营口</option>
                        <option value="bx">本溪</option>
                    </select>
                </td>
            </tr>


            <tr>
                <td colspan="2" align="center">
                    <input type="button" onclick="checkInformation()" id="regist" name="regist" value="注册">
                </td>
            </tr>

        </table>
    </form>
</fieldset>
</body>
</html>