<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>报表</title>
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
<body>	
    <div class="main-content">	
        <div class="chart-cate js-chart-cate">
            <span class="chart-title-active">分类</span>
            <span>趋势</span>
            <span>对比</span>
            <span>成员</span>
        </div>
        <p class="chart-time js-time">
            <i class="iconfont icon-pa-left js-minus"></i>
            <span class="js-year">2016</span>
            年
            <span class="js-month">11</span>
            月
            <i class="iconfont icon-pa-right js-add"></i>
        </p>
        <div class="item-cate js-flow-type">
            <span class="chart-title-active" atype="N">支出</span><span atype="Y">收入</span>
        </div>
        <div id="sumchart" style="height:300px;"></div> 
        <div id="barchart" style="height:60px;border-radius:5px;margin:5px;"></div>
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
        <a class="tab-active" href="/charts">
            <i class="iconfont icon-pa-chart"></i>
            <p>报表</p>
        </a>
        <a  href="./me">
            <i class="iconfont icon-pa-me"></i>
            <p>设置</p>
        </a>
    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.min.js"></script>
<script src="../../public/wechatapp/js/echarts.common.min.js"></script>
<script>
    var valuedata,legenddata;
    $().ready(function(){
        legenddata = ['水果','零食','虚拟产品','数码','其他'];
        valuedata = [
                        {value:335, name:'水果'},
                        {value:310, name:'零食'},
                        {value:234, name:'虚拟产品'},
                        {value:135, name:'数码'},
                        {value:1548, name:'其他'}
                    ];
        drawpiechart(valuedata,legenddata);
    });
    //收支切换
    $(".js-flow-type span").click(function(){
        $(".chart-title-active").removeClass("chart-title-active");
        $(this).addClass("chart-title-active");
    });
    //图标切换
    $(".js-chart-cate span").click(function(){
        $(".chart-title-active").removeClass("chart-title-active");
        $(this).addClass("chart-title-active");
        var charttype = $(this).index();
        switch(charttype){
            case 0:
                $(".js-time").slideDown();
                $(".js-flow-type").slideDown();
                $("#sumchart").fadeIn();
                $("#barchart").fadeOut();
                drawpiechart(valuedata,legenddata);
            break;
            case 1:
                $(".js-time").slideUp();
                $(".js-flow-type").slideUp();
                $("#sumchart").fadeIn();
                $("#barchart").fadeOut();
                drawlinechart();
            break;
            case 2:
                $(".js-time").slideUp();
                $(".js-flow-type").slideUp();
                $("#sumchart").slideUp();
                $("#barchart").fadeIn();
                drawbarchart();
            break;
            case 3:
                drawpiechart(valuedata,legenddata);
            break;
        }
    });
    //更改年月
    $(".js-add").click(function(){
        var month = parseInt($(".js-month").text());
        var year = parseInt($(".js-year").text());
        if(month=="12"){
            $(".js-month").text("1");
            $(".js-year").text(year+1);
        }else{
            $(".js-month").text(month+1);
        }
    }); 
    $(".js-minus").click(function(){
        var month = parseInt($(".js-month").text());
        var year = parseInt($(".js-year").text());
        if(month=="1"){
            $(".js-month").text("12");
            $(".js-year").text(year-1);
        }else{
            $(".js-month").text(month-1);
        }
    });
    //分类统计
    function drawpiechart(valuedata,legenddata){
        var sumchart = echarts.init(document.getElementById('sumchart')); 
        var option = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                //orient: 'vertical',
                bottom: '0%',
                data: legenddata
            },
            series : [
                {
                    name: '月支出品类',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '50%'],
                    data:valuedata,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ],
            color : ["#80bfeb","#8bc7bf","#e8c77f","#da9cc7","#dea67c","#92e587","#87aee2"]
        };
        sumchart.setOption(option); 
    }
    //趋势图
    function drawlinechart(){
        var linechart = echarts.init(document.getElementById('sumchart'));
        var option = {
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['支出','收入','结余']
                },
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data : ['Jun','Jul','Aug','Sep','Oct','Nov']
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'支出',
                        type:'line',
                        smooth:true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[12, 21, 54, 260, 830, 710]
                    },
                    {
                        name:'收入',
                        type:'line',
                        smooth:true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[182, 434, 791, 390, 30, 10]
                    },
                    {
                        name:'结余',
                        type:'line',
                        smooth:true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[1132, 601, 234, 120, 90, 20]
                    }
                ],
                 color : ["#80bfeb","#8bc7bf","#e8c77f","#da9cc7","#dea67c","#92e587","#87aee2"]
            };
            linechart.setOption(option);     
    }
    //统一品类对比图
    function drawbarchart(){
        var barchart = echarts.init(document.getElementById('barchart'));
        var option = {
                grid: {
                    left: 50,
                    right: 100,
                },
                backgroundColor:'#80bfeb',
                xAxis: {
                    type: 'value',
                    show:false
                },
                yAxis: {
                    type: 'category',
                    data: ['9月','10月','11月'],
                    axisLine: {show: false},
                    axisTick: {show: false},
                    splitLine: {show: false},
                    axisLabel:{
                        textStyle:{
                            color: '#fff'
                        }
                    }
                },
                series: [
                    {
                        name: '交通',
                        type: 'bar',
                        itemStyle : { 
                            normal: {
                                label : 
                                    {
                                        show: true, 
                                        position: 'right'                                        
                                    },
                                barBorderRadius: 5, 
                            },
                            
                        },
                        barWidth:8,
                        data: [193, 234, 310]
                    }
                ],
                 color : ["#fff"]
            };
            barchart.setOption(option);
    }
</script>
</body>
</html>