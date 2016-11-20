<extend name="Public/Admin/index_base.php"/>
<!--网页标题-->
<block name="title">后台管理-教师账户管理</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
		#add_admin input[type=text] {
			width: 15%;
			height: 25px;
			margin-right: 5px;
		}
		
		#add_admin input[type=submit] {
			padding: 5px 10px;
			border-radius: 20px 0 20px 0;
			outline: none;
		}
		
		#table tr:hover {
			background: #eeeeee;
		}
		
		#table tr:hover td {
			background: none;
		}
	</style>
	<script>
		function deleteItem($url) {
			var $del = confirm("确认禁用吗？");
			if ($del) {
				window.location.href = $url;
			} else {
				return false;
			}
		}
		function recoverItem($url) {
			window.location.href = $url;
		}
		function deleteReal($url) {
			var $del = confirm("确认删除吗？");
			if ($del) {
				window.location.href = $url;
			} else {
				return false;
			}
		}
	</script>
</block>
<!--当前位置-->
<block name="location">教师账户管理</block>
<!--顶部子选项菜单-->
<block name="menu">
</block>
<!--主要内容-->
<block name="main">
	<form action="{:U('Account/runAddTea')}" id="add_admin" style="margin: 20px 0 0 40px;" method="post">
		<label for="match">选择比赛：
			<select name="matchid" id="match">
				<foreach name="match" item="vo">
					<option value="{$vo['id']}">{$vo['title']}</option>
				</foreach>
			</select>
		</label>
		<label for="type">账户类型:
			<select name="type" id="type">
				<option value="hpu">学校账户</option>
				<option value="pw">评委老师</option>
				<?php
				foreach ($college_list as $vo) {
					if ($vo['del'] == 0) {
						?>
						<option value="{$vo['code']}">学院-{$vo['college']}</option>
						<?php
					}
				}
				?>
			</select>
		</label>
		<label>登录密码: <input type="text" name="password" id="password" placeholder="输入默认密码" required="required"/></label>
		<label for="ccount">数量: <input type="text" name="count" id="count" placeholder="输入账号数量" required="required" maxlength="12"/></label>
		<input type="submit" value="生成账户"/>
	</form>
	<table border="1" id="table" style="margin: 20px 0 0 2%; width: 97%;">
		<tr>
			<th align="center">ID</th>
			<th align="center">编号</th>
			<th align="center">比赛</th>
			<th align="center">类别/学院</th>
			<th align="center">操作</th>
		</tr>
		<?php
		foreach ($list as $vo) {
			if ($vo['del'] == 0) {
				?>
				<tr>
					<td align="center" width="10%">{$vo['id']}</td>
					<td align="center" width="20%">{$vo['code']}</td>
					<td align="center" width="20%">{$vo['match']}</td>
					<td align="center" width="30%">{$vo['college']}</td>
					<td align="center" width="20%">
						<?php
						if ($vo['status'] == 1) {
							?>
							<button style="background: lightgreen;padding: 3px;" onclick="deleteItem('{:U('Account/runDelTea',array('id'=>$vo['id']))}')">禁用</button>
							<?php
						} elseif ($vo['status'] == 2) {
							?>
							<button style="background: pink;padding: 3px;" onclick="recoverItem('{:U('Account/runRecTea',array('id'=>$vo['id']))}')">启用</button>
							<?php
						}
						?>
						<button style="border: 2px solid red;padding: 3px;" onclick="deleteReal('{:U('Account/runRealDelTea',array('id'=>$vo['id']))}')">删除！</button>
					</td>
				</tr>
				<?php
			}
		}
		?>
		<tr>
			<td colspan="5" align="center" class="page">
				<if condition="$showpage eq null">
					已显示所有条目
					<else/>
					{$showpage}
				</if>
			</td>
		</tr>
	</table>
</block>