<?php
namespace Home\Controller;

use Org\Util\Date;
use Think\Controller;

/*
 * 学生视图
 */

class StudentController extends Controller {

//	登录有效性检查
	public function _initialize() {
		if (!cookie('sId') || !cookie('sCode')) {
			$this->error('您的登录已失效,请重新登录!', U('Index/index'), 3);
		}
	}
	
	public function index() {
		$stu_info = M('Student')->where(array('id' => cookie('sId'), 'code' => cookie('sCode')))->find();
		if (!$stu_info) {
			$this->error('信息异常，请重新登录！', U('Index/logout'), 3);
		}
		$match_info = M('Match')->where(array('id' => $stu_info['matchid']))->find();
		$check = M('Reginfo')->where(array('code' => $stu_info['code']))->find();
		if ($check) {
			$this->teamList();
		} else {
			$this->assign('match_info', $match_info);
			$typelist = M("typelink")->where(array("match_id" => $stu_info['matchid']))->select();
			$arr = array();
			foreach ($typelist as $item) {
				$one_type=M("type")->where(array("id" => $item['type_id']))->getField("type");
				$arr[] = $one_type ? $one_type : "失效的关联类型";
			}
			$this->assign('typelist', $arr);
			$this->display('index');
		}
	}
	
	public function runUpload() {
//		foreach ($_POST as $k => $v) {
//			if ($k != 'teaminfo') {
//				if (trim($v) == '') {
//					$this->error('您的表单未填写完整！');
//				}
//			} else {
//				foreach ($_POST['teaminfo'] as $key => $val) {
//					if (trim($val) == '') {
//						unset($_POST['teaminfo'][$key]);
//					}
//				}
//			}
//		}
		foreach ($_POST as $k => $v) {
			if ($k == 'teaminfo') {
				foreach ($_POST['teaminfo'] as $key => $val) {
					if (trim($val) == '') {
						unset($_POST['teaminfo'][$key]);
					}
				}
			} elseif ($k == 'guide') {
				foreach ($_POST['guide'] as $key => $val) {
					if (trim($val) == '') {
						unset($_POST['guide'][$key]);
					}
				}
			} else {
				if (trim($v) == '') {
					$this->error('您的表单未填写完整！');
				}
			}
		}
		$stu_info = M('Student')->where(array('id' => cookie('sId'), 'code' => cookie('sCode')))->find();
		if (!$stu_info) $this->error('信息异常，请重新登录！', U('Index/logout'), 3);
		$match_info = M('Match')->where(array('id' => $stu_info['matchid']))->find();
		if (count($_POST['teaminfo']) > $match_info['limit']) {
			$this->error('您报名的人数超过了比赛限制！', U('Student/index'), 3);
		}
		$check = M('Reginfo')->where(array('code' => $stu_info['code']))->find();
		if ($check) $this->error('您已经报名，不能重复报名！');
		$upload = new \Think\Upload();
		$upload->maxSize = 104857600;//上传文件大小限制100M
		$upload->exts = json_decode($match_info['extension'], TRUE);//扩展名
		$upload->savePath = '/Match/Stu/';//上传目录
		$upload->autoSub = TRUE;//自动生成子文件夹
		$upload->subName = $stu_info['code'];
		$info = $upload->upload();
		if ($info) {
			$data['code'] = $stu_info['code'];
			$data['stuid'] = $stu_info['id'];
			$data['team'] = $_POST['team'];
			$data['title'] = $_POST['title'];
			$data['type'] = $_POST['type'];
			$data['info'] = $_POST['info'];
			$data['teaminfo'] = json_encode($_POST['teaminfo']);
			$data['guide'] = json_encode($_POST['guide']);
			$data['collegeid'] = $stu_info['collegeid'];
			$data['matchid'] = $stu_info['matchid'];
			$data['fileroute'] = json_encode($info);
			$data['date'] = time();
			$data['status'] = 0;
			$save = M('Reginfo')->add($data);
			if ($save) {
				$this->success('恭喜，操作成功！');
			} else {
				$this->error('网络故障！');
			}
		} else {
			$this->error($upload->getError());
		}
		
	}

//	参与当前比赛的所有队伍的列表(仅仅是列表,公示审核状态),接收传入的get-id(比赛id)
	public function teamList() {
//		传递比赛信息
		$match_id = M('Student')->where(array('id' => cookie('sId'), 'code' => cookie('sCode')))->getField('matchid');
		$info = M('Match')->where(array('id' => $match_id))->find();
		$this->assign('info', $info);
//		传递当前比赛的所有报名信息
//		$list = M('Reginfo')->where(array('matchid' => $match_id))->select();
//		$list = D('Common')->listStatus($list);
//		$this->assign('list', $list);
//		传递自己的比赛信息
		$my = M('Reginfo')->where(array('code' => $_COOKIE['sCode']))->find();
		$my = D('Common')->oneStatus($my);
		$this->assign('my', $my);
		$this->display('teamList');
	}

//	显示自己队伍的详细信息
	public function myinfo() {
//		检索自己的信息
		$myinfo = M('Reginfo')->where(array('stuid' => cookie('sId'), 'code' => cookie('sCode')))->find();
		$myinfo = D('Common')->oneStatus($myinfo);
		$myinfo = D('Common')->oneScore($myinfo);
		$myinfo = D('Common')->downLink($myinfo);
		$this->assign('info', $myinfo);
		$this->display();
	}
	
	public function update() {
		$stu_info = M('Student')->where(array('id' => cookie('sId'), 'code' => cookie('sCode')))->find();
		if (!$stu_info) $this->error('信息异常，请重新登录！', U('Index/logout'), 3);
		$match_info = M('Match')->where(array('id' => $stu_info['matchid']))->find();
		$check = M('Reginfo')->where(array('code' => $stu_info['code']))->find();
//		下面检查是否已经提交作品
		if (!$check) {
			$this->error('请先进行报名！', U('Student/index'), 2);
		} else {
//		检查作品现在是否能进行修改！
			if ($check['status'] != 0 && $check['status'] != 4 && $check['status'] != 5) {
				$this->error('您的作品已经被老师进行审核或评分操作，无法进行修改！', U('Student/myinfo'), 3);
			}
//			表单提交开始
			if (IS_POST) {
//			开始检查输入表单
//				对队员列表进行去空处理
				foreach ($_POST['teaminfo'] as $key => $val) {
					if (trim($val) == '') {
						unset($_POST['teaminfo'][$key]);
					}
				}
				if (count($_POST['teaminfo']) > $match_info['limit']) {
					$this->error('您报名的人数超过了比赛限制！');
				}
				foreach ($_POST as $k => $v) {
					if ($k == 'teaminfo') {
						foreach ($v as $key => $val) {
							if (trim($val) == '') {
								unset($_POST['teaminfo'][$key]);
							}
						}
						if (count($_POST['teaminfo']) == 0) {
							$this->error('您的队伍信息不能为空！');
						}
					} elseif ($k == 'guide') {
						foreach ($v as $key => $val) {
							if (trim($val) == '') {
								unset($_POST['guide'][$key]);
							}
						}
						if (count($_POST['guide']) == 0) {
							$this->error('指导老师不能为空！');
						}
					} else {
						if (trim($v) == '') {
							$this->error('基本信息未填写完整！');
						}
					}
				}
//				检查输入表单结束
				$data = array();
//				循环判断文件上传是否为空
				$i = 0;
				foreach ($_FILES as $k => $v) {
					if ($v['name'] != '') {
						$i++;
					}
				}
				if ($i != 0) {//如果有文件
//			        开始执行更新上传
					$upload = new \Think\Upload();
					$upload->maxSize = 104857600;//上传文件大小限制100M
					$upload->exts = json_decode($match_info['extension'], TRUE);//扩展名
					$upload->savePath = '/Match/Stu/';//上传目录
					$upload->autoSub = TRUE;//自动生成子文件夹
					$upload->subName = $stu_info['code'];
					$upload->hash = FALSE;//不计算hash
					$info = $upload->upload();
//				    执行上传完毕
//				    整合新文件完毕
					if ($info) {
//				        整合新的文件组json
//				        获取到现有的上传文件数据
						$oldFile = json_decode($check['fileroute'], TRUE);
						$newFile = array_merge($oldFile, $info);
						$data['fileroute'] = json_encode($newFile);
					} else {
						$this->error($upload->getError());
					}
				}
				$data['code'] = $stu_info['code'];
				$data['stuid'] = $stu_info['id'];
				$data['team'] = $_POST['team'];
				$data['title'] = $_POST['title'];
				$data['info'] = $_POST['info'];
				$data['teaminfo'] = json_encode($_POST['teaminfo']);
				$data['guide'] = json_encode($_POST['guide']);
				$data['collegeid'] = $stu_info['collegeid'];
				$data['matchid'] = $stu_info['matchid'];
				$data['date'] = time();
				$data['status'] = 0;
				$data['reason'] = null;
				$data['suggest'] = null;
				$save = M('Reginfo')->where(array('code' => $stu_info['code']))->save($data);
				if ($save) {
					$this->success('恭喜，操作成功！', U('Student/index'), 3);
				} else {
					$this->error('网络故障！');
				}
//				结束
				die;
			}
//			表单提交结束
			$check['teaminfo'] = json_decode($check['teaminfo'], true);
			$this->assign('match_info', $match_info);
			$this->assign('reginfo', $check);
			$this->display('update');
		}
	}
}