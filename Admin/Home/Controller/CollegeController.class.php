<?php
namespace Home\Controller;
use Think\Controller;
/*
 * 学院控制器
 * 学生报名时需要选择学院
 * 前端学院账户level=2,需要关联学院id
 * 学生报名时提交的作品,包含比赛项目id和学院id
 * 
 */
class CollegeController extends Controller {
	//	登录有效性检查
	public function _initialize(){
		$ip=M('Admin')->where(array('id'=>cookie('adminId'),'username'=>cookie('adminName')))->find();
		if($ip['loginip']!=$_SERVER['REMOTE_ADDR']){
			$this->error('您的登录已失效,请重新登录!',U('Login/index'),3);
		}
	}
//	显示学院列表进行管理的视图
    public function index(){
    	$college_list=M('College')->order('id asc')->select();
		$this->assign('college_list',$college_list);
		$this->display();
    }
//	添加学院的视图
	public function add(){
		$this->display();
	}
//	执行添加学院的方法
	public function runAdd(){
		$checkCol=M('College')->where(array('college'=>trim($_POST['college'])))->find();
		$checkCode=M('College')->where(array('code'=>trim($_POST['code'])))->find();
		if($checkCol || $checkCode){
			$this->error('添加失败，学院名或代号有重复！');
		}
		if(trim($_POST['college'])!='' && trim($_POST['code'])!=''){
			$data=array();
			$data['college']=trim($_POST['college']);
			$data['code']=trim($_POST['code']);
			$add=M('College')->add($data);
			if($add){
				$this->success('添加成功!');
			}else{
				$this->error('网络故障,请刷新重试!');
			}
		}else{
			$this->error('所有表单项均不能为空！');
		}
	}
	
	public function runRealDelCollege() {
		$count=M("College")->where(array('del'=>0))->count();
		if ($count==1) {
			$this->error("至少保留一个学院！",U("College/index"));
		}
		$id=(int)$_GET['id'];
		$del=M("College")->where(array('id'=>$id))->save(array('del'=>1));
		if ($del) {
			$this->success("删除学院成功！",U("College/index"));
		}else{
			$this->error("不好意思，操作失败，请重试！",U("College/index"));
		}
	}
}