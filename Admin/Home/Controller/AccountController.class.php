<?php
namespace Home\Controller;

use Think\Controller;

/*
 * 账户控制器
 * 管理员账户列表
 * 老师账户列表
 * 学生账户列表
 * 添加管理员账户
 * 添加学生账户
 * 添加老师账户(身份+学院)
 */

class AccountController extends Controller {
	
	//	登录有效性检查
	public function _initialize() {
		$ip = M('Admin')->where(array('id' => cookie('adminId'), 'username' => cookie('adminName')))->find();
		if ($ip['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('您的登录已失效,请重新登录!', U('Login/index'), 3);
		}
	}

//	管理员列表(包含添加管理员的表单)
	public function adminList() {
		$list = M('Admin')->order('id asc')->page($_GET['p'], 10)->select();
		$this->assign('list', $list);
		$count = M('Admin')->count();
		$page = new \Think\Page($count, 10);
		$show = $page->show();
		$this->assign('showpage', $show);
		$this->display();
	}

//	执行添加管理员方法
	public function runAddAdmin() {
		foreach ($_POST as $k => $v) {
			if (trim($v) == '') {
				$this->error('用户名或密码不能为空！');
			}
		}
		$username = $_POST['username'];
		$password = sha1($_POST['password']);
		$check = M('Admin')->where(array('username' => $username))->find();
		if ($check) {
			$this->error('用户名重复！');
		}
		$add = M('Admin')->add(array('username' => $username, 'password' => $password));
		if ($add) {
			$this->success('新增管理员成功！');
		} else {
			$this->error('新增失败，请刷新重试！');
		}
	}

//	执行删除管理员方法
	public function runDelAdmin() {
		$coo_id = cookie('adminId');
		$my_info = M('Admin')->where(array('id' => $coo_id))->find();
//		对比当前的IP和登录时记录的ip是否一致
		if ($my_info['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('非法访问！！！');
		} else {
			$count=M('Admin')->count();
			if ($count==1) {
				$this->error('您不能删除仅有的一位管理员 :)');
			}
			$del = M('Admin')->where((array('id' => $_GET['id'])))->delete();
			if ($del) {
				$this->success('删除成功！！！');
			} else {
				$this->error('删除失败！！！');
			}
		}
	}

//	管理员修改密码视图
	public function fixAdmin() {
		$this->display();
	}

//	执行管理员修改密码方法
	public function runFixAdmin() {
		$username = $_POST['username'];
		$oldPass = sha1($_POST['oldPass']);
		$password = sha1($_POST['password']);
		$coo_id = cookie('adminId');
		$my_info = M('Admin')->where(array('id' => $coo_id))->find();
		//		对比当前的IP和登录时记录的ip是否一致
		if ($my_info['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('非法访问！！！');
		} elseif ($my_info['password'] != $oldPass) {
			$this->error('原密码错误！！！');
		} else {
			$fix = M('Admin')->where(array('id' => $coo_id))->save(array('username' => $username, 'password' => $password));
			if ($fix) {
				cookie('adminId', null);
				cookie('adminName', null);
				$this->success('密码修改成功,请重新登录！！！', U('Login/index'), 3);
			} else {
				$this->error('密码修改失败！！！');
			}
		}
	}

//	学生列表
	public function stuList() {
		$sort='matchid desc,collegeid asc,num asc';
		//	学生列表(包含添加学生的表单)
		$list = M('Student')->order($sort)->page($_GET['p'], 20)->select();
		foreach ($list as $k => $v) {
			$matchName = M('match')->where(array('id' => $v['matchid']))->getField('title');
			$colName = M('college')->where(array('id' => $v['collegeid']))->getField('college');
			$list[$k]['colName'] = $colName;
			$list[$k]['matchName'] = $matchName;
		}
		$this->assign('list', $list);
		$count = M('Student')->count();
		$page = new \Think\Page($count, 20);
		$show = $page->show();
		$this->assign('showpage', $show);
		$match = M('Match')->select();
		$this->assign('match', $match);
		$college = M('college')->select();
		$this->assign('college', $college);
		$this->display();
	}

//	执行添加学生账户方法
	public function runAddStu() {
		$max = M('Student')->where(array('matchid' => $_POST['matchid'], 'collegeid' => $_POST['collegeid']))->order('num desc')->getField('num');
		if (!$max) $max = 0;
		$max = (int)$max + 1;
		$colCode = M('College')->where(array('id' => $_POST['collegeid']))->getField('code');
		for ($i = $max; $i < $max + $_POST['count']; $i++) {
			$stu = array();
			$stu['code'] = $colCode . $_POST['matchid'] . $i;
			$stu['num'] = $i;
			$stu['matchid'] = $_POST['matchid'];
			$stu['collegeid'] = $_POST['collegeid'];
			$stu['password'] = sha1(trim($_POST['password']));
			$stu['status'] = 1;
			M('Student')->add($stu);
		}
		redirect(U('Account/stuList'));
	}

//	执行删除学生账户方法
	public function runDelStu() {
		$coo_id = cookie('adminId');
		$my_info = M('Admin')->where(array('id' => $coo_id))->find();
		//		对比当前的IP和登录时记录的ip是否一致
		if ($my_info['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('非法访问！！！');
		} else {
			M('Student')->where(array('id' => $_GET['id']))->save(array("status" => 2));
			$this->success('禁用学生账户成功');
		}
	}

//	执行回复学生账户方法
	public function runRecStu() {
		$coo_id = cookie('adminId');
		$my_info = M('Admin')->where(array('id' => $coo_id))->find();
		//		对比当前的IP和登录时记录的ip是否一致
		if ($my_info['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('非法访问！！！');
		} else {
			M('Student')->where(array('id' => $_GET['id']))->save(array("status" => 1));
			$this->success('启用学生账户成功');
		}
	}

//	老师列表
	public function teaList() {
		//	老师列表(包含添加老师的表单)
		$list = M('Teacher')->order('matchid desc,collegeid asc,id asc')->page($_GET['p'], 10)->select();
		foreach ($list as $k => $v) {
			$list[$k]['college'] = M('College')->where(array('id' => $v['collegeid']))->getField('college');
			if ($v['level'] == 2) {
				$list[$k]['college'] = '学校账户';
			} elseif ($v['level'] == 3) {
				$list[$k]['college'] = '评委账户';
			}
			$list[$k]['match'] = M('Match')->where(array('id' => $v['matchid']))->getField('title');
		}
		$this->assign('list', $list);
		$college = M('College')->select();
		$this->assign('college_list', $college);
		$match = M('Match')->select();
		$this->assign('match', $match);
		$count = M('Teacher')->count();
		$page = new \Think\Page($count, 10);
		$show = $page->show();
		$this->assign('showpage', $show);
		$this->display();
	}

//	执行添加老师账户方法
	public function runAddTea() {
		$current = M('Teacher')->where(array('matchid' => $_POST['matchid'], 'type' => $_POST['type']))->order('num desc')->getField('num');
		$current = $current ? $current : 0;
		$max = $current + (int)trim($_POST['count']);
		for ($i = $current + 1; $i <= $max; $i++) {
			$tea = array();
			$tea['code'] = $_POST['type'] . $_POST['matchid'] . $i . 't';
			$tea['num'] = $i;
			$tea['status'] = 1;
			$tea['type'] = $_POST['type'];
			$colId = M('College')->where(array('code' => $_POST['type']))->getField('id');
			$tea['collegeid'] = $colId ? $colId : null;
			$tea['matchid'] = $_POST['matchid'];
			//		级别
			if ($_POST['type'] == 'hpu') {
				//			学校的账户为二级审核
				$tea['level'] = 2;
			} elseif ($_POST['type'] == 'pw') {
				//			评委的账户为三级（评分）
				$tea['level'] = 3;
			} else {
				//			学院老师的账户为一级审核
				$tea['level'] = 1;
			}
			$tea['password'] = sha1(trim($_POST['password']));
//			dump($tea);
			M('Teacher')->add($tea);
		}
		redirect(U('Account/teaList'));
	}

//	执行禁用老师账户方法
	public function runDelTea() {
		$coo_id = cookie('adminId');
		$my_info = M('Admin')->where(array('id' => $coo_id))->find();
		//		对比当前的IP和登录时记录的ip是否一致
		if ($my_info['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('非法访问！！！');
		} else {
			M('Teacher')->where(array('id' => $_GET['id']))->save(array("status"=>2));
			$this->success('禁用教师账户成功');
		}
	}
	//	执行回复老师账户方法
	public function runRecTea() {
		$coo_id = cookie('adminId');
		$my_info = M('Admin')->where(array('id' => $coo_id))->find();
		//		对比当前的IP和登录时记录的ip是否一致
		if ($my_info['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('非法访问！！！');
		} else {
			M('Teacher')->where(array('id' => $_GET['id']))->save(array("status"=>1));
			$this->success('启用教师账户成功');
		}
	}
	
	public function runRealDelTea() {
		$coo_id = cookie('adminId');
		$my_info = M('Admin')->where(array('id' => $coo_id))->find();
		//		对比当前的IP和登录时记录的ip是否一致
		if ($my_info['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('非法访问！！！');
		} else {
			M('Teacher')->where(array('id' => $_GET['id']))->save(array("del"=>1));
			$this->success('删除教师账户成功');
		}
	}
	public function runRealDelStu() {
		$coo_id = cookie('adminId');
		$my_info = M('Admin')->where(array('id' => $coo_id))->find();
		//		对比当前的IP和登录时记录的ip是否一致
		if ($my_info['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('非法访问！！！');
		} else {
			M('Student')->where(array('id' => $_GET['id']))->save(array("del"=>1));
			$this->success('删除学生账户成功');
		}
	}
}