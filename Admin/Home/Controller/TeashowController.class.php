<?php
namespace Home\Controller;
use Think\Controller;
/*
 * 人才展示管理控制器(后台)
 * 添加人才
 * 删除人才
 * 修改人才信息
 */
class TeashowController extends Controller {
	//	登录有效性检查
	public function _initialize(){
		$ip=M('Admin')->where(array('id'=>cookie('adminId'),'username'=>cookie('adminName')))->find();
		if($ip['loginip']!=$_SERVER['REMOTE_ADDR']){
			$this->error('您的登录已失效,请重新登录!',U('Login/index'),3);
		}
	}
	//	人才管理列表的视图
	public function index() {
		$list = M('Teashow') -> order('id asc') -> page($_GET['p'], 10) -> select();
		foreach ($list as $k=>$v){
			if ($v['type']==1){
				$list[$k]['type']='指导老师';
			}elseif ($v['type']==2){
				$list[$k]['type']='评委老师';
			}
		}
		$this -> assign('list', $list);
		$count = M('Teashow') -> count();
		$page = new \Think\Page($count, 10);
		$show = $page -> show();
		$this -> assign('showpage', $show);
		$this -> display();
	}

	//	添加人才的视图
	public function add() {
		$this -> display();
	}

	//	执行添加人才的方法
	public function runAdd() {
		//  	判断不能为空
		foreach ($_POST as $k => $v) {
			if (trim($v) == '') {
				$this -> error('信息未填写完整!!');
			}
		}
		$data['teaname'] = trim($_POST['teaname']);
		$data['content'] = $_POST['content'];
		$data['date'] = date("Y-m-d H:i:s");
		$data['type'] = $_POST['type'];
		//		开始上传
		$upload = new \Think\Upload();
		//		文件大小限制3M
		$upload -> maxSize = 3145728;
		//		格式限制
		$upload -> exts = array('jpg', 'png', 'jpeg');
		//		上传路径为Upload文件夹下的Match下的InfoDoc文件夹下
		$upload -> savePath = 'teaimg/';
		//		不自动创建子目录
		$upload -> autoSub = false;
		//		文件重命名，防止重名，命名方式为时间戳+四位随机数
		$upload -> saveName = time() . rand(1000, 9999);
		//		执行上传方法
		$info = $upload -> upload();
		//		判断，如果上传成功，执行写入数据库
		if ($info) {
			//			组合路径
			$data['imgroute'] = '/Uploads/' . $info['file']['savepath'] . $info['file']['savename'];
			//			dump($data);
			if ( M('Teashow') -> add($data)) {
				//				添加成功
				$this -> success('添加成功');
			} else {
				//				添加失败
				$this -> error('添加失败');
			}
		} else {
			$this -> error($upload -> getError());
		}
	}

	//	修改人才信息的视图
	public function fix() {
		$info = M('Teashow') -> where(array('id' => $_GET['id'])) -> find();
		$this -> assign('info', $info);
		$this -> display();
	}

	//	执行修改人才信息的方法
	public function runFix() {
		//  	判断不能为空
		foreach ($_POST as $k => $v) {
			if (trim($v) == '') {
				$this -> error('信息未填写完整!!');
			}
		}
		$get = M('Teashow') -> where(array('id' => $_POST['id'])) -> find();
		$data['teaname'] = trim($_POST['teaname']);
		$data['content'] = $_POST['content'];
		$data['date'] = date("Y-m-d H:i:s");
		$data['type'] = $_POST['type'];
		if ($_FILES['file']['name'] != '') {
			//			开始上传
			$upload = new \Think\Upload();
			//			文件大小限制3M
			$upload -> maxSize = 3145728;
			//			格式限制
			$upload -> exts = array('jpg', 'png', 'jpeg');
			//		上传路径为Upload文件夹下的Match下的InfoDoc文件夹下
			$upload -> savePath = 'teaimg/';
			//		不自动创建子目录
			$upload -> autoSub = false;
			//		文件重命名，防止重名，命名方式为时间戳+四位随机数
			$upload -> saveName = time() . rand(1000, 9999);
			//		执行上传方法
			$info = $upload -> upload();
			//		判断，如果上传成功，执行写入数据库
			if ($info) {
				//				组合路径
				$data['imgroute'] = '/Uploads/' . $info['file']['savepath'] . $info['file']['savename'];
				unlink('.' . $get['imgroute']);
			} else {
				$this -> error($upload -> getError());
			}
		}
		//			执行添加
		$fix = M('Teashow') -> where(array('id' => $_POST['id'])) -> save($data);
		if ($fix) {
			//					添加成功
			$this -> success('更新成功');
		} else {
			//					添加失败
			$this -> error('更新失败');
		}
	}

	//	执行删除人才的方法
	public function runDel() {
		$get = M('Teashow') -> where(array('id' => $_GET['id'])) -> find();
		$del = M('Teashow') -> where(array('id' => $_GET['id'])) -> delete();
		if ($del) {
			unlink('.' . $get['imgroute']);
			$this -> success('删除成功!');
		} else {
			$this -> error('删除失败!');
		}
	}

}
