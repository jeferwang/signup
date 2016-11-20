<?php
return array(
	//'配置项'=>'配置值'
	//数据库配置
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'127.0.0.1',
	'DB_USER'=>'root',
	'DB_PWD'=>'root',
	'DB_NAME'=>'signup',
	'DB_PREFIX'=>'reg_',
	//修改模版中的文件的后缀
	'TMPL_TEMPLATE_SUFFIX'=>'.php',
	//设置伪静态后缀，默认为html
	'URL_HTML_SUFFIX'=>'html',
	//自定义成功和错误提示模版页面
	'TMPL_ACTION_SUCCESS'=>'Public/success',
	'TMPL_ACTION_ERROR'=>'Public/error',
);