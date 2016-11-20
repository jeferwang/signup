<extend name="Public/Admin/index_base.php" />
<!--网页标题-->
<block name="title">后台管理-管理员列表</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
		#add_admin input[type=text]{
			width: 20%;
			height: 25px;
			margin-right: 5px;
		}
		#add_admin input[type=submit]{
			padding: 5px 10px;
			border-radius: 20px 0 20px 0;
			outline: none;
		}
	    #table tr:hover{
	    	background: #eeeeee;
	    }
	    #table tr:hover td{
	    	background: none;
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
<block name="location">管理员列表</block>
<!--顶部子选项菜单-->
<block name="menu">
	<a href="{:U('Account/adminList')}">管理员列表</a>
	<a href="{:U('Account/fixAdmin')}">登录信息修改</a>
</block>
<!--主要内容-->
<block name="main">
	<form action="{:U('Account/runAddAdmin')}" id="add_admin" style="margin: 20px 0 0 40px;" method="post">
	    <label>用户: <input type="text" name="username" id="username" placeholder="输入管理员登录用户名" required="required" /></label>
	    <label>密码: <input type="text" name="password" id="password" placeholder="输入管登录密码" required="required" /></label>
	    <input type="submit" value="添加管理员"/>
	</form>
	<table border="1" id="table" style="margin: 20px 0 0 2%; width: 97%;">
		<tr>
			<th align="center">ID</th>
			<th align="center">姓名</th>
			<th align="center">最近登录</th>
			<th align="center">登录IP</th>
			<th align="center">操作</th>
		</tr>
		<foreach name="list" item="vo">
		    <tr>
		    	<td align="center" width="20%">{$vo['id']}</td>
		    	<td align="center" width="20%">{$vo['username']}</td>
		    	<td align="center" width="20%">{$vo['logindate']}</td>
		    	<td align="center" width="20%">{$vo['loginip']}</td>
		    	<td align="center" width="20%">
				    <button onclick="deleteItem('{:U('Account/runDelAdmin',array('id'=>$vo['id']))}')">删除</button>
		    	</td>
		    </tr>
		</foreach>
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