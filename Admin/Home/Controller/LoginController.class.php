<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
//登录控制器
class LoginController extends Controller {
//	登录页面的首页
    public function index(){
    	$this->display();
    }
//	执行登录的方法
	public function login(){
		foreach($_POST as $k=>$v){
			if(trim($v)==''){
				$this->error('登录表单未填写完整!');
			}
		}
		$code=$_POST['code'];
		if(!check_verify($code)){
			$this->error('验证码错误!');
		}
		$username=$_POST['username'];
		$password=sha1($_POST['password']);
		$find=M('admin')->where(array('username'=>$username,'password'=>$password))->find();
		if(!$find){
			$this->error('用户名或密码错误!',U('Login/index'));
		}
//		写入登录信息
		$date=date("Y-m-d H:i:s");
		$ip=$_SERVER['REMOTE_ADDR'];
		$record=M('admin')->where(array('username'=>$username,'password'=>$password))->save(array('logindate'=>$date,'loginip'=>$ip));
		if(!$record){
			$this->error('登录出现错误,请刷新重试!');
		}
		cookie('adminId',$find['id']);
		cookie('adminName',$find['username']);
		$this->success('登录成功!',U('Index/index'));	
	}
//	执行登出的方法
	public function logout(){
		cookie('adminId',null);
		cookie('adminName',null);
		$this->success('退出成功!',U('Login/index'));	
	}
//	显示验证码的方法
	public function verify(){
		$config=array(
			'codeSet'=>'234567890',
			'useNoise'=>false,
			'length'=>4,
			'useCurve'=>FALSE,
		);
		$verify=new Verify($config);
		$verify->entry();
	}
}