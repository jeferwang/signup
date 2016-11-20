<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>作品审核列表</title>
		<link rel="stylesheet" href="/signup/Public/App/style/main.css">
		<link rel="stylesheet" href="/signup/Public/App/style/teacher.css">
		<link rel="stylesheet" href="/signup/Public/App/style/footer.css">
		<script src="/signup/Public/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/signup/Public/App/js/teacher.js"></script>
		
	<style type="text/css">
		
	</style>
	<script type="text/javascript">
		$().ready(function(){
			$("#ping_fen").addClass("unselect");
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
	</head>
	<body>
		<!-- 头部开始 -->
		<div id="header">
			<p>
				<span><?php echo (cookie('tCode')); ?></span>
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
		
	<!-- 审核开始 -->
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
							<a href="<?php echo U('Examine/examineTeam',array('id'=>$vo['id']));?>"><?php echo ($vo['code']); ?></a>
							<p><span><?php echo ($vo['zhuangtai']); ?></span>
								<span style="padding-right: 5px;border-right: 1px solid black;"><a style="width: auto;" href="<?php echo U('Examine/examineTeam',array('id'=>$vo['id']));?>">查看详情</a></span>
								<span><?=date("Y-m-d H:i:s",$vo['date'])?></span></p>
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