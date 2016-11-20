<extend name="Public/Admin/index_base.php" />
<!--网页标题-->
<block name="title">评分务分配-选择比赛项目</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
	    #table tr:hover{
	    	background: #eeeeee;
	    }
	    #table tr:hover td{
	    	background: none;
	    }
	</style>
</block>
<!--当前位置-->
<block name="location">选择比赛项目</block>
<!--顶部子选项菜单-->
<block name="menu">
	<a href="{:U('Task/index')}">选择比赛项目</a>
</block>
<!--主要内容-->
<block name="main">
	<table id="table" border="1" style="width: 97%;margin: 30px 0 0 2%;">
		<tr>
			<th width="5%">ID</th>
			<th width="30%">比赛项目</th>
			<th width="5%">文档</th>
			<th width="10%">发布时间</th>
			<th width="25%">格式限制</th>
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
		    		<a href="{:U('Task/taskList',array('mid'=>$vo['id']))}">[分配评分人员]</a> 
		    	</td>
		    </tr>
		</foreach>
		<th colspan="7" align="center" class="page">
				<if condition="$showpage eq null">
				已显示所有条目
				<else/>
				{$showpage}
				</if>
		</th>
	</table>
</block>