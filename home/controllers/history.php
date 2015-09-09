<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * 博客时间轴
	 */
	public function index() {
		$data['list'] = $this->history_model->getEvent();
		$this->load->view('history',$data);
	}
	
	
}