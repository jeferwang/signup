<extend name='Public/App/teacher_frame.php' />
<block name="title">作品评分列表</block>
<block name="css_js">
	<style type="text/css">
		
	</style>
	<script type="text/javascript">
		$().ready(function(){
			$("#shen_he").addClass("unselect");
		});
	</script>
</block>
<block name="main">
	<!-- 评分开始 -->
		<div class="verify">
			<!--点击比赛项目之后显示队伍列表 -->
			<div class="verify_first">
				<div class="nav_title" >
					<ul>
						<li class="nav_focus" style="width: auto;">
							<a>
								<!--比赛名-->
								{$matchInfo['title']}
							</a>
						</li>
					</ul>
				</div>
				<div class="game">
					<ul class="page">
					<foreach name="list" item="vo">
						<li>
							<!--队伍点击之后进入的页面-->
							<a href="{:U('Evaluate/teamInfo',array('id'=>$vo['id']))}">
								{$vo['title']}--{$vo['code']}
							</a>
							<p>
								<span>{$vo['zhuangtai']}</span>
								<span style="padding-right: 5px;border-right: 1px solid black;"><a style="width: auto;" href="{:U('Evaluate/teamInfo',array('id'=>$vo['id']))}">查看详情</a></span>
								<span><?=date('Y-m-d',$vo['date'])?></span>
							</p>
						</li>
					</foreach>
				</ul>
				<div class="pagenavi">
					{$showPage}
				</div>
				</div>
			</div>
			<!-- 比赛项目结束 -->
			</div>
</block>