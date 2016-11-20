<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>欢迎各位学生报名比赛</title>
	<link rel="stylesheet" href="/signup/Public/App/style/main.css">
	<link rel="stylesheet" href="/signup/Public/App/style/student.css">
	<link rel="stylesheet" href="/signup/Public/App/style/footer.css">
	<!--[if IE]-->
	<style>
		.clearfix {
			zoom: 1;
			/* triggers hasLayout */
			display: block;
			/* resets display for IE/Win */
		}
		
		#change_password_box {
			display: none;
			position: absolute;
			top: 150px;
			left: 40%;
			width: 400px;
			height: 250px;
			background: white;
			border: 5px groove #ccc;
			padding: 10px;
		}
		
		#change_password_box input[type=password] {
			padding: 10px 0;
			margin: 10px 0;
			border: 1px solid #bbb;
		}
		
		#change_password_box input[type=button] {
			padding: 10px 20px;
			border: 1px solid #bbb;
		}
		
		#passowrd_close {
			width: 20px;
			float: right;
			cursor: pointer;
			font-weight: 900;
			font-size: 20px;
		}
	</style>
	<script src="/signup/Public/App/js/jquery-1.11.2.min.js"></script>
	<script>
		$().ready(function () {
			$("#change_password").click(function () {
				$("#change_password_box").show(500)
			});
			$("#run_change").click(change_password)
		});
		function password_close() {
			$("#change_password_box").hide(500)
		}
		function change_password() {
			var old_p = $("#old_password").val();
			var new_p = $("#new_password").val();
			var re_p = $("#re_password").val();
			if (old_p && new_p && re_p) {
				$.post("<?php echo U('Index/change_password');?>", {'old': old_p, 'new': new_p, 're': re_p}, function (data) {
					if (data == 'Success') {
						alert("修改成功！");
						window.location.href="<?php echo U('Index/logout');?>"
					}else if(data=='OldError'){
						$("#change_password_tips").text("原密码错误")
					}else if(data=='EmptyError'){
						$("#change_password_tips").text("密码不能为空，也不能有空格")
					}else if(data=='SameError'){
						$("#change_password_tips").text("两次输入不一致")
					}
				});
			}
		}
	</script>
	
	<script src="/signup/Public/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
	
	<style type="text/css">
		#title {
			border-bottom: 1px solid #000;
			width: 150px;
			height: 20px;
			margin-bottom: 10px;
			width: 390px;
			font-size: 20px;
			padding: 5px;
		}
		
		.teaminfo {
			border: 1px solid #888;
			width: 100%;
			height: 30px;
			font-size: 18px;
		}
		
		#bssm div {
			margin: 10px 0 0 0;
		}
		
		#down_a {
			display: block;
			margin: 10px 0 30px -120px;
		}
		
		#down_btn {
			width: 80px;
			height: 30px;
			cursor: pointer;
			background-color: #446473;
			color: #fff;
		}
		
		fieldset {
			border: 1px solid #aaa;
			padding: 5px;
		}
		
		#guide input {
			margin-bottom: 5px;
		}
	
	</style>

</head>
<body>

	<!-- 头部开始 -->
	<div id="header">
		<p>
			<span><?php echo (cookie('sCode')); ?></span>
			<span><a href="javascript:void (0)" id="change_password">修改密码</a></span>
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
	<div id="change_password_box">
		<p id="passowrd_close" onclick="password_close()"><span>x</span></p>
		<label for="">原密码：</label>
		<input type="password" placeholder="原密码" id="old_password"><br>
		<label for="">新密码：</label>
		<input type="password" placeholder="新密码" id="new_password"><br>
		<label for="">重复密码：</label>
		<input type="password" placeholder="重复密码" id="re_password"><br>
		<span id="change_password_tips"></span><br>
		<input type="button" value="修改密码" id="run_change"><br>
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
		<form class="clearfix" action="<?php echo U('Student/runUpload');?>" method="post" enctype="multipart/form-data">
			<!-- <p>下载文档</p> -->
			<div class="upload_nav">
				<!-- <p>上传文件</p> -->
				<div class="upload_nav_team">
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
					<br/>
					<input type="text" name="team" style="width: 100%;padding-left: 0;padding-right: 0;">
					<br>
					<span>项目名称:</span>
					<br/>
					<input type="text" name="title" id="title" style="width: 100%;padding-left: 0;padding-right: 0;">
					<br/>
					<label for="type">选择项目类型</label>
					<select name="type" id="type" style="border: 1px solid #777;padding: 5px 10px;">
						<!--						<option value="科技发明制作类">科技发明制作类</option>-->
						<!--						<option value="自然科学类">自然科学类</option>-->
						<!--						<option value="哲学社科类">哲学社科类</option>-->
						<?php
 foreach ($typelist as $key => $type) { ?>
							<option value="<?= $type ?>"><?= $type ?></option>
							<?php
 } ?>
					</select>
					<br>
					<span class="zuopin">作品简介：</span>
					<textarea style="width: 100%;" rows="10" name="info"></textarea>
					<br/>
					<span>队伍信息：
						<br/>请列举你的队伍的成员的信息<br>严格按照 <span style="color: mediumseagreen;">姓名-学号-学院-专业班级-联系方式</span>的格式填写(使用‘-’分割数据)</span>
					<br/>
					<fieldset id="teaminfo">
						<legend>队员列表</legend>
						<span style="color:blue;">队长：</span><input type="text" name="teaminfo[]" class="teaminfo" required/><br/>
						<?php
 for ($i = 1; $i < $match_info['limit']; $i++) { ?>
							<span>队员<?= $i ?>：</span><input type="text" name="teaminfo[]" class="teaminfo"/><br/>
							<?php
 } ?>
					</fieldset>
					<br/>
					<fieldset id="guide">
						<legend>指导老师</legend>
						<div>填写格式：<span style="color: blue;">姓名-学院</span></div>
						<input type="text" class="teaminfo" name="guide[]" placeholder="指导老师1" required>
						<input type="text" class="teaminfo" name="guide[]" placeholder="指导老师2(没有可不填)">
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
						<legend>相关图片资料:</legend>
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
					<span class="upload_style">格式限制：<?= $match_info['extension'] ? $match_info['extension'] : '无' ?></span>
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