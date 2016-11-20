<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="__PUBLIC__/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/index.js"></script>
<link rel="stylesheet" href="__PUBLIC__/Admin/Css/public.css" />
<link rel="stylesheet" href="__PUBLIC__/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title><block name="title"></block></title>
<block name="css_js"></block>
<head>
</head>
<body>
	<div id="top">
		<div>
		</div>
		<div class="menu">
			<a href="javascript:void(0)" >当前位置:<block name="location"></block></a>
			<block name="menu"></block>
		</div>
		<div class="exit">
			<a href="{:U('Login/logout')}">退出</a>
		</div>
	</div>
	<div id="left">
		<dl>
			<dt>首页</dt>
			<dd><a href="{:U('Index/index')}">登录信息</a></dd>
		</dl>
		<dl>
			<dt>内容管理</dt>
			<dd><a href="{:U('Teashow/index')}">人才管理</a></dd>
			<dd><a href="{:U('Teashow/add')}">新增人才</a></dd>
			<dd><a href="{:U('Match/index')}">比赛管理</a></dd>
			<dd><a href="{:U('College/index')}">学院管理</a></dd>
			<dd><a href="{:U('Type/index')}">作品类型管理</a></dd>
		</dl>
		<dl>
			<dt>账户管理</dt>
			<dd><a href="{:U('Account/adminlist')}">管理员账户管理</a></dd>
			<dd><a href="{:U('Account/teaList')}">教师账户管理</a></dd>
			<dd><a href="{:U('Account/stuList')}">学生账户管理</a></dd>
		</dl>
		<dl>
			<dt>任务分配</dt>
			<dd><a href="{:U('Task/index')}">评分任务分配</a></dd>
		</dl>
		<dl>
			<dt>作品管理</dt>
			<dd><a href="{:U('Reginfo/index')}">作品列表</a></dd>
		</dl>
	</div>
	<div id="right">
		<block name="main"></block>
	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>