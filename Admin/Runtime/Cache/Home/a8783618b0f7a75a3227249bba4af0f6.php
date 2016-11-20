<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>后台管理-修改人才库条目</title>

	<style type="text/css">
	    .info{
	    	margin: 5px 0;
	    }
	</style>

<head>
</head>
<body>
	<div id="top">
		<div>
		</div>
		<div class="menu">
			<a href="javascript:void(0)" >当前位置:修改人才库条目</a>
			
	

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
		
	<form style="margin: 20px 0 0 30px;" method="post" action="<?php echo U('Teashow/runFix');?>" enctype="multipart/form-data">
		<p class="info"><label for="teaname">姓名：</label><input type="text" id="teaname" required="required" name="teaname" style="height: 20px; width: 200px;" maxlength="10" value="<?php echo ($info['teaname']); ?>" />
			<input type="submit" id="submit" value=">>>>执行修改<<<<" style="cursor: pointer;"/>
		</p>
		<input type="hidden" name="id" value="<?php echo ($info['id']); ?>" />
		<p class="info"><label for="imgroute">照片：</label><input type="file" id="imgroute" name="file" style="border: none;width: 200px;" />
			<span style="font-size: 12px;color: orangered;">格式限制:jpg,jpeg,png;不超过1M</span></p>
		<!--		类型-->
		<span>人才类型：</span>
		<label for="zdls"><input type="radio" id="zdls" name="type" value="1" checked>指导老师</label>
		<label for="pwls"><input type="radio" id="pwls" name="type" value="2">评委老师</label>
		<!--百度编辑器-->
		<div id="editor" style="margin-top: 10px;">
				<script id="content" name="content" type="text/plain" style="width: 95%;"><?php echo ($info['content']); ?></script>
				<!-- 配置文件 -->
				<script type="text/javascript" src="/signup/Public/uEditor/ueditor.config.js">
				</script>
				<!-- 编辑器源码文件 -->
				<script type="text/javascript" src="/signup/Public/uEditor/ueditor.all.js">
				</script>
				<!-- 实例化编辑器 -->
				<script type="text/javascript">
				var ue = UE.getEditor('content',{
					initialFrameHeight:600
				});
				</script>
		</div>
	</form>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>