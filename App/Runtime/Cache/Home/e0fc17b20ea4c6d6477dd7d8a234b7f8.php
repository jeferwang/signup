<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>创建项目</title>
		<link rel="stylesheet" href="/Public/App/style/main.css">
		<link rel="stylesheet" href="/Public/App/style/teacher.css">
		<link rel="stylesheet" href="/Public/App/style/footer.css">
		<script src="/Public/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/Public/App/js/teacher.js"></script>
		
	<style type="text/css">
		.fixStatus{
		    width: 82px;
		    height: 26px;
		    background-color: #fff;
		    border: 1px solid #003567;
		    border-radius: 5px;
		    margin: 0 30px;
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
					<a class="clearfix" id="validate" href="<?php echo U('Teacher/examine');?>">
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
					<a class="clearfix unselect" id="examine" href="<?php echo U('Teacher/evaluate');?>">
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
							<?php echo ($info['title']); ?>--详情
						</a>
					</li>
				</ul>
			</div>
			<!-- 创建项目开始	这里引入creative.css页面 -->
			<form action="<?php echo U('Teacher/addMatch');?>" method="post" enctype="multipart/form-data">
				<div>
					<span style="color: #666;">项目名称:</span><span style="padding-bottom: 1px;border-bottom: 1px solid black;"><?php echo ($info['title']); ?></span>
						<?php if($info['status'] == '0'): ?><span style="font-size: small;">(未发布)</span><?php endif; ?>	
				</div>
				<div>
					<span style="color: #666666;">比赛说明:</span>
					<div name="contest help">&emsp;&emsp;<?php echo ($info['info']); ?></div>
				</div>
				<div>
					<span style="color: #666666;">文档下载:</span><span><a href="<?php echo ($info['document']); ?>"><input type="button" style="padding: 5px; background: skyblue;cursor: pointer;" value="下载说明文档" /></a></span>
				</div>
				<div class="button">
					<?php if($info['status'] == '0'): ?><a href="<?php echo U('Teacher/rePublish',array('id'=>$info['id']));?>"><input type="button" class="fixStatus" value="执行发布"></a>
					<?php elseif($info['status'] == '1'): ?>
						<a href="<?php echo U('Teacher/endMatch',array('id'=>$info['id']));?>"><input type="button" class="fixStatus" value="结束本场比赛"></a><?php endif; ?>
				</div>
			</form>
			<!-- 创建项目结束 -->
		</div>
		<!-- 创建结束 -->

		<div class="footer-style">
    		<p>copyright&copy; 2016 行思工作室　版权所有</p>
    	</div>
	</body>
</html>