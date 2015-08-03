<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller {
	var $tokentype = 'links';
	
	public function __construct() {
		parent::__construct();
	}
	/**
	 * 公共跳转页面
	 */
	public function index() {
		$data = array();
		$message = $this->input->get('mess');
		$data['message'] = urldecode($message);
		$url = $this->input->get('url');
		if(!empty($url)) {
			$data['reurl'] = urldecode($url);
		} else {
			$data['reurl'] = $_SERVER['HTTP_REFERER'];
		}
		
		//设置seo
		$seo_info = $this->config->item('index_seo');
		$aMeta['title'] = $seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'common';
		$this->public_model->loadView($aMeta,$sHeader,'public/common',$data);
	}
	/**
	 * 友情链接页
	 */
	public function links() {
		//token
		$data['token'] = getToken($this->tokentype);
		
		//首页右侧个人信息
		$data['blogger'] = $this->public_model->getBloggerInfo();
		
		$sTitle = '王永东的个人博客';
		$sHeader = 'links';
		$this->public_model->loadView($sTitle,$sHeader,'links',$data);
	}
	/**
	 * 友情链接申请
	 */
	public function doLinks() {
		$data = array();
		$data['email'] = sg($this->input->post('email', TRUE));
		$data['sitename'] = sg($this->input->post('name', TRUE));
		$data['siteurl'] = prep_url(sg($this->input->post('url', TRUE)));
		$data['description'] = sg($this->input->post('desc', TRUE));
		$data['status'] = 'hide';
		$data['datetime'] = date("Y-m-d H:i:s",time());
		if (empty($data['email']) || empty($data['sitename']) || empty($data['siteurl']) || empty($data['description'])) {
			localCommon('数据信息不完整。');
		}
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		$iInsert = $this->public_model->doLinks($data);
		if(!empty($iInsert)) {
			//添加提醒
			$aNotice = array();
			$aNotice['type'] = 'links';
			$aNotice['id'] = $iInsert;
			$this->public_model->addNotice($aNotice);
			//跳转
			localCommon('申请已提交，审核通过后会已邮件的形式通知您');
		}
	}
}