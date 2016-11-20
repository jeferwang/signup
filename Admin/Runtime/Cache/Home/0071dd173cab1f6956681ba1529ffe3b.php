<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>后台管理-管理员列表</title>

	<style type="text/css">
		#add_admin input[type=text]{
			width: 20%;
			height: 25px;
			margin-right: 5px;
		}
		#add_admin input[type=submit]{
			padding: 5px 10px;
			border-radius: 20px 0 20px 0;
			outline: none;
		}
	    #table tr:hover{
	    	background: #eeeeee;
	    }
	    #table tr:hover td{
	    	background: none;
	    }
	</style>
	<script>
		function deleteItem($url) {
			var $del = confirm("确认删除吗？");
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
		
	<form action="<?php echo U('Account/runAddAdmin');?>" id="add_admin" style="margin: 20px 0 0 40px;" method="post">
	    <label>用户: <input type="text" name="username" id="username" placeholder="输入管理员登录用户名" required="required" /></label>
	    <label>密码: <input type="text" name="password" id="password" placeholder="输入管登录密码" required="required" /></label>
	    <input type="submit" value="添加管理员"/>
	</form>
	<table border="1" id="table" style="margin: 20px 0 0 2%; width: 97%;">
		<tr>
			<th align="center">ID</th>
			<th align="center">姓名</th>
			<th align="center">最近登录</th>
			<th align="center">登录IP</th>
			<th align="center">操作</th>
		</tr>
		<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
		    	<td align="center" width="20%"><?php echo ($vo['id']); ?></td>
		    	<td align="center" width="20%"><?php echo ($vo['username']); ?></td>
		    	<td align="center" width="20%"><?php echo ($vo['logindate']); ?></td>
		    	<td align="center" width="20%"><?php echo ($vo['loginip']); ?></td>
		    	<td align="center" width="20%">
				    <button onclick="deleteItem('<?php echo U('Account/runDelAdmin',array('id'=>$vo['id']));?>')">删除</button>
		    	</td>
		    </tr><?php endforeach; endif; ?>
		<tr>
			<td colspan="5" align="center" class="page">
				<?php if($showpage == null): ?>已显示所有条目
				<?php else: ?>
				<?php echo ($showpage); endif; ?>
			</td>
		</tr>
	</table>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>