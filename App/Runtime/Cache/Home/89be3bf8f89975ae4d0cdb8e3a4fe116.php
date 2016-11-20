<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>比赛评分</title>
		<link rel="stylesheet" href="/Public/App/style/main.css">
		<link rel="stylesheet" href="/Public/App/style/teacher.css">
		<script src="/Public/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/Public/App/js/teacher.js"></script>
		
	<style type="text/css">
		.sub_button{
			width: 82px;
		    height: 26px;
		    background-color: lightgreen;
		    border: 1px solid #003567;
		    border-radius: 5px;
		    cursor: pointer;
		}
	</style>

		<!--[if IE]-->
		<style type=”text/css”>.clearfix {
			zoom: 1;
			/* triggers hasLayout */
			display: block;
			/* resets display for IE/Win */
		}
		</style>
	</head>
	<body>
		<!-- 头部开始 -->
		<div id="header">
			<p>
				<span><?php echo (cookie('teaname')); ?></span>
				<a href="<?php echo U('Index/logout',array('type'=>'teacher'));?>">
					退出
				</a>
			</p>
		</div>
		<!-- 头部结束 -->

		<!-- 创建、审核、评分开始 -->
		<!-- 注：
		红色代表选中，蓝色代表有权限选择，灰色代表没有权限 -->
		<div id="nav">
			<ul>
				<li>
					<a class="clearfix select" id="new" href="<?php echo U('Teacher/index');?>">
						<i class="i_left"></i>
						<i class="i_right"></i>
						<div class="hexagon">
							<s></s>
							<b></b>
							<span>创建</span>
						</div>
					</a>
				</li>
				<li>
					<a class="clearfix" id="validate" href="<?php echo U('Teacher/validate');?>">
						<i class="i_left"></i>
						<i class="i_right"></i>
						<div class="hexagon">
							<s></s>
							<b></b>
							<span>审核</span>
						</div>
					</a>
				</li>
				<li>
					<a class="clearfix unselect" id="examine" href="<?php echo U('Teacher/examine');?>">
						<i class="i_left"></i>
						<i class="i_right"></i>
						<div class="hexagon">
							<s></s>
							<b></b>
							<span>评分</span>
						</div>
					</a>
				</li>
			</ul>
		</div>
		<!-- 创建、审核、评分级结束 -->
		
	<!-- 创建开始 -->
		<div class="creative">
			<div class="nav_title">
				<ul>
					<li class="nav_focus" style="width: auto;">
						<a>
							<?php echo ($info['team']); ?>--报名信息
						</a>
					</li>
				</ul>
			</div>
			<!-- 创建项目开始	这里引入creative.css页面 -->
				<div>
					<span>当前状态:<?php echo ($info['status']); ?></span>
					<span>
						<?php if($info['score'] == null): ?>&emsp;未评分
						<?php else: ?>
						&emsp;已评分,分数:<?php echo ($info['score']); endif; ?>
					</span>
				</div>
				<div>
					<span>团队名称:<?php echo ($info['team']); ?></span>
				</div>
				<div>
					<span>学生学号:<?php echo ($info['stuid']); ?></span>
				</div>
				<div>
					<span>学生姓名:<?php echo ($info['stuname']); ?></span>
				</div>
				<div>
					<span class="special">作品简要说明:</span>
					<span name="contest help"><?php echo ($info['info']); ?></span>
				</div>
				<div>
					<span>作品下载</span>
					<span>
					<a class="special" href="<?php echo ($info['fileroute']); ?>" style="color: blue;">
						[下载]
					</a></span>
				</div>
				<div class="button">
					<!--打分的表单-->
					<form action="<?php echo U('Examine/runEvaluate');?>" method="post">
						<label for="score">分数:</label>
						<input type="text" name="score" id="score" required="required" />
						<input type="hidden" name="id" id="id" value="<?php echo ($info['id']); ?>" />
						<input type="submit" style="background: pink;" value="不通过">
					</form>
				</div>
			<!-- 创建项目结束 -->
		</div>
		<!-- 创建结束 -->

	</body>
</html>