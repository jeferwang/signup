<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<link rel="stylesheet" href="/signup/Public/App/style/index.css">
</head>
<body>
	<div id="header">
<!--		<hr/>-->
<!--		<hr/>-->
		<h1>河南理工大学学生课外科技竞赛管理系统</h1>
	</div>
	<div id="container">
		<form action="<?php echo U('Index/login');?>" method="post">
			<div>
				<input type="text" name="username" placeholder="账号(学号或教师号)">
				<img src="/signup/Public/App/img/person.png" alt="用户">
			</div>
			<div>
				<input type="password" name="password" placeholder="密码">
				<img src="/signup/Public/App/img/password.png" alt="密码">
			</div>
			<input type="submit" value="登录">
			<div class="radio">
				<input type="radio" checked="check" name="id" value="teacher">
				<span>教师</span>
				<input type="radio" name="id" value="student">
				<span>学生</span>
				<span><a href="<?php echo U('Teashow/index',array('type'=>1));?>" style="color: white;float: right;">导师展示&gt;&gt;</a></span>
				<br>
				<span><a href="<?php echo U('Teashow/index',array('type'=>2));?>" style="color: white;float: right;">评委简介&gt;&gt;</a></span>
			</div>
		</form>
	</div>
	<div id="footer">
		<p>copyright© 2016 行思工作室　版权所有</p>
	</div>
</body>
</html>