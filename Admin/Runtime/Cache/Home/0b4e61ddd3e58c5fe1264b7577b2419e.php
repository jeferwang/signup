<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>后台管理-教师账户管理</title>

	<style type="text/css">
		#add_admin input[type=text] {
			width: 15%;
			height: 25px;
			margin-right: 5px;
		}
		
		#add_admin input[type=submit] {
			padding: 5px 10px;
			border-radius: 20px 0 20px 0;
			outline: none;
		}
		
		#table tr:hover {
			background: #eeeeee;
		}
		
		#table tr:hover td {
			background: none;
		}
	</style>
	<script>
		function deleteItem($url) {
			var $del = confirm("确认禁用吗？");
			if ($del) {
				window.location.href = $url;
			} else {
				return false;
			}
		}
		function recoverItem($url) {
			window.location.href = $url;
		}
		function deleteReal($url) {
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
			<a href="javascript:void(0)" >当前位置:教师账户管理</a>
			

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
		
	<form action="<?php echo U('Account/runAddTea');?>" id="add_admin" style="margin: 20px 0 0 40px;" method="post">
		<label for="match">选择比赛：
			<select name="matchid" id="match">
				<?php if(is_array($match)): foreach($match as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['title']); ?></option><?php endforeach; endif; ?>
			</select>
		</label>
		<label for="type">账户类型:
			<select name="type" id="type">
				<option value="hpu">学校账户</option>
				<option value="pw">评委老师</option>
				<?php
 foreach ($college_list as $vo) { if ($vo['del'] == 0) { ?>
						<option value="<?php echo ($vo['code']); ?>">学院-<?php echo ($vo['college']); ?></option>
						<?php
 } } ?>
			</select>
		</label>
		<label>登录密码: <input type="text" name="password" id="password" placeholder="输入默认密码" required="required"/></label>
		<label for="ccount">数量: <input type="text" name="count" id="count" placeholder="输入账号数量" required="required" maxlength="12"/></label>
		<input type="submit" value="生成账户"/>
	</form>
	<table border="1" id="table" style="margin: 20px 0 0 2%; width: 97%;">
		<tr>
			<th align="center">ID</th>
			<th align="center">编号</th>
			<th align="center">比赛</th>
			<th align="center">类别/学院</th>
			<th align="center">操作</th>
		</tr>
		<?php
 foreach ($list as $vo) { if ($vo['del'] == 0) { ?>
				<tr>
					<td align="center" width="10%"><?php echo ($vo['id']); ?></td>
					<td align="center" width="20%"><?php echo ($vo['code']); ?></td>
					<td align="center" width="20%"><?php echo ($vo['match']); ?></td>
					<td align="center" width="30%"><?php echo ($vo['college']); ?></td>
					<td align="center" width="20%">
						<?php
 if ($vo['status'] == 1) { ?>
							<button style="background: lightgreen;padding: 3px;" onclick="deleteItem('<?php echo U('Account/runDelTea',array('id'=>$vo['id']));?>')">禁用</button>
							<?php
 } elseif ($vo['status'] == 2) { ?>
							<button style="background: pink;padding: 3px;" onclick="recoverItem('<?php echo U('Account/runRecTea',array('id'=>$vo['id']));?>')">启用</button>
							<?php
 } ?>
						<button style="border: 2px solid red;padding: 3px;" onclick="deleteReal('<?php echo U('Account/runRealDelTea',array('id'=>$vo['id']));?>')">删除！</button>
					</td>
				</tr>
				<?php
 } } ?>
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