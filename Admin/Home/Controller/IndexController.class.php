<?php
namespace Home\Controller;
use Think\Controller;
/*
 * 后台首页控制器
 */
class IndexController extends Controller {
//	登录有效性检查
	public function _initialize(){
		$ip=M('Admin')->where(array('id'=>cookie('adminId'),'username'=>cookie('adminName')))->find();
		if($ip['loginip']!=$_SERVER['REMOTE_ADDR']){
			redirect(U('Login/index'));
		}
	}
//	后台管理的首页,显示一些信息
    public function index(){
    	$this->display();
    }
}