<!DOCTYPE html>
	<head lang="en">
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="author" content="JealandJiang">
	    <!--地址栏Logo-->
	    <link type="image/x-icon" href="/public/images/titleimg.png" mce_href="../../public/images/titleimg.png" rel="icon">
	    <!--标签栏Logo-->
	    <link type="image/x-icon" href="/public/images/titleimg.png" mce_href="../../public/images/titleimg.png" rel="shortcut icon">
	    <!-- Bootstrap -->
	    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../../public/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" />
		<link href="../public/css/general.css" type="text/css" rel="stylesheet">
	    <script type="text/javascript" src="../../public/js/jquery-1.12.4.min.js"></script>
		<style>	
            .context{
                position:relative;
                margin:0 auto;
                width:80%;
            }

            .title li{
                float:left;
                width:350px;
                margin:10px;
                cursor:pointer;
                border-radius:3px;
                border:1px solid #6f6f6f;
                text-align:center;
                height:20px;
                line-height:20px;
                overflow:hidden;
                background-color:#aad4ff;
            }	
		</style>
	</head>
	<body>
        <div class="header"></div>
        <div class="context">
            <ul class="title">

            </ul>
        </div>
    </body>
    <script>
        var title =<?php echo $title?>;
        //插入li
		$(function(){
            for(i=0;i<title.length;i++){
                str = '';
                str = '<li>'+title[i]+'</li>';
                $(".title").append(str);
            }
            $(".title li").on("click",function(){
                li_title = $(this).html();
                url = "./Rnovel/main_content?title="+li_title;
                // alert(url);
                self.location.href = url;
            });
        });
    </script>
</html>
    
