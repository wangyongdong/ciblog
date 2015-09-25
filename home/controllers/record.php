<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 说说相关类
 * @author WangYongdong
 */
class Record extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('record_model');
	}
	/**
	 * 说说列表
	 */
	public function index() {
		//分页执行
		$pageId = $this->input->get('page');
		$sPageNum = getSet('record_nums');
		$arr = $this->public_model->getPage('record','record?',$pageId,$sPageNum);
		$data['record'] = $this->record_model->getRecordList($arr['start'],$arr['pagenum']);
		
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '碎言碎语'.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'record';
		$this->public_model->loadView($aMeta,$sHeader,'record',$data);
	}
	
}