<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>后台管理-作品类型管理</title>

	<style>
		#add {
			margin: 20px 0 0 30px;
		}
		
		#type {
			padding: 5px;
			width: 200px;
		}
		
		#submit_btn {
			padding: 5px;
		}
	</style>
	<script>
		function deleteItem($url) {
			var $del = confirm("确认删除吗？删除之后会影响已经关联了此类型的比赛！");
			if ($del) {
				window.location.href = $url;
			} else {
				return false;
			}
		}
	</script>

<head>
</head>
<body>
	<div id="top">
		<div>
		</div>
		<div class="menu">
			<a href="javascript:void(0)" >当前位置:作品类型管理</a>
			


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
		
	<form action="<?php echo U('Type/add');?>" method="post" id="add">
		<label for="type">作品类型名字：</label>
		<input type="text" name="type" id="type" placeholder="请输入要添加的作品类型" required>
		<input type="submit" value="添加" id="submit_btn">
	</form>
	<table>
		<thead>
		<tr>
			<th>id</th>
			<th>作品类型</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php
 foreach ($types as $key => $type) { ?>
			<tr>
				<td width="20%"><?=$type['id']?></td>
				<td width="60%"><?=$type['type']?></td>
				<td width="20%" align="center"><button onclick="deleteItem('<?php echo U('Type/del',array('typeid'=>$type['id']));?>')">删除</button></td>
			</tr>
			<?php
 } ?>
		</tbody>
	</table>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>