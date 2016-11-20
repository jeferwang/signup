<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>人物详情--<?php echo ($info['teaname']); ?></title>
		<link rel="stylesheet" href="/signup/Public/Teashow/css/myspace2.css" />
	</head>
	<body>
		<div id="mainbody">
			<div id="box">
				<div id="pcontext">
					<div id="pbox">
						<img src="/signup<?php echo ($info['imgroute']); ?>" width="120px" height="160px" />
						<p id="name"><?php echo ($info['teaname']); ?></p>
					</div>
					<div id="perif"><?php echo ($info['content']); ?></div>
				</div>
			</div>
			<div id='other'>
				<ul id="oteacher">
					<li class="panel-heading">其他老师：</li>
					<?php if(is_array($other)): foreach($other as $key=>$vo): ?><li><a href="<?php echo U('Teashow/teainfo',array('id'=>$vo['id']));?>"><?php echo ($vo['teaname']); ?></a></li><?php endforeach; endif; ?>
					<li class="panel-heading"><a href="<?php echo U('Teashow/index');?>">更多-></a></li>
				</ul>
			</div>
		</div>
	</body>
</html>