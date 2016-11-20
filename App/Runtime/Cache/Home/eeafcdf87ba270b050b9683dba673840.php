<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		作品评分列表
	</title>
	<link rel="stylesheet" href="/signup/Public/App/style/main.css">
	<link rel="stylesheet" href="/signup/Public/App/style/teacher.css">
	<link rel="stylesheet" href="/signup/Public/App/style/footer.css">
	<script src="/signup/Public/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/signup/Public/App/js/teacher.js"></script>
	
	<style type="text/css">
		
	</style>
	<script type="text/javascript">
		$().ready(function(){
			$("#shen_he").addClass("unselect");
		});
	</script>

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
</head>
<body>
<!-- 头部开始 -->
<div id="header">
	<p>
		<span><?php echo (cookie('tCode')); ?></span>
		<span><a href="javascript:void (0)" id="change_password">修改密码</a></span>
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
			<a class="clearfix" id="shen_he">
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
			<a class="clearfix" id="ping_fen">
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

	<!-- 评分开始 -->
		<div class="verify">
			<!--点击比赛项目之后显示队伍列表 -->
			<div class="verify_first">
				<div class="nav_title" >
					<ul>
						<li class="nav_focus" style="width: auto;">
							<a>
								<!--比赛名-->
								<?php echo ($matchInfo['title']); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="game">
					<ul class="page">
					<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li>
							<!--队伍点击之后进入的页面-->
							<a href="<?php echo U('Evaluate/teamInfo',array('id'=>$vo['id']));?>">
								<?php echo ($vo['title']); ?>--<?php echo ($vo['code']); ?>
							</a>
							<p>
								<span><?php echo ($vo['zhuangtai']); ?></span>
								<span style="padding-right: 5px;border-right: 1px solid black;"><a style="width: auto;" href="<?php echo U('Evaluate/teamInfo',array('id'=>$vo['id']));?>">查看详情</a></span>
								<span><?=date('Y-m-d',$vo['date'])?></span>
							</p>
						</li><?php endforeach; endif; ?>
				</ul>
				<div class="pagenavi">
					<?php echo ($showPage); ?>
				</div>
				</div>
			</div>
			<!-- 比赛项目结束 -->
			</div>

<div class="footer-style">
	<p>copyright&copy; 2016 行思工作室　版权所有</p>
</div>
</body>
</html>