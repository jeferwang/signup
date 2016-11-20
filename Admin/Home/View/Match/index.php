<extend name="Public/Admin/index_base.php"/>
<!--网页标题-->
<block name="title">后台管理-比赛列表</block>
<!--样式表和js引入-->
<block name="css_js">
	<script type="text/javascript">
		//		切换状态
		function toggleStatus($id) {
			$.post("{:U('Match/toggleStatus')}", {'id': $id}, function () {
				location.reload(true);
			});
		}
		//		删除
		function deleteItem($id) {
			var $del = confirm("确认删除吗？");
			if ($del) {
				runDel($id);
			} else {
				return false;
			}
		}
		function runDel($id) {
			$.post("{:U('Match/runDel')}", {'id': $id}, function () {
				location.reload(true);
			});
		}
	</script>
	<style type="text/css">
		#table tr:hover {
			background: #eeeeee;
		}
		
		#table tr:hover td {
			background: none;
		}
	</style>
</block>
<!--当前位置-->
<block name="location">比赛列表</block>
<!--顶部子选项菜单-->
<block name="menu">
	<a href="{:U('Match/index')}">比赛列表</a>
	<a href="{:U('Match/add')}">新增比赛</a>
</block>
<!--主要内容-->
<block name="main">
	<table id="table" border="1" style="width: 97%;margin: 30px 0 0 2%;">
		<tr>
			<th width="5%">ID</th>
			<th width="30%">比赛项目</th>
			<th width="5%">文档</th>
			<th width="10%">发布时间</th>
			<th width="20%">格式限制</th>
			<th width="5%">人数</th>
			<th width="10%">状态</th>
			<th width="15%">操作</th>
		</tr>
		<foreach name="list" item="vo">
			<tr>
				<td align="center">{$vo['id']}</td>
				<td align="left">{$vo['title']}</td>
				<td align="center">
					<a href="__ROOT__{$vo['document']}">下载</a>
				</td>
				<td align="center">{$vo['starttime']}</td>
				<td align="center">{$vo['extension']}</td>
				<td align="center">{$vo['limit']}</td>
				<td align="center">
					<if condition="$vo['status'] eq 0">
						<font color="orangered">未发布</font>
						<elseif condition="$vo['status'] eq 1"/>
						<font color="green">已发布</font>
						<elseif condition="$vo['status'] eq 2"/>
						<font color="gray">已结束</font>
					</if>
				</td>
				<td align="center">
					<a href="javascript:void(0)" onclick="toggleStatus('{$vo['id']}')">[发布/结束]</a>
					<a href="{:U('Match/fix',array('id'=>$vo['id']))}">[修改]</a>
					<a href="javascript:void(0)" onclick="deleteItem('{$vo['id']}')">[删除]</a>
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
</block>