<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>设置</title>
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
        <a class="me-me" href="./mesetting">
            <img src="../../public/wechatapp/images/head_default.jpg" alt="头像" />
            <p>昵称</p>
            <p>一句话简介。</p>
            <i class="iconfont icon-pa-right"></i>
        </a>
        <a class="me-list">
            <i class="iconfont icon-pa-sports"></i>
            <p>导出</p>
            <i class="iconfont icon-pa-right"></i>
        </a>
        <a class="me-list">
            <i class="iconfont icon-pa-sports"></i>
            <p>反馈</p>
            <i class="iconfont icon-pa-right"></i>
        </a>


    </div>
    <div style="height:72px;"></div>
    <div class="tabs">
        <a href="./detail">
            <i class="iconfont icon-pa-detail"></i>
            <p>明细</p>
        </a>
        <a href="./balance">
            <i class="iconfont icon-pa-balance"></i>
            <p>余额</p>
        </a>
        <a href="./additem">
            <i class="iconfont icon-pa-add"></i>
        </a>
        <a href="./charts">
            <i class="iconfont icon-pa-chart"></i>
            <p>报表</p>
        </a>
        <a class="tab-active"  href="./me">
            <i class="iconfont icon-pa-me"></i>
            <p>设置</p>
        </a>
    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.slim.min.js"></script>
<script src="../../public/wechatapp/js/common.js"></script>
</body>
</html>