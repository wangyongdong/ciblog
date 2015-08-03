<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台首页相关
 * @author WangYongdong
 */
class Show extends MY_Controller {
	
	/**
	 * 加载后台
	 */
	/* public function index() {
		$this->load->library('access');
		$data['data'] = $this->access->getAccessMenu();
		//获取未读消息数量
		$data['notices'] = $this->public_model->countNotices();
		
		$this->load->view('show',$data);
	} */
	
	/**
	 * 加载首页
	 */
	/* public function main() {
		$this->load->view('main');			
	} */
	
	
	/**
	 * 加载后台
	 */
	public function index() {
		//$this->load->library('access');
		//$data['data'] = $this->access->getAccessMenu();
		//获取未读消息数量
		//$data['notices'] = $this->public_model->countNotices();
		$data = 1;
		$this->load->view('public/header',$data);
		$this->load->view('show',$data);
		$this->load->view('public/footer',$data);
	}
}