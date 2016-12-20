<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
    <!-- jQuery Configuration -->
    <script type="text/javascript" src="scripts/simpla.jquery.configuration.js"></script>
    <!-- Facebox jQuery Plugin -->
    <script type="text/javascript" src="scripts/facebox.js"></script>
    <!-- jQuery WYSIWYG Plugin -->
    <script type="text/javascript" src="scripts/jquery.wysiwyg.js"></script>
    <!-- jQuery Datepicker Plugin -->
    <script type="text/javascript" src="scripts/jquery.datePicker.js"></script>
    <script type="text/javascript" src="scripts/jquery.date.js"></script>
    <script>
        function checkInformation() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var confirm = document.getElementById('confirm').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            //正则表达式:
            var regUsername = /^[a-zA-Z0-9]{6,10}$/;
            var regPassword = /^\w{6,10}$/;
            var regEmail = /^[A-Za-z0-9]\w*@\w+\.(com|cn|com\.cn)$/;
            var regPhone = /^1[34578]\d{9}$/;
            if(!regUsername.test(username))
            {
                alert("用户名格式错误");
                return;
            }
            //调用检测重名方法:
            //allow是一个标识符:
            var allow = checkUsername();
            if(!regPassword.test(password))
            {
                alert("密码格式错误");
                return;
            }
            if(confirm != password)
            {
                alert("两次密码不一致");
                return;
            }
            if(!regEmail.test(email))
            {
                alert("邮箱格式不正确");
                return;
            }
            if(!regPhone.test(phone))
            {
                alert("手机号码格式不正确");
                return;
            }

            //注册数据都合理,做数据的提交:
            var gender = "";
            var man = document.getElementById('man');
            var woman = document.getElementById('woman');
            var other = document.getElementById('other');
            if(man.checked)
            {
                gender = man.value;
            }
            if(woman.checked)
            {
                gender = woman.value;
            }
            if(other.checked)
            {
                gender = other.value;
            }

            //获取爱好:
            var hobbies = getHobbies();
            var city = getCity();
            var form = document.getElementById('myForm');
            form.submit();
        }


        //获取爱好的函数:
        function getHobbies() {
            var hobbies = document.getElementsByName('hobby[]');
            var resultString = "";
            for(var i = 0; i < hobbies.length; i++)
            {
                if (hobbies[i].checked)
                {
                    resultString += hobbies[i].value + " ";
                }
            }
//            document.write(resultString);
            return resultString;
        }


        function getCity() {
            var city = "";
            var cities = document.getElementById('city');
            for(var i = 0; i < cities.length; i++)
            {
                if(cities[i].checked)
                {
                    city = cities[i].text;
                }
            }
            return city;
        }



        function checkUsername() {

            var username = document.getElementById('username').value;
            if(username == "")
            {
                alert("用户名不能为空!");
                return 0;
            }
            //检测是否存在这个用户名
            //将用户名传给后台php文件进行是否存在的验证

            var urlString = 'checkName.php?username='+username;
            var allow = 0;
            $.ajax({
                type : "GET",
                url : urlString,
                dataType : 'json',
                success : function (json) {
                    if(json.flag)
                    {
                        allow = 0;
                    }
                    else
                    {
                        allow = 1;
                    }
                }
            });
            return allow;
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
                    <input type="radio" name="gender" id="man" value="male" checked>男
                    <input type="radio" name="gender" id="woman" value="female">女
                    <input type="radio" name="gender" id="other" value="unknown">未知
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