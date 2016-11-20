<?php
namespace Home\Controller;

use Think\Controller;

/*
 * 教师视图
 * 发布比赛index
 * 执行发布的方法addMatch
 * 历史发布列表视图history
 * 审核列表页examine
 * 评分列表页evaluate
 */

class TeacherController extends Controller {

//	登录有效性检查
	public function _initialize() {
		if (!cookie('tId') || !cookie('tCode')) {
			$this->error('您的登录已失效,请重新登录!', U('Index/index'), 3);
		}
	}

//	教师页面的主页视图
	public function index() {
//  	搜集老师账户的信息
		$tea_info = M('Teacher')->where(array('id' => cookie('tId'), 'code' => cookie('tCode')))->find();
		if (!$tea_info) $this->error('信息异常，请重新登录！', U('Index/logout'), 3);
		$level = $tea_info['level'];
		$type = $tea_info['type'];
		$collegeId = $tea_info['collegeid'];
		$collegeInfo = M('College')->where(array('id' => $collegeId))->find();
		$this->assign('collegeInfo', $collegeInfo);
		$matchId = $tea_info['matchid'];
		$matchInfo = M('Match')->where(array('id' => $matchId))->find();
		$this->assign('matchInfo', $matchInfo);
//		检索对应的信息,生成条件
		if ($level == 1) {
			$map = array();
			$map['collegeid'] = $collegeId;
			$map['matchid'] = $matchId;
		} elseif ($level == 2) {
			$map = array();
			$map['matchid'] = $matchId;
		} elseif ($level == 3) {
			$task = M('Task')->where(array('pwid' => $tea_info['id']))->select();
			$taskList = array();
			foreach ($task as $k => $v) {
				$taskList[] = $v['projectid'];
			}
			$map = array();
			if (count($taskList) == 0) {
				$taskList = array(0 => 0);
			}
			$map['id'] = array('in', $taskList);//必须是已经两级审核通过的才能评分
		}
//		检索并传递信息
		$list = M('Reginfo')->where($map)->order('id asc')->page($_GET['p'])->select();
		// $list=D('Common')->listStatus($list);
		// $this->assign('list',$list);
		$count = M('Reginfo')->where($map)->count();
		$page = new \Think\Page($count, 20);
		$showPage = $page->show();
		$this->assign('showPage', $showPage);
//		渲染不同的视图
		if ($level == 1 || $level == 2) {
			$list = D('Common')->listStatus($list);
			$this->assign('list', $list);
			$this->display('examine');
		} elseif ($level == 3) {
			$list = D('Common')->listStatusPW($list);
			$this->assign('list', $list);
			$this->display('evaluate');
		} else {
			$this->error('账号信息异常,请联系后台管理员！', U('Index/logout'), 3);
		}
	}
}