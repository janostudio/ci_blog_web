<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>账户详情</title>
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
</head>
<body style="background-color:#f5f5f5;">	
    <div class="main-content">
        <a class="normal-list bg-white list-input">
            <p>账户名</p>
            <input class="js-name" type="text">
        </a>
        <a class="normal-list bg-white list-input">
            <p>余额</p>
            <input class="js-balance" type="text">
        </a>
        <a class="normal-list bg-white list-input">
            <p>备注</p>
            <input class="js-remark" type="text">
        </a>
        <?php
            $str='';
            switch($value){
                case 1:
                    $str .= '<button class="normal-btn bg-white" value="'.$value.'" >添加</button>';
                break;
                case 2:
                    $str .= '<button class="normal-btn bg-blue" value="'.$value.'" >添加</button>';
                break;
                case 3:
                    $str .= '<button class="normal-btn bg-dblue" value="'.$value.'" >添加</button>';
                break;
                case 4:
                    $str .= '<button class="normal-btn bg-cyan" value="'.$value.'" >添加</button>';
                break;
                case 5:
                    $str .= '<button class="normal-btn bg-yellow" value="'.$value.'" >添加</button>';
                break;
                case 6:
                    $str .= '<button class="normal-btn bg-pink" value="'.$value.'" >添加</button>';
                break;
                case 7:
                    $str .= '<button class="normal-btn bg-orange" value="'.$value.'" >添加</button>';
                break;
                case 8:
                    $str .= '<button class="normal-btn bg-green" value="'.$value.'" >添加</button>';
                break;
            }
            echo $str;
         ?>

    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.min.js"></script>
<script src="../../public/wechatapp/js/common.js"></script>
<script>
    $().ready(function(){
        $(".js-name").focus();
    });
    //提交新账号
    $(".normal-btn").click(function(){
        var name = $(".js-name").val();
        var balance = $(".js-balance").val();
        var value = $(this).attr("value");
        var remark = $(".js-remark").val();
        if(name != "" && balance!=""){
          $.post("/pandoracommon/accountadd",{name:name,balance:balance,value:value,remark:remark},function(data){
              location.href = "/pandora/balancestatic";
          },'json');  
        }        
    });
</script>
</body>
</html>