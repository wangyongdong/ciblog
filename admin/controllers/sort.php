<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义文章类别相关类
 * @author WangYongdong
 */
class Sort extends MY_Controller {
	var $tokentype = 'sort';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 文章类别页
	 */
	public function index() {
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("sort",'sort/index?',$pageId);
		//执行查询
		$data['list'] = $this->sort_model->getSortList($arr['start'],$arr['pagenum']);
		$data['token'] = getToken($this->tokentype);
		$this->load->view('public/header',$data);
		$this->load->view('sort/sort_list',$data);
		$this->load->view('public/footer',$data);
		
	}
	
	/**
	 * 修改类别页
	 */
	public function update() {
		$iSort = $this->uri->segment(3);
		$data['list'] = $this->sort_model->getSortInfo($iSort);
		$data['token'] = getToken($this->tokentype);
		$this->load->view('public/header',$data);
		$this->load->view('sort/sort_edit',$data);
		$this->load->view('public/footer',$data);
		
	}
	
	/**
	 * 新增类别信息
	 */
	public function doSort() {
		if(empty($_POST['id'])) {				//添加
			$data['uid'] = $_SESSION['uid'];
			$data['datetime'] = date("Y-m-d H:i:s",time());
		} else {
			$data['id'] = sg($_POST['id'],0);	//修改
		}
		
		$data['name'] = sg($_POST['name']);
		$data['alias'] = sg($_POST['alias']);
		$data['description'] = sg($_POST['description']);
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		//输入数据验证
		//checkEmpty(array($data['name'],$data['alias']),$data['id'],'sort/slist','sort/update/');
		
		$affect = $this->sort_model->doSort($data);
		if($affect) {
			//headers(site_url('sort/slist'),'active_s','操作成功');
		}
	}
	
	/**
	 * 删除类别
	 */
	public function doDel() {
		$iSort = sg($_POST['id']);
		$affect = $this->sort_model->doDel($iSort);
		echo $affect;
	}
	
}