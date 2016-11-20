<extend name="Public/Admin/index_base.php"/>
<!--网页标题-->
<block name="title">后台管理-评分任务分配</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
		#table tr:hover {
			background: #eeeeee;
		}
		
		#table tr:hover td {
			background: none;
		}
	</style>
	<script type="text/javascript">
		var select_all = document.getElementById("select_all");
		function selectAll() {
			var obj = document.getElementsByClassName("select_box");
			if (document.getElementById("select_all").checked == false) {
				for (var i = 0; i < obj.length; i++) {
					obj[i].checked = false;
				}
			} else {
				for (var i = 0; i < obj.length; i++) {
					obj[i].checked = true;
				}
			}
			
		}
	</script>
</block>
<!--当前位置-->
<block name="location">评分任务分配</block>
<!--顶部子选项菜单-->
<block name="menu">

</block>
<!--主要内容-->
<block name="main">
	<form action="{:U('Task/runAddTask')}" method="post">
		<input type="hidden" name="matchid" id="matchid" value="{$match_info['id']}"/>
		<p style="margin: 10px 0 0 40px;font-size: 18px;">
			<span style="margin-right: 30px;">所选比赛项目：{$match_info['title']}</span>
			<span style="color: red;">&gt;&gt;选择评委老师：
			<select name="teacher">
				<foreach name="tea_list" item="vo">
					<option value="{$vo['id']}">{$vo['code']}</option>
				</foreach>
		</select></span>
			<span><input type="submit" value="分配所选任务到评委老师"/></span>
			<!--		<span style="color: orange;">注意：如果您勾选的作品已经有评委老师，那么新分配的评委老师将会替换原来的</span>-->
		</p>
		<table id="table" border="1" style="width: 97%;margin: 20px 0 0 2%;">
			<tr>
				<th width="5%"><input type="checkbox" id="select_all" onclick="selectAll()"/>全选</th>
				<th width="5%">ID</th>
				<th width="10%">学院</th>
				<th width="7%">编号</th>
				<th width="10%">团队名</th>
				<th width="20%">作品标题</th>
				<th width="10%">作品类型</th>
				<th width="33%">评委</th>
			</tr>
			<foreach name="zp_list" item="vo">
				<tr>
					<td align="center"><input type="checkbox" name="task[]" class="select_box" value="{$vo['id']}"/></td>
					<td align="center">{$vo['id']}</td>
					<td>{$vo['college']}</td>
					<td>{$vo['code']}</td>
					<td>{$vo['team']}</td>
					<td>{$vo['title']}</td>
					<td>{$vo['type']}</td>
					<td>
						<foreach name="vo.pw" item="oneTea">
						<span>[ <font color="orange">{$oneTea['code']}</font> 评分:<font color="green">
								<?php
								if ($oneTea['score']) {
									echo $oneTea['score'];
								} else {
									echo '无';
								}
								?>
								
							</font> ] </span>
						</foreach>
					</td>
				</tr>
			</foreach>
			<th colspan="8" align="center" class="page">
				<if condition="$showpage eq null">
					已显示所有条目
					<else/>
					{$showpage}
				</if>
			</th>
		</table>
	</form>
</block>