<extend name="Public/Admin/index_base.php" />
<!--网页标题-->
<block name="title">
	作品管理
</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">

	</style>
</block>
<!--当前位置-->
<block name="location">
	选择比赛
</block>
<!--顶部子选项菜单-->
<block name="menu">
	<a href="{:U('Reginfo/index')}">选择比赛</a>
</block>
<!--主要内容-->
<block name="main">
<table border="1">
	<thead>
		<tr>
			<th align="center">ID</th>
			<th align="center">比赛名称</th>
			<th align="center">状态</th>
			<th align="center">操作</th>
		</tr>
	</thead>
	<tbody>
		<foreach name="list" item="vo">
		    <tr>
		    	<td align="center" width="10%">{$vo['id']}</td>
		    	<td width="60%">{$vo['title']}</td>
		    	<td width="20%" align="center">{$vo['zhuangtai']}</td>
		    	<td align="center" width="10%">
		    		<a href="{:U('Reginfo/reginfo',array('m'=>$vo['id']))}">
		    			进入
		    		</a>
		    	</td>
		    </tr>
		</foreach>
	</tbody>
	<tfoot>
		<tr>
			<td align="center" colspan="4">
				{$showPage}
			</td>
		</tr>
	</tfoot>
</table>
</block>