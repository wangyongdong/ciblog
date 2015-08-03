<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义作品相关类
 * @author WangYongdong
 */
class Works extends MY_Controller {
	var $tokentype = 'works';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 获取作品列表
	 */
	public function wlist() {
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("works",'works/wlist?',$pageId);
		//执行查询
		$data['list'] = $this->works_model->getWorksList($arr['start'],$arr['pagenum']);
		
		$this->load->view('works/works_list',$data);
	}
	/**
	 * 获取添加页面
	 */
	public function wnew() {
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('works/works_new',$data);
	}
	
	/**
	 * 获取修改页面
	 */
	public function update() {
		$iWorks = $this->uri->segment(3);
		$data['list'] = $this->works_model->getWorksInfo($iWorks);
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('works/works_edit',$data);
	}
	
	/**
	 * 执行添加，修改
	 */
	public function doWorks() {
		$data = array();
		if(empty($_POST['id'])) {
			$data['uid'] = $_SESSION['uid'];
			$data['datetime'] = date("Y-m-d H:i:s",time());
		} else {
			$data['id'] = sg($_POST['id'],0);
		}
		$data['title'] = sg($_POST['title']);
		$data['description'] = sg($_POST['description']);
		$data['respon'] = sg($_POST['respon']);
		$data['summary'] = sg($_POST['summary']);
		$data['img'] = '';
		$data['link'] = prep_url(sg($_POST['link']));
		$data['status'] = sg($_POST['status']);
		$data['date_start'] = sg($_POST['date_start']);
		$data['date_end'] = sg($_POST['date_end']);
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		//输入数据验证
		$arr = array($data['title'],$data['description'],$data['respon'],$data['summary'],$data['date_start'],$data['date_start']);
		checkEmpty($arr,$data['id'],'works/wnew','works/update/');
		
		$affect = $this->works_model->doWorks($data);
		if($affect) {
			headers(site_url('works/wlist'),'active_s','作品信息更新成功');
		}
		
	}
	
	/**
	 * 执行删除
	 */
	public function doDel($iWorks) {
		$iWorks = sg($_POST['id']);
		$affect = $this->works_model->delWorks($iWorks);
		echo $affect;
	}
}
