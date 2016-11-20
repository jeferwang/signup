<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>后台管理-评分任务分配</title>

	<style type="text/css">
		#table tr:hover {
			background: #eeeeee;
		}
		
		#table tr:hover td {
			background: none;
		}
	</style>
	<script type="text/javascript">
		var select_all = document.getElementById("select_all");
		function selectAll() {
			var obj = document.getElementsByClassName("select_box");
			if (document.getElementById("select_all").checked == false) {
				for (var i = 0; i < obj.length; i++) {
					obj[i].checked = false;
				}
			} else {
				for (var i = 0; i < obj.length; i++) {
					obj[i].checked = true;
				}
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
			<a href="javascript:void(0)" >当前位置:评分任务分配</a>
			


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
		
	<form action="<?php echo U('Task/runAddTask');?>" method="post">
		<input type="hidden" name="matchid" id="matchid" value="<?php echo ($match_info['id']); ?>"/>
		<p style="margin: 10px 0 0 40px;font-size: 18px;">
			<span style="margin-right: 30px;">所选比赛项目：<?php echo ($match_info['title']); ?></span>
			<span style="color: red;">&gt;&gt;选择评委老师：
			<select name="teacher">
				<?php if(is_array($tea_list)): foreach($tea_list as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['code']); ?></option><?php endforeach; endif; ?>
		</select></span>
			<span><input type="submit" value="分配所选任务到评委老师"/></span>
			<!--		<span style="color: orange;">注意：如果您勾选的作品已经有评委老师，那么新分配的评委老师将会替换原来的</span>-->
		</p>
		<table id="table" border="1" style="width: 97%;margin: 20px 0 0 2%;">
			<tr>
				<th width="5%"><input type="checkbox" id="select_all" onclick="selectAll()"/>全选</th>
				<th width="5%">ID</th>
				<th width="10%">学院</th>
				<th width="7%">编号</th>
				<th width="10%">团队名</th>
				<th width="20%">作品标题</th>
				<th width="10%">作品类型</th>
				<th width="33%">评委</th>
			</tr>
			<?php if(is_array($zp_list)): foreach($zp_list as $key=>$vo): ?><tr>
					<td align="center"><input type="checkbox" name="task[]" class="select_box" value="<?php echo ($vo['id']); ?>"/></td>
					<td align="center"><?php echo ($vo['id']); ?></td>
					<td><?php echo ($vo['college']); ?></td>
					<td><?php echo ($vo['code']); ?></td>
					<td><?php echo ($vo['team']); ?></td>
					<td><?php echo ($vo['title']); ?></td>
					<td><?php echo ($vo['type']); ?></td>
					<td>
						<?php if(is_array($vo["pw"])): foreach($vo["pw"] as $key=>$oneTea): ?><span>[ <font color="orange"><?php echo ($oneTea['code']); ?></font> 评分:<font color="green">
								<?php
 if ($oneTea['score']) { echo $oneTea['score']; } else { echo '无'; } ?>
								
							</font> ] </span><?php endforeach; endif; ?>
					</td>
				</tr><?php endforeach; endif; ?>
			<th colspan="8" align="center" class="page">
				<?php if($showpage == null): ?>已显示所有条目
					<?php else: ?>
					<?php echo ($showpage); endif; ?>
			</th>
		</table>
	</form>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>