<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义说说相关类
 * @author WangYongdong
 */
class Record extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * 说说
	 */
	public function index() {
		$data['user'] = getUser(UserId());//获取用户信息
		//分页执行
		$pageId = $this->input->get('page');
		$sFilter = ' AND reply_id=0 ';
		$arr = $this->public_model->getPage("record",'record?',$pageId,$sFilter);
		$data['list'] = $this->record_model->getRecordList($arr['start'],$arr['pagenum']);
		$data['nav'] = 'record';
		
		$this->load->view('public/header',$data);
		$this->load->view('record/index',$data);
		$this->load->view('public/footer',$data);		
	}
	/**
	 * 执行发布
	 */
	public function doRecord() {
		$data = array();
		$data['uid'] = UserId();
		$data['content'] = sg($_POST['content']);
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		$arr = array($data['uid'],$data['content']);//数据验证
		checkEmpty($arr);
		$affect = $this->record_model->doRecord($data);
		if($affect) {
			succes(site_url('record'));
		}
	}
	/**
	 * 删除说说
	 */
	public function doDel($iRecord) {
		$iRecord = sg($_POST['id']);
		$affect = $this->record_model->doDel($iRecord);
		echo $affect;
	}
	
}