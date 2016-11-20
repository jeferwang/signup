<extend name="Public/Admin/index_base.php" />
<!--网页标题-->
<block name="title">后台管理-修改人才库条目</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
	    .info{
	    	margin: 5px 0;
	    }
	</style>
</block>
<!--当前位置-->
<block name="location">修改人才库条目</block>
<!--顶部子选项菜单-->
<block name="menu">
	
</block>
<!--主要内容-->
<block name="main">
	<form style="margin: 20px 0 0 30px;" method="post" action="{:U('Teashow/runFix')}" enctype="multipart/form-data">
		<p class="info"><label for="teaname">姓名：</label><input type="text" id="teaname" required="required" name="teaname" style="height: 20px; width: 200px;" maxlength="10" value="{$info['teaname']}" />
			<input type="submit" id="submit" value=">>>>执行修改<<<<" style="cursor: pointer;"/>
		</p>
		<input type="hidden" name="id" value="{$info['id']}" />
		<p class="info"><label for="imgroute">照片：</label><input type="file" id="imgroute" name="file" style="border: none;width: 200px;" />
			<span style="font-size: 12px;color: orangered;">格式限制:jpg,jpeg,png;不超过1M</span></p>
		<!--		类型-->
		<span>人才类型：</span>
		<label for="zdls"><input type="radio" id="zdls" name="type" value="1" checked>指导老师</label>
		<label for="pwls"><input type="radio" id="pwls" name="type" value="2">评委老师</label>
		<!--百度编辑器-->
		<div id="editor" style="margin-top: 10px;">
				<script id="content" name="content" type="text/plain" style="width: 95%;">{$info['content']}</script>
				<!-- 配置文件 -->
				<script type="text/javascript" src="__PUBLIC__/uEditor/ueditor.config.js">
				</script>
				<!-- 编辑器源码文件 -->
				<script type="text/javascript" src="__PUBLIC__/uEditor/ueditor.all.js">
				</script>
				<!-- 实例化编辑器 -->
				<script type="text/javascript">
				var ue = UE.getEditor('content',{
					initialFrameHeight:600
				});
				</script>
		</div>
	</form>
</block>