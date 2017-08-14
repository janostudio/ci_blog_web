<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>余额汇总</title>
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
            //var_dump ($balance);
            $str = '';
            //各个账户余额
            for($i=0;$i<count($balance["account_name"]);$i++){
              $balance["id"][$i] = $balance["id"][$i]*7*17;  
              switch($balance["account_type_id"][$i])
              {
                  case 1:
                      $str .= '<div class="balance-card bg-white" accountid = "'.$balance["id"][$i].'"><i class="iconfont icon-pa-'
                          .$balance["account_icon"][$i].'"></i><p>'
                          .$balance["account_name"][$i].'</p><p>'
                          .$balance["account_remark"][$i].'&nbsp;</p><span>'
                          .number_format($balance["money_sum"][$i],2).'</span></div> ';
                      break;
                  case 2:
                      $str .= '<div class="balance-card bg-blue" accountid = "'.$balance["id"][$i].'"><i class="iconfont icon-pa-'
                          .$balance["account_icon"][$i].'"></i><p>'
                          .$balance["account_name"][$i].'</p><p>'
                          .$balance["account_remark"][$i].'&nbsp;</p><span>'
                          .number_format($balance["money_sum"][$i],2).'</span></div> ';
                      break;
                  case 3:
                      $str .= '<div class="balance-card bg-dblue" accountid = "'.$balance["id"][$i].'"><i class="iconfont icon-pa-'
                          .$balance["account_icon"][$i].'"></i><p>'
                          .$balance["account_name"][$i].'</p><p>'
                          .$balance["account_remark"][$i].'&nbsp;</p><span>'
                          .number_format($balance["money_limit"][$i],2).'</span></div> ';
                      break;
                  case 4:
                      $str .= '<div class="balance-card bg-cyan" accountid = "'.$balance["id"][$i].'"><i class="iconfont icon-pa-'
                          .$balance["account_icon"][$i].'"></i><p>'
                          .$balance["account_name"][$i].'</p><p>'
                          .$balance["account_remark"][$i].'&nbsp;</p><span>'
                          .number_format($balance["money_sum"][$i],2).'</span></div> ';
                      break;
                  case 5:
                      $str .= '<div class="balance-card bg-yellow" accountid = "'.$balance["id"][$i].'"><i class="iconfont icon-pa-'
                          .$balance["account_icon"][$i].'"></i><p>'
                          .$balance["account_name"][$i].'</p><p>'
                          .$balance["account_remark"][$i].'&nbsp;</p><span>'
                          .number_format($balance["money_sum"][$i],2).'</span></div> ';
                      break;
                  case 6:
                      $str .= '<div class="balance-card bg-pink" accountid = "'.$balance["id"][$i].'"><i class="iconfont icon-pa-'
                          .$balance["account_icon"][$i].'"></i><p>'
                          .$balance["account_name"][$i].'</p><p>'
                          .$balance["account_remark"][$i].'&nbsp;</p><span>'
                          .number_format($balance["money_sum"][$i],2).'</span></div> ';
                      break;
                  case 7:
                      $str .= '<div class="balance-card bg-orange" accountid = "'.$balance["id"][$i].'"><i class="iconfont icon-pa-'
                          .$balance["account_icon"][$i].'"></i><p>'
                          .$balance["account_name"][$i].'</p><p>'
                          .$balance["account_remark"][$i].'&nbsp;</p><span>'
                          .number_format($balance["money_sum"][$i],2).'</span></div> ';
                      break;
                  case 8:
                      $str .= '<div class="balance-card bg-green" accountid = "'.$balance["id"][$i].'"><i class="iconfont icon-pa-'
                          .$balance["account_icon"][$i].'"></i><p>'
                          .$balance["account_name"][$i].'</p><p>'
                          .$balance["account_remark"][$i].'&nbsp;</p><span>'
                          .number_format($balance["money_sum"][$i],2).'</span></div> ';
                      break;
              }  
            }
            echo $str;
        ?>
        <div class="balance-card bg-white js-new-balance" accountid="617" style="color:#8d8d8d;">
            <i class="iconfont icon-pa-add"></i>
            <p style="line-height:35px;padding-top:4px;">添加账户</p>
        </div> 
        <!--<div class="balance-card bg-white">
            <i class="iconfont icon-pa-cash"></i>
            <p>现金</p>
            <p>眼睛左侧</p>
            <span>1000.00</span>
        </div>    
        <div class="balance-card bg-white">
            <i class="iconfont icon-pa-cash"></i>
            <p>现金</p>
            <p>您还为设置现金二度，请设置</p>
            <span>1000.00</span>
        </div>    
        <div class="balance-card bg-blue">
            <i class="iconfont icon-pa-cash"></i>
            <p>现金</p>
            <p>您还为设置现金二度，请设置</p>
            <span>1000.00</span>
        </div>-->
    </div>
        <!--模态窗-->
    <div class="modal-money js-modal-money">
        <div class="modal-money-box">
            <p>新建账户<i class="iconfont icon-pa-close"></i></p>
            <input type="text" value="">
            <input type="text" value="" placeholder="账户说明">
            <input type="text" value="" placeholder="余额">
            
            <button class="js-submit">新增</button>
        </div>
    </div>

    <div style="height:72px;"></div>
    <div class="tabs">
        <a href="./detail">
            <i class="iconfont icon-pa-detail"></i>
            <p>明细</p>
        </a>
        <a class="tab-active" href="./balance">
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
<script src="../../public/wechatapp/js/common.js"></script>
<script>
    //点击跳转到余额详情页
    $(".balance-card").click(function(){
        var account_id = $(this).attr("accountid");
        if(account_id == 617){
            location.href = "./balancenew";
        }else{
            location.href = "./balancestatic?account_id="+account_id;
        }
    });
</script>
</body>
</html>