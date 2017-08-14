<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新增品类</title>
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
        <div class="item-cate js-flow-type">
            <span class="chart-title-active" atype="N">支出</span><span atype="Y">收入</span>
        </div>
        <div class="bg-white newcate">
            <p><i class="iconfont icon-pa-fruit" id="showicon"></i></p>
            <input type="text" class="js-name" placeholder="类别名"/>
        </div>
        <div class="category js-category box-border">
            <div class="single-cate">
                <i class="iconfont icon-pa-snacks"></i>
                <p>零食零食</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-other"></i>
                <p>其他</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-food"></i>
                <p>餐饮</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-traffic"></i>
                <p>交通</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-fruit"></i>
                <p>水果</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-maicai"></i>
                <p>买菜</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-clothing"></i>
                <p>服饰</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-shyp"></i>
                <p>生活用品</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-call"></i>
                <p>话费</p>
            </div>

            <div class="single-cate">
                <i class="iconfont icon-pa-shoe"></i>
                <p>鞋子</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-bag"></i>
                <p>包包</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-beauty"></i>
                <p>护肤彩妆</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-rent"></i>
                <p>房租</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-entertainment"></i>
                <p>娱乐</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-medician"></i>
                <p>医药</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-redenvelope"></i>
                <p>红包</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-electric"></i>
                <p>电子产品</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-virtual"></i>
                <p>虚拟产品</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-digit"></i>
                <p>数码</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-book"></i>
                <p>书籍</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-salary"></i>
                <p>工资</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-shenghuojiaofei"></i>
                <p>生活费</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-cash"></i>
                <p>零花钱</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-ptjob"></i>
                <p>外快兼职</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-award"></i>
                <p>奖金</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-baoxiao"></i>
                <p>报销</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-yue"></i>
                <p>现金</p>
            </div>
            <div class="single-cate">
                <i class="iconfont icon-pa-refund"></i>
                <p>退款</p>
            </div>
            <div style="clear:both;"></div>
        </div>
        <p><button class="js-submit submit-btn">新增</button></p>        
    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.min.js"></script>
<script src="../../public/wechatapp/js/jquery.calendar-widget.js"></script>
<script>
    var atype = "N";
    var aicon = "fruit";
    $(".js-flow-type span").click(function(){
        $(".chart-title-active").removeClass("chart-title-active");
        $(this).addClass("chart-title-active");
        var atype = $(this).attr("atype");
    });
    $(".single-cate").click(function(){
        var icon = $(this).find("i").attr("class");
        $("#showicon").attr("class",icon);
        abicon = $(this).find("i").attr("class").split("-",3);
        aicon = abicon[2];
    });
    $(".js-submit").click(function(){
        aname = $(".js-name").val();
        if(aname!=""){
            $.post("/pandoracommon/addcate",{name:aname,icon:aicon,type:atype},function(data){
                window.location.reload();
            },'json');
        }
    });
</script>
</body>
</html>