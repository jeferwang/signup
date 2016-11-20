<?php
namespace Home\Controller;
use Think\Controller;
/*
 * 人才库前端控制器
 * 显示人才库页面
 * 显示某个人的详细信息
 */
class TeashowController extends Controller {
    public function index(){
//    	根据url的type判断链接类型，然后输出不同的结果
	    $type=$_GET['type'];
    	$list=M('Teashow')->where(array('type'=>$type))->order('id asc')->page($_GET['p'],10)->select();
		$this->assign('list',$list);
		$count=M('Teashow')->count();
		$page=new \Think\Page($count,10);
		$show=$page->show();
		$this->assign('showpage',$show);
    	$this->display();
    }
	public function teainfo(){
		$info=M('Teashow')->where(array('id'=>$_GET['id']))->find();
		$this->assign('info',$info);
		$other=M('Teashow')->order('id asc')->limit(10)->select();
		$this->assign('other',$other);
		$this->display();
	}
}