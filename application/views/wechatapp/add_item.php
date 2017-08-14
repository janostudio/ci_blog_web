<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新增明细</title>
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
            <span class="chart-title-active">支出</span><span>收入</span>
        </div>
        <div class="item-opt">
            <p class="js-account"></p>
            <p class="js-date"></p>
        </div>
        <p class="item-value">
            <span class="js-special"><i class="iconfont icon-pa-fruit"></i>水果</span>
            <input type="text" class="js-fund" value="0.00"/>
        </p>
        <div class="category js-category">
<!--            这是一个demo
            <div class="single-cate">
                <i class="iconfont icon-pa-snacks"></i>
                <p>零食零食</p>
            </div>-->

        </div>

        <textarea class="item-remark js-remark" rows="3" cols="" placeholder="备注"></textarea>
        <button class="js-submit submit-btn">提交</button>
    </div>
    <!--模态窗(账户)-->
    <div class="modal-money js-modal-money">
        <div class="modal-money-box js-modal modal-add">
        </div>
    </div>
    <!--模态窗（日期）-->
    <div class="modal-money js-modal-date">
        <div class="modal-date-box">
            <div class="head-date">
                    <a class="btn js-prev">上个月</a>
                    <span><span class="js-year">2016</span>年<span class="js-month">11</span>月</span>
                    <a class="btn js-next">下个月</a>
            </div>	
            <div id="calendar">
                <p>Please enable Javascript to view this calendar.</p>
            </div>                 
        </div>
    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.min.js"></script>
<script src="../../public/wechatapp/js/jquery.calendar-widget.js"></script>
<script>
    var category = <?php echo json_encode($category) ?>;
    var account = <?php echo json_encode($account) ?>;
    var inout = "N";
    $().ready(function(){
        //加载支出品类
        add_cate("N");
        //品类第一个为默认品类
        select_cate();
        //加载账户
        add_account();
        //默认账户
        $(".js-account").text(account['accountname'][0]);
        $(".js-account").attr("value",account["accountid"][0]);
        var today = new Date();
        var month = today.getMonth()+1;
        var year = today.getYear()+1900;
        $(".js-date").text(today.getMonth()+1+'月'+today.getDate()+'日');
        $(".js-date").attr("value",year+"-"+month+"-0"+today.getDate());
        //弹窗增加今日日期
        // $(".js-date-year>span").text(1900+today.getYear());
        // $(".js-date-month>span").text(month);
        // $(".js-date-day>span").text(today.getDate());
        //载入插件日历
	    $("#calendar").calendarWidget({});
        //获取年月日
        $(".current-month").click(function(){
            var dayvalue = $(this).find(".day").text();
            var monthvalue = $(".js-month").text();
            var yearvalue = $(".js-year").text();
            $(".js-date").text(month+'月'+dayvalue+'日');
            $(".js-date").attr("value",yearvalue+"-"+monthvalue+"-"+dayvalue);
            $(".js-modal-date").hide();		
        });
    });
    //支出收入切换
    $(".js-flow-type span").click(function(){
        $(".chart-title-active").removeClass("chart-title-active");
        $(this).addClass("chart-title-active");
        if($(this).index() == 0 ){
            add_cate("N");
            inout = "N";
            select_cate();
        }else{
            add_cate("Y");
            inout = "Y";
            select_cate();
        }
    });

    //修改金额
    $(".js-account").click(function(){
        $(".js-modal-money").show();
    });
    //修改日期
    $(".js-date").click(function(){
        $(".js-modal-date").show();
    });   
	//月份切换
	$(".js-next").click(function(){
		var month = $(".js-month").text();
		var year = $(".js-year").text();
		if(parseInt(month) != 12){
			$(".js-month").text(parseInt(month)+1);
			$("#calendar").calendarWidget({
				month:parseInt(month),
				year:year
			});			
		}else{
			$(".js-month").text(1);
			$(".js-year").text(parseInt(year)+1);
			$("#calendar").calendarWidget({
				month:0,
				year:parseInt(year)+1
			});				
		}
	});
	
	$(".js-prev").click(function(){
		var month = $(".js-month").text();
		var year = $(".js-year").text();
		if(parseInt(month) != 1){
			$(".js-month").text(parseInt(month)-1);
			$("#calendar").calendarWidget({
				month:parseInt(month)-2,
				year:year
			});			
		}else{
			$(".js-month").text(12);
			$(".js-year").text(parseInt(year)-1);
			$("#calendar").calendarWidget({
				month:11,
				year:parseInt(year)-1
			});				
		}
	});
    //点击现金时，清空
    $(".js-fund").focus(function(){
        $(this).val("");
    }); 
    //提交明细
    $(".js-submit").click(function(){
        $.post("/Pandoracommon/itemadd",{money:$(".js-fund").val(),date:$(".js-date").attr("value"),book_id:"11",account_id:$(".js-account").attr("value"),inout_type:inout,category_id:$(".js-special").attr("value"),remark:$(".js-remark").val()},function(){
            alert("提交成功");
        },'json');
    });
    //添加明细
    function add_cate(yn){
        var str = '';
        for(i=0;i<category["catetype"].length;i++){
            if(category["catetype"][i] == yn){
                str += '<div class="single-cate js-single-cate" value="'+category["cateid"][i]+'" ><i class="iconfont icon-pa-'+category["icon"][i]
                    +  '" ></i><p>' +category["name"][i]
                    +  '</p></div>';
            }
        }
        str = str + '<div class="single-cate js-new-cate" value="newcate" ><i class="iconfont icon-pa-newcate" ></i><p>新增</p></div>';
        $(".js-category").html(str);      
        //绑定切换类别
        $(".js-single-cate").on("click",function(){
            var iicon = $(this).find("i").attr("class");
            var ptext = $(this).find("p").text();
            var vvalue = $(this).attr("value");
            $(".js-special").html('<i class="'+iicon+'"></i>'+ptext);
            $(".js-special").attr("value",vvalue);
        });
        //新增品类
        $(".js-new-cate").on("click",function(){
            location.href = "/pandora/addcategory";
        });
    }
    //选中品类
    function select_cate(){
        var cate_value = $(".js-single-cate:first").attr("value");
        var cate_text = $(".js-single-cate:first").find("p").text();
        var cate_icon = $(".js-single-cate:first").find("i").attr("class");
        $(".js-special").html('<i class="'+cate_icon+'"></i>'+cate_text);
        $(".js-special").attr("value",cate_value);       
    }
    //增加账户
    function add_account(){
        var str2 = '';
        for(i=0;i<account["accountname"].length;i++){
            str2 += ' <p class="js-close" value="'
                 +account["accountid"][i]
                 +'">'
                 +account["accountname"][i]
                 +'</p>'
        }
        $(".js-modal").html(str2);
        $(".js-close").on("click",function(){
            $(".js-modal-money").hide();
            $(".js-account").text($(this).text());
            $(".js-account").attr("value",$(this).attr("value"));
        });  
    }
</script>
</body>
</html>