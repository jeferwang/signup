<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>后台管理-登录信息修改</title>

	<style type="text/css">
		#fix_form{
			margin: 20px 0 0 40px;
		}
		#fix_form input[type=text]{
			width: 20%;
			padding: 6px;
			margin-bottom: 15px;
		}
		#fix_form input[type=submit]{
			padding: 5px 15px;
			border-radius: 20px 0 20px 0;
			outline: none;
		}
		#fix_form p{
			margin-bottom: 15px;
			color: #888;
		}
	</style>

<head>
</head>
<body>
	<div id="top">
		<div>
		</div>
		<div class="menu">
			<a href="javascript:void(0)" >当前位置:管理员列表</a>
			
	<a href="<?php echo U('Account/adminList');?>">管理员列表</a>
	<a href="<?php echo U('Account/fixAdmin');?>">登录信息修改</a>

		</div>
		<div class="exit">
			<a href="<?php echo U('Login/logout');?>">退出</a>
		</div>
	</div>
	<div id="left">
		<dl>
			<dt>首页</dt>
			<dd><a href="<?php echo U('Index/index');?>">登录信息</a></dd>
		</dl>
		<dl>
			<dt>内容管理</dt>
			<dd><a href="<?php echo U('Teashow/index');?>">人才管理</a></dd>
			<dd><a href="<?php echo U('Teashow/add');?>">新增人才</a></dd>
			<dd><a href="<?php echo U('Match/index');?>">比赛管理</a></dd>
			<dd><a href="<?php echo U('College/index');?>">学院管理</a></dd>
		</dl>
		<dl>
			<dt>账户管理</dt>
			<dd><a href="<?php echo U('Account/adminlist');?>">管理员账户管理</a></dd>
			<dd><a href="<?php echo U('Account/teaList');?>">教师账户管理</a></dd>
			<dd><a href="<?php echo U('Account/stuList');?>">学生账户管理</a></dd>
		</dl>
		<dl>
			<dt>任务分配</dt>
			<dd><a href="<?php echo U('Task/index');?>">评分任务分配</a></dd>
		</dl>
		<dl>
			<dt>作品管理</dt>
			<dd><a href="<?php echo U('Reginfo/index');?>">作品列表</a></dd>
		</dl>
	</div>
	<div id="right">
		
	<form action="<?php echo U('Account/runFixAdmin');?>" method="post" id="fix_form">
		<p>为防止输入错误，密码采用明文显示，请确认周边环境是否安全</p>
		<label for="">新用户名：<input type="text" name="username" id="username" placeholder="请在此输入新的用户名" required="required" /></label>
		<br />
		<label for="">原先密码：<input type="text" name="oldPass" id="oldPass" placeholder="请输入原密码" required="required" /></label>
		<br />
		<label for="">新的密码：<input type="text" name="password" id="password" placeholder="请输入新的密码" required="required" /></label>
		<br />
		<input type="submit" value=">>>>修改信息<<<<"/>
	</form>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>