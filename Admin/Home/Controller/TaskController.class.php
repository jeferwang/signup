<?php
namespace Home\Controller;
use Think\Controller;
/*
 * 后台管理的任务分配控制器
 */
class TaskController extends Controller {
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
//	显示所有通过学校审核的作品，分页，每页20个
    public function taskList(){
    	$match_info=M('Match')->where(array('id'=>$_GET['mid']))->find();
		$this->assign('match_info',$match_info);
		$tea_list=M('Teacher')->where(array('level'=>3,'matchid'=>$match_info['id']))->order('id asc')->select();
		$this->assign('tea_list',$tea_list);
    	$zp_list=M('Reginfo')->where(array('status'=>array('in',array(2,3)),'matchid'=>$_GET['mid']))->order('collegeid asc,type asc,date asc')->page($_GET['p'],20)->select();
		foreach($zp_list as $k=>$v){
//			从学院表查询学院信息压入数组
			$col_info=M('College')->where(array('id'=>$v['collegeid']))->find();
			$zp_list[$k]['college']=$col_info['college'];
//			根据作品id从任务表查询老师id，再从老师表查询老师姓名，压入数组
			$task_info=M('Task')->where(array('projectid'=>$v['id']))->select();
			foreach ($task_info as $pw) {
				$tea_info=M('Teacher')->where(array('id'=>$pw['pwid']))->find();
				$tea_info['score']=$pw['score'];
				$zp_list[$k]['pw'][]=$tea_info;
			}
		}
		$this->assign('zp_list',$zp_list);
		$count=M('Reginfo')->where(array('status'=>2))->count();
		$page=new \Think\Page($count,20);
		$show_page=$page->show();
		$this->assign('showpage',$show_page);
		$this->display();
    }
//	执行收集复选框，添加分配任务信息的方法
	public function runAddTask(){
//		评委的id
		$pwid=$_POST['teacher'];
//		勾选的作品id数组
		$task=$_POST['task'];
		foreach($task as $v){
			$check=M('Task')->where(array('projectid'=>$v,'pwid'=>$pwid))->find();
			if(!$check){
				$data['pwid']=$pwid;
				$data['projectid']=$v;
				M('Task')->add($data);
			}
		}
		$this->success('分配成功， 请刷新查看任务分配情况，或继续分配任务','',5);
	}
}