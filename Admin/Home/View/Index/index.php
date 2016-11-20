<extend name="Public/Admin/index_base.php" />
<!--网页标题-->
<block name="title">后台管理-首页</block>
<!--样式表和js引入-->
<block name="css_js">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Admin/Css/Index_index.css"/>
</block>
<!--当前位置-->
<block name="location">首页-登录信息</block>
<!--顶部子选项菜单-->
<block name="menu">
	
</block>
<!--主要内容-->
<block name="main">
	<div id="info">
	    <p style="border-top: none;"><font color="orangered">后台管理仅限管理员使用，请谨慎使用，在删除数据前进行确认，以免误删！</font></p>
		<p>当前管理员：<?php echo cookie('adminName'); ?></p>
		<p>管理员ID：<?php echo cookie('adminId'); ?></p>
		<p>当前主机名：<?php echo $_SERVER['SERVER_NAME']; ?> </p>
	    <p>网站运行环境：<?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
	    <p>浏览器信息：<?php echo $_SERVER['HTTP_USER_AGENT'];  ?> </p>
		<p>文件根目录：<?php echo $_SERVER['DOCUMENT_ROOT'];  ?> </p>
		<p>CGI规范版本：<?php echo $_SERVER['GATEWAY_INTERFACE']; ?> </p>
		<p>网络通信协议：<?php echo $_SERVER['SERVER_PROTOCOL']; ?> </p>
		<p>当前登录IP：<?php echo $_SERVER['REMOTE_ADDR'];  ?> </p>
	</div>
</block>