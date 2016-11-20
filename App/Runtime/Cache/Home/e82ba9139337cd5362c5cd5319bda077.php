<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>审核作品</title>
		<link rel="stylesheet" href="/Public/App/style/main.css">
		<link rel="stylesheet" href="/Public/App/style/teacher.css">
		<script src="/Public/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/Public/App/js/teacher.js"></script>
		
	<style type="text/css">
		.prev,.current,.next{
			color: #e1a2ae;
		}
		.pagenavi a{
			margin: 0 5px;
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
		
	<!-- 审核开始 -->
		<div class="verify">
			<!-- 比赛项目开始 -->
			<!-- 一个老师可能会有不同的项目要审核，所以第一个页面是项目，点击具体项目才是比赛内容 -->
			<div class="verify_first">
				<div class="nav_title" >
					<ul>
						<li class="nav_focus" style="width: auto;">
							<a>
								请选择比赛项目
							</a>
						</li>
					</ul>
				</div>
				<div class="game">
					<ul class="page">
					<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li>
							<a href="<?php echo U('Examine/index',array('id'=>$vo['id']));?>">
								<?php echo ($vo['title']); ?>
							</a>
							<p><?php echo ($vo['status']); ?><span><?php echo ($vo['starttime']); ?></span></p>
						</li><?php endforeach; endif; ?>
				</ul>
				<div class="pagenavi">
					<?php echo ($page); ?>
				</div>
				</div>
			</div>
			<!-- 比赛项目结束 -->
			</div>

	</body>
</html>