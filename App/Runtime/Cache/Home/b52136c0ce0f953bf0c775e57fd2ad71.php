<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		比赛评分
	</title>
	<link rel="stylesheet" href="/signup/Public/App/style/main.css">
	<link rel="stylesheet" href="/signup/Public/App/style/teacher.css">
	<link rel="stylesheet" href="/signup/Public/App/style/footer.css">
	<script src="/signup/Public/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/signup/Public/App/js/teacher.js"></script>
	
	<style type="text/css">
		.sub_button {
			width: 82px;
			height: 26px;
			background-color: lightgreen;
			border: 1px solid #003567;
			border-radius: 5px;
			cursor: pointer;
		}
		
		.info_box {
			margin-top: 20px;
		}
		
		.info_label {
			margin-right: 20px;
			color: #666666;
		}
		
		#teamlist td {
			border: 1px solid #888;
		}
		
		#teamlist td {
			padding: 5px;
			width: 50%;
		}
		
		#suggest {
			height: 100px;
		}
	</style>
	<script type="text/javascript">
		$().ready(function () {
			$("#shen_he").addClass("unselect");
		});
	</script>

	<!--[if IE]-->
	<style type=”text/css”>.clearfix {
			zoom: 1;
			/* triggers hasLayout */
			display: block;
			/* resets display for IE/Win */
		}
	</style>
	<script>
		window.onload(function () {
			$("#change_password").click(function () {
				
			})
		})
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
<!-- 创建、审核、评分级结束 -->

	<!--	--><? //=dump($info['pw'])?>
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
		<div class="info_box">
			<span class="info_label">当前状态:</span>
			<!--			<span><?php echo ($info['zhuangtai']); ?></span>-->
			<?php
 foreach ($info['pw'] as $pw) { if ($pw['pwid'] == cookie('tId')) { $thisPw = $pw; } } if ($thisPw['score'] == null) { ?>
				<span style="color: red;">您未评分</span>
				<?php
 } else { ?>
				<span style="color: green;">您的评分:<?php echo ($thisPw['score']); ?></span>
				<?php
 } ?>
		
		</div>
		<!--				<div class="info_box">-->
		<!--					<span class="info_label">学生编号:</span><span><?php echo ($info['code']); ?></span>-->
		<!--				</div>-->
		<div class="info_box">
			<span class="info_label">团队名称:</span><span><?php echo ($info['team']); ?></span>
		</div>
		<!--				<div class="info_box">-->
		<!--					<table id="teamlist" cellspacing="0">-->
		<!--						<tr>-->
		<!--							<th>成员列表</th>-->
		<!--						</tr>-->
		<!--					--><?php
 ?><!--	-->
		<!--					<tr><td align="center">--><? //=$v?><!--</td></tr>-->
		<!--					--><?php  ?>
		<!--					</table>-->
		<!--				</div>-->
		<div class="info_box">
			<span class="info_label">作品标题:</span><span><?php echo ($info['title']); ?></span>
		</div>
		<div class="info_box">
			<span class="info_label">作品类型:</span><span><?php echo ($info['type']); ?></span>
		</div>
		<div class="info_box">
			<span class="info_label">作品简要说明:</span>
			<br/>
			<span name="contest help">&emsp;&emsp;<?php echo ($info['info']); ?></span>
		</div>
		<div class="info_box">
			<!--继承Public/App下的下载链接文件，方便修改-->
			<span class="info_label">作品下载</span>
<span>
<!--申报书-->
<?php if($info['fileroute']['shenbaoshu']['name'] != null): ?><a class="special" href="/signup/Uploads<?php echo ($info['fileroute']['shenbaoshu']['route']); ?>" download="<?php echo ($info['fileroute']['shenbaoshu']['name']); ?>" style="color: blue;">
		[申报书]
	</a><?php endif; ?>
<!--演示ppt-->
<?php if($info['fileroute']['ppt']['name'] != null): ?><a class="special" href="/signup/Uploads<?php echo ($info['fileroute']['ppt']['route']); ?>" download="<?php echo ($info['fileroute']['ppt']['name']); ?>" style="color: blue;">
		[演示PPT]
	</a><?php endif; ?>
<!--相关图片-->
<?php if($info['fileroute']['tupian']['name'] != null): ?><a class="special" href="/signup/Uploads<?php echo ($info['fileroute']['tupian']['route']); ?>" download="<?php echo ($info['fileroute']['tupian']['name']); ?>" style="color: blue;">
		[相关图片]
	</a><?php endif; ?>
<!--作品说明文档-->
<?php if($info['fileroute']['shuoming']['name'] != null): ?><a class="special" href="/signup/Uploads<?php echo ($info['fileroute']['shuoming']['route']); ?>" download="<?php echo ($info['fileroute']['shuoming']['name']); ?>" style="color: blue;">
		[作品说明文档]
	</a><?php endif; ?>
<!--参赛作品-->
<?php if($info['fileroute']['zuopin']['name'] != null): ?><a class="special" href="/signup/Uploads<?php echo ($info['fileroute']['zuopin']['route']); ?>" download="<?php echo ($info['fileroute']['zuopin']['name']); ?>" style="color: blue;">
		[参赛作品]
	</a><?php endif; ?>
</span>
		</div>
		<br/>
		<div class="button">
			<!--打分的表单-->
			<form action="<?php echo U('Evaluate/runEvaluate');?>" method="post">
				<textarea name="suggest" id="suggest" placeholder="请输入评语" required="required"><?php echo ($thisPw['suggest']); ?></textarea>
				<br>
				<br>
				<label for="score">分数:</label>
				<input type="text" name="score" id="score" value="<?php echo ($thisPw['score']); ?>" required="required" style="border-bottom: 1px solid #333;"/>
				<input type="hidden" name="id" id="id" value="<?php echo ($info['id']); ?>"/>
				<input type="submit" style="background: #268425;color: white;" value="评分">
			</form>
		</div>
		<!-- 创建项目结束 -->
	</div>
	<!-- 创建结束 -->

<div class="footer-style">
	<p>copyright&copy; 2016 行思工作室　版权所有</p>
</div>
<div id="change_password_box" style="display: block;position: absolute;top: 150px;margin:0 auto;background: white;border: 5px groove #838383">
	<input type="password" placeholder="原密码">
	<input type="password" placeholder="新密码">
	<input type="password" placeholder="重复密码">
	<span id="change_password_tips"></span>
	<input type="button" value="修改密码">
</div>
</body>
</html>