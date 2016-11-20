<?php
namespace Home\Controller;

use Think\Controller;

/*
 * 首页(登录)
 * 验证登录
 * 执行登出
 */

class IndexController extends Controller {

//	报名系统的首页，默认设置为了登录页面
	public function index() {
		$this->display();
	}
//	执行登录的方法,验证用户名和密码，以及账户类型，如果成功，则创建cookie
//	cookie默认周期浏览器生命周期
//	记得判断身份,根据不同的身份执行不同的方法
	public function login() {
//		判断账户类型，并找出对应的密码
		if ($_POST['id'] == 'teacher') {//老师身份
			$info = M('Teacher')->where(array('code' => $_POST['username']))->find();
			if ($info['del']==1) {
				$this->error('账号不可用！');
			}
//			开始判断比赛状态
//			$match=M('Match')->where(array('id'=>$info['matchid']))->find();
//			if($match['status']!=1){
//				$this->error('对不起，这个比赛现在未开放，不能登录！');
//			}
//			结束判断比赛状态
			if (!$info) {
				$this->error('找不到该用户,请检查用户名或者更改所选用户类型');
			}
			if ($info['status'] != 1) {
				$this->error('您的账户未启用，请与管理员联系');
			}
			if ($info['password'] == sha1($_POST['password'])) {
				//登录成功
				cookie('tId', $info['id']);
				cookie('tCode', $info['code']);
				redirect(U('Teacher/index'));
			} else {
				//登录失败
				$this->error('用户名或密码错误！', U('Index/index'));
			}
		} elseif ($_POST['id'] == 'student') {//学生身份
			$info = M('Student')->where(array('code' => $_POST['username']))->find();
			if (!$info) {
				$this->error('找不到该用户,请检查用户名或者更改所选用户类型');
			}
			if ($info['del']==1) {
				$this->error('账号不可用！');
			}
//			开始判断比赛状态
			$match = M('Match')->where(array('id' => $info['matchid']))->find();
			if ($match['status'] != 1) {
				$this->error('对不起，这个比赛现在未开放，不能登录！');
			}
//			结束判断比赛状态
			if ($info['status'] != 1) {
				$this->error('您的账户未启用，请与管理员联系');
			}
			if ($info['password'] == sha1($_POST['password'])) {
				//登录成功
				cookie('sId', $info['id']);
				cookie('sCode', $info['code']);
				redirect(U('Student/index'));
			} else {
				//登录失败
				$this->error('用户名或密码错误！', U('Index/index'));
			}
		} else {//如果id异常，抛出错误
			$this->error('身份验证异常，请刷新重试！', U('Index/index'));
		}
	}

//	执行登出的方法,退出账户,转到登录页面,同时销毁cookie
	public function logout() {
		//销毁cookie
		if ($_GET['type'] == 'teacher') {
			cookie('tId', null);
			cookie('tCode', null);
		} elseif ($_GET['type'] == 'student') {
			cookie('sId', null);
			cookie('sCode', null);
		} else {
			cookie('tId', null);
			cookie('tCode', null);
			cookie('sId', null);
			cookie('sCode', null);
		}
		$this->success('注销账号成功！', U('Index/index'), 2);
	}
	
	public function change_password() {
		foreach ($_POST as $item) {
			if (trim($item)=='') {
				die("EmptyError");
			}
		}
		if (!(cookie('sId') && cookie('sCode')) && !(cookie('tId') && cookie('tCode'))) {
			die('AuthError');
		}
//		学生身份
		if (cookie('sId')) {
			$info = M('Student')->where(array('code' => cookie('sCode')))->getField('password');
			if (sha1($_POST['old'])==$info) {
				if ($_POST['new']!=$_POST['re']) {
					die('SameError');
				}
				$change = M('Student')->where(array('code' => cookie('sCode'),'password'=>sha1($_POST['old'])))->save(array('password'=>sha1($_POST['new'])));
				if ($change) {
					die('Success');
				}
			}else{
				die("OldError");
			}
		}
//		老师身份
		if (cookie('tId')) {
			$info = M('Teacher')->where(array('code' => cookie('tCode')))->getField('password');
			if (sha1($_POST['old'])==$info) {
				if ($_POST['new']!=$_POST['re']) {
					die('SameError');
				}
				$change = M('Teacher')->where(array('code' => cookie('tCode'),'password'=>sha1($_POST['old'])))->save(array('password'=>sha1($_POST['new'])));
				if ($change) {
					die('Success');
				}
			}else{
				die("OldError");
			}
		}
		
	}
}