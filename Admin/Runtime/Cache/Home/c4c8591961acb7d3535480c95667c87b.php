<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" href="/signup/Public/Admin/Css/login.css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript">
//				验证码的点击刷新
				var imgSrc;
			function changeImg(){
				if(imgSrc==null){
					imgSrc=$("#code").attr('src');
				}
				$("#code").attr('src',imgSrc+'/?r='+Math.random());
			}
		</script>
	</head>
	<body>
		<div id="top">

		</div>
		<div class="login">	
			<form action="<?php echo U('Login/login');?>" method="post" id="login">
			<h2 class="title" align="center">HPU报名--后台管理系统</h2>
			<table border="1" width="100%">
				<tr>
					<th>管理员帐号:</th>
					<td>
						<input type="username" name="username" class="len250" required="required"/>
					</td>
				</tr>
				<tr>
					<th>密码:</th>
					<td>
						<input type="password" class="len250" name="password" required="required"/>
					</td>
				</tr>
				<tr>
					<th>验证码:</th>
					<td>
						<input type="code" class="len250" name="code" required="required"/> <img src="<?php echo U('Login/verify');?>" width="100px" height="40px" id="code"/> <a href="javascript:void(0)" onclick="changeImg()">看不清</a>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:160px;"> <input type="submit" class="submit" value="登录"/></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a href="http://www.xsgzs.org/" target="_blank">行思工作室</a>　版权所有</p>
	</div>
	</body>
</html>