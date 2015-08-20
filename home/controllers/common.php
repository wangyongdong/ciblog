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
}