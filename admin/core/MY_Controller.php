<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 自定义基础类
 * @author WangYongDong
 */
class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		//$this->checkLogin();
		$this->loadAccess();
		$this->loadModel();
		$this->loadView();
	}
	//登陆验证
	private function checkLogin(){
		session_start();
		$this->load->library('auth');
		$this->auth->userLoginCheck();
		if(empty($_SESSION['uid']) && empty($_SESSION['username'])) {
			header("location:".site_url('login/getLogin'));
		}
	}
	//权限验证
	private function loadAccess() {
		/* //权限验证
		$cname = $this->uri->segment(1);
		//echo $cname;
		$this->load->library('access');
		$this->access->checkAccess($cname); */
	}
	//加载页面
	private function loadView() {
		//$this->load->view('public/header.php');
		//$this->load->view('public/footer.php');
	}
	//实例化model
	private function loadModel(){
		$this->load->model('article_model');
		$this->load->model('comment_model');
		$this->load->model('sort_model');
		$this->load->model('public_model');
		$this->load->model('member_model');
		$this->load->model('comment_model');
		$this->load->model('contact_model');
		$this->load->model('site_model');
		$this->load->model('record_model');
		$this->load->model('works_model');
		$this->load->model('links_model');
		$this->load->model('login_model');
		$this->load->model('setting_model');
	}
}