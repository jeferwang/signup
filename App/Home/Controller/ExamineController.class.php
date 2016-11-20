<?php
namespace Home\Controller;
use Think\Controller;
/*
 * 关于审核的控制器
 * 审核的主页面:队伍列表index
 * 某个队伍的详细信息examineTeam
 * 审核成功与否的两个方法
 */
class ExamineController extends Controller {
//	登录有效性检查
	public function _initialize(){
		if(!cookie('tId') || !cookie('tCode')){
			$this->error('您的登录已失效,请重新登录!',U('Index/index'),3);
		}
	}

//	点击队伍信息之后的页面
	public function examineTeam(){
		$id=$_GET['id'];
		$info=M('Reginfo')->where(array('id'=>$id))->find();
		$info=D('Common')->oneStatus($info);
		$info=D('Common')->oneScore($info);
		$info=D('Common')->downLink($info);
		$this->assign('info',$info);
		$tea_info=M('Teacher')->where(array('id'=>cookie('tId'),'code'=>cookie('tCode')))->find();
		$this->assign('tea_info',$tea_info);
		$this->display();		
	}
//	执行审核通过的方法
	public function examineTrue(){
		$tea_info=M('Teacher')->where(array('id'=>cookie('tId'),'code'=>cookie('tCode')))->find();
		$reg_info=M('Reginfo')->where(array('id'=>$_GET['id']))->find();
//		分不同身份执行审核通过的操作
		if($tea_info['level']==1){//学院
			if($reg_info['status']==0 || $reg_info['status']==1 || $reg_info['status']==4){
				$pass=M('Reginfo')->where(array('id'=>$_GET['id']))->save(array('status'=>1,'reason'=>''));
				$this->success('审核通过操作成功！',U('Teacher/index'),1);
			}else{
				$this->error('此作品已经被更高级别审核或者评分，您不能执行操作！');
			}
		}elseif($tea_info['level']==2){//学校
			if($reg_info['status']==1 || $reg_info['status']==2 || $reg_info['status']==5){
				$pass=M('Reginfo')->where(array('id'=>$_GET['id']))->save(array('status'=>2,'reason'=>''));
				$this->success('审核通过操作成功！',U('Teacher/index'),1);
			}elseif($reg_info['status']==4){
				$this->error('该作品已经被学院标记‘不通过’,您不能执行此操作！');
			}elseif($reg_info['status']==0){
				$this->error('该作品尚未被学院标记通过，您暂时不能操作！');
			}
		}else{
			$this->error('您没有权限进行此操作！');
		}
	}
//	审核不通过的方法
	public function examineFalse(){
		if(trim($_POST['reason'])==''){
			$this->error('您没有填写\'不通过\'的原因');
		}
		$tea_info=M('Teacher')->where(array('id'=>cookie('tId'),'code'=>cookie('tCode')))->find();
		$reg_info=M('Reginfo')->where(array('id'=>$_POST['id']))->find();
//		下面是分不同的身份标识审核失败
		if($tea_info['level']==1){//学院
			if($reg_info['status']==0 || $reg_info['status']==1 || $reg_info['status']==4){
				$nopass=M('Reginfo')->where(array('id'=>$_POST['id']))->save(array('status'=>4,'reason'=>$_POST['reason']));
				$this->success('‘不通过’操作成功！',U('Teacher/index'),1);
			}else{
				$this->error('此作品已经被更高级别审核或者评分，您不能执行操作！');
			}
		}elseif($tea_info['level']==2){//学校
			if($reg_info['status']==1 || $reg_info['status']==2 || $reg_info['status']==5){
				$nopass=M('Reginfo')->where(array('id'=>$_POST['id']))->save(array('status'=>5,'reason'=>$_POST['reason']));
				$this->success('‘不通过’操作成功！',U('Teacher/index'),1);
			}else{
				$this->error('该作品已经被学院标记‘不通过’,您不能执行此操作！');
			}
		}else{
			$this->error('您没有权限进行此操作！');
		}
	}
}