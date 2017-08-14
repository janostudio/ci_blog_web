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
			.index-slogo{
				height:50px;
				width:50px;
				opacity:0.5;
			}
			.headfont{
				background:#F7F7F7;
				border-radius:5px;
			}
			.container-fluid{
				margin-left:10%;
				width:90%;
			}
			.headfont a{
				color:#808080;
			}
			.nav a{
				font-weight:500;
			}
			.mark1{
				background:#777;
			}
			.mark1 a{
				color:#eee;
			}			
		</style>
	</head>
	<body>
<div class="wrap_all">
	<div class="container-fluid">
		  <div class="row headfont">
		    <div class="navbar-header col-sm-offset-2">
		      <a class="navbar-brand" href="../">Janostudio</a>
		      <img src="../../public/images/singlelogo.png" alt="singlelogo" class="index-slogo">
		    </div>
		    <div class="col-sm-offset-8">
			    <ul class="nav navbar-nav">
			      <li><a href="../">Home</a></li>
			      <li class="mark1"><a href="#"><b><?php echo $_SESSION['nickname'] ?></b></a></li>
			      <li><a href="#">Games</a></li> 
			      <li><a href="../home/work">Works</a></li> 
			    </ul>
		    </div>
		  </div>		
	</div>

    </body>
</html>
    