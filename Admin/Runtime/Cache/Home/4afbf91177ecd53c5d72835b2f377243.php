<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>
	后台管理-修改比赛信息
</title>

	<style type="text/css">
		#add_form{
			margin: 20px 0 0 30px;
		}
		#add_form div{
			margin-bottom: 20px;
		}
	    #add_form label{
	    	cursor: pointer;
	    }
	    #add_form input[type=text],#add_form textarea{
	    	border: 1px solid #ccc;
	    }
	    #add_form input[type=text]{
	    	width: 50%;
	    	padding: 5px;
	    }
	    #add_form input[type=submit]{
	    	width: 200px;
	    	height: 30px;
	    	border-radius: 30px 0 30px 0;
	    	outline: none;
	    }
	    #add_form textarea{
	    	width: 80%;
	    	height: 400px;
	    }
	    #ext label{
	    	margin: 0 0 0 20px;
	    	font-size: 15px;
	    }
	    #add_form h1{
	    	font-family: "微软雅黑";
	    	font-size: 20px;
	    	margin-bottom: 20px;
	    	color: #999;
	    }
	</style>

<head>
</head>
<body>
	<div id="top">
		<div>
		</div>
		<div class="menu">
			<a href="javascript:void(0)" >当前位置:
	修改比赛信息
</a>
			
	<a href="<?php echo U('Match/index');?>">
		比赛列表
	</a>
	<a href="<?php echo U('Match/add');?>">
		新增比赛
	</a>

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
		
	<!-- 创建项目开始 -->
	<form id="add_form" action="<?php echo U('Match/runFix');?>" method="post" enctype="multipart/form-data">
		<h1>修改: <?php echo ($info['title']); ?></h1>
		<div>
			<label>比赛项目: <input type="text" name="title" id="title" value="<?php echo ($info['title']); ?>" required="required"></label>
			<input type="hidden" name="id" value="<?php echo ($info['id']); ?>" />
			<label for="">人数限制：<input type="number" name="limit" min="1" max="50" step="1"  value="<?php echo ($info['limit']); ?>"  /></label>
		</div>
		<div>
			<label>比赛说明: <textarea name="info" cols="30" rows="10" style="vertical-align: top;" required="required"><?php echo ($info['info']); ?></textarea></label>
			
		</div>
		<div>
			<label>说明文档: <input type="file" name="file"></label>
			
		</div>
		<fieldset style="padding: 10px;width: 80%">
			<legend>作品类型选项</legend>
			<?php
 foreach ($types as $key=>$type) { ?>
				<label><input type="checkbox" name="type[]" <?php if(in_array($type['id'],$selected_types)) echo 'checked'; ?> value="<?=$type['id']?>"><?=$type['type']?></label>&emsp;&emsp;
				<?php
 } ?>
		</fieldset>
		<div id="ext">
			<span>格式限制: </span>
			<label><input type="checkbox" name="zip">压缩文件</label>
			<label><input type="checkbox" name="doc">office文档</label>
			<label><input type="checkbox" name="img">图片文件</label>
		</div>
		<div class="button">
			<input type="submit" name="submit" value=">>>>更新信息>>>>">
		</div>
	</form>
	<!-- 创建项目结束 -->

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>