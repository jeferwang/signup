<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/Public/Admin/Css/index.css" />
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
			<a href="javascript:void(0)">当前位置:修改人才库条目</a>
			
	

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
			<dd><a href="#">删除比赛</a></dd>
			<dd><a href="#">学院管理</a></dd>
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
		
	<form style="margin: 20px 0 0 30px;" method="post" action="<?php echo U('People/runFix');?>" enctype="multipart/form-data">
		<p class="info"><label for="teaname">姓名：</label><input type="text" id="teaname" name="teaname" style="height: 20px; width: 200px;" maxlength="10" value="<?php echo ($info['teaname']); ?>" />
			<input type="submit" id="submit" value=">>>>执行修改<<<<" style="cursor: pointer;"/>
		</p>
		<input type="hidden" name="id" value="<?php echo ($info['id']); ?>" />
		<p class="info"><label for="imgroute">照片：</label><input type="file" id="imgroute" name="file" style="border: none;width: 200px;" />
			<span style="font-size: 12px;color: orangered;">格式限制:jpg,jpeg,png;不超过1M</span></p>
		<!--百度编辑器-->
		<div id="editor" style="margin-top: 10px;">
				<script id="content" name="content" type="text/plain" style="width: 95%;"><?php echo ($info['content']); ?></script>
				<!-- 配置文件 -->
				<script type="text/javascript" src="/Public/uEditor/ueditor.config.js">
				</script>
				<!-- 编辑器源码文件 -->
				<script type="text/javascript" src="/Public/uEditor/ueditor.all.js">
				</script>
				<!-- 实例化编辑器 -->
				<script type="text/javascript">
				var ue = UE.getEditor('content',{
					initialFrameHeight:600,
				});
				</script>
		</div>
	</form>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a href="http://www.xsgzs.org/" target="_blank">行思工作室</a>　版权所有</p>
	</div>
</body>
</html>