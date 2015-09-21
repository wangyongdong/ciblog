<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 自定义基础类
 * @author WangYongDong
 */
class MY_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->loadModel();
		$this->addLog();
	}
	
	/**
	 * 添加访问记录
	 */
	private function addLog() {
		$this->public_model->addLog();
	}
	
	//实例化model
	private function loadModel(){
		//$this->load->model('article_model');
		$this->load->model('public_model');
		//$this->load->model('record_model');
		//$this->load->model('contact_model');
		//$this->load->model('comment_model');
		//$this->load->model('sort_model');
		//$this->load->model('links_model');
		//$this->load->model('cms_model');
		//$this->load->model('archive_model');
		//$this->load->model('history_model');
	}
}