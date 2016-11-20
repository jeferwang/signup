<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>欢迎各位学生报名比赛</title>
	<link rel="stylesheet" href="/signup/Public/App/style/main.css">
	<link rel="stylesheet" href="/signup/Public/App/style/student.css">
	<link rel="stylesheet" href="/signup/Public/App/style/footer.css">
	<!--[if IE]-->
	<style type=”text/css”>
　　.clearfix {zoom: 1;/* triggers hasLayout */
　　display: block;/* resets display for IE/Win */}
	</style>
	
	<script src="/signup/Public/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
	<style type="text/css">
		fieldset {
			border: 1px solid #888;
			padding: 20px;
		}
		
		#team, #title, .teaminfo {
			padding: 5px;
			border: none;
			border-bottom: 1px solid black;
			font-size: 14px;
			width: 80%;
		}
	</style>
	<script>
		function addInput() {
			$("#teaminfo").append('<div class="onePerson"><span>新队员：</span><input type="text" name="teaminfo[]" class="teaminfo""/><br /></div>');
		}
	</script>

</head>
<body>

	<!-- 头部开始 -->
	<div id="header">
		<p>
			<span><?php echo (cookie('sCode')); ?></span>
			<a href="<?php echo U('Index/logout',array('type'=>'student'));?>">退出</a>
		</p>
	</div>
	<!-- 头部结束 -->

	<!-- 创建、审核、评分开始 -->
	<!-- 注：
	红色代表选中，蓝色代表有权限选择，灰色代表没有权限 -->
	<div id="nav">
		<ul>
			
			<li>
				<a class="clearfix" href="<?php echo U('Student/index');?>" id="upload">
					<i class="i_left"></i>
					<i class="i_right"></i>
					<div class="hexagon">
						<s></s>
						<b></b>
						<span>报名</span>
					</div>
				</a>
			</li>
		</ul>
	</div>
	<!-- 创建、审核、评分级结束 -->
	
	<!-- 上传页面开始 -->
	<div class="upload">
		<div class="nav_title">
			<ul>
				<li class="arrow left"><a href="#">&lt;</a></li>
				<li class="nav_focus" style="width: auto;">
					<a><?php echo ($match_info['title']); ?></a>
				</li>
				<li class="arrow right"><a href="#">&gt;</a></li>
			
			</ul>
		</div>
		<form class="clearfix" action="<?php echo U('Student/update');?>" method="post" enctype="multipart/form-data">
			<!-- <p>下载文档</p> -->
			<div class="upload_nav">
				<!-- <p>上传文件</p> -->
				<div class="upload_nav_team">
					<span>团队名称:</span>
					<br/>
					<input type="text" name="team" id="team" value="<?php echo ($reginfo['team']); ?>">
					<br>
					<span>作品名称:</span>
					<br/>
					<input type="text" name="title" id="title" value="<?php echo ($reginfo['title']); ?>">
					<br/>
					<span class="zuopin">作品简介：</span>
					<textarea style="width: 100%;" rows="10" name="info"><?php echo ($reginfo['info']); ?></textarea>
					<br/>
					<span>队伍信息：<input style="border: 1px solid #888;padding: 2px;" type="button" onclick="addInput()" value="添加队员+"/>
						<span style="color: red;">最多<?php echo ($match_info['limit']); ?>人</span></span>
					<br/>
					<fieldset id="teaminfo">
						<legend>队员列表</legend>
						<span style="margin-bottom: 20px;color: #888888">&emsp;格式：姓名-学号-学院-联系方式</span>
						<?php $i = 0; ?>
						<?php foreach ($reginfo['teaminfo'] as $vo) { ?>
							<?php $i++ ?>
							<div class="onePerson">
								<span>队员<?php echo ($i); ?>：</span>
								<input type="text" name="teaminfo[]" class="teaminfo" value="<?php echo ($vo); ?>"/>
								<br/>
							</div>
							
							<?php
 } if ($i < $match_info['limit']) { $i++; for ($i; $i <= $match_info['limit']; $i++) { ?>
								<div class="onePerson">
									<span>队员<?php echo ($i); ?>：</span>
									<input type="text" name="teaminfo[]" class="teaminfo"/>
									<br/>
								</div>
								<?php
 } } ?>
					</fieldset>
					<br/>
					<!--上传文件区-->
					<fieldset id="">
						<legend>作品申报书:</legend>
						<input type="file" class="file" name="shenbaoshu">
					</fieldset>
					<fieldset id="">
						<legend>演示PPT:</legend>
						<input type="file" class="file" name="ppt">
					</fieldset>
					<fieldset id="">
						<legend>相关图片:</legend>
						<input type="file" class="file" name="tupian">
					</fieldset>
					<fieldset id="">
						<legend>作品说明文档:</legend>
						<input type="file" class="file" name="shuoming">
					</fieldset>
					<fieldset id="">
						<legend>参赛作品:</legend>
						<input type="file" class="file" name="zuopin">
					</fieldset>
					<!--上传文件结束-->
					
					<br/>
					<fieldset id="guide">
						<legend>指导老师</legend>
						<div>填写格式：<span style="color: blue;">姓名-学院</span></div>
						<?php $guide=json_decode($reginfo['guide'],true) ?>
						<input type="text" class="teaminfo" name="guide[]" placeholder="指导老师1" required value="<?=$guide[0]?>">
						<input type="text" class="teaminfo" name="guide[]" placeholder="指导老师2(没有可不填)" value="<?=$guide[1]?$guide[1]:''?>">
					</fieldset>
					<br/>
					<span class="upload_style">格式限制：
					<?php if($match_info['extension'] != null): echo ($match_info['extension']); ?>
					    <?php else: ?>
						无<?php endif; ?>
					</span>
					<input type="submit" value="上传">
				</div>
			</div>
		</form>
	</div>
	<!-- 上传页面结束 -->

	<div class="footer-style">
    		<p>copyright&copy; 2016 行思工作室　版权所有</p>
    </div>
</body>
</html>