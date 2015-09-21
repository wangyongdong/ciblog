<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 自定义基础类
 * @author WangYongDong
 */
class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->checkLogin();
		$this->CheckAccess();
		$this->loadModel();
	}
	//登陆验证
	private function checkLogin(){
		session_start();
		$this->load->library('auth');
		$this->auth->userLoginCheck();
		if(empty($_SESSION['uid']) && empty($_SESSION['username'])) {
			header("location:".site_url('login'));
		}
	}
	//权限验证
	private function CheckAccess() {
		$sAname = $this->uri->segment(1);
		$sFname = $this->uri->segment(2);
		$this->load->library('access');
		$this->access->checkAccess($sAname,$sFname);
	}
	//实例化model
	private function loadModel() {
		//$this->load->model('record_model');
		//$this->load->model('article_model');
		//$this->load->model('sort_model');
		//$this->load->model('comment_model');
		//$this->load->model('contact_model');
		//$this->load->model('links_model');
		//$this->load->model('member_model');
		$this->load->model('site_model');
		$this->load->model('public_model');
	}
}