<extend name="Public/Admin/index_base.php" />
<!--网页标题-->
<block name="title">
	后台管理-修改比赛信息
</block>
<!--样式表和js引入-->
<block name="css_js">
	<style type="text/css">
		#add_form{
			margin: 20px 0 0 30px;
		}
		#add_form div{
			margin-bottom: 20px;
		}
	    #add_form label{
	    	cursor: pointer;
	    }
	    #add_form input[type=text],#add_form textarea{
	    	border: 1px solid #ccc;
	    }
	    #add_form input[type=text]{
	    	width: 50%;
	    	padding: 5px;
	    }
	    #add_form input[type=submit]{
	    	width: 200px;
	    	height: 30px;
	    	border-radius: 30px 0 30px 0;
	    	outline: none;
	    }
	    #add_form textarea{
	    	width: 80%;
	    	height: 400px;
	    }
	    #ext label{
	    	margin: 0 0 0 20px;
	    	font-size: 15px;
	    }
	    #add_form h1{
	    	font-family: "微软雅黑";
	    	font-size: 20px;
	    	margin-bottom: 20px;
	    	color: #999;
	    }
	</style>
</block>
<!--当前位置-->
<block name="location">
	修改比赛信息
</block>
<!--顶部子选项菜单-->
<block name="menu">
	<a href="{:U('Match/index')}">
		比赛列表
	</a>
	<a href="{:U('Match/add')}">
		新增比赛
	</a>
</block>
<!--主要内容-->
<block name="main">
	<!-- 创建项目开始 -->
	<form id="add_form" action="{:U('Match/runFix')}" method="post" enctype="multipart/form-data">
		<h1>修改: {$info['title']}</h1>
		<div>
			<label>比赛项目: <input type="text" name="title" id="title" value="{$info['title']}" required="required"></label>
			<input type="hidden" name="id" value="{$info['id']}" />
			<label for="">人数限制：<input type="number" name="limit" min="1" max="50" step="1"  value="{$info['limit']}"  /></label>
		</div>
		<div>
			<label>比赛说明: <textarea name="info" cols="30" rows="10" style="vertical-align: top;" required="required">{$info['info']}</textarea></label>
			
		</div>
		<div>
			<label>说明文档: <input type="file" name="file"></label>
			
		</div>
		<fieldset style="padding: 10px;width: 80%">
			<legend>作品类型选项</legend>
			<?php
			foreach ($types as $key=>$type) {
				?>
				<label><input type="checkbox" name="type[]" <?php if(in_array($type['id'],$selected_types)) echo 'checked'; ?> value="<?=$type['id']?>"><?=$type['type']?></label>&emsp;&emsp;
				<?php
			}
			?>
		</fieldset>
		<div id="ext">
			<span>格式限制: </span>
			<label><input type="checkbox" name="zip">压缩文件</label>
			<label><input type="checkbox" name="doc">office文档</label>
			<label><input type="checkbox" name="img">图片文件</label>
		</div>
		<div class="button">
			<input type="submit" name="submit" value=">>>>更新信息>>>>">
		</div>
	</form>
	<!-- 创建项目结束 -->
</block>