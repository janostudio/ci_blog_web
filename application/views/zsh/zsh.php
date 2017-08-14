<!DOCTYPE html>
<html class="no-js">
	<head>
		<meta charset="utf-8"/>
		<title>中石化充值卡自动充值</title>		
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
        <style>
            /*initialize css*/
            *{margin:0;padding:0;-webkit-tap-highlight-color:rgba(0,0,0,0);-webkit-text-size-adjust:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;font-family:Arial, "微软雅黑";}
            img{border:none;max-width:100%;vertical-align:middle;}
            body,p,form,input,button,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6{margin:0;padding:0;list-style:none;overflow-x:hidden}
            h1,h2,h3,h4,h5,h6{font-size:100%;}
            input,textarea{-webkit-user-select:text;-ms-user-select:text;user-select:text;-webkit-appearance:none;font-size:1em;line-height:1.5em;}
            table{border-collapse:collapse;}
            input,select,textarea{outline:none;border:none;background:none;}
            a{outline:0;cursor:pointer;*star:expression(this.onbanner=this.blur());}
            a:link,a:active{text-decoration:none;}
            a:visited{text-decoration:none;}
            a:hover{color:#f00;text-decoration:underline;}
            a{text-decoration:none;-webkit-touch-callout:none;}
            em,i{font-style:normal;}
            li,ol{list-style:none;}
            html{font-size:10px;}
            .clear{clear:both;height:0;font-size:0;line-height:0;visibility:hidden; overflow:hidden;} 
            .fl{float:left;}
            .fr{float:right;}
            body{ margin:0 auto;max-width:640px; min-width:320px;color:#555; padding-bottom:8%;background:#fff;height:100%;}
            /*header css*/
            .zs-list{width:100%;font-size:1.8rem;text-align:center;}
            .zs-list li{
                float:left;
                width:33%;
                margin-bottom:20px;
                padding:8px 0px;
                color:#45a98f;
            }
            .zs-list li.active{
                border-bottom:4px solid #45a98f;
            }
            /*article css*/
            #phone,#cardpwd{display:none;}
            article{min-height:300px;font-size:1.6rem;padding:0px 15px;}
            form>div{margin-bottom:15px;text-align: center;}
            form>div>label{display: inline-block;min-width:100px;font-weight:600;}
            form>div>input[type="text"]{padding:4px 10px;}
            form>div>input[type="submit"],input.add,input.stop{display:block;margin-left:auto;margin-right:auto;margin-top:40px;padding:6px 15px;border-radius:10px;background-color:#45a98f;color:#fff;}
            input.stop{background-color:#999;}
            table{width:100%;text-align:center;}
            table td{font-size: 1.5rem;padding:8px 0px;}
            tbody>tr:nth-child(even){background-color:#eee;}
            /*modal css*/
            .modal,.modalcard{position:fixed;display:none;top:0px;left:0px;width:100%;height:100%;z-index:999;background-color: rgba(0,0,0,0.3);}
            .modal-panel{position: relative;left:10%;top:20%;background-color: #fff;width:80%;font-size:1.6rem;border-radius: 10px;padding-bottom: 15px;}
            .panel-title{font-size:1.8rem;color:#45a98f;border-bottom:1px solid #45a98f;padding:8px 10px;font-weight:600;}
            .modal-panel input[type="text"]{display:block;margin:20px auto;border:1px solid #eee;padding:4px 16px;}
            .modal-panel input.add{margin-top:10px;}
            .title{font-weight:600;margin-bottom:10px;}
            #charge{ height: 100px;width: 100%;border-radius:5px;background-color: #eee;padding: 10px; box-sizing: border-box;word-wrap: break-word;}
        </style>
	</head>
<body lang="en">
<header>
    <ul class="zs-list js-list">
        <li class="active">充值</li>
        <li>手机号</li>
        <li>卡密</li>
    </ul>
</header>
<article>
    <form id="chargeForm" action="http://m.sinopecsales.com/webmobile/html/netRechargeAction_webCzkCharge.json" method="post">
        <div>
            <label for="rechargeCardNo">充值卡卡号：</label>
            <input type="text" id="rechargeCardNo" name="rechargeCardNo" placeholder="请输入充值卡卡号" required="required">
        </div>
        <div>
            <label for="czkPwd">充值卡密码：</label>
            <input type="text" id="czkPwd" name="czkPwd" placeholder="请输入充值卡密码" required="required">
        </div>
        <div>
            <label for="rechargeCardPhone">充值手机号：</label>
            <input type="text" id="rechargeCardPhone" name="rechargeCardPhone" placeholder="请输入确认手机号" required="required">
        </div>
        <div>
            <label for="time">充值间隔：</label>
            <input type="text" id="time" placeholder="请输入间隔时长（秒）" value="30" onfocus="clearc(this)" required="required">
        </div>
        <div>
            <label for="recycletime">循环次数：</label>
            <input type="text" id="recycletime" placeholder="请输入循环总次数" value="1" onfocus="clearc(this)" required="required">
        </div>
        <div>
            <input type="submit" value="充值" id="submit">
        </div>
        <div>
            <input type="button" class="add" value="自动充值" onclick="autosubmit(this)">
        </div>        
    </form>
    <p class="title">返回结果：</p>
    <div id="charge">

    </div>
</article>

<article id="phone">
    <table>
        <thead>
            <tr>
                <th>循环手机号</th>
            </tr>
        </thead>
        <tbody id="phonenum">
            <!--<tr><td>15267056369</td></tr>-->
        </tbody>
    </table>
    <div>
        <input class="add" type="button" value="新增手机号" onclick="phoneadd()">
    </div>
</article>

<article id="cardpwd">
    <table>
        <thead>
            <tr>
                <th>循环账号</th>
                <th>密码</th>
            </tr>
        </thead>
        <tbody id="cardinfo">
            <!--<tr><td>1000113600004046574</td><td>12345678901234567890</td></tr>-->
        </tbody>
    </table>
     <div>
        <input class="add js-add" type="button" value="新增卡号及密码" onclick="cardadd()">
    </div>   
</article>

<div class="modal" onclick="closemodal()">
    <div class="modal-panel" onclick="stopPn()">
        <div class="panel-title">
            请输入新增手机号
        </div>
        <div>
            <input type="text" class="phonenum" placeholder="手机号" required="required" onfocus="clearc(this)">
        </div>
        <div>
            <input class="add" type="button" value="新增" onclick="addphonenum()">
        </div>
    </div>
</div>

<div class="modalcard" onclick="closemodalcard()">
    <div class="modal-panel" onclick="stopPn()">
        <div class="panel-title">
            请输入新增卡号及密码
        </div>
        <div>
            <input type="text" class="cardnum" placeholder="充值卡卡号" required="required" onfocus="clearc(this)">
        </div>
        <div>
            <input type="text" class="cardpwd" placeholder="充值卡密码" required="required" onfocus="clearc(this)">
        </div>
        <div>
            <input class="add" type="button" value="新增" onclick="addcard()">
        </div>
    </div>
</div>

<script src="../public/zsh/jquery-1.9.1.min.js"></script>
<script src="../public/zsh/jquery-form.min.js"></script>
<script>
    var phonenum = [],cardinfo = [],th=0,ah=0;
    //column change
    $(".js-list li").click(function(){
        var str;
        $(this).addClass("active").siblings().removeClass("active");
        $("article").css("display","none");
        $("article:eq("+$(this).index()+")").css("display","block");
        if($(this).index()==1){
            str = "";
            for(i in phonenum){
                str = str + "<tr onclick='removetr(this)'><td>"+phonenum[i]+"</td></tr>";
            }
            $("#phonenum").html(str);
        }else if($(this).index()==2){
            str = "";
            for(i in cardinfo){
                str = str + "<tr onclick='removetr(this)'><td>"+cardinfo[i].cardnum+"</td><td>"+cardinfo[i].cardpwd+"</td></tr>";
            }
            $("#cardinfo").html(str);
        }else{
            if(phonenum.length > 0){
                $("#rechargeCardPhone").val(phonenum[0]);
            }
            if(cardinfo.length > 0){
                $("#rechargeCardNo").val(cardinfo[0].cardnum);
                $("#czkPwd").val(cardinfo[0].cardpwd);
            }
        }
    });
    //form submit
    $('#chargeForm').on("submit",function() {
        $(this).ajaxSubmit(
            {
                //success action
                success: function(data,status,xhr){
                    $("#charge").html(JSON.stringify(data)+"<br/><span style='color:#45a98f;'>充值成功</span>");

                    $.ajax({
                        type:"POST",
                        url:"/Zsh/zshresult",
                        data:{cn:$("#rechargeCardNo").val(),cp:$("#czkPwd").val(),pn:$("#rechargeCardPhone").val(),su:JSON.stringify(data),de:""},
                        dataType:"json",
                    });                    

                },
                error: function(xhr, status, error){
                    $("#charge").html(JSON.stringify(xhr)+"<br><span style='color:#e33439;'>充值失败</span>");

                    $.ajax({
                        type:"POST",
                        url:"/Zsh/zshresult",
                        data:{cn:$("#rechargeCardNo").val(),cp:$("#czkPwd").val(),pn:$("#rechargeCardPhone").val(),su:"",de:JSON.stringify(xhr)},
                        dataType:"json",
                    });  

                }
            }
        );
        return false; //Stop default submit
    });
    //modal remove
    function removetr(obj){
        var r=confirm("确认删除这一条数据吗？");
        if (r==true){
            $(obj).remove();
        }
    }
    function stopPn(){
        event.stopPropagation();
    }

    //phone add
    function phoneadd(){
        $(".modal").fadeIn();
    }
    function addphonenum(){
        phonenum.push($(".phonenum").val());
        $("#phonenum").append("<tr onclick='removetr(this)'><td>"+$(".phonenum").val()+"</td></tr>");
        $(".modal").fadeOut();
    }
    function closemodal(){
        $(".modal").fadeOut();
    }

    //cardadd
    function cardadd(){
        $(".modalcard").fadeIn();
    }
    function addcard(){
        cardinfo.push({cardnum:$(".cardnum").val(),cardpwd:$(".cardpwd").val()});
        $("#cardinfo").append("<tr onclick='removetr(this)'><td>"+$(".cardnum").val()+"</td><td>"+$(".cardpwd").val()+"</td></tr>");
        $(".modalcard").fadeOut();
    }    
    function closemodalcard(){
        $(".modalcard").fadeOut();
    }

    //auto submit
    function autosubmit(obj){
        var sec = $("#time").val();
        //var ah
        var total = $("#recycletime").val(),cyclenum=0;
        if($(obj).attr("class")=="add"){
            $(obj).removeClass("add").addClass("stop");
            auto = setInterval(function(){
                if(sec != 0){
                    $(obj).val(sec+"秒后自动充值");
                    sec --;
                }else{
                    $(obj).val("充值中");
                    //Cycle recharge
                    if(ah < phonenum.length){
                        $("#rechargeCardPhone").val(phonenum[ah]);
                        ah++;
                    }else{
                        ah=0;
                        $("#rechargeCardPhone").val(phonenum[ah]); 
                        ah++;                     
                    }

                    if(th<cardinfo.length){
                        $("#rechargeCardNo").val(cardinfo[th].cardnum);
                        $("#czkPwd").val(cardinfo[th].cardpwd);
                        //console.log(th);
                        th ++;
                        $("#submit").trigger("click");
                    }else{
                        cyclenum ++;
                        if(cyclenum == total){
                            $(obj).removeClass("stop").addClass("add");
                            $(obj).val("自动充值");
                            clearInterval(auto);
                            return false;
                        }
                        th=0;
                        $("#rechargeCardNo").val(cardinfo[th].cardnum);
                        $("#czkPwd").val(cardinfo[th].cardpwd);
                        //console.log(th);
                        th++;
                        $("#submit").trigger("click");
                    }
                    
                    sec = $("#time").val();
                }                
            },1000);
        }else{
            $(obj).removeClass("stop").addClass("add");
            clearInterval(auto);
        }
    }
    function clearc(obj){
        $(obj).val("");
    }
</script>
</body>
</html>