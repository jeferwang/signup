<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>后台管理-首页</title>

	<link rel="stylesheet" type="text/css" href="/signup/Public/Admin/Css/Index_index.css"/>

<head>
</head>
<body>
	<div id="top">
		<div>
		</div>
		<div class="menu">
			<a href="javascript:void(0)" >当前位置:首页-登录信息</a>
			
	

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
			<dd><a href="<?php echo U('Type/index');?>">作品类型管理</a></dd>
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
		
	<div id="info">
	    <p style="border-top: none;"><font color="orangered">后台管理仅限管理员使用，请谨慎使用，在删除数据前进行确认，以免误删！</font></p>
		<p>当前管理员：<?php echo cookie('adminName'); ?></p>
		<p>管理员ID：<?php echo cookie('adminId'); ?></p>
		<p>当前主机名：<?php echo $_SERVER['SERVER_NAME']; ?> </p>
	    <p>网站运行环境：<?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
	    <p>浏览器信息：<?php echo $_SERVER['HTTP_USER_AGENT']; ?> </p>
		<p>文件根目录：<?php echo $_SERVER['DOCUMENT_ROOT']; ?> </p>
		<p>CGI规范版本：<?php echo $_SERVER['GATEWAY_INTERFACE']; ?> </p>
		<p>网络通信协议：<?php echo $_SERVER['SERVER_PROTOCOL']; ?> </p>
		<p>当前登录IP：<?php echo $_SERVER['REMOTE_ADDR']; ?> </p>
	</div>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>