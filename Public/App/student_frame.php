<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><block name="title"></block></title>
	<link rel="stylesheet" href="__PUBLIC__/App/style/main.css">
	<link rel="stylesheet" href="__PUBLIC__/App/style/student.css">
	<link rel="stylesheet" href="__PUBLIC__/App/style/footer.css">
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
	<script src="__PUBLIC__/App/js/jquery-1.11.2.min.js"></script>
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
				$.post("{:U('Index/change_password')}", {'old': old_p, 'new': new_p, 're': re_p}, function (data) {
					if (data == 'Success') {
						alert("修改成功！");
						window.location.href="{:U('Index/logout')}"
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
	<block name="css_js"></block>
</head>
<body>

	<!-- 头部开始 -->
	<div id="header">
		<p>
			<span>{$Think.cookie.sCode}</span>
			<span><a href="javascript:void (0)" id="change_password">修改密码</a></span>
			<a href="{:U('Index/logout',array('type'=>'student'))}">退出</a>
		</p>
	</div>
	<!-- 头部结束 -->

	<!-- 创建、审核、评分开始 -->
	<!-- 注：
	红色代表选中，蓝色代表有权限选择，灰色代表没有权限 -->
	<div id="nav">
		<ul>
			
			<li>
				<a class="clearfix" href="{:U('Student/index')}" id="upload">
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
	<block name='main'></block>
	<div class="footer-style">
    		<p>copyright&copy; 2016 行思工作室　版权所有</p>
    </div>
</body>
</html>