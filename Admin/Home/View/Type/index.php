<extend name="Public/Admin/index_base.php"/>
<!--网页标题-->
<block name="title">后台管理-作品类型管理</block>
<!--样式表和js引入-->
<block name="css_js">
	<style>
		#add {
			margin: 20px 0 0 30px;
		}
		
		#type {
			padding: 5px;
			width: 200px;
		}
		
		#submit_btn {
			padding: 5px;
		}
	</style>
	<script>
		function deleteItem($url) {
			var $del = confirm("确认删除吗？删除之后会影响已经关联了此类型的比赛！");
			if ($del) {
				window.location.href = $url;
			} else {
				return false;
			}
		}
	</script>
</block>
<!--当前位置-->
<block name="location">作品类型管理</block>
<!--顶部子选项菜单-->
<block name="menu">

</block>
<!--主要内容-->
<block name="main">
	<form action="{:U('Type/add')}" method="post" id="add">
		<label for="type">作品类型名字：</label>
		<input type="text" name="type" id="type" placeholder="请输入要添加的作品类型" required>
		<input type="submit" value="添加" id="submit_btn">
	</form>
	<table>
		<thead>
		<tr>
			<th>id</th>
			<th>作品类型</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($types as $key => $type) {
			?>
			<tr>
				<td width="20%"><?=$type['id']?></td>
				<td width="60%"><?=$type['type']?></td>
				<td width="20%" align="center"><button onclick="deleteItem('{:U('Type/del',array('typeid'=>$type['id']))}')">删除</button></td>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table>
</block>