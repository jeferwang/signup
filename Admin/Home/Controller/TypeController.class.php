<?php
namespace Home\Controller;

use Think\Controller;

class TypeController extends Controller {
	
	public function index() {
		$types=M("Type")->select();
		$this->assign("types",$types);
		$this->display();
	}
	
	public function add() {
		$type=trim($_POST['type']);
		if (!$type) {
			$this->error("作品类型不能为空",U("Type/index"),3);
		}
		if(!(M("type")->where(array("type"=>$type))->find())){
			$add=M("Type")->add(array("type"=>$type));
			if ($add) {
				$this->success("添加成功",U("Type/index"),3);
			}else{
				$this->error("添加失败，请刷新重试",U("Type/index"),3);
			}
		}else{
			$this->error("这个类型已存在",U("Type/index"),3);
		}
		
	}
	
	public function del() {
		$type_id=(int)$_GET['typeid'];
		$del=M("Type")->where(array("id"=>$type_id))->delete();
		if($del){
			$this->success("删除成功",U("Type/index"),3);
		}else{
			$this->error("删除失败，请刷新重试",U("Type/index"),3);
		}
	}
}