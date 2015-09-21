<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 留言相关类
 * @author WangYongdong
 */
class Contact extends MY_Controller {
	var $tokentype = 'contact';
	public function __construct() {
		parent::__construct();
		$this->load->model('contact_model');
	}
	/**
	 * 留言页
	 */
	public function index() {
		$data['blogger'] = $this->public_model->getBloggerInfo();//首页右侧个人信息
		$data['token'] = getToken($this->tokentype);//token
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '给我留言'.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'contact';
		$this->public_model->loadView($aMeta,$sHeader,'contact',$data);
	}
	/**
	 * 添加留言信息
	 */
	public function doContact() {
		$data['author'] = sg($this->input->post('name', TRUE));
		$data['email'] = sg($this->input->post('email', TRUE));
		$data['url'] = prep_url(sg($this->input->post('url', TRUE)));
		$data['content'] = sg($this->input->post('content', TRUE));
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		if (empty($data['author']) || empty($data['email']) || empty($data['content'])) {
			localCommon('数据信息不完整。');
		} else if (mb_strlen($data['author']) < 2 || mb_strlen($data['author']) > 16) {
			localCommon('用户名在2-16个字符。');
		} else if (!is_email($data['email'])) {
			localCommon('邮箱格式不正确。');
		} else if (mb_strlen($data['content']) < 2 || mb_strlen($data['content']) > 500) {
			localCommon('评论内容在2-500个字符。');
		}
		checkToken($_POST['token'],$this->tokentype);//token验证
		
		$this->load->model('contact_model');
		$iInsert = $this->contact_model->doContact($data);
		if(!empty($iInsert)) {
			$aNotice = array();
			$aNotice['type'] = 'contact';
			$aNotice['author'] = $data['author'];
			$this->public_model->addNotice($aNotice);
			//跳转
			localCommon('留言成功，请等待回复，回复内容会已邮件的形式通知您');
		}
	}
}