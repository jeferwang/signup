<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>评分务分配-选择比赛项目</title>

	<style type="text/css">
	    #table tr:hover{
	    	background: #eeeeee;
	    }
	    #table tr:hover td{
	    	background: none;
	    }
	</style>

<head>
</head>
<body>
	<div id="top">
		<div>
		</div>
		<div class="menu">
			<a href="javascript:void(0)" >当前位置:选择比赛项目</a>
			
	<a href="<?php echo U('Task/index');?>">选择比赛项目</a>

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
		
	<table id="table" border="1" style="width: 97%;margin: 30px 0 0 2%;">
		<tr>
			<th width="5%">ID</th>
			<th width="30%">比赛项目</th>
			<th width="5%">文档</th>
			<th width="10%">发布时间</th>
			<th width="25%">格式限制</th>
			<th width="10%">状态</th>
			<th width="15%">操作</th>
		</tr>
		<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
		    	<td align="center"><?php echo ($vo['id']); ?></td>
		    	<td align="left"><?php echo ($vo['title']); ?></td>
		    	<td align="center">
		    		<a href="/signup<?php echo ($vo['document']); ?>">下载</a>
		    	</td>
		    	<td align="center"><?php echo ($vo['starttime']); ?></td>
		    	<td align="center"><?php echo ($vo['extension']); ?></td>
		    	<td align="center">
		    		<?php if($vo['status'] == 0): ?><font color="orangered">未发布</font>
		    		    <?php elseif($vo['status'] == 1): ?>
		    		        <font color="green">已发布</font>
		    		    <?php elseif($vo['status'] == 2): ?> 
		    		        <font color="gray">已结束</font><?php endif; ?>
		    	</td>
		    	<td align="center">
		    		<a href="<?php echo U('Task/taskList',array('mid'=>$vo['id']));?>">[分配评分人员]</a> 
		    	</td>
		    </tr><?php endforeach; endif; ?>
		<th colspan="7" align="center" class="page">
				<?php if($showpage == null): ?>已显示所有条目
				<?php else: ?>
				<?php echo ($showpage); endif; ?>
		</th>
	</table>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>