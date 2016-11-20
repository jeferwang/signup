<?php
namespace Home\Model;

class CommonModel {

//	根据数组中status字段的数据来生成对应的中文状态信息，限制单个记录
	public static function oneStatus($info) {
		switch ($info['status']) {
			case 0:
				$info['zhuangtai'] = '<span style="color:gray;">待审核</span>';
				break;
			case 1:
				$info['zhuangtai'] = '<span style="color:#87b123;">学院审核通过</span>';
				break;
			case 2:
				$info['zhuangtai'] = '<span style="color:#169042;">学校审核通过</span>';
				break;
			case 3:
				$info['zhuangtai'] = '<span style="color:#00BFFF;">已评分 </span>';
				break;
			case 4:
				$info['zhuangtai'] = '<span style="color:#c76679;">学院审核预通过</span>';
				break;
			case 5:
				$info['zhuangtai'] = '<span style="color:red;">学校审核预通过</span>';
				break;
		}
		return $info;
	}

//	一组数据进行添加分数、建议等数组元素
	public static function oneScore($info) {
		$tasks = M('Task')->join('left join reg_teacher on reg_task.pwid=reg_teacher.id')->where(array('projectid' => $info['id']))->select();
		$info['pw'] = $tasks;
		return $info;
	}

//	多组数据进行判断状态，添加中文状态提示
	public static function listStatus($list) {
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
					$teaInfo = M('Teacher')->where(array('id' => cookie('tId')))->find();
					if ($teaInfo['level'] == 3) {//确认评委身份
						$taskInfo = M('Task')->where(array('pwid' => $teaInfo['id']))->getField('score');
						if ($taskInfo != null) {//已评分的评委老师
							$list[$k]['zhuangtai'] = '<span style="color:#00BFFF;">已评分</span>';
						} else {//没有评分的评委老师
							$list[$k]['zhuangtai'] = '<span style="color:#ff1ddd;">未评分 </span>';
						}
					} else {//非评委的老师
						$list[$k]['zhuangtai'] = '<span style="color:#00BFFF;">已评分 </span>';
					}
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
//-----------------------------------------------------------------------------------------------------------
//	多组数据进行判断状态，添加中文状态提示(评委)
	public static function listStatusPW($list) {
		foreach ($list as $k => $v) {
			switch ($v['status']) {
				case 0:
					$list[$k]['zhuangtai'] = '<span style="color:gray;">任务分配错误</span>';
					break;
				case 1:
					$list[$k]['zhuangtai'] = '<span style="color:#87b123;">任务分配错误</span>';
					break;
				case 2:
					$list[$k]['zhuangtai'] = '<span style="color:#169042;">未评分</span>';
					break;
				case 3:
					$teaInfo = M('Teacher')->where(array('id' => cookie('tId')))->find();
					if ($teaInfo['level'] == 3) {//确认评委身份
						$taskInfo = M('Task')->where(array('pwid' => $teaInfo['id'], 'projectid' => $v['id']))->getField('score');
						if ($taskInfo != null) {//已评分的评委老师
							$list[$k]['zhuangtai'] = '<span style="color:#00BFFF;">已评分</span>';
						} else {//没有评分的评委老师
							$list[$k]['zhuangtai'] = '<span style="color:#169042;">未评分 </span>';
						}
					}
					break;
				case 4:
					$list[$k]['zhuangtai'] = '<span style="color:#c76679;">任务分配错误</span>';
					break;
				case 5:
					$list[$k]['zhuangtai'] = '<span style="color:red;">任务分配错误</span>';
					break;
				
			}
		}
		return $list;
	}
	
	//	根据数组中status字段的数据来生成对应的中文状态信息，限制单个记录(评委)
	public static function oneStatusPW($info) {
		switch ($info['status']) {
			case 0:
				$info['zhuangtai'] = '<span style="color:gray;">任务分配错误</span>';
				break;
			case 1:
				$info['zhuangtai'] = '<span style="color:#87b123;">任务分配错误</span>';
				break;
			case 2:
				$info['zhuangtai'] = '<span style="color:#169042;">未评分</span>';
				break;
			case 3:
				// $info['zhuangtai'] = '<span style="color:#00BFFF;">已评分 </span>';
				$teaInfo = M('Teacher')->where(array('id' => cookie('tId')))->find();
				$taskInfo = M('Task')->where(array('pwid' => $teaInfo['id']))->getField('score');
				if ($taskInfo != null) {//已评分的评委老师
					$info['zhuangtai'] = '<span style="color:#00BFFF;">已评分</span>';
				} else {//没有评分的评委老师
					$info['zhuangtai'] = '<span style="color:#ff1ddd;">未评分 </span>';
				}
				break;
			case 4:
				$info['zhuangtai'] = '<span style="color:#c76679;">任务分配错误</span>';
				break;
			case 5:
				$info['zhuangtai'] = '<span style="color:red;">任务分配错误</span>';
				break;
		}
		return $info;
	}
//--------------------------------------------------------------------------------------------------------------------
//	多组数据进行添加分数、建议等数组元素,放在pw中
	public static function listScore($list) {
		foreach ($list as $key => $value) {
			$tasks = M('Task')->where(array('projectid' => $value['id']))->select();
			$list[$key]['pw'] = $tasks['score'];
		}
		return $list;
	}

//	返回下载连接，供视图里下载文件使用
	public function downLink($info) {
		$json = $info['fileroute'];
		$files = json_decode($json, true);
		$link = array();
		if ($files['shenbaoshu']) {
			$link['shenbaoshu'] = array(
				'name'  => $files['shenbaoshu']['name'],
				'route' => $files['shenbaoshu']['savepath'] . $files['shenbaoshu']['savename'],
			);
		}
		if ($files['ppt']) {
			$link['ppt'] = array(
				'name'  => $files['ppt']['name'],
				'route' => $files['ppt']['savepath'] . $files['ppt']['savename'],
			);
		}
		if ($files['tupian']) {
			$link['tupian'] = array(
				'name'  => $files['tupian']['name'],
				'route' => $files['tupian']['savepath'] . $files['tupian']['savename'],
			);
		}
		if ($files['shuoming']) {
			$link['shuoming'] = array(
				'name'  => $files['shuoming']['name'],
				'route' => $files['shuoming']['savepath'] . $files['shuoming']['savename'],
			);
		}
		if ($files['zuopin']) {
			$link['zuopin'] = array(
				'name'  => $files['zuopin']['name'],
				'route' => $files['zuopin']['savepath'] . $files['zuopin']['savename'],
			);
		}
		$info['fileroute'] = $link;
		return $info;
	}
}
