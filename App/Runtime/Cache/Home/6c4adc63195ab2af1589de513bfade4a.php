<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>报名审核</title>
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
		
		.info_label {
			margin-right: 20px;
			color: #666;
		}
		
		.info_box {
			margin-top: 20px;
		}
		
		#teamlist td {
			border: 1px solid #888;
		}
		
		#teamlist td {
			padding: 5px;
		}
		#reason{
			height: 100px;
		}
	</style>
	<script type="text/javascript">
		$().ready(function () {
			$("#ping_fen").addClass("unselect");
			$("#shen_he").attr('href', "<?php echo U('Teacher/index');?>");
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
			<span class="info_label">学生编号:</span><span><?php echo ($info['code']); ?></span>
		</div>
		<div class="info_box">
			<span class="info_label">当前状态:</span><span><?php echo ($info['zhuangtai']); ?></span>
		
		</div>
		<div class="info_box">
			<?php if($tea_info['level'] == 2): ?><span>评委评分：</span>
				<span>
								<?php
 if ($info['pw']) { foreach ($info['pw'] as $oneTea) { ?>
										<div>
											<?= $oneTea['code'] ?>&emsp;分数：
											<?php
 if ($oneTea['score']) { echo $oneTea['score']; } else { echo '无'; } ?>
											<span>&emsp;评委建议:</span>
											<?php
 if ($oneTea['suggest']) { echo $oneTea['suggest']; } else { echo '暂无'; } ?>
										</div>
										<?php
 } ?>
									<?php
 } else { echo '暂无'; } ?>
								
						</span><?php endif; ?>
		</div>
		<!--		<div class="info_box">-->
		<!--			-->
		<!--			<div style="margin-left: 30px">-->
		<!--				<?php if(is_array($info["pw"])): foreach($info["pw"] as $key=>$oneTea): ?>-->
		<!--					【-->
		<!--					--><?php
 ?>
		<!--					】<br>-->
		<!--<?php endforeach; endif; ?>-->
		<!--			</div>-->
		<!--		</div>-->
		<div class="info_box">
			<span class="info_label">团队名称:</span><span><?php echo ($info['team']); ?></span>
		</div>
		<div class="info_box">
<!--			<table id="teamlist" cellspacing="0" width="70%">-->
<!--				<tr>-->
<!--					<td colspan="2" style="color: red;">成员列表：(其中第一个为队长)</td>-->
<!--				</tr>-->
<!--				--><?php
?>
<!--					<tr><td align="center" colspan="2">--><?//= $v ?><!--</td></tr>-->
<!--					--><?php
?>
<!--				<tr>-->
<!--					<td style="color: blue;" colspan="2">指导老师：</td>-->
<!--				</tr>-->
<!--				<tr>-->
<!--					<td>--><?//= json_decode($info['guide'], true)[0] ?><!--</td>-->
<!--					<td>--><?//= json_decode($info['guide'], true)[1] ? json_decode($info['guide'], true)[1] : '无' ?><!--</td>-->
<!--				</tr>-->
<!--			</table>-->
			
			<table id="teamlist" cellspacing="0" width="70%">
				<thead>
				<tr>
					<td colspan="5" style="color: red;">成员列表：(其中第一个为队长)</td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>姓名</td>
					<td>学号</td>
					<td>学院</td>
					<td>班级</td>
					<td>联系方式</td>
				</tr>
				
				<?php
 foreach (json_decode($info['teaminfo'], true) as $k => $v) { $v = explode('-', $v); ?>
					<tr>
						<td align="center"><?= $v[0] ?></td>
						<td align="center"><?= $v[1] ?></td>
						<td align="center"><?= $v[2] ?></td>
						<td align="center"><?= $v[3] ?></td>
						<td align="center"><?= $v[4] ?></td>
					</tr>
					<?php
 } ?>
				
				<tr>
					<td colspan="1" style="color: blue;">指导老师：</td>
					<td colspan="2"><?= json_decode($info['guide'], true)[0] ?></td>
					<td colspan="2"><?= json_decode($info['guide'], true)[1] ? json_decode($info['guide'], true)[1] : '无' ?></td>
				</tr>
				</tbody>
			</table>
		</div>
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
			<form action="<?php echo U('Examine/examineFalse');?>" method="post">
				<label for="score">如果不通过,请填写原因:</label>
				<textarea name="reason" id="reason" required="required"><?php echo ($info['reason']); ?></textarea>
				<br/>
				<a href="<?php echo U('Examine/examineTrue',array('id'=>$info['id']));?>"><input type="button" class="sub_button" value="通过"></a>
				<input type="submit" style="background: pink;" value="不通过">
				<input type="hidden" name="id" id="id" value="<?php echo ($info['id']); ?>"/>
			</form>
		</div>
		<!-- 创建项目结束 -->
	</div>
	<!-- 创建结束 -->

		<div class="footer-style">
    		<p>copyright&copy; 2016 行思工作室　版权所有</p>
    	</div>
	</body>
</html>