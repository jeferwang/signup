<extend name='Public/App/teacher_frame.php'/>
<block name="title">报名审核</block>
<block name="css_js">
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
			$("#shen_he").attr('href', "{:U('Teacher/index')}");
		});
	</script>
</block>
<block name="main">
	<!-- 创建开始 -->
	<div class="creative">
		<div class="nav_title">
			<ul>
				<li class="nav_focus" style="width: auto;">
					<a>
						{$info['team']}--报名信息
					</a>
				</li>
			</ul>
		</div>
		<!-- 创建项目开始	这里引入creative.css页面 -->
		<div class="info_box">
			<span class="info_label">学生编号:</span><span>{$info['code']}</span>
		</div>
		<div class="info_box">
			<span class="info_label">当前状态:</span><span>{$info['zhuangtai']}</span>
		
		</div>
		<div class="info_box">
			<if condition="$tea_info['level'] eq 2">
				<span>评委评分：</span>
				<span>
								<?php
								if ($info['pw']) {
									foreach ($info['pw'] as $oneTea) {
										?>
										<div>
											<?= $oneTea['code'] ?>&emsp;分数：
											<?php
											if ($oneTea['score']) {
												echo $oneTea['score'];
											} else {
												echo '无';
											}
											?>
											<span>&emsp;评委建议:</span>
											<?php
											if ($oneTea['suggest']) {
												echo $oneTea['suggest'];
											} else {
												echo '暂无';
											}
											?>
										</div>
										<?php
									}
									?>
									<?php
								} else {
									echo '暂无';
								}
								?>
								
						</span>
			</if>
		</div>
		<!--		<div class="info_box">-->
		<!--			-->
		<!--			<div style="margin-left: 30px">-->
		<!--				<foreach name="info.pw" item="oneTea">-->
		<!--					【-->
		<!--					--><?php
		//					if ($oneTea['suggest']) {
		//						echo $oneTea['code'] . '->' . $oneTea['suggest'];
		//					} else {
		//						echo $oneTea['code'] . '->暂无';
		//					}
		//					?>
		<!--					】<br>-->
		<!--				</foreach>-->
		<!--			</div>-->
		<!--		</div>-->
		<div class="info_box">
			<span class="info_label">团队名称:</span><span>{$info['team']}</span>
		</div>
		<div class="info_box">
<!--			<table id="teamlist" cellspacing="0" width="70%">-->
<!--				<tr>-->
<!--					<td colspan="2" style="color: red;">成员列表：(其中第一个为队长)</td>-->
<!--				</tr>-->
<!--				--><?php
//				foreach (json_decode($info['teaminfo'], true) as $k => $v) {
//					?>
<!--					<tr><td align="center" colspan="2">--><?//= $v ?><!--</td></tr>-->
<!--					--><?php
//				}
//				?>
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
				foreach (json_decode($info['teaminfo'], true) as $k => $v) {
					$v = explode('-', $v);
					?>
					<tr>
						<td align="center"><?= $v[0] ?></td>
						<td align="center"><?= $v[1] ?></td>
						<td align="center"><?= $v[2] ?></td>
						<td align="center"><?= $v[3] ?></td>
						<td align="center"><?= $v[4] ?></td>
					</tr>
					<?php
				}
				?>
				
				<tr>
					<td colspan="1" style="color: blue;">指导老师：</td>
					<td colspan="2"><?= json_decode($info['guide'], true)[0] ?></td>
					<td colspan="2"><?= json_decode($info['guide'], true)[1] ? json_decode($info['guide'], true)[1] : '无' ?></td>
				</tr>
				</tbody>
			</table>
		</div>
		<div class="info_box">
			<span class="info_label">作品标题:</span><span>{$info['title']}</span>
		</div>
		<div class="info_box">
			<span class="info_label">作品类型:</span><span>{$info['type']}</span>
		</div>
		<div class="info_box">
			<span class="info_label">作品简要说明:</span>
			<br/>
			<span name="contest help">&emsp;&emsp;{$info['info']}</span>
		</div>
		<div class="info_box">
			<!--继承Public/App下的下载链接文件，方便修改-->
			<include file="Public/App/downLink.php"/>
		</div>
		<br/>
		<div class="button">
			<form action="{:U('Examine/examineFalse')}" method="post">
				<label for="score">如果不通过,请填写原因:</label>
				<textarea name="reason" id="reason" required="required">{$info['reason']}</textarea>
				<br/>
				<a href="{:U('Examine/examineTrue',array('id'=>$info['id']))}"><input type="button" class="sub_button" value="通过"></a>
				<input type="submit" style="background: pink;" value="不通过">
				<input type="hidden" name="id" id="id" value="{$info['id']}"/>
			</form>
		</div>
		<!-- 创建项目结束 -->
	</div>
	<!-- 创建结束 -->
</block>
