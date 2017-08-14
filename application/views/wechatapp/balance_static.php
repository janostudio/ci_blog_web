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
        <!--顶部-->
        <?php 
            //var_dump ($change);
            //echo $change["month"];
            $str = '';
            $str1 = '';
            switch($change["account_type_id"]){
                case 1:
                    $str = '<div class="account-title bg-white"><p class="js-money">'
                        .number_format($change["money_sum"],2).'<i class="iconfont icon-pa-edit"></i></p><p>'
                        .$change["account_name"].'余额</p>';
                    $str1 = '<div style="height:42px;"></div><div  class="tabs bottom-kit js-transfer"><p>转账</p></div>';
                    break;
                case 2:
                    $str = '<div class="account-title bg-blue"><p class="js-money">'
                        .number_format($change["money_sum"],2).'<i class="iconfont icon-pa-edit"></i></p><p>'
                        .$change["account_name"].'余额</p>';
                    $str1 = '<div style="height:42px;"></div><div  class="tabs bottom-kit cl-blue js-transfer"><p>转账</p></div>';
                    break;
                case 3:
                    $str = '<div class="account-title bg-dblue"><p class="js-money">'
                        .number_format($change["money_limit"],2).'<i class="iconfont icon-pa-edit"></i></p><p>'
                        .$change["account_name"].'余额</p>';
                    $str1 = '<div style="height:42px;"></div>';
                    break;
                case 4:
                    $str = '<div class="account-title bg-cyan"><p class="js-money">'
                        .number_format($change["money_sum"],2).'<i class="iconfont icon-pa-edit"></i></p><p>'
                        .$change["account_name"].'余额</p>';
                    $str1 = '<div style="height:42px;"></div><div  class="tabs bottom-kit cl-cyan js-transfer"><p>转账</p></div>';
                    break;
                case 5:
                    $str = '<div class="account-title bg-yellow"><p class="js-money">'
                        .number_format($change["money_sum"],2).'<i class="iconfont icon-pa-edit"></i></p><p>'
                        .$change["account_name"].'余额</p>';
                    $str1 = '<div style="height:42px;"></div><div  class="tabs bottom-kit cl-yellow js-transfer"><p>转账</p></div>';
                    break;
                case 6:
                    $str = '<div class="account-title bg-pink"><p class="js-money">'
                        .number_format($change["money_sum"],2).'<i class="iconfont icon-pa-edit"></i></p><p>'
                        .$change["account_name"].'余额</p>';
                    $str1 = '<div style="height:42px;"></div><div  class="tabs bottom-kit cl-pink js-transfer"><p>转账</p></div>';
                    break;
                case 7:
                    $str = '<div class="account-title bg-orange"><p class="js-money">'
                        .number_format($change["money_sum"],2).'<i class="iconfont icon-pa-edit"></i></p><p>'
                        .$change["account_name"].'余额</p>';
                    $str1 = '<div style="height:42px;"></div><div  class="tabs bottom-kit cl-orange js-transfer"><p>转账</p></div>';
                    break;
                case 8:
                    $str = '<div class="account-title bg-green"><p class="js-money">'
                        .number_format($change["money_sum"],2).'<i class="iconfont icon-pa-edit"></i></p><p>'
                        .$change["account_name"].'余额</p>';
                    $str1 = '<div style="height:42px;"></div><div  class="tabs bottom-kit cl-green js-transfer"><p>转账</p></div>';
                    break;
            }
            $str .= '<div>
                <div>
                    <p class="js-add"><i class="iconfont icon-pa-shang"></i></p>
                    <p><span class="js-month">'.$change["month"].'</span><span>月</span></p>
                    <p class="js-minus"><i class="iconfont icon-pa-bottom"></i></p>
                    <p class="js-year">'.$change["year"].'年</p>
                </div>
                <div>
                    <span>'.number_format($change["sum_in"],2).'</span>
                    <p>流入</p>
                </div>
                <div>
                    <span>'.number_format($change["sum_out"],2).'</span>
                    <p>流出</p>           
                    
                </div>
            </div>
        </div>';
        if(count($change["cate_date"])>0){
            $today = $change["cate_date"][0];
            $str .= '<p class="date-list">'.$today.'</p>';
            for($i=0;$i<count($change["cate_money"]);$i++){
                if($today == $change["cate_date"][$i]){
                    if($change["cate_inout_type"][$i]=='N'){
                        $str .= '<div class="month-detail-list">
                                <i class="iconfont icon-pa-'.$change["cate_icon"][$i].'"></i>
                                <p>'.$change["cate_name"][$i].'</p>
                                <p>'.$change["cate_remark"][$i].'&nbsp;</p>
                                <span>-'.number_format($change["cate_money"][$i],2).'</span>
                                </div>';
                    }else{
                        $str .= '<div class="month-detail-list">
                                <i class="iconfont icon-pa-'.$change["cate_icon"][$i].'"></i>
                                <p>'.$change["cate_name"][$i].'</p>
                                <p>'.$change["cate_remark"][$i].'&nbsp;</p>
                                <span class="detail-list-in">+'.number_format($change["cate_money"][$i],2).'</span>
                                </div>';
                    }
                }else{
                    $today = $change["cate_date"][$i];
                    if($change["cate_inout_type"][$i]=='N'){
                        $str .= '<p class="date-list">'.$today.'</p><div class="month-detail-list">
                                <i class="iconfont icon-pa-'.$change["cate_icon"][$i].'"></i>
                                <p>'.$change["cate_name"][$i].'</p>
                                <p>'.$change["cate_remark"][$i].'&nbsp;</p>
                                <span>-'.number_format($change["cate_money"][$i],2).'</span>
                                </div>';
                    }else{
                        $str .= '<p class="date-list">'.$today.'</p><div class="month-detail-list">
                                <i class="iconfont icon-pa-'.$change["cate_icon"][$i].'"></i>
                                <p>'.$change["cate_name"][$i].'</p>
                                <p>'.$change["cate_remark"][$i].'&nbsp;</p>
                                <span class="detail-list-in>+'.number_format($change["cate_money"][$i],2).'</span>
                                </div>';
                    }
                }
            }
        }
        //var_dump ($change);
        echo $str.$str1;

        ?>
        <!--<div class="account-title bg-blue">
            <p class="js-money">74.00<i class="iconfont icon-pa-edit"></i></p>
            <p>现金余额</p>
            <div>
                <div>
                    <p><i class="iconfont icon-pa-shang"></i></p>
                    <p><span>11</span><span>月</span></p>
                    <p><i class="iconfont icon-pa-bottom"></i></p>
                    <p>2015年</p>
                </div>
                <div>
                    <span>100.00</span>
                    <p>流入</p>
                </div>
                <div>
                    <span>1000.00</span>
                    <p>流出</p>           
                </div>
            </div>
        </div>-->
        <!--列表-->
        <!--<p class="date-list">11月1日</p>
        <div class="month-detail-list">
            <i class="iconfont icon-pa-snacks"></i>
            <p>零食</p>
            <p>百奇两包</p>
            <span>-50.00</span>
        </div>
        <div style="height:42px;"></div>
        <div  class="tabs bottom-kit cl-blue js-transfer">
            <p>转账</p>
        </div>-->
    </div>
        <!--模态窗-->
    <div class="modal-money js-modal-money">
        <div class="modal-money-box">
        <p>修改余额 <i class="iconfont icon-pa-close js-close"></i></p>
        <?php
            if($change["account_type_id"]!=3){
                $str2 = '<input type="text" class="js-account-name" accounttype="'.$change["account_type_id"].'" accountid="'
                        .$change["id"].'" value="'
                        .$change["account_name"].'"/><input class="js-account-money" type="text" value="'
                        .number_format($change["money_sum"],2).'"/>';
            }else{
                $str2 = '<input type="text" class="js-account-name" accounttype="'.$change["account_type_id"].'" accountid="'
                        .$change["id"].'" value="'
                        .$change["account_name"].'"/><input class="js-account-money" type="text" value="'
                        .number_format($change["money_limit"],2).'"/>';
            }
            echo $str2;
        ?>

<!--        <input type="text" value="现金"/>
            <input type="text" value="0.00"/>-->
            <button class="js-submit">确定</button>
        </div>
    </div>
<script src="../../public/wechatapp/js/jquery-3.1.1.min.js"></script>
<script src="../../public/wechatapp/js/common.js"></script>
<script>
    $().ready(function(){
        var money = $(".js-account-money").val();
        var name = $(".js-account-name").val();
        var dtype = $(".js-account-name").attr("accounttype");
        var did = $(".js-account-name").attr("accountid");
        //更改账号名或余额
        $(".js-submit").click(function(){
            var dmoney = $(".js-account-money").val();
            var dname = $(".js-account-name").val();
            if(name == dname){
                dname = "notchange";
            }
            if(money==dmoney){
                dmoney = "notchange";
            }            
            if(dmoney!="notchange" || dname!="notchange" ){
                $.post("/Pandoracommon/moneychange",{money:dmoney,name:dname,type:dtype,id:did},function(data){
                    window.location.reload();
                },'json');
            }
        }); 
        //转账
        $(".js-transfer").click(function(){
            location.href = "/pandora/transfer?did="+parseInt(did)*1111+"&dname="+name;
        });
    });
    //修改金额
    $(".js-money").click(function(){
        $(".js-modal-money").show();
    });
    $(".js-close").click(function(){
        $(".js-modal-money").hide();
    });
    //更改年月
    $(".js-add").click(function(){
        var month = parseInt($(".js-month").text());
        var year = parseInt($(".js-year").text());
        if(month=="12"){
            $(".js-month").text("1");
            $(".js-year").text(year+1+'年');
        }else{
            $(".js-month").text(month+1);
        }
    }); 
    $(".js-minus").click(function(){
        var month = parseInt($(".js-month").text());
        var year = parseInt($(".js-year").text());
        if(month=="1"){
            $(".js-month").text("12");
            $(".js-year").text(year-1+'年');
        }else{
            $(".js-month").text(month-1);
        }
    });
</script>
</body>
</html>