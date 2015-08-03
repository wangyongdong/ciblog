<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 个人信息类
 * @author WangYongdong
 */
class Setting extends MY_Controller {
	var $tokentype = 'setting';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 个人资料页
	 */
	public function personal() {
		$data['list'] = $this->setting_model->getPersonal();
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('setting/personal',$data);
	}
	
	/**
	 * 修改个人信息
	 */
	public function doPersonal() {
		$data = array();
		$data['id'] = sg($_POST['id']);
		$data['username'] = sg($_POST['username']);
		$data['email'] = sg($_POST['email']);
		$data['qq'] = sg($_POST['qq']);
		$data['address'] = sg($_POST['address']);
		$data['job'] = sg($_POST['job']);
		$data['updatetime'] = date("Y-m-d H:i:s");
		$oldpass = sg($_POST['oldpass']);
		$newpass = sg($_POST['newpass']);
		$repass = sg($_POST['repass']);
		
		$password = getUser($data['id'],'password');
		$uniquely = getUser($data['id'],'uniquely');
		
		//输入数据验证
		$arr = array($data['username'],$data['id']);
		checkEmpty($arr,'','setting/personal/','setting/personal/');
		
		if($newpass !== $repass) {
			checkEmpty('','','setting/personal/','setting/personal/','两次密码不一致');
		}
		
		if(!empty($newpass) && !empty($oldpass) && !empty($repass)) {
			$this->load->library('encrypt');
			$data['password'] = $this->encrypt->encryptcode($newpass,$uniquely); //新密码加密
			$old_pass = $this->encrypt->encryptcode($oldpass,$uniquely);	 //旧密码加密
			
			if($password !== $old_pass) {
				headers(site_url('setting/personal/'),'error_e','旧密码输入不正确');
			}
		} else {
			$data['password'] = $password;
		}
		
		checkToken($_POST['token'],$this->tokentype);
		
		//执行文件上传
		if(!empty($_FILES['picname']['tmp_name'])) {
			$targetPath = UPLOAD_PATH . 'user/';	//上传目录
			$info = uploadFile($_FILES['picname'],$targetPath);
			if($info["status"]===false){
				die("图片信息上传失败！原因：".$info["info"]);
			} else {
				$data['picname'] = $info['info']; //获取图片名
			}
		} else {
			$data['picname'] = $_POST['oldpic'];
		}
		
		$affect = $this->setting_model->doPersonal($data);
		if($affect) {
			headers(site_url('setting/personal'),'active_s','操作成功');
		}
	}
	
	/**
	 * 关于我页
	 */
	public function about() {
		$data['list'] = $this->setting_model->getAboutMe();
		$data['uedit'] = getUeditForBig($data['list']);
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('setting/about_me',$data);	
	}
	
	/**
	 * 修改关于我的信息
	 */
	public function updAbout() {
		checkToken($_POST['token'],$this->tokentype);
		
		$sContent = sg($_POST['content']);
		$affect = $this->setting_model->updAbout($sContent);
		if($affect) {
			headers(site_url('setting/about'),'active_s','操作成功');
		}
	}
	
	
}