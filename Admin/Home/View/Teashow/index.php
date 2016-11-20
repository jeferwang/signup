<extend name="Public/Admin/index_base.php"/>
<!--网页标题-->
<block name="title">后台管理-人才列表</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
		#opera a {
			color: orangered;
			font-size: 15px;
			padding: 5px 10px;
			border-radius: 5px;
		}
	</style>
	<script>
		function deleteItem($url) {
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
<block name="location">人才管理</block>
<!--顶部子选项菜单-->
<block name="menu">

</block>
<!--主要内容-->
<block name="main">
	<table border="1" style="margin: 20px 0 0 2%; width: 97%;">
		<tr>
			<th align="center">ID</th>
			<th align="center">姓名</th>
			<th align="center">照片</th>
			<th align="center">类型</th>
			<th align="center">简介</th>
			<th align="center">操作</th>
		</tr>
		<foreach name="list" item="vo">
			<tr>
				<td align="center" width="10%">{$vo['id']}</td>
				<td align="center" width="10%">{$vo['teaname']}</td>
				<td align="center" width="10%"><img src="__ROOT__{$vo['imgroute']}" alt="{$vo['imgroute']}" width="150px" height="200px"/></td>
				<td align="center" width="10%">{$vo['type']}</td>
				<td width="50%">{$vo['content'] | strip_tags}</td>
				<td align="center" width="10%" id="opera">
					<a href="{:U('Teashow/fix',array('id'=>$vo['id']))}"><button>修改</button></a>
					<button onclick="deleteItem('{:U('Teashow/runDel',array('id'=>$vo['id']))}')">删除</button>
				</td>
			</tr>
		</foreach>
		<tr>
			<td colspan="6" align="center" class="page">
				<if condition="$showpage eq null">
					已显示所有条目
					<else/>
					{$showpage}
				</if>
			</td>
		</tr>
	</table>
</block>