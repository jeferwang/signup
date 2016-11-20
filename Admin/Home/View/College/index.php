<extend name="Public/Admin/index_base.php"/>
<!--网页标题-->
<block name="title">后台管理-学院列表</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
		#add_college {
			margin: 20px 0 0 30px;
		}
		
		#add_college h1 {
			color: #777;
			font-size: 16px;
		}
		
		#add_college input[type=text] {
			padding: 3px;
		}
		
		#add_college input[type=submit] {
			padding: 3px;
		}
		
		/*#tips{*/
		/*margin: 20px 0 0 30px;*/
		/*color: #999;*/
		/*}*/
	</style>
	<script>
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
<block name="location">学院列表</block>
<!--顶部子选项菜单-->
<block name="menu">
</block>
<!--主要内容-->
<block name="main">
	<div id="add_college">
		<form action="{:U('College/runAdd')}" method="post">
			<h1>添加学院</h1>
			<label for="college">请输入学院名:<input type="text" name="college" id="college" placeholder="输入学院名" required="required"/></label>
			<label for="code">请输入学院代码:<input type="text" name="code" id="code" placeholder="例如：计算机->jsj" required="required"/></label>
			<input type="submit" id="sub_college" value="添加学院 [Add College]"/>
		</form>
	</div>
	<!--	<div id="tips">-->
	<!--	    <p>由于删除学院会影响到很多数据,此处不提供学院的删除功能,如果需要删除学院,请直接使用软件连接数据库进行操作</p>-->
	<!--	</div>-->
	<table border="1" style="width: 97%; margin: 20px 0 0 2%;">
		<tr>
			<th width="20%">ID</th>
			<th width="60%">学院</th>
			<th width="10%">代号</th>
			<th width="10%">操作</th>
		</tr>
		<?php
		foreach ($college_list as $vo) {
			if ($vo['del'] == 0) {
				?>
				<tr>
					<td align="center">{$vo['id']}</td>
					<td>{$vo['college']}</td>
					<td align="center">{$vo['code']}</td>
					<td align="center">
						<button style="border: 2px solid red;padding: 3px;" onclick="deleteReal('{:U('College/runRealDelCollege',array('id'=>$vo['id']))}')">删除！</button>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</table>
</block>