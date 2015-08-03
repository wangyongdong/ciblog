<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义用户相关类
 * @author WangYongdong
 */
class Member extends MY_Controller {
	var $tokentype = 'member';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 获取用户列表
	 */
	public function index() {
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("member",'member/index?',$pageId);
		//执行查询
		$data['list'] = $this->member_model->getMemberList($arr['start'],$arr['pagenum']);
		
		$this->load->view('public/header',$data);
		$this->load->view('member/member_list',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 获取修改页
	 */
	public function update() {
		$iUser = $this->uri->segment(3);
		$data['list'] = getUser($iUser);
		//token
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('public/header',$data);
		$this->load->view('member/member_edit',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 获取添加页
	 */
	public function create() {
		//token
		$data['token'] = getToken($this->tokentype);
	
		$this->load->view('public/header',$data);
		$this->load->view('member/member_create',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 执行会员信息修改和添加
	 */
	public function doUser() {
		$data['username'] = sg($_POST['name']);
		$data['email'] = sg($_POST['email']);
		$data['role_id'] = sg($_POST['role_id'],'3');
		if(!empty($_POST['id'])) {				//修改
			$data['id'] = sg($_POST['id']);
			$data['qq'] = sg($_POST['qq']);
			$data['address'] = sg($_POST['address']);
			$data['job'] = sg($_POST['job']);
			$data['updatetime'] = date("Y-m-d H:i:s");
		} else {
			$data['datetime'] = date("Y-m-d H:i:s");
		}
		if(!empty($_POST['password']) && !empty($_POST['repassword'])) {
			$newpass = sg($_POST['password']);
			$repass = sg($_POST['repassword']);
			
			if(empty($data['id'])) {	//添加用户
				$result = checkPass($newpass,$repass);
				if($result == '1') {
					echo "数据为空";exit;
				}
				if($result == '2') {
					echo "两次密码不一致";exit;
				}
				$data['uniquely'] = rand(1,100);
				$this->load->library('encrypt');
				$data['password'] = $this->encrypt->encryptcode($newpass,$data['uniquely']);
			} else {		//修改用户
				$result = checkPass($newpass,$repass);
				if($result == '1') {
					echo "数据为空";exit;
				}
				if($result == '2') {
					echo "两次密码不一致";exit;
				}
				$UserInfo = getUser($data['id']);
				$this->load->library('encrypt');
				$data['password'] = $this->encrypt->encryptcode($UserInfo['password'],$UserInfo['uniquely']);
				/* if($data['password'] != $UserInfo['password']) {
				 echo "旧密码输入不正确";exit; //
				} */
			}
		}
		
		
		//token验证
		//checkToken($_POST['token'],$this->tokentype);
		
		$affect = $this->member_model->doUser($data);
		if($affect) {
			//headers(site_url('member/ulist'),'active_s','操作成功');
		}
	}
	
	/**
	 * 删除会员
	 */
	public function doDel() {
		$iUser = sg($_POST['id']);
		$affect = $this->member_model->doDel($iUser);
		echo $affect;
	}
	
	/**
	 * 获取个人资料页
	 */
	public function profile() {
		$iUser = $this->uri->segment(3);
		$data['list'] = getUser('1');
		//token
		$data['token'] = getToken($this->tokentype);
	
		$this->load->view('public/header',$data);
		$this->load->view('member/member_profile',$data);
		$this->load->view('public/footer',$data);
	}
	
}