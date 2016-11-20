<?php
namespace Home\Controller;
use Think\Controller;
/*
 * 关于评分的控制器
 * 评分的队伍列表index
 * 某个队伍的详情页teamInfo
 * 执行评分的方法runEvaluate 
 */
class EvaluateController extends Controller {
//	登录有效性检查
	public function _initialize(){
		if(!cookie('tId') || !cookie('tCode')){
			$this->error('您的登录已失效,请重新登录!',U('Index/index'),3);
		}
	}

//	点击队伍之后进入的评分页面
	public function teamInfo(){
		$info=M('Reginfo')->where(array('id'=>$_GET['id']))->find();
		$info=D('Common')->oneStatusPW($info);
		$info=D('Common')->oneScore($info);
		$info=D('Common')->downLink($info);
		$this->assign('info',$info);
		$this->display();
	}
//	执行评分,把分数写入数据库
	public function runEvaluate(){
		if(trim($_POST['score'])=='' || trim($_POST['suggest'])==''){
			$this->error('您没有填写完整!');
		}
		if((double)trim($_POST['score'])>100){
			$this->error('分数不能超过100');
		}
		$tea_info=M('Teacher')->where(array('id'=>cookie('tId'),'code'=>cookie('tCode')))->find();
		$reg_info=M('Reginfo')->where(array('id'=>$_POST['id']))->find();
//		再次验证评委老师的身份
		if($tea_info['level']==3){
			if($reg_info['status']==2 || $reg_info['status']==3){//首次评分
				M('Reginfo')->where(array('id'=>$_POST['id']))->save(array('status'=>3));
				M('Task')->where(array('projectid'=>$_POST['id'],'pwid'=>cookie('tId')))->save(array('score'=>$_POST['score'],'suggest'=>$_POST['suggest']));
				$this->success('评分成功！',U('Teacher/index'),2);
			}else{//如果是不符合规矩的作品
				$this->error('您没有权限操作此作品！');
			}
		}else{
			$this->error('只有评委老师才能执行此操作！');
		}
	}
}