<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>注册</title>
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
        <from actoin="" method="post">
            <div class="login-box">
                <input type="text" id="nickname" name="nickname" placeholder="昵称(以后的登陆账户名)" />
                <input type="text" id="phone" name="phone" placeholder="手机号" />
                <p class="error js-phone-error1">手机号错误！</p>
                <p class="error js-phone-error2">手机号已存在！</p>
                <input type="password" id="pwd" name="pwd" placeholder="密码" /> 
                <p class="error js-pwd-error">密码最短6位！</p>
                <input type="password" id="pwd-second" name="pwd-second" placeholder="请再次密码" />    
                <p class="error js-pwd-second-error">两次密码不一样！</p>
                <div class="input-btn">
                    <input type="text" class="js-varinum" placeholder="验证码" />
                    <button class="js-varibtn" >验证码</button>
                </div>  
                <button class="js-regist">注册</button>
            </div>            
        </form>
    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.min.js"></script>
<script>
    var phone_number ,pwd ,code_flag=0,code;
    //手机号是否重复，正确
    $("#phone").blur(function(){
        var reg = /^1[3|5|8][0-9]\d{4,8}$/;
        if($("#phone").val().length == 11&& reg.test($("#phone").val())==true){
            $(".js-phone-error1").hide();
            $.post("/Pandoracommon/phonevarify",{'phone':$("#phone").val()},function(data){
                if(data==true){
                    $(".js-phone-error2").hide();
                    phone_number = $("#phone").val();
                }else{
                    $(".js-phone-error2").show();    
                }
            },'json');
        }else{
            $(".js-phone-error1").show();
        }
    });
    //两次密码是否一致，最短6位
    $("#pwd-second").blur(function(){
        if($("#pwd").val().length < 6){
            $(".js-pwd-error").show();
        }else{
            $(".js-pwd-error").hide();

            if($("#pwd-second").val()==$("#pwd").val()){
                $(".js-pwd-second-error").hide();
                pwd = $("#pwd").val();
            }else{
                $(".js-pwd-second-error").show();
            }
        }

    });
    //注册账号
    $(".js-regist").click(function(){             
        if(pwd != null && phone_number != null && $("#nickname").val() != "" && code != null && $(".js-varinum").val()!=""){
           $.post("/Pandoracommon/regist",{'pwd': pwd,'name':$("#nickname").val(),'phone':phone_number,'code':code,'usercode':$(".js-varinum").val()},function(data){
                if(data){
                    location.href = "/Pandora";
                }                
            },'json');
        }
    });
    //获取验证码
    $(".js-varibtn").click(function(){
        if(phone_number!=null && code_flag==0){
            $.post("/Pandoracommon/sendtoali",{'phone':phone_number},function(data){
                $(".js-varibtn").html('<span class="js-interval">120</span>s');
                $(".js-varibtn").addClass("waittime");
                setInterval('intervalsec($(".js-interval").text())',1000);
                code = data;
            });
            code_flag=1;
        }
         
    });
    //时间-1s
    function intervalsec(sec){
        if(sec==0){
            $(".js-varibtn").html('验证码');
            $(".js-varibtn").removeClass("waittime");
            code_flag=0;
            window.clearTimeout();
        }else{
            sec = sec-1;
            $(".js-interval").text(sec);
        }
    }
</script>
</body>
</html>