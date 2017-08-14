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
        <a class="normal-list bg-white js-card">
            <i class="iconfont icon-pa-cash"></i>
            <p>现金</p>
            <i class="iconfont icon-pa-right"></i>
        </a>
        <a class="normal-list bg-blue js-card">
            <i class="iconfont icon-pa-deposit_card"></i>
            <p>储蓄卡</p>
            <i class="iconfont icon-pa-right"></i>
        </a>
        <a class="normal-list bg-dblue js-card">
            <i class="iconfont icon-pa-credit_card"></i>
            <p>信用卡</p>
            <i class="iconfont icon-pa-right"></i>
        </a>
        <a class="normal-list bg-cyan js-card">
            <i class="iconfont icon-pa-network_account"></i>
            <p>网络账户</p>
            <i class="iconfont icon-pa-right"></i>
        </a>
        <a class="normal-list bg-yellow js-card">
            <i class="iconfont icon-pa-investment"></i>
            <p>投资账户</p>
            <i class="iconfont icon-pa-right"></i>
        </a>
        <a class="normal-list bg-pink js-card">
            <i class="iconfont icon-pa-pre_paid"></i>
            <p>储值卡</p>
            <i class="iconfont icon-pa-right"></i>
        </a> 
        <a class="normal-list bg-orange js-card">
            <i class="iconfont icon-pa-debt"></i>
            <p>应收帐</p>
            <i class="iconfont icon-pa-right"></i>
        </a>
        <a class="normal-list bg-green js-card">
            <i class="iconfont icon-pa-loan"></i>
            <p>应付帐</p>
            <i class="iconfont icon-pa-right"></i>
        </a>

    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.min.js"></script>
<script src="../../public/wechatapp/js/common.js"></script>
<script>
    $(".js-card").click(function(){
        var value = $(this).index()+1;
        location.href = "/pandora/balancenewdetail?value="+value;
    });
</script>
</body>
</html>