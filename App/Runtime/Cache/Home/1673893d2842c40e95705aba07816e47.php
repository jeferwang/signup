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
					<li class="nav_focus">
						<a href="<?php echo U('Teacher/index');?>">
							创建项目
						</a>
					</li>
					<li>
						<a href="<?php echo U('Teacher/history');?>">
							历史发布
						</a>
					</li>
				</ul>
			</div>
			<!-- 创建项目开始	这里引入creative.css页面 -->
			<form action="<?php echo U('Teacher/addMatch');?>" method="post" enctype="multipart/form-data">
				<div>
					<span>比赛项目</span>
					<input type="text" name="name">
				</div>
				<div>
					<span class="special">比赛说明</span>
					<textarea name="contest help" cols="30" rows="10"></textarea>
				</div>
				<div>
					<span>文件上传</span>
					<input type="file" name="file">
				</div>
				<div>
					<span>限制设置</span>
					<input type="checkbox" name="zip">
					<span>
					<a href="#">
						.zip/rar
					</a></span>
					<input type="checkbox" name="doc">
					<span>
					<a href="#">
						.doc/docx
					</a></span>
					<input type="checkbox" name="ppt">
					<span>
					<a href="#">
						.ppt/pptx
					</a></span>
				</div>
				<div class="button">
					<input type="submit" name="submit" value="发布">
					<input type="submit" name="submit" value="储存">
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