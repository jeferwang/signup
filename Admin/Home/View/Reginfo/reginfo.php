<extend name="Public/Admin/index_base.php"/>
<!--网页标题-->
<block name="title">
	{$match['title']}作品
</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
		#form {
			padding: 2px;
		}
		
		.score {
			width: 30px;
		}
		
		#info_box {
			display: none;
			z-index: 999;
			border: 5px solid #ccc;
			width: 60%;
			height: 400px;
			overflow: auto;
			overflow-x: hidden;
			position: absolute;
			top: 100px;
			margin-left: 15%;
			background: #eee;
			padding: 15px;
		}
	</style>
	<script>
		function showInfo($id) {
			$("#info_box").show(300);
			$.post("{:U('Reginfo/getAllInfo')}", {'id': $id}, function (data) {
				$("#show_info").show().html(data);
				$("#tips").hide();
			});
		}
		function closeInfo() {
			$("#info_box").hide(200);
			$("#tips").show();
		}
	</script>
</block>
<!--当前位置-->
<block name="location">
	{$match['title']}作品
</block>
<!--顶部子选项菜单-->
<block name="menu">
	<a href="{:U('Reginfo/index')}">选择比赛</a>
	<a href="{:U('Reginfo/export')}">导出到Excel</a>
</block>
<!--主要内容-->
<block name="main">
	<div id="form">
		<form action="" method="post">
			<label for="college">学院:</label>
			<select name="collegeid" id="college">
				<option value="">所有学院</option>
				<foreach name="college" item="vo">
					<option value="{$vo['id']}">{$vo['college']}</option>
				</foreach>
			</select>
			<label for="status"></label>
			<select name="status">
				<option value="">所有状态</option>
				<option value="0">未审核</option>
				<option value="1">已通过学院审核</option>
				<option value="2">已通过学校审核</option>
				<option value="3">已评分</option>
				<option value="4">未通过学院审核</option>
				<option value="5">未通过学校审核</option>
			</select>
			<select name="sort" id="">
				<option value="college">按学院排序</option>
				<option value="type">按类别排序</option>
				<option value="avg">按平均分排序</option>
			</select>
			<!--	<label>-->
			<!--		分数段：-->
			<!--		<input type="text" name="score_min" id="score_min" class="score"/>-->
			<!--		~-->
			<!--		<input type="text" name="score_max" id="score_max" class="score" />-->
			<!--	</label>-->
			<input type="submit" value="检索"/>
		</form>
	</div>
	<table border="1">
		<thead>
		<tr>
			<th align="center">ID</th>
			<th align="center">队伍名称</th>
			<th align="center">作品标题</th>
			<th align="center">作品类别</th>
			<th align="center">所属学院</th>
			<th align="center">作品状态</th>
			<th align="center">评阅分数</th>
			<th align="center">平均分</th>
			<th align="center">操作</th>
		</tr>
		</thead>
		<tbody>
		<foreach name="list" item="vo">
			<tr>
				<td align="center">{$vo['id']}</td>
				<td>{$vo['code']}--{$vo['team']}</td>
				<td>{$vo['title']}</td>
				<td>{$vo['type']}</td>
				<td align="center">{$vo['college']['college']}</td>
				<td align="center">{$vo['zhuangtai']}</td>
				<td align="left">
					<?php
					foreach ($vo['pw'] as $oneTea) {
						?>
						<span>[ <font color="orange"><?= $oneTea['code'] ?></font> 评分:<font color="green">
								<?php
								if ($oneTea['score']) {
									echo $oneTea['score'];
								} else {
									echo '无';
								}
								?>
								
							</font> ] </span>
						<?php
					}
					?>
				</td>
				<td align="center"><?= $vo['avg'] ?></td>
				<td align="center">
					<button onclick="showInfo(<?= $vo['id'] ?>)">查看详情</button>
				</td>
			</tr>
		</foreach>
		</tbody>
		<tfoot>
		<tr>
			<td align="center" colspan="9">
				已显示所有条目
			</td>
		</tr>
		</tfoot>
	</table>
	<div id="info_box">
		<p id="close"><span id="close_box" onclick="closeInfo()" style="float: right;width: 15px;text-align: center;cursor: pointer;color: red;border: 1px solid black">x</span></p>
		<p id="tips">正在加载信息，请稍等······</p>
		
		<div id="show_info" style="display: none;">
		
		</div>
	
	</div>
</block>