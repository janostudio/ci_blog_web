<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>账单明细</title>
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
        <?php 
            //var_dump ($detail);
            $str = '';
            if(count($detail["date"])>0){
                $paraday = $detail["date"][0];
                $str = '<p class="date-list">'.$paraday.'</p>';
                for($i=0;$i<count($detail["date"]);$i++){
                    if($detail["date"][$i]!=$paraday){
                        $paraday = $detail["date"][$i];
                        if($detail["inout_type"][$i]=="N"){
                            $str = $str.'<p class="date-list">'.$paraday.'</p><p class="detail-list">
                                        <span>'.$detail["account"][$i].'</span>
                                        <span>'.$detail["category_id"][$i].'</span>
                                        <span>'.number_format($detail["money"][$i],2).'</span></p>';     
                        }else{
                            $str = $str.'<p class="date-list">'.$paraday.'</p><p class="detail-list">
                                    <span>'.$detail["account"][$i].'</span>
                                    <span>'.$detail["category_id"][$i].'</span>
                                    <span class="detail-list-in">'.number_format($detail["money"][$i],2).'</span></p>'; 
                        }                    
                    }else{
                        if($detail["inout_type"][$i]=="N"){
                            $str = $str.'<p class="detail-list">
                                            <span>'.$detail["account"][$i].'</span>
                                            <span>'.$detail["category_id"][$i].'</span>
                                            <span>'.number_format($detail["money"][$i],2).'</span><i class="delete-opt iconfont icon-pa-delete"></i></p>'; 
                        }else{
                            $str = $str.'<p class="detail-list">
                                            <span>'.$detail["account"][$i].'</span>
                                            <span>'.$detail["category_id"][$i].'</span>
                                            <span class="detail-list-in">'.number_format($detail["money"][$i],2).'</span><i class="delete-opt iconfont icon-pa-delete"></i></p>'; 
                        }
    
                    }
                }
            }
            echo $str;
        ?>
        <!--<p class="date-list">2016年11月5日<span>-9000.00</span></p>
        <p class="detail-list">
            <span>支付宝</span>
            <span>衣服鞋包</span>
            <span>10007.55</span>
        </p>
        <p class="detail-list">
            <span>支付宝</span>
            <span>工资</span>
            <span class="detail-list-in">1007.55</span>
        </p>-->
    </div>
    <div style="height:72px;"></div>
    <div class="tabs">
        <a class="tab-active" href="./detail">
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
        <a  href="./me">
            <i class="iconfont icon-pa-me"></i>
            <p>设置</p>
        </a>
    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.min.js"></script>
<script>
var touchEvent={    
    /*向左滑动事件*/
    swipeLeft:function(element,fn){
        var isTouchMove, startTx, startTy;
        element.addEventListener( 'touchstart', function( e ){
            var touches = e.touches[0];
            startTx = touches.clientX;
            startTy = touches.clientY;
            isTouchMove = false;
        }, false );
        element.addEventListener( 'touchmove', function( e ){
            isTouchMove = true;
            e.preventDefault();
        }, false );
        element.addEventListener( 'touchend', function( e ){
            if( !isTouchMove ){
            return;
            }
            var touches = e.changedTouches[0],
            endTx = touches.clientX,
            endTy = touches.clientY,
            distanceX = startTx - endTx
            distanceY = startTy - endTy,
            isSwipe = false;
            if( Math.abs(distanceX) >= Math.abs(distanceY) ){
                if( distanceX > 20  ){
                    fn();       
                    isSwipe = true;
                }
            }
        }, false );	
    },
    
    /*向右滑动事件*/
    swipeRight:function(element,fn){
        var isTouchMove, startTx, startTy;
        element.addEventListener( 'touchstart', function( e ){
            var touches = e.touches[0];
            startTx = touches.clientX;
            startTy = touches.clientY;
            isTouchMove = false;
        }, false );
        element.addEventListener( 'touchmove', function( e ){
            isTouchMove = true;
            e.preventDefault();
        }, false );
        element.addEventListener( 'touchend', function( e ){
            if( !isTouchMove ){
            return;
            }
            var touches = e.changedTouches[0],
            endTx = touches.clientX,
            endTy = touches.clientY,
            distanceX = startTx - endTx
            distanceY = startTy - endTy,
            isSwipe = false;
            if( Math.abs(distanceX) >= Math.abs(distanceY) ){
                if( distanceX < -20  ){
                    fn();       
                    isSwipe = true;
                }
            }
        }, false );	
    }
    
}
</script>
<script>
var el = document.getElementsByClassName("detail-list");
$(el).each(function(){
    var ele = document.getElementsByClassName("detail-list")[0];
    touchEvent.swipeLeft(ele,function(){
        //$(this).animate({"right":"0px"},500);
        //$(".delete-opt").css("right","0px");
        alert("1");
    }) 
});
 

  
</script>
</body>
</html>