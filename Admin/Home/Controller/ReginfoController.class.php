<?php
namespace Home\Controller;

use Think\Controller;

class ReginfoController extends Controller {

//	登录有效性检查
	public function _initialize() {
		$ip = M('Admin')->where(array('id' => cookie('adminId'), 'username' => cookie('adminName')))->find();
		if ($ip['loginip'] != $_SERVER['REMOTE_ADDR']) {
			$this->error('您的登录已失效,请重新登录!', U('Login/index'), 3);
		}
	}

//	首先是当前的比赛列表
	public function index() {
		$match = M('Match');
		$match_list = $match->page($_GET['p'], 10)->select();
		$match_list = D('Common')->listMatchStatus($match_list);
		$this->assign('list', $match_list);
		$count = $match->count();
		$page = new \Think\Page($count, 10);
		$showPage = $page->show();
		$this->assign('showPage', $showPage);
		$this->display('index');
	}
	
	public function reginfo() {
		if (IS_POST) {
			if ($_POST['collegeid']) $map['collegeid'] = $_POST['collegeid'];
			if ($_POST['status'] !== '') $map['status'] = $_POST['status'];
			if ($_POST['score_min'] != '' && $_POST['score_max'] == '') {
				$map['score'] = array('gt', $_POST['score_min']);
			} elseif ($_POST['score_min'] == '' && $_POST['score_max'] != '') {
				$map['score'] = array('lt', $_POST['score_max']);
			} elseif ($_POST['score_min'] != '' && $_POST['score_max'] != '') {
				$map['score'] = array('between', array($_POST['score_min'], $_POST['score_max']));
			}
			cookie('seCondition', json_encode($map));
		} else {
			$map = null;
			cookie('seCondition', null);
		}
		if (isset($_POST['sort'])) {
			if ($_POST['sort'] == 'college') {
				$sort = 'collegeid asc,type asc,date asc';
			} elseif ($_POST['sort'] == 'type') {
				$sort = 'type asc,collegeid asc,date asc';
			}
		} else {
			$sort = 'collegeid asc,type asc,date asc';
		}
		$mid = $_GET['m'];
		if (!$mid) $this->error('请先选择一个比赛！', U('Reginfo/index'), 2);
		$map['matchid'] = $mid;
		$match = M('Match')->where(array('id' => $mid))->find();
		$this->assign('match', $match);
		$reg = M('Reginfo');
		$list = $reg->where($map)->order($sort)->select();
		$list = D('Common')->listStatus($list);
		$list = D('Common')->listScore($list);
		$list = D('Common')->getListCollege($list);
		if (isset($_POST['sort'])) {
			if ($_POST['sort'] == 'avg') {
				$arr_tmp = array();
				foreach ($list as $k => $v) {
					$arr_tmp[$k] = $v['avg'];
				}
				arsort($arr_tmp);
				$arr_res = [];
				foreach ($arr_tmp as $k => $v) {
					$arr_res[$k] = $list[$k];
				}
				$list = $arr_res;
			}
		}
		$this->assign('list', $list);
		$college = M('College')->select();
		$this->assign('college', $college);
		$this->display('reginfo');
	}
	
	public function getAllInfo() {
		$id = $_POST['id'];
		D('Common')->getOnesAllInfo($id);
	}
	
	public function export() {
		import("Org.Util.PHPExcel");
		$data = M('Reginfo')->where(json_decode(cookie('seCondition')))->select();
		$data = D('Common')->getListInfo($data);
		$data = D('Common')->listScore($data);
		$data = D('Common')->listStatusPur($data);
		//分数字符串
		foreach ($data as $key => $val) {
			foreach ($val['pw'] as $k => $v) {
				if (trim($v['score']) == '') {
					$data[$key]['score'] .= $v['code'] . '：未评分；';
				} else {
					$data[$key]['score'] .= $v['code'] . '：' . $v['score'] . '；';
				}
			}
			$data[$key]['guide'] = '';
			foreach (json_decode($val['guide'], true) as $g) {
				$data[$key]['guide'] .= $g . '    ';
			}
		}
		$objPHPExcel = new \PHPExcel();
		$objSheet = $objPHPExcel->getActiveSheet();
		$objSheet->setTitle('报名信息表');
		$objSheet->setCellValue('A1', '比赛标题')
			->setCellValue('B1', '学院信息')
			->setCellValue('C1', '学生编号')
			->setCellValue('D1', '队伍名称')
			->setCellValue('E1', '成员信息')
			->setCellValue('F1', '作品标题')
			->setCellValue('G1', '作品简介')
			->setCellValue('H1', '作品状态')
			->setCellValue('I1', '报名时间')
			->setCellValue('J1', '所有评委评分')
			->setCellValue('K1', '平均分')
			->setCellValue('L1', '指导老师');
		foreach ($data as $key => $val) {
			$teaminfo = '';
			foreach (json_decode($val['teaminfo'], true) as $k => $v) {
				$stu = explode('-', $v);
				$teaminfo .= $stu[0] . '-' . $stu[1] . '//';
			}
			$objSheet->setCellValue('A' . ($key + 2), $val['match'])
				->setCellValue('B' . ($key + 2), $val['college'])
				->setCellValue('C' . ($key + 2), $val['code'])
				->setCellValue('D' . ($key + 2), $val['team'])
				->setCellValue('E' . ($key + 2), $teaminfo)
				->setCellValue('F' . ($key + 2), $val['title'])
				->setCellValue('G' . ($key + 2), $val['info'])
				->setCellValue('H' . ($key + 2), $val['zhuangtai'])
				->setCellValue('I' . ($key + 2), date('Y-m-d H:i:s', $val['date']))
				->setCellValue('J' . ($key + 2), $val['score'])
				->setCellValue('K' . ($key + 2), $val['avg'])
				->setCellValue('L' . ($key + 2), $val['guide']);
		}
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="01simple.xls"');
		header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
}
