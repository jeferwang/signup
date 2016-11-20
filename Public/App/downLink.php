<span class="info_label">作品下载</span>
<span>
<!--申报书-->
<if condition="$info['fileroute']['shenbaoshu']['name'] neq null">
	<a class="special" href="__ROOT__/Uploads{$info['fileroute']['shenbaoshu']['route']}" download="{$info['fileroute']['shenbaoshu']['name']}" style="color: blue;">
		[申报书]
	</a>
</if>
<!--演示ppt-->
<if condition="$info['fileroute']['ppt']['name'] neq null">
	<a class="special" href="__ROOT__/Uploads{$info['fileroute']['ppt']['route']}" download="{$info['fileroute']['ppt']['name']}" style="color: blue;">
		[演示PPT]
	</a>
</if>
<!--相关图片-->
<if condition="$info['fileroute']['tupian']['name'] neq null">
	<a class="special" href="__ROOT__/Uploads{$info['fileroute']['tupian']['route']}" download="{$info['fileroute']['tupian']['name']}" style="color: blue;">
		[相关图片]
	</a>
</if>
<!--作品说明文档-->
<if condition="$info['fileroute']['shuoming']['name'] neq null">
	<a class="special" href="__ROOT__/Uploads{$info['fileroute']['shuoming']['route']}" download="{$info['fileroute']['shuoming']['name']}" style="color: blue;">
		[作品说明文档]
	</a>
</if>
<!--参赛作品-->
<if condition="$info['fileroute']['zuopin']['name'] neq null">
	<a class="special" href="__ROOT__/Uploads{$info['fileroute']['zuopin']['route']}" download="{$info['fileroute']['zuopin']['name']}" style="color: blue;">
		[参赛作品]
	</a>
</if>
</span>