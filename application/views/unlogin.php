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
<p>您还未登陆，本页将在<span id='number'>5</span>秒后跳回主页</p>

</body>
<script type="text/javascript">
(function(){
	var num=document.getElementById("number"),i=4;
	var time=setInterval(function(){

		num.innerHTML=i;
		i--;
		if(i<0){
			clearInterval(time);location.href="/";
		}
	},1000);

})()
</script>
</html>