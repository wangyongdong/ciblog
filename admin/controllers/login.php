<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 登录相关类
 * @author WangYongdong
 */
class login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('login_model');		//实例化model类
	}
	
	/**
	 * 获取登陆页
	 */
	public function getLogin() {
		$this->load->view('public/login');
	}
	
	/**
	 * 执行用户登录
	 */
	public function loginIn() {
		if(!empty($_POST)) {
			$name = trim(sg($_POST['name']));
			$pass = trim(sg($_POST['pass']));
			
			if(empty($name) || empty($pass)) {
				exit('不允许为空');
			}
			
			//查询用户信息
			$res = $this->login_model->checkUserLogin($name,$pass);
			
			if($res < 0) {
				echo $res;
				exit;
			}
			//添加cookie
			$this->load->library('auth');
			$this->auth->userLoginSet($res['id'],$res['username']);
		
			header("location:".base_url());
		}
		
	}
	
	/**
	 * 登出操作
	 */
	public function loginOut() {
		$this->load->library('auth');
		$this->auth->useLoginOut();
		header("location:".base_url());
	}
}