<extend name="Public/App/student_frame.php"/>
<block name="title">
	当前比赛作品信息
</block>
<block name="css_js">
	<script src="__PUBLIC__/App/js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>

</block>
<block name="main">
	<div class="upload">
		<div class="nav_title">
			<ul>
				<li class="arrow left">
					<a href="JavaScript:void(0)">
						&lt;
					</a>
				</li>
				<li class="nav_focus" style="width: auto;">
					<a>
						{$info['title']}--我的作品
					</a>
				</li>
				<li class="arrow right">
					<a href="JavaScript:void(0)">
						&gt;
					</a>
				</li>
			</ul>
		</div>
		<div class="game">
			<ul class="page">
				<li>
					<a>
						{$my['code']}
					</a>
					<p>
						<span>
							<a style="width: auto;" href="{:U('Student/myinfo')}">查看详情</a>
						</span>
						<span>{$my['zhuangtai']}</span><span><?php echo date("Y-m-d H:i:s", $my['date']) ?></span>
					</p>
				</li>
				<!--								<foreach name="list" item="vo">-->
				<!--									<li>-->
				<!--										<!--队伍点击之后进入的页面-->-->
				<!--										<a>-->
				<!--											{$vo['code']}-->
				<!--										</a>-->
				<!--										<p>-->
				<!--											<span>-->
				<!--											<if condition="$vo['stuid'] eq $_COOKIE['sId']">-->
				<!--												<a style="width: auto;" href="{:U('Student/myinfo')}">查看详情</a>-->
				<!--											</if>-->
				<!--											</span>-->
				<!--											<span>{$vo['zhuangtai']}</span><span>--><?php //echo date("Y-m-d H:i:s",$vo['date']) ?><!--</span>-->
				<!--										</p>-->
				<!--									</li>-->
				<!--								</foreach>-->
			</ul>
		</div>
	</div>
</block>