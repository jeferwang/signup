<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>操作成功</title>
<style>
*{margin:0;padding:0;outline:none;font-family:\5FAE\8F6F\96C5\9ED1,宋体;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;-khtml-user-select:none;user-select:none;cursor:default;font-weight:lighter;}
.center{margin:0 auto;}
.whole{width:100%;height:100%;line-height:100%;position:fixed;bottom:0;left:0;z-index:-1000;overflow:hidden;}
.whole img{width:100%;height:100%;}
.mask{width:100%;height:100%;position:absolute;top:0;left:0;background:#000;opacity:0.6;filter:alpha(opacity=60);}
.b{width:100%;text-align:center;height:400px;position:absolute;top:50%;margin-top:-230px}.a{width:150px;height:50px;margin-top:30px}.a a{display:block;float:left;width:150px;height:50px;background:#fff;text-align:center;line-height:50px;font-size:18px;border-radius:25px;color:#333}.a a:hover{color:#000;box-shadow:#fff 0 0 20px}
p{color:#fff;margin-top:40px;font-size:24px;}
#wait{margin:0 5px;font-weight:bold;}
#href{color: white;cursor: pointer;}
</style>
</head>

<body>
<div class="whole">
	<img src="/signup/Public/jump_images/back.jpg" />
    <div class="mask"></div>
</div>
<div class="b" id="info">
		<h1 align="center" style="color:white;font-size:50px;font-weight:bold;">( ^_^ )</h1>
		<!-- <img src="/signup/Public/jump_images/404.png" class="center"/> -->
		<p>
			<?php echo($message); ?><br>
            <span id="wait"><?php echo($waitSecond); ?></span>秒后自动<a id="href" href="<?php echo($jumpUrl); ?>">跳转</a>
		</p>
</div>
<script type="text/javascript">(function() {
	var wait = document.getElementById('wait'),
		href = document.getElementById('href').href;
	var interval = setInterval(function() {
		var time = --wait.innerHTML;
		if(time <= 0) {
			location.href = href;
			clearInterval(interval);
		};
	}, 1000);
})();
</script>
</body>
</html>