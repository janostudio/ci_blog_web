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
        <?php
            //echo $dname,$did;
            //var_dump($balance);
            $str = '';
            for($i=0;$i<count($balance['id']);$i++){
                    if($did/1111 == $balance["id"][$i]){
                        if($balance["account_type_id"]==3){
                            $str = '<div class="balance-card transfer-card bg-white" atype="'
                                .$balance["account_type_id"][$i].'" bmoney="'
                                .$balance["money_limit"][$i].'" accountid="'
                                .($did/1111).'"><i class="iconfont icon-pa-virtual"></i><p>'
                                .$balance["account_name"][$i].' </p><p>转账账户</p><input class="js-money" value="'
                                .number_format($balance["money_limit"][$i],2).'"></div>';
                        }else{
                            $str = '<div class="balance-card transfer-card bg-white" atype="'
                                .$balance["account_type_id"][$i].'" bmoney="'
                                .$balance["money_sum"][$i].'" accountid="'
                                .($did/1111).'"><i class="iconfont icon-pa-virtual"></i><p>'
                                .$balance["account_name"][$i].' </p><p>转账账户</p><input class="js-money" value="'
                                .number_format($balance["money_sum"][$i],2).'"></div>';
                        }
                    }
            }
            echo $str;
        ?>
        <!--顶部-->
        <!--<div class="balance-card bg-white">
            <i class="iconfont icon-pa-virtual"></i>
            <p> 现金</p>
            <p>转账账户</p>
            <span>0.00</span>
        </div> -->
        <p class="transfer-arrow"><span><i class="iconfont icon-pa-transferout js-arrow" iutype="out"></i></span></p>
        <div class="balance-card bg-white js-taccount">            
            <p style="text-indent:1rem;margin:9px 0px;">选择账户</p>
            <span>0.00</span>
        </div>
        <?php
            $str1='<div class="fixed-bottom bg-white js-fixed-bottom"><p>选择账户</p>';
            for($i=0;$i<count($balance['id']);$i++){
                $str1 .= '<p class="js-baccount" typeid="'
                .$balance["account_type_id"][$i].'" accountid="'
                .$balance["id"][$i].'">'
                .$balance["account_name"][$i].'<span>';
                if($balance["account_type_id"][$i]==3){
                    $str1 .= $balance["money_limit"][$i].'</span></p>';
                }else{
                    $str1 .= $balance["money_sum"][$i].'</span></p>';
                }
            }
            echo $str1.'</div>';
        ?>
        <!--<div class="fixed-bottom bg-white js-fixed-bottom">
            <p>选择账户</p>
            <p>现金<span>0.00</span></p>
        </div>
        <div class="balance-card bg-blue">
            <i class="iconfont icon-pa-deposit_card"></i>
            <p>招商银行</p>
            <p>储蓄卡</p>
            <span>0.00</span>
        </div>-->
        <div class="tabs bottom-kit js-transfer" style="z-index:-1;">
            <p>转账</p>
        </div>
    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.min.js"></script>
<script src="../../public/wechatapp/js/common.js"></script>
<script>
    var bottomheight; 
    $().ready(function(){
        bottomheight = $(".js-fixed-bottom").height();
        $(".js-fixed-bottom").css("bottom","-"+bottomheight+"px");
        $(".js-taccount").click(function(){
            $(".js-fixed-bottom").css("visibility","visible");
            $(".js-fixed-bottom").animate({"bottom":"0px"},1000);
        });
    });
    $(".js-baccount").click(function(){
        $(".js-taccount").html('<p style="text-indent:1rem;margin:9px 0px;">'+$(this).text().split(/-|\d/,1)+'</p><span btype="'+$(this).attr("typeid")+'">'+$(this).find("span").text()+'</span>');
        $(".js-taccount").attr("accountid",$(this).attr("accountid"));
        switch($(this).attr("typeid")){
            case "1":
                $(".js-taccount").removeClass().addClass("balance-card js-taccount bg-white");
            break;
            case "2":
                $(".js-taccount").removeClass().addClass("balance-card js-taccount bg-blue");
                $(".js-transfer").addClass("cl-blue");
            break;
            case "3":
                $(".js-taccount").removeClass().addClass("balance-card js-taccount bg-dblue");
                $(".js-transfer").addClass("cl-dblue");
            break;
            case "4":
                $(".js-taccount").removeClass().addClass("balance-card js-taccount bg-cyan");
                $(".js-transfer").addClass("cl-cyan");
            break;
            case "5":
                $(".js-taccount").removeClass().addClass("balance-card js-taccount bg-yellow");
                $(".js-transfer").addClass("cl-yellow");
            break;
            case "6":
                $(".js-taccount").removeClass().addClass("balance-card js-taccount bg-pink");
                $(".js-transfer").addClass("cl-pink");
            break;
            case "7":
                $(".js-taccount").removeClass().addClass("balance-card js-taccount bg-orange");
                $(".js-transfer").addClass("cl-orange");
            break;
            case "8":
                $(".js-taccount").removeClass().addClass("balance-card js-taccount bg-green");
                $(".js-transfer").addClass("cl-green");
            break;
        }
        $(".js-fixed-bottom").animate({"bottom":"-"+bottomheight+"px"},1000);
    });
    $(".js-transfer").click(function(){
        var accounta = $(".transfer-card").attr("accountid");
        var accountb = $(".js-taccount").attr("accountid");
        var money = $(".js-money").val();
        var moneya = $(".transfer-card").attr("bmoney")-money;
        var moneyb = $(".js-taccount").find("span").text()+money;
        var typea = $(".transfer-card").attr("atype");
        var typeb = $(".js-taccount").find("span").attr("btype");
        if(accountb){
            $.post("/pandoracommon/transfermoney",{money:money,a:accounta,b:accountb,moneya:moneya,moneyb:moneyb,typea:typea,typeb:typeb},function(data){
                location.href = "/pandora/balance";
            },'json');
        }
    });
    $(".js-money").click(function(){
        $(this).val("");
    });
    $(".js-money").blur(function(){
        if($(this).val()==""){
            $(this).val("0.00");
        }
    });
    $(".js-arrow").click(function(){
        if($(this).attr("iutype")=="out"){
            $(this).attr("class","iconfont icon-pa-transferin js-arrow");
            $(this).attr("iutype","in");
        }else{
            $(this).attr("class","iconfont icon-pa-transferout js-arrow");
            $(this).attr("iutype","out");
        }
    });
</script>
</body>
</html>