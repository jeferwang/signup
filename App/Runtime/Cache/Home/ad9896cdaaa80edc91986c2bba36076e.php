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
	<script type="text/javascript">
		$().ready(function(){
			$("#upload").addClass('select');
		});
	</script>
	<style type="text/css">
	    #title{
			border-bottom: 1px solid #000;
			width: 150px;
			height: 20px;
			margin-bottom: 10px;
			width: 390px;
			font-size: 20px;
			padding: 5px;
		}
	</style>

</head>
<body>

	<!-- 头部开始 -->
	<div id="header">
		<p>
			<span><?php echo (cookie('stuname')); ?></span>
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
				<a href="<?php echo U('Student/index');?>" class="clearfix" id="select">
					<i class="i_left"></i>
					<i class="i_right"></i>
					<div class="hexagon">
						<s></s>
						<b></b>
						<span>选择</span>
					</div>
				</a>
			</li>
			<li>
				<a class="clearfix" id="upload">
					<i class="i_left"></i>
					<i class="i_right"></i>
					<div class="hexagon">
						<s></s>
						<b></b>
						<span>上传</span>
					</div>
				</a>
			</li>
		</ul>
	</div>
	<!-- 创建、审核、评分级结束 -->
	
	<!-- 上传页面开始 -->
	<div class="upload">
		<div class="nav_title" >
			<ul>
				<li class="arrow left"><a href="#">&lt;</a></li>
				<li class="nav_focus" style="width: auto;">
					<a><?php echo ($info['title']); ?></a>
				</li>
				<li class="arrow right"><a href="#">&gt;</a></li>
				
			</ul>
		</div>
		<form class="clearfix" action="<?php echo U('Student/runUpload');?>" method="post" enctype="multipart/form-data">
				<!-- <p>下载文档</p> -->
 			<div class="upload_nav">
				<!-- <p>上传文件</p> -->
				<a href="<?php echo ($info['document']); ?>" title="<?php echo ($info['title']); ?>"><input type="button" style="width: 100px;height: 40px;cursor: pointer;background-color: #446473;color: #fff;" value="下载文档"></a>
				<div class="upload_nav_team" >
					<span>团队名称:</span><input type="text" name="team">
					<br>
					<span>作品名称:</span><input type="text" name="title" id="title">
					<br>
					<span style="color: red;">选择学院: <select name="college" style="border: 1px solid #777;">
						<?php if(is_array($college_list)): foreach($college_list as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['college']); ?></option><?php endforeach; endif; ?>
					</select></span>
					<br />
					<span class="zuopin">作品简介：</span>
					<textarea cols="65" rows="10" name="info"></textarea>
					<label>选择文件: <input type="file" class="file" name="file"></label>
					<input type="hidden" name="match" id="match" value="<?php echo ($info['id']); ?>" />
					<br />
					<br />
					<span class="upload_style">格式限制：<?php echo ($info['extension']); ?></span>
					<input type="submit" value="上传" >
				</div>
			</div> 
		</form>
		<div align="center" style="margin: 40px 0;">
			<a href="<?php echo U('Student/teamList',array('id'=>$info['id']));?>" style="font-size: small;color: #666666;">当前比赛的队伍&gt;&gt;</a>
			<br />
			<br />
			<span style="color: #888888;">如果重复报名(未审核状态下),将会使用最新提交的信息</span>
		</div>
	</div>
	<!-- 上传页面结束 -->

	<div class="footer-style">
    		<p>copyright&copy; 2016 行思工作室　版权所有</p>
    </div>
</body>
</html>