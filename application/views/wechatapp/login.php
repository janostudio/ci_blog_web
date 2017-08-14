<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录</title>
    <!--屏幕与设备1：1，不用于放大查看-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--忽略讲数字识别为代码-->
	<meta name="format-detection" content="telephone=no">
    <!--safari私有标签，允许全屏-->
	<meta name="apple-mobile-web-app-capable" content="yes">
    <!--iphone私有标签，顶部颜色样式-->
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!--添加到桌面时有圆角-->
    <!--<link rel="apple-touch-icon-precomposed" href="./build/img/icon.png" />-->
    <!--不带高光显示-->
    <link rel="apple-touch-startup-image" href="" />  
    <!--IOS桌面，有圆角-->
    <link rel="apple-touch-icon" href="../../public/wechatapp/images/logo.png" />
    <!--Android桌面，有圆角-->
    <link rel="apple-touch-icon-precomposed" href="../../public/wechatapp/images/logo.png" />     
<!--	<meta http-equiv="expires" content="0">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache"> 不允许脱机预览-->
	<link rel="stylesheet" type="text/css" href="../../public/wechatapp/css/standard.css">
    <link rel="stylesheet" type="text/css" href="../../public/wechatapp/css/iconfont/iconfont.css">    	    
	<link rel="stylesheet" type="text/css" href="../../public/wechatapp/css/main.css">	
    <style>
        body{
            background:url("../../public/wechatapp/images/login-bg.jpg") no-repeat;
            background-size:cover;
        }
    </style>
</head>
<body>	
    <div class="main-content">	

        <form action="/Pandoracommon/verification" method="post" >
            <div class="login-box">
                <input type="text" class="js-name" name="name" required="required" placeholder="账号" />
                <input type="password" class="js-pwd" name="pwd" required="required" placeholder="密码" />
                <input type="checkbox" id="checkbox-10-1" /><label for="checkbox-10-1"></label>
                <a>忘记密码</a>           
                <button type="submit" class="js-btn">登录</button>
                <p class="js-register">点击这里注册</p>
            </div>            
        </form>
    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.slim.min.js"></script>
<script src="../../public/wechatapp/js/common.js"></script>
<script>
    $().ready(function(){
        if(localStorage.getItem("pandoraname")){
            $("#checkbox-10-1").prop("checked",true);
            $(".js-name").val(localStorage.getItem("pandoraname"));
            $(".js-pwd").val(localStorage.getItem("pandorapwd"));
        }
    });
    $(".js-register").click(function(){
        location.href="./pandora/register";
    });
    $("#checkbox-10-1").click(function(){
        if($("#checkbox-10-1").is(":checked")){
            localStorage.setItem("pandoraname", $(".js-name").val());
            localStorage.setItem("pandorapwd", $(".js-pwd").val());
        }else{
            localStorage.removeItem("pandoraname");
            localStorage.removeItem("pandorapwd");
        }
    });
</script>
</body>
</html>