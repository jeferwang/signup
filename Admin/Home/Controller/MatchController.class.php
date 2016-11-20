<?php
namespace Home\Controller;
use Think\Controller;
/*
 * 比赛控制器
 */
class MatchController extends Controller {
	//	登录有效性检查
	public function _initialize(){
		$ip=M('Admin')->where(array('id'=>cookie('adminId'),'username'=>cookie('adminName')))->find();
		if($ip['loginip']!=$_SERVER['REMOTE_ADDR']){
			$this->error('您的登录已失效,请重新登录!',U('Login/index'),3);
		}
	}
	//	比赛列表
	public function index() {
		//  	检索第一页历史项目，限制20条
		$list = M('Match') -> order('id desc') -> page($_GET['p'], 20) -> select();
		$this -> assign('list', $list);
		//		计算页码
		$list_count = M('Match') -> count();
		$page = new \Think\Page($list_count, 20);
		$show = $page -> show();
		$this -> assign('showpage', $show);
		$this -> display();
	}

	//	添加比赛的视图
	public function add() {
		$types=M("Type")->select();
		$this->assign("types",$types);
		$this -> display();
	}

	//	执行添加比赛的方法
	public function runAdd() {
		if (!$_POST['submit']) {
			$this -> error('非法添加！');
		}
		//		判断表单数据是否存在空值(去除两端空格)
		foreach ($_POST as $k => $v) {
			if ($k!="type") {
				if (trim($v) == '') {
					$this -> error('表单不完整！');
				}
			}else{
				if (!$_POST['type']) {
					$this -> error('必须选择作品类型！');
				}
			}
		}
		//		初始化数据并进行整理
		$data = array();
		$data['title'] = $_POST['title'];
		$data['info'] = $_POST['info'];
		$data['limit'] = $_POST['limit'];
		
		
		//		根据勾选情况，把允许的格式堆入$data['extension']数组
		if ($_POST['zip'] == 'on') {//压缩文件
			$data['extension'][] = 'zip';
			$data['extension'][] = 'rar';
			$data['extension'][] = '7z';
		}
		if ($_POST['doc'] == 'on') {//文档演示文稿
			$data['extension'][] = 'doc';
			$data['extension'][] = 'docx';
			$data['extension'][] = 'ppt';
			$data['extension'][] = 'pptx';
			$data['extension'][] = 'xls';
			$data['extension'][] = 'xlsx';
			$data['extension'][] = 'wps';
		}
		if ($_POST['img'] == 'on') {//图片文件
			$data['extension'][] = 'jpg';
			$data['extension'][] = 'jpeg';
			$data['extension'][] = 'png';
			$data['extension'][] = 'bmp';
		}
		
		//		如果格式限制勾选了，把允许的格式堆入数组之后，转换成json存入数据库
		if ($data['extension']) {
			$data['extension'] = json_encode($data['extension']);
		}
		//		判断是点击的哪个submit按钮，并存储不同的发布状态
		if ($_POST['submit'] == '发布') {
			$data['status'] = 1;
		} elseif ($_POST['submit'] == '储存') {
			$data['status'] = 0;
		}
		//		日期
		$data['starttime'] = date('Y-m-d');
		//		开始上传
		$upload = new \Think\Upload();
		//		文件大小限制10M
		$upload -> maxSize = 10485760;
		//		发布比赛信息，不做格式限制
		//		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		//		上传路径为Upload文件夹下的Match下的InfoDoc文件夹下
		$upload -> savePath = 'Match/InfoDoc/';
		//		不自动创建子目录
		$upload -> autoSub = false;
		//		文件重命名，防止重名，命名方式为时间戳+四位随机数
		$upload -> saveName = time() . rand(1000, 9999);
		//		执行上传方法
		$info = $upload -> upload();
		//		判断，如果上传成功，执行写入数据库
		if ($info) {
			//			组合路径
			$data['document'] = '/Uploads/' . $info['file']['savepath'] . $info['file']['savename'];
			//			dump($data);
			$add=M('Match') -> add($data);
			if ( $add) {
				//				添加比赛成功
				
				
				
				foreach ($_POST['type'] as $key=>$type){
					M("Typelink")->add(array("match_id"=>$add,"type_id"=>$type));
				}
				
				
				
				$this -> success('新增比赛成功');
			} else {
				//				添加比赛失败
				$this -> error('新增比赛失败');
			}
		} else {
			$this -> error($upload -> getError());
		}
	}

	//	修改比赛信息的视图
	public function fix() {
		$id=$_GET['id'];
		$info=M('Match')->where(array('id'=>$id))->find();
		$this->assign('info',$info);
		$types=M("Type")->select();
		$this->assign("types",$types);
		$selected_types=M("Typelink")->where(array("match_id"=>$id))->select("type_id");
		$arr=array();
		foreach ($selected_types as $selected_type) {
			$arr[]=$selected_type['type_id'];
		}
		$this->assign("selected_types",$arr);
		$this->display();
	}

	//	执行修改比赛的方法
	public function runFix() {
		//		判断表单数据是否存在空值(去除两端空格)
//		foreach ($_POST as $k => $v) {
//			if (trim($v) == '') {
//				$this -> error('表单不完整！');
//			}
//		}
		foreach ($_POST as $k => $v) {
			if ($k!="type") {
				if (trim($v) == '') {
					$this -> error('表单不完整！');
				}
			}else{
				if (!$_POST['type']) {
					$this -> error('必须选择作品类型！');
				}
			}
		}
		$id = $_POST['id'];
		$get = M('Match') -> where(array('id' => $id)) -> find();
		//		初始化数据并进行整理
		$data = array();
		$data['title'] = $_POST['title'];
		$data['info'] = $_POST['info'];
		$data['limit'] = $_POST['limit'];
		//		根据勾选情况，把允许的格式堆入$data['extension']数组
		//		根据勾选情况，把允许的格式堆入$data['extension']数组
		if ($_POST['zip'] == 'on') {//压缩文件
			$data['extension'][] = 'zip';
			$data['extension'][] = 'rar';
			$data['extension'][] = '7z';
		}
		if ($_POST['doc'] == 'on') {//文档演示文稿
			$data['extension'][] = 'doc';
			$data['extension'][] = 'docx';
			$data['extension'][] = 'ppt';
			$data['extension'][] = 'pptx';
			$data['extension'][] = 'xls';
			$data['extension'][] = 'xlsx';
			$data['extension'][] = 'wps';
		}
		if ($_POST['img'] == 'on') {//图片文件
			$data['extension'][] = 'jpg';
			$data['extension'][] = 'jpeg';
			$data['extension'][] = 'png';
			$data['extension'][] = 'bmp';
		}
		//		如果格式限制勾选了，把允许的格式堆入数组之后，转换成json存入数据库
		if ($data['extension']) {
			$data['extension'] = json_encode($data['extension']);
		}else{
			$data['extension'] =null;
		}
		//		日期
		$data['starttime'] = date('Y-m-d');
//		判断是否选择了上传文件
		if ($_FILES['file']['name'] != '') {
			//		开始上传
			$upload = new \Think\Upload();
			//		文件大小限制10M
			$upload -> maxSize = 10485760;
			//		发布比赛信息，不做格式限制
			//		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
			//		上传路径为Upload文件夹下的Match下的InfoDoc文件夹下
			$upload -> savePath = 'Match/InfoDoc/';
			//		不自动创建子目录
			$upload -> autoSub = false;
			//		文件重命名，防止重名，命名方式为时间戳+四位随机数
			$upload -> saveName = time() . rand(1000, 9999);
			//		执行上传方法
			$info = $upload -> upload();
			//		判断，如果上传成功，执行写入数据库
			if ($info) {
				//			组合路径
				$data['document'] = '/Uploads/' . $info['file']['savepath'] . $info['file']['savename'];
			} else {
				$this -> error($upload -> getError());
			}
		}
		//		执行更新信息
		$fix = M('Match') -> where(array('id' => $id)) -> save($data);
		if ($fix) {
			//				添加比赛成功
			unlink('.' . $get['document']);
			
			M("Typelink")->where(array("match_id"=>$id))->delete();
			foreach ($_POST['type'] as $key=>$type){
				M("Typelink")->add(array("match_id"=>$id,"type_id"=>$type));
			}
			
			$this -> success('更新比赛信息成功~');
		}
		else {
			//				添加比赛失败
			M("Typelink")->where(array("match_id"=>$id))->delete();
			foreach ($_POST['type'] as $key=>$type){
				M("Typelink")->add(array("match_id"=>$id,"type_id"=>$type));
			}
			$this -> error('您可能没有修改信息，请刷新');
		}
	}

	//	删除比赛的方法
	public function runDel() {
		$id = $_POST['id'];
		$info = M('Match') -> where(array('id' => $id)) -> find();
		unlink('.' . $info['document']);
		$del = M('Match') -> where(array('id' => $id)) -> delete();
		M("Typelink")->where(array("match_id"=>$id))->delete();
	}

	//	切换比赛的状态,如果为0或2,切换为1,如果为1,切换为2
	public function toggleStatus() {
		$id = $_POST['id'];
		$info = M('Match') -> where(array('id' => $id)) -> find();
		if ($info['status'] == 0 || $info['status'] == 2) {
			M('Match') -> where(array('id' => $id)) -> save(array('status' => 1));
		} elseif ($info['status'] == 1) {
			M('Match') -> where(array('id' => $id)) -> save(array('status' => 2));
		}
	}

}
