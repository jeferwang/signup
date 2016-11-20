<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>后台管理-添加学院</title>

<head>
</head>
<body>
	<div id="top">
		<div>
		</div>
		<div class="menu">
			<a href="javascript:void(0)" >当前位置:添加学院</a>
			
	<a href="<?php echo U('College/index');?>">学院列表</a>
	<a href="<?php echo U('College/add');?>">添加学院</a>

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
			<dd><a href="<?php echo U('People/index');?>">人才管理</a></dd>
			<dd><a href="<?php echo U('People/add');?>">新增人才</a></dd>
			<dd><a href="<?php echo U('Match/index');?>">比赛管理</a></dd>
			<dd><a href="<?php echo U('College/index');?>">学院管理</a></dd>
		</dl>
		<dl>
			<dt>账户管理</dt>
			<dd><a href="#">管理员账户管理</a></dd>
			<dd><a href="#">教师账户管理</a></dd>
			<dd><a href="#">学生账户管理</a></dd>
			<dd><a href="#">修改登录信息</a></dd>
		</dl>
		<dl>
			<dt>任务分配</dt>
			<dd><a href="#">评分任务分配</a></dd>
		</dl>
	</div>
	<div id="right">
		
	<table border="1" style="width: 97%; margin: 20px 0 0 2%;">
		<tr>
			<th></th>
			<th></th>
		</tr>
	</table>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a href="http://www.xsgzs.org/" target="_blank">行思工作室</a>　版权所有</p>
	</div>
</body>
</html>