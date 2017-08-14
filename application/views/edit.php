<!DOCTYPE html>
<head lang="en">
    <meta charset="UTF-8">
    <title>JealandEdit</title>
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
    
    <link rel="stylesheet" type="text/css" href="../../public/css/wangEditor.min.css">
    <style>
        .wrap_all{
            min-height:100%;
            margin:0 auto -40px;
            padding-bottom:40px;
        }
        .edit_wrap{
            position:relative;
            width:60%;
            left:20%;
            margin-top:5%;
        }
        .wangEditor-txt{
            height:400px;
        }
        .btn_wrap{
            position:relative;
            top:20px;
            left:50%;
        }
        .btn{
            left:-50%;
        }
        body{
            overflow:hidden;
        }
        .input-group{
            width:60%;
            margin-left:20%;
        }
        .input-group-sm{
            margin-bottom:30px;
        }
    </style>
</head>
<body>
    <div class="edit_wrap">
        <div class="input-group input-group-lg">
            <span class="input-group-addon">Title</span>
            <input type="text" class="form-control title_edit" placeholder="Enter Paper Title">
        </div><br>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control slug_edit" placeholder='Use one sentence to describe your paper.'>
            <span class="input-group-addon">Slug</span>
        </div>
        <!--class="wangEditor-txt"-->
        <div id='wang_edit'>

        </div>
    </div>
    <!--  btn-success -->
    <div class='btn_wrap'><button type="button" class="btn btn-default">SUBMIT！</button></div>
<script type="text/javascript" src="../../public/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="../../public/js/wangEditor.min.js"></script>
<script type="text/javascript">
    $(function () {
        var editor = new wangEditor('wang_edit');
        editor.create();
    });
    $('.btn').click(function(){
        //$('.wangEditor-txt').html()包含文本格式的内容；$('.title_edit').val()+$('.slug_edit').val();
        var title = $('.title_edit').val();
        var slug = $('.slug_edit').val();
        var text = $('.wangEditor-txt').html();
        $.post('../Common/upload_blog',{'title':title,'slug':slug,'text':text},function(data){
            if(data){
                alert('上传成功！');
                window.location="/home/blog";
            }
        },'json');
    });
</script>