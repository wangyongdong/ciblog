<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义评论，留言相关类
 * @author WangYongdong
 */
class Contact extends MY_Controller {
	var $tokentype = 'contact';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 获取留言列表
	 */
	public function index() {
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("contact",'contact/index?',$pageId);
		//留言信息
		$data['list'] = $this->contact_model->getContact('contact',$arr['start'],$arr['pagenum']);
		//token
		$data['token'] = getToken($this->tokentype);
		
		//标记已读
		$this->contact_model->doRead();

		$this->load->view('public/header',$data);
		$this->load->view('contact/contact_list',$data);
		$this->load->view('public/footer',$data);
	}
	/**
	 * 获取修改页
	 */
	public function update() {
		$iContact = $this->uri->segment(3);
		$data['list'] = $this->contact_model->getContactInfo($iContact);
		
		$data['reply'] = $this->contact_model->getContactReply($iContact);
		//token
		$data['token'] = getToken($this->tokentype);
		$this->load->view('public/header',$data);
		$this->load->view('contact/contact_edit',$data);
		$this->load->view('public/footer',$data);
	}
	/**
	 * 修改留言
	 */
	public function doContact() {
		$data = array();
		$data['id'] = sg($_POST['id']);				//id
		$data['author'] = sg($_POST['author']);		//留言者
		$data['email'] = sg($_POST['email']);		//email
		$data['url'] = sg($_POST['url']);			//url
		$data['content'] = sg($_POST['content']);	//内容
		$data['status'] = sg($_POST['status']);		//状态
		//数据验证
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		$affect = $this->contact_model->doContact($data);
		if($affect) {
			//headers(site_url($successHref),'active_s','文章操作成功');
		}
	}
	/**
	 * 添加回复
	 */
	public function doReply() {
		$data = array();
		if(!empty($_POST['id'])) {
			$data['id'] = sg($_POST['id']);
		}
		$data['reply_id'] = sg($_POST['reply_id']);				//回复id
		$data['userid'] = 1;									//userid
		//$data['author'] = getUser($_SESSION['uid'],'username');	//用户名
		$data['author'] = '王永东';	//用户名
		$data['content'] = sg($_POST['content']);				//内容
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		//数据验证
		//token验证
		checkToken($_POST['token'],$this->tokentype);
	
		$affect = $this->contact_model->doReply($data);
		if($affect) {
			//headers(site_url($successHref),'active_s','文章操作成功');
		}
	
	}
	/**
	 * 删除操作
	 */
	public function doDel() {
		$iContact = sg($_POST['id']);
		$affect = $this->contact_model->doDel($iContact);
		echo $affect;
	}
	
}