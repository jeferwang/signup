<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/signup/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/signup/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/signup/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/signup/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>
	<?php echo ($match['title']); ?>作品
</title>

	<style type="text/css">
		#form {
			padding: 2px;
		}
		
		.score {
			width: 30px;
		}
		
		#info_box {
			display: none;
			z-index: 999;
			border: 5px solid #ccc;
			width: 60%;
			height: 400px;
			overflow: auto;
			overflow-x: hidden;
			position: absolute;
			top: 100px;
			margin-left: 15%;
			background: #eee;
			padding: 15px;
		}
	</style>
	<script>
		function showInfo($id) {
			$("#info_box").show(300);
			$.post("<?php echo U('Reginfo/getAllInfo');?>", {'id': $id}, function (data) {
				$("#show_info").show().html(data);
				$("#tips").hide();
			});
		}
		function closeInfo() {
			$("#info_box").hide(200);
			$("#tips").show();
		}
	</script>

<head>
</head>
<body>
	<div id="top">
		<div>
		</div>
		<div class="menu">
			<a href="javascript:void(0)" >当前位置:
	<?php echo ($match['title']); ?>作品
</a>
			
	<a href="<?php echo U('Reginfo/index');?>">选择比赛</a>
	<a href="<?php echo U('Reginfo/export');?>">导出到Excel</a>

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
		
	<div id="form">
		<form action="" method="post">
			<label for="college">学院:</label>
			<select name="collegeid" id="college">
				<option value="">所有学院</option>
				<?php if(is_array($college)): foreach($college as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['college']); ?></option><?php endforeach; endif; ?>
			</select>
			<label for="status"></label>
			<select name="status">
				<option value="">所有状态</option>
				<option value="0">未审核</option>
				<option value="1">已通过学院审核</option>
				<option value="2">已通过学校审核</option>
				<option value="3">已评分</option>
				<option value="4">未通过学院审核</option>
				<option value="5">未通过学校审核</option>
			</select>
			<select name="sort" id="">
				<option value="college">按学院排序</option>
				<option value="type">按类别排序</option>
				<option value="avg">按平均分排序</option>
			</select>
			<!--	<label>-->
			<!--		分数段：-->
			<!--		<input type="text" name="score_min" id="score_min" class="score"/>-->
			<!--		~-->
			<!--		<input type="text" name="score_max" id="score_max" class="score" />-->
			<!--	</label>-->
			<input type="submit" value="检索"/>
		</form>
	</div>
	<table border="1">
		<thead>
		<tr>
			<th align="center">ID</th>
			<th align="center">队伍名称</th>
			<th align="center">作品标题</th>
			<th align="center">作品类别</th>
			<th align="center">所属学院</th>
			<th align="center">作品状态</th>
			<th align="center">评阅分数</th>
			<th align="center">平均分</th>
			<th align="center">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
				<td align="center"><?php echo ($vo['id']); ?></td>
				<td><?php echo ($vo['code']); ?>--<?php echo ($vo['team']); ?></td>
				<td><?php echo ($vo['title']); ?></td>
				<td><?php echo ($vo['type']); ?></td>
				<td align="center"><?php echo ($vo['college']['college']); ?></td>
				<td align="center"><?php echo ($vo['zhuangtai']); ?></td>
				<td align="left">
					<?php
 foreach ($vo['pw'] as $oneTea) { ?>
						<span>[ <font color="orange"><?= $oneTea['code'] ?></font> 评分:<font color="green">
								<?php
 if ($oneTea['score']) { echo $oneTea['score']; } else { echo '无'; } ?>
								
							</font> ] </span>
						<?php
 } ?>
				</td>
				<td align="center"><?= $vo['avg'] ?></td>
				<td align="center">
					<button onclick="showInfo(<?= $vo['id'] ?>)">查看详情</button>
				</td>
			</tr><?php endforeach; endif; ?>
		</tbody>
		<tfoot>
		<tr>
			<td align="center" colspan="9">
				已显示所有条目
			</td>
		</tr>
		</tfoot>
	</table>
	<div id="info_box">
		<p id="close"><span id="close_box" onclick="closeInfo()" style="float: right;width: 15px;text-align: center;cursor: pointer;color: red;border: 1px solid black">x</span></p>
		<p id="tips">正在加载信息，请稍等······</p>
		
		<div id="show_info" style="display: none;">
		
		</div>
	
	</div>

	</div>
	<div id="footer" style="clear: both;">
	    <p align="center">copyright &copy; 2016 <a>行思工作室</a>　版权所有</p>
	</div>
</body>
</html>