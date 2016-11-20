<extend name="Public/Admin/index_base.php" />
<!--网页标题-->
<block name="title">后台管理-登录信息修改</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
		#fix_form{
			margin: 20px 0 0 40px;
		}
		#fix_form input[type=text]{
			width: 20%;
			padding: 6px;
			margin-bottom: 15px;
		}
		#fix_form input[type=submit]{
			padding: 5px 15px;
			border-radius: 20px 0 20px 0;
			outline: none;
		}
		#fix_form p{
			margin-bottom: 15px;
			color: #888;
		}
	</style>
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
	<form action="{:U('Account/runFixAdmin')}" method="post" id="fix_form">
		<p>为防止输入错误，密码采用明文显示，请确认周边环境是否安全</p>
		<label for="">新用户名：<input type="text" name="username" id="username" placeholder="请在此输入新的用户名" required="required" /></label>
		<br />
		<label for="">原先密码：<input type="text" name="oldPass" id="oldPass" placeholder="请输入原密码" required="required" /></label>
		<br />
		<label for="">新的密码：<input type="text" name="password" id="password" placeholder="请输入新的密码" required="required" /></label>
		<br />
		<input type="submit" value=">>>>修改信息<<<<"/>
	</form>
</block>