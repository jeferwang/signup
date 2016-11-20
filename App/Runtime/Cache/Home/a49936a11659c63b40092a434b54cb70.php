<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
	我的作品信息
</title>
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
		#myinfo p {
			font-family: "微软雅黑";
			line-height: 40px;
		}
		
		.info_label {
			color: #777777;
			margin-right: 20px;
		}
		
		#teamlist td {
			border: 1px solid #888;
		}
		
		#teamlist td {
			padding: 5px;
		}
	</style>

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
	
	<div class="upload">
		<div class="nav_title">
			<ul>
				<li class="arrow left">
					<a href="JavaScript:void(0)">
						&lt;
					</a>
				</li>
				<li class="nav_focus" style="width: auto;">
					<a>
						我的作品信息
					</a>
				</li>
				<li class="arrow right">
					<a href="JavaScript:void(0)">
						&gt;
					</a>
				</li>
			</ul>
		</div>
		<div class="game">
			<div id="myinfo">
				<p><span class="info_label">编号：</span><?php echo ($info['code']); ?>&emsp;&emsp;
					<?php
 if ($info['status'] == 0 || $info['status'] == 4 || $info['status'] == 5) { ?>
						<a href="<?php echo U('Student/update');?>" style="color: blue;">
							修改信息
						</a>
						<?php
 } ?>
				</p>
				<p><span class="info_label">团队名称：</span><?php echo ($info['team']); ?></p>
				<p><span class="info_label">作品名称：</span><?php echo ($info['title']); ?></p>
				<p><span class="info_label">作品类型：</span><?php echo ($info['type']); ?></p>
				<p><span class="info_label">作品简介：</span><?php echo ($info['info']); ?></p>
				
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
				<p><span class="info_label">审核情况：</span>
					<?php echo ($info['zhuangtai']); ?>
				</p>
				<?php if($info['reason'] != null): ?><p><span class="info_label">未通过原因：</span>
						<?php echo ($info['reason']); ?>
					</p><?php endif; ?>
				<?php
 if ($info['pw']) { ?>
					<p class="info_label">评委老师意见：</p>
					<div style="margin-left: 30px">
						<?php
 $i = 1; foreach ($info['pw'] as $one) { if (trim($one['suggest']) != '') { ?>
								<p style="color:dodgerblue;">&emsp;&emsp;评委<?= $i ?>：<?= $one['suggest'] ?></p>
								<?php
 } else { ?>
								<p style="color:orangered;">&emsp;&emsp;评委<?= $i ?>：<?= 暂无建议 ?></p>
								<?php
 } $i++; } ?>
					</div>
					<?php
 } ?>
			</div>
		</div>
	</div>

	<div class="footer-style">
    		<p>copyright&copy; 2016 行思工作室　版权所有</p>
    </div>
</body>
</html>