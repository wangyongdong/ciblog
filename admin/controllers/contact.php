<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义评论，留言相关类
 * @author WangYongdong
 */
class Contact extends MY_Controller {
	var $tokentype = 'contact';
	public function __construct() {
		parent::__construct();
		$this->load->model('contact_model');
	}
	/**
	 * 获取留言列表
	 */
	public function index() {
		$data['aFilter']['keyword'] = sg($this->input->get('s'));
		//分页执行
		$pageId = $this->input->get('page');
		$sFilter = ' AND author LIKE"%'.$data['aFilter']['keyword'].'%"';
		$arr = $this->public_model->getPage("contact",'contact?',$pageId,$sFilter);
		$data['list'] = $this->contact_model->getContact('contact',$arr['start'],$arr['pagenum'],$data['aFilter']);
		$data['token'] = getToken($this->tokentype);
		$data['nav'] = 'comcon';
		$this->contact_model->doRead();//标记已读
		
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
		$data['token'] = getToken($this->tokentype);
		$data['nav'] = 'comcon';
		
		$this->load->view('public/header',$data);
		$this->load->view('contact/contact_edit',$data);
		$this->load->view('public/footer',$data);
	}
	/**
	 * 修改留言
	 */
	public function doContact() {
		$data = array();
		$data['id'] = sg($_POST['id']);
		$data['author'] = sg($_POST['author']);
		$data['email'] = sg($_POST['email']);
		$data['url'] = sg($_POST['url']);
		$data['content'] = sg($_POST['content']);
		$data['status'] = sg($_POST['status']);
		
		$arr = array($data['content']);//数据验证
		checkEmpty($arr);
		checkToken($_POST['token'],$this->tokentype);//token验证
		
		$this->contact_model->doContact($data);
		succes(site_url('contact'));
	}
	/**
	 * 添加回复
	 */
	public function doReply() {
		$data = array();
		if(!empty($_POST['id'])) {
			$data['id'] = sg($_POST['id']);
		}
		$data['reply_id'] = sg($_POST['reply_id']);
		$data['userid'] = UserId();
		$data['author'] = UserName();
		$data['content'] = sg($_POST['reply_content']);
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		$arr = array($data['author'],$data['content']);
		checkEmpty($arr);
	
		$this->contact_model->doReply($data);
		succes(site_url('contact'));
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