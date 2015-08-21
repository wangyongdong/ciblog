<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		//获取个人信息
		$list = $this->public_model->getBloggerInfo();
		$data['blogger'] = $list;
		
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '关于我'.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'about';
		$this->public_model->loadView($aMeta,$sHeader,'about',$data);
	}
}