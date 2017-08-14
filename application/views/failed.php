<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>错误页面</title>
	<style type="text/css">
	#number{
	font-size:20px;
	color:red;
	}
	</style>
</head>
<body>
<p>登陆失败</p>

</body>
<script type="text/javascript">
(function(){
	var num=document.getElementById("number"),i=4;
	var time=setInterval(function(){

		num.innerHTML=i;
		i--;
		if(i<0){
			clearInterval(time);location.href="http://office.e-corp.cn:8002";
		}
	},1000);

})()
</script>
</html>