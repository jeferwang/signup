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
	    #title{
			border-bottom: 1px solid #000;
			width: 150px;
			height: 20px;
			margin-bottom: 10px;
			width: 390px;
			font-size: 20px;
			padding: 5px;
		}
		.teaminfo{
			border: 1px solid #888;
			width: 100%;
			height: 30px;
			font-size: 18px;
		}
		#bssm div{
			margin: 10px 0 0 0 ;
		}
		#down_a{
			display: block;
			margin: 10px 0 30px -120px;
		}
		#down_btn{
			width: 80px;height: 30px;cursor: pointer;background-color: #446473;color: #fff;
		}
		fieldset{
			border: 1px solid #aaa;
			padding: 5px;
		}
	</style>
	<script type="text/javascript">
		var $num=1;
		function addInput(){
			$num++;
			$("#teaminfo").append('<span>队员'+$num+'：</span><input type="text" name="teaminfo[]" class="teaminfo" /><br>');
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
		<div class="nav_title" >
			<ul>
				<li class="arrow left"><a href="#">&lt;</a></li>
				<li class="nav_focus" style="width: auto;">
					<a><?php echo ($match_info['title']); ?></a>
				</li>
				<li class="arrow right"><a href="#">&gt;</a></li>
				
			</ul>
		</div>
		<form class="clearfix" action="<?php echo U('Student/runUpload');?>" method="post" enctype="multipart/form-data">
				<!-- <p>下载文档</p> -->
 			<div class="upload_nav">
				<!-- <p>上传文件</p> -->
				<div class="upload_nav_team" >
				<div id="bssm">
				<!--比赛说明-->
					<h3 align="center">
						比赛说明
					</h3>
					<div>
						<?php echo ($match_info['info']); ?>
					</div>
						<a href="/signup<?php echo ($match_info['document']); ?> " download title="<?php echo ($match_info['title']); ?>" id="down_a"><input id="down_btn" type="button" value="下载文档"></a>
				</div>
						<span>团队名称:</span>
						<br />
						<input type="text" name="team" style="width: 100%;padding-left: 0;padding-right: 0;">
						<br>
						<span>作品名称:</span>
						<br />
						<input type="text" name="title" id="title" style="width: 100%;padding-left: 0;padding-right: 0;">
						<br />						
						<span class="zuopin">作品简介：</span>
						<textarea style="width: 100%;" rows="10" name="info"></textarea>
						<br />
					<span>队伍信息：<input style="border: 1px solid #888;padding: 2px;" type="button"  onclick="addInput()" value="添加队员+" />
						<span style="color: red;">最多<?php echo ($match_info['limit']); ?>人</span>
						<br />请列举你的队伍的成员的信息，包括学院专业班级信息、联系方式，并指明负责人</span>
					<br />
					<fieldset id="teaminfo">
						<legend>队员列表</legend>
						<span>队员1：</span><input type="text" name="teaminfo[]" class="teaminfo"/><br />
					</fieldset>
					<br />
					
					<fieldset id="">
						<legend>申报书:</legend>
						<input type="file" class="file" name="shenbaoshu">
					</fieldset>
					<fieldset id="">
						<legend>PPT:</legend>
						<input type="file" class="file" name="ppt">
					</fieldset>
					<fieldset id="">
						<legend>说明文档:</legend>
						<input type="file" class="file" name="shuoming">
					</fieldset>
					<fieldset id="">
						<legend>作品:</legend>
						<input type="file" class="file" name="zuopin">
					</fieldset>
					
					
					
					<br />
					<span class="upload_style">格式限制：<?php echo ($match_info['extension']); ?></span>
					<input type="submit" value="上传" >
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