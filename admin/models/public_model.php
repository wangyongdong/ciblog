<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_model extends CI_Model  {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * 调用分页类
     */
    public function getPage($sTable,$sUrl,$pageId,$sFilter='',$iPageNum=10) {
    	//调用page类
    	$this->load->library('page');
    	$iCount = getPageCount($sTable,$sFilter);
    	$iPageSize = $iPageNum;
    	$this->page->loadPage($iCount,$iPageSize,$sUrl);
    
    	//总页数
    	$num_pages = ceil($iCount/$iPageSize);
    	if($pageId > $num_pages) {
    		$pageId = $num_pages;
    	}
    	if($pageId < 0) {
    		$pageId = 1;
    	}
    	$arr = $this->page->getParam($iPageSize,$pageId);
    	return $arr;
    }
    
	/**
	 * 添加操作log
	 */
	public function addActionLog($sAction,$sFunction) {
		$data = array();
		$data['userid'] = UserId();
		$data['action'] = $sAction;
		$data['function'] = $sFunction;
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		$this->db->insert('action_log',$data);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
}