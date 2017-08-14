<!DOCTYPE html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Blog_Jealand</title>
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
    <link href="../../public/css/blogCss.css" type="text/css" rel="stylesheet">
</head>
<body>
	<canvas id="bgcanvas"></canvas>
	<div class="container">
		<div class="mainwrap">
<!--   			<div class="mainblog">
				<span class="bloghead"><h3>Title<small> author</small></h3></span>
				<hr/>
				<span class="blogslug">This is a demo for nonactive blogslug.<br/> aa</span>
				<p class="blogtext" style="display:none;">
					This is text for blog;
				</p>
				<div class="bloglable">
					<span class="badge">2016-07-11</span>
				</div>
			</div>--> 
			<div class="bpage">
				<ul class="pager">
					<li class="previous"><a href="#">&larr; Previous</a></li>
					<li class="next"><a href="#">Next &rarr;</a></li>
				</ul>
			</div>
		</div>
		<div class="rightwrap">
			<div class="righthead">
				<h3>Article Menu <a href='../home/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></h3>
				<hr/>
				<div class="blogtitles">
					<ul class="blogtit">
<!--						<li><a href="#">Title1</a></li>
						<li><a href="#">Title2</a></li>
						<li><a href="#">Title3</a></li> 
					</ul>	
				</div>
			</div>
			<div class="feedback">
				<img src="../../public/images/feedbackb.png" >
			</div>-->
		</div>

	</div>
    <script type="text/javascript" src="../../public/js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="../../public/js/blogJs.js"></script>
	<script type="text/javascript" src="../../public/js/blogCanvas.js"></script>
	<script type="text/javascript">
		var $bloginfo =<?php echo $bloginfo ?>;
		var $blogtitle=<?php echo $blogtitle ?>;
		var $sum=<?php echo $sum ?>;
		var str1;
		var str2;
		//写入Blog
		$(function(){
			//mainblog
		    for(i=$bloginfo["title"].length-1;i>=0;i--){
			    str = '<div class="mainblog"><span class="bloghead"><h3>'
				    +$bloginfo["title"][i]+'<small>'
				    +$bloginfo["username"][i]+'</small></h3></span><hr/><span class="blogslug" id="'
					+$bloginfo["cid"][i]+'">'
			        +$bloginfo["slug"][i]+'</span><p class="blogtext" style="display:none;"></p><div class="bloglable"><span class="badge">'
			        +$bloginfo["createdtime"][i]+'</span></div></div>';
			    $(".mainwrap").append(str);
			    // str2='<li><a href="#">'+$bloginfo["title"][i]+'</a></li>';
			    // $(".blogtit").append(str2);
		    }
			$(".blogslug").on("click",function(){
				var cid=$(this).attr("id");
				if($("#"+cid).next().html()==''){				
					$.post("/Common/blog_text",{'cid': cid},function(data){
						// alert ($("#"+cid).next().attr("class"));
						$("#"+cid).next().append(data.text);
					},'json');
				}
				$(this).hide();
				$(this).next().show();
				$(this).parent().siblings().hide();
			});
			$(".blogtext").on("click",function(){
				$(this).hide();
				$(this).prev().show();
				$(this).parent().siblings().show();
			});
			//righttitle
			for(i=$blogtitle["title"].length-1;i>=0;i--){
				str2='<li><a href="#" value="'+$blogtitle["cid"][i]+'">'+$blogtitle["title"][i]+'</a></li>';
			    $(".blogtit").append(str2);
			}
			//click next or previous 
			$(".next").click(function(){
				var page = Math.ceil(parseInt($('.mainblog:last-child').find('.blogslug').attr('id'))/5)+1;
				// first page and page = 1;
				if(page<Math.ceil($sum/5)+1){
					$.get("/Common/turn_page?page="+page,function(data){
						$(".mainblog").remove();
						add_blog_on(data);
					},'json');
				}else{
					alert("这已经是最后一页了");
				}
			});
			$(".previous").click(function(){
				/*
				* first page and page = 1;
				*/
				var page = Math.ceil(parseInt($('.mainblog:last-child').find('.blogslug').attr('id'))/5)-1;
				if(page>0){
					$.get("/Common/turn_page?page="+page,function(data){
						$(".mainblog").remove();
						//add new blog
						add_blog_on(data);
					},'json');
				}else{
					alert("这已经是第一页了！");				}

			});			
			/*
			*click righttitle
			*/
			$(".blogtit>li>a").click(function(){
				// alert($(this).attr('value'));
				var page1 = Math.ceil(parseInt($('.mainblog:last-child').find('.blogslug').attr('id'))/5)
				var page2 = Math.ceil(parseInt($(this).attr('value'))/5);
				if(page1 != page2){
					$.ajaxSetup({  
						async: false
					}); 
					$.get("/Common/turn_page?page="+page2,function(data){
						$(".mainblog").remove();
						//add new blog
						//when loaded ,the 'click' can't be triggered.
						add_blog_on(data);
					},'json');
				}else{
					$(".blogtext").hide();
					$(".mainblog").show();
					$(".blogslug").show();
				}
				$("#"+parseInt($(this).attr('value'))).trigger('click');
			});
		});


		/*
		*新增翻页博文并绑定动作
		*/ 
		function add_blog_on(data){
			// alert(data['bloginfo']['title'][i]);
		    for(i=data['bloginfo']['title'].length-1;i>=0;i--){
			    str = '<div class="mainblog"><span class="bloghead"><h3>'
				    +data['bloginfo']['title'][i]+'<small>'
				    +data['bloginfo']['username'][i]+'</small></h3></span><hr/><span class="blogslug" id="'
					+data['bloginfo']['cid'][i]+'">'
			        +data['bloginfo']['slug'][i]+'</span><p class="blogtext" style="display:none;"></p><div class="bloglable"><span class="badge">'
			        +data['bloginfo']['createdtime'][i]+'</span></div></div>';
			    $(".mainwrap").append(str);
			    // str2='<li><a href="#">'+$bloginfo["title"][i]+'</a></li>';
			    // $(".blogtit").append(str2);
		    }
			$(".blogslug").on("click",function(){
				var cid=$(this).attr("id");
				if($("#"+cid).next().html()==''){				
					$.post("/Common/blog_text",{'cid': cid},function(data){
						// alert ($("#"+cid).next().attr("class"));
						$("#"+cid).next().append(data.text);
					},'json');
				}
				$(this).hide();
				$(this).next().show();
				$(this).parent().siblings().hide();
			});
			$(".blogtext").on("click",function(){
				$(this).hide();
				$(this).prev().show();
				$(this).parent().siblings().show();
			});			
		}
			
	</script>
    