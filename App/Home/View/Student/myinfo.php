<extend name="Public/App/student_frame.php"/>
<block name="title">
	我的作品信息
</block>
<block name="css_js">
	<script src="__PUBLIC__/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
	
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
</block>
<block name="main">
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
				<p><span class="info_label">编号：</span>{$info['code']}&emsp;&emsp;
					<?php
					if ($info['status'] == 0 || $info['status'] == 4 || $info['status'] == 5) {
						?>
						<a href="{:U('Student/update')}" style="color: blue;">
							修改信息
						</a>
						<?php
					}
					?>
				</p>
				<p><span class="info_label">团队名称：</span>{$info['team']}</p>
				<p><span class="info_label">作品名称：</span>{$info['title']}</p>
				<p><span class="info_label">作品类型：</span>{$info['type']}</p>
				<p><span class="info_label">作品简介：</span>{$info['info']}</p>
				
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
				<div class="info_box">
					<!--继承Public/App下的下载链接文件，方便修改-->
					<include file="Public/App/downLink.php"/>
				</div>
				<p><span class="info_label">审核情况：</span>
					{$info['zhuangtai']}
				</p>
				<if condition="$info['reason'] neq null">
					<p><span class="info_label">未通过原因：</span>
						{$info['reason']}
					</p>
				</if>
				<?php
				if ($info['pw']) {
					?>
					<p class="info_label">评委老师意见：</p>
					<div style="margin-left: 30px">
						<?php
						$i = 1;
						foreach ($info['pw'] as $one) {
							if (trim($one['suggest']) != '') {
								?>
								<p style="color:dodgerblue;">&emsp;&emsp;评委<?= $i ?>：<?= $one['suggest'] ?></p>
								<?php
							} else {
								?>
								<p style="color:orangered;">&emsp;&emsp;评委<?= $i ?>：<?= 暂无建议 ?></p>
								<?php
							}
							$i++;
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</block>