<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="/signup/Public/Teashow/css/teacher.css" />
	</head>
	<body>
		<div class="container">
			<div class="header" style="border-radius: 5px;">
				<a href="<?php echo U('Index/index');?>" style="padding: 5px 5px;display: inline-block;"><img src="/signup/Public/Teashow/img/arrow_r.gif" />返回登陆页面</a>
			</div>
		</div>
		<div id="mainbody">
			<div class="container">
				<?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="panel panel-default">
					<div class="panel-heading"><a href="<?php echo U('Teashow/teainfo',array('id'=>$vo['id']));?>"><?php echo ($vo['teaname']); ?>：</a></div>
					<div class="panel-body">
						<img src="/signup<?php echo ($vo['imgroute']); ?>" width="150px" height="200px" class="pict"/>
							<h3 class="phead">个人简介：</h3>
							<p class="pbody" style="line-height: 30px;">&emsp;&emsp;<?php echo (mb_substr(strip_tags($vo['content'] ),0,200,utf8)); ?></p>
					</div>
					<div class="panel-footer">&emsp;<a href="<?php echo U('Teashow/teainfo',array('id'=>$vo['id']));?>">查看详细信息-></a></div>
				</div><?php endforeach; endif; ?>
			</div>
			
			<div class="container">
				<div id="page">
				<?php echo ($showpage); ?>
				</div>
			</div>
		</div>
		
		
		<footer>
			<div class="container">
        <ul class="footer-link">
            <li class="hidden-xs"><a href="http://www.xsgzs.org/">网站作者</a></li>
            <li class="hidden-xs cut">/</li>
            <li><a href="http://www.xsgzs.org/">联系我们</a></li>
            <li class="cut">/</li>
            <li><a href="#">返回顶部</a></li>
        </ul>
        <p style="color:#8c8c8c;">本站由<a href="http://www.xsgzs.org/">行思工作室</a>制作。</p>
        <p style="margin-top:10px;">© 2016 行思工作室。</p>
    </div>
		</footer>
	</body>
</html>