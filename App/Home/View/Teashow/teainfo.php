<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>人物详情--{$info['teaname']}</title>
		<link rel="stylesheet" href="__PUBLIC__/Teashow/css/myspace2.css" />
	</head>
	<body>
		<div id="mainbody">
			<div id="box">
				<div id="pcontext">
					<div id="pbox">
						<img src="__ROOT__{$info['imgroute']}" width="120px" height="160px" />
						<p id="name">{$info['teaname']}</p>
					</div>
					<div id="perif">{$info['content']}</div>
				</div>
			</div>
			<div id='other'>
				<ul id="oteacher">
					<li class="panel-heading">其他老师：</li>
					<foreach name="other" item="vo">
					<li><a href="{:U('Teashow/teainfo',array('id'=>$vo['id']))}">{$vo['teaname']}</a></li>
					</foreach>
					<li class="panel-heading"><a href="{:U('Teashow/index')}">更多-></a></li>
				</ul>
			</div>
		</div>
	</body>
</html>