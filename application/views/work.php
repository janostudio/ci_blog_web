<!DOCTYPE html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Works_Jealand</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" content="blog,html5,anime,phy,game">
    <meta name="author" content="JealandJiang">
    <meta name="description" content="Private website where summary my learning record.">
    <!--address column Logo-->
    <link type="image/x-icon" href="/public/images/titleimg.png" mce_href="../../public/images/titleimg.png" rel="icon">
    <!--Lable column Logo-->
    <link type="image/x-icon" href="/public/images/titleimg.png" mce_href="../../public/images/titleimg.png" rel="shortcut icon">
        <!-- Bootstrap -->
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../../public/css/workCss.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="album_wrap">
        <!--Vertical Label Demo-->
        <div class="verti_lable_wrap">
            <div>请务必自动换行</div>
            <ul>
                <li class="img_name">phote</li>
            </ul>
        </div>
    </div>
<script type="text/javascript">
    //替换导航页的登陆样式
    $(function(){
        $(".mark1").removeClass("mark1");
        $(".nav li").eq(3).addClass("mark1");
        nickname = "<?php echo $nickname ?>";
        if(nickname){
            $(".nav li").eq(3).find("a").text(nickname);
        }

    });
</script>