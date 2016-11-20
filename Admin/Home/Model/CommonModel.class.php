<?php
namespace Home\Model;
class CommonModel {
//	根据状态添加显示文字
	public function oneMatchStatus($info) {
		switch ($info['status']) {
			case 0:
				$info['zhuangtai'] = '未发布';
				break;
			case 1:
				$info['zhuangtai'] = '已发布';
				break;
			case 2:
				$info['zhuangtai'] = '已结束';
				break;
		}
		return $info;
	}

//	给一列比赛添加状态
	public function listMatchStatus($list) {
		foreach ($list as $k => $v) {
			switch ($v['status']) {
				case 0:
					$list[$k]['zhuangtai'] = '未发布';
					break;
				case 1:
					$list[$k]['zhuangtai'] = '已发布';
					break;
				case 2:
					$list[$k]['zhuangtai'] = '已结束';
					break;
			}
		}
		return $list;
	}

//	多组作品数据进行判断状态，添加中文状态提示
	public function listStatus($list) {
		foreach ($list as $k => $v) {
			switch ($v['status']) {
				case 0:
					$list[$k]['zhuangtai'] = '<span style="color:gray;">待审核</span>';
					break;
				case 1:
					$list[$k]['zhuangtai'] = '<span style="color:#87b123;">学院审核通过</span>';
					break;
				case 2:
					$list[$k]['zhuangtai'] = '<span style="color:#169042;">学校审核通过</span>';
					break;
				case 3:
					$list[$k]['zhuangtai'] = '<span style="color:#00BFFF;">已评分 </span>';
					break;
				case 4:
					$list[$k]['zhuangtai'] = '<span style="color:#c76679;">学院审核预通过</span>';
					break;
				case 5:
					$list[$k]['zhuangtai'] = '<span style="color:red;">学校审核预通过</span>';
					break;
				
			}
		}
		return $list;
	}

//	多组数据进行添加分数、建议等数组元素
	public static function listScore($list) {
		foreach ($list as $key => $value) {
			$tasks = M()->table('__TASK__ AS TA')->join('left join __TEACHER__ AS TE on TA.pwid=TE.id')->field('TE.CODE,TA.SCORE,TA.SUGGEST')->where(array('projectid' => $value['id']))->select();
			$list[$key]['pw'] = $tasks;
			$count = 0;
			$num = 0;
			foreach ($tasks as $task) {
				if ($task['score']) {
					$count += $task['score'];
					$num++;
				}
			}
			$avg=$count / $num;
			$list[$key]['avg'] = round($avg,2);
		}
		return $list;
	}

//	多组作品数据进行判断状态，添加中文状态提示
	public function listStatusPur($list) {
		foreach ($list as $k => $v) {
			switch ($v['status']) {
				case 0:
					$list[$k]['zhuangtai'] = '待审核';
					break;
				case 1:
					$list[$k]['zhuangtai'] = '学院审核通过';
					break;
				case 2:
					$list[$k]['zhuangtai'] = '学校审核通过';
					break;
				case 3:
					$list[$k]['zhuangtai'] = '已评分';
					break;
				case 4:
					$list[$k]['zhuangtai'] = '学院审核预通过';
					break;
				case 5:
					$list[$k]['zhuangtai'] = '学校审核预通过';
					break;
				
			}
		}
		return $list;
	}

//	根据collegeid获取到学院信息
	public function getListCollege($list) {
		foreach ($list as $k => $v) {
			$college = M('College')->where(array('id' => $v['collegeid']))->find();
			$list[$k]['college'] = $college;
		}
		return $list;
	}
	
	public function getListInfo($list) {
		foreach ($list as $k => $v) {
			$match = M('Match')->where(array('id' => $v['matchid']))->getField('title');
			$list[$k]['match'] = $match;
			$college = M('College')->where(array('id' => $v['collegeid']))->getField('college');
			$list[$k]['college'] = $college;
		}
		$list = $this->listStatusPur($list);
		return $list;
	}

//	获取到队伍的详细信息
	public function getOnesAllInfo($id) {
		$regInfo = M('Reginfo')->where(array('id' => $id))->find();
		$template = '
			<p>团队名称：%s</p>
			<p>作品名称：%s</p>
			<p>作品类型：%s</p>
			<p>作品简介：</p>
			<p>&emsp;&emsp;%s</p>
			<table id="teamlist" cellspacing="0">
				<tr>
					<td style="color:red;" colspan="5">成员列表：(第一个为队长)</td>
				</tr>
				<tr>
						<td>姓名</td>
						<td>学号</td>
						<td>学院</td>
						<td>班级</td>
						<td>联系方式</td>
					</tr>
				';
		
		foreach (json_decode($regInfo['teaminfo'], true) as $k => $v) {
//			连接单元格(团队信息)
			$v = explode('-', $v);
			$template .= '
							<tr>
							<td>' . $v[0] . '</td>
							<td>' . $v[1] . '</td>
							<td>' . $v[2] . '</td>
							<td>' . $v[3] . '</td>
							<td>' . $v[4] . '</td>
							</tr>
							';
		}
		$template .= '<tr>
							<td style="color:blue;"colspan="1">指导老师：</td>
						';
		$template .= '<td align="center" colspan="2">' . json_decode($regInfo['guide'], true)[0] . '</td>';
		$two = json_decode($regInfo['guide'], true)[1] ? json_decode($regInfo['guide'], true)[1] : '无';
		$template .= '<td align="center" colspan="2">' . $two . '</td></tr>';
		$template .= '</table>';
		$files = json_decode($regInfo['fileroute'], true);
		$link = '';
		if ($files['shenbaoshu']['name'] != null) {
			$link .= '<a href="' . __ROOT__ . '/Uploads' . $files['shenbaoshu']['savepath'] . $files['shenbaoshu']['savename'] . '">[申报书]</a>&emsp;';
		}
		if ($files['ppt']['name'] != null) {
			$link .= '<a href="' . __ROOT__ . '/Uploads' . $files['ppt']['savepath'] . $files['ppt']['savename'] . '">[演示PPT]</a>&emsp;';
		}
		if ($files['tupian']['name'] != null) {
			$link .= '<a href="' . __ROOT__ . '/Uploads' . $files['tupian']['savepath'] . $files['tupian']['savename'] . '">[相关图片]</a>&emsp;';
		}
		if ($files['shuoming']['name'] != null) {
			$link .= '<a href="' . __ROOT__ . '/Uploads' . $files['shuoming']['savepath'] . $files['shuoming']['savename'] . '">[作品说明文档]</a>&emsp;';
		}
		if ($files['zuopin']['name'] != null) {
			$link .= '<a href="' . __ROOT__ . '/Uploads' . $files['zuopin']['savepath'] . $files['zuopin']['savename'] . '">[参赛作品]</a>&emsp;';
		}
		
		$template .= '
			<p>' . $link . '</p>
			<p>未通过原因：%s</p>
		';
		
		$pw_suggests=M("Task")->where(array('projectid'=>$regInfo['id']))->select();
		foreach ($pw_suggests as $pw_k=>$pw_v){
//			获取这个评委的code
			$pw_code=M("Teacher")->where(array('id'=>$pw_v['pwid']))->getField('code');
			$template.="<p>评委：".$pw_code."&emsp;&emsp;评分：".($pw_v['score'] ? $pw_v['score'] : "暂无评分")."&emsp;&emsp;建议：".($pw_v['suggest'] ? $pw_v['suggest'] : "暂无建议")."</p>";
		}
		$result = sprintf($template, $regInfo['team'], $regInfo['title'], $regInfo['type'], $regInfo['info'], $regInfo['reason'] ? $regInfo['reason'] : '无');
		echo $result;
//		var_dump($files);
//		echo $template;
	}
}
