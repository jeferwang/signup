<extend name='Public/App/teacher_frame.php'/>
<block name="title">比赛评分</block>
<block name="css_js">
	<style type="text/css">
		.sub_button {
			width: 82px;
			height: 26px;
			background-color: lightgreen;
			border: 1px solid #003567;
			border-radius: 5px;
			cursor: pointer;
		}
		
		.info_box {
			margin-top: 20px;
		}
		
		.info_label {
			margin-right: 20px;
			color: #666666;
		}
		
		#teamlist td {
			border: 1px solid #888;
		}
		
		#teamlist td {
			padding: 5px;
			width: 50%;
		}
		
		#suggest {
			height: 100px;
		}
	</style>
	<script type="text/javascript">
		$().ready(function () {
			$("#shen_he").addClass("unselect");
		});
	</script>
</block>
<block name="main">
	<!--	--><? //=dump($info['pw'])?>
	<!-- 创建开始 -->
	<div class="creative">
		<div class="nav_title">
			<ul>
				<li class="nav_focus" style="width: auto;">
					<a>
						{$info['team']}--报名信息
					</a>
				</li>
			</ul>
		</div>
		<!-- 创建项目开始	这里引入creative.css页面 -->
		<div class="info_box">
			<span class="info_label">当前状态:</span>
			<!--			<span>{$info['zhuangtai']}</span>-->
			<?php
			foreach ($info['pw'] as $pw) {
				if ($pw['pwid'] == cookie('tId')) {
					$thisPw = $pw;
				}
			}
			if ($thisPw['score'] == null) {
				?>
				<span style="color: red;">您未评分</span>
				<?php
			} else {
				?>
				<span style="color: green;">您的评分:{$thisPw['score']}</span>
				<?php
			}
			?>
		
		</div>
		<!--				<div class="info_box">-->
		<!--					<span class="info_label">学生编号:</span><span>{$info['code']}</span>-->
		<!--				</div>-->
		<div class="info_box">
			<span class="info_label">团队名称:</span><span>{$info['team']}</span>
		</div>
		<!--				<div class="info_box">-->
		<!--					<table id="teamlist" cellspacing="0">-->
		<!--						<tr>-->
		<!--							<th>成员列表</th>-->
		<!--						</tr>-->
		<!--					--><?php
		//					foreach(json_decode($info['teaminfo']) as $k=>$v){
		//					?><!--	-->
		<!--					<tr><td align="center">--><? //=$v?><!--</td></tr>-->
		<!--					--><?php //
		//					}
		//					?>
		<!--					</table>-->
		<!--				</div>-->
		<div class="info_box">
			<span class="info_label">作品标题:</span><span>{$info['title']}</span>
		</div>
		<div class="info_box">
			<span class="info_label">作品类型:</span><span>{$info['type']}</span>
		</div>
		<div class="info_box">
			<span class="info_label">作品简要说明:</span>
			<br/>
			<span name="contest help">&emsp;&emsp;{$info['info']}</span>
		</div>
		<div class="info_box">
			<!--继承Public/App下的下载链接文件，方便修改-->
			<include file="Public/App/downLink.php"/>
		</div>
		<br/>
		<div class="button">
			<!--打分的表单-->
			<form action="{:U('Evaluate/runEvaluate')}" method="post">
				<textarea name="suggest" id="suggest" placeholder="请输入评语" required="required">{$thisPw['suggest']}</textarea>
				<br>
				<br>
				<label for="score">分数:</label>
				<input type="text" name="score" id="score" value="{$thisPw['score']}" required="required" style="border-bottom: 1px solid #333;"/>
				<input type="hidden" name="id" id="id" value="{$info['id']}"/>
				<input type="submit" style="background: #268425;color: white;" value="评分">
			</form>
		</div>
		<!-- 创建项目结束 -->
	</div>
	<!-- 创建结束 -->
</block>
