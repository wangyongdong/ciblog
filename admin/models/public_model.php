<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_model extends CI_Model  {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。
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
     * 获取未读消息
     */
    public function countNotices() {
    	$sql = 'SELECT
					count(*) as nums
				FROM
					blog_notice
    			WHERE
    				status = "unread"
				ORDER BY
					datetime DESC';
    	$res = $this->db->query($sql);
    	$list = $res->row_array();
    	return $list['nums'];
    }
    
    /**
     * 获取消息列表
     */
	function getNotice($iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_notice
    			ORDER BY
    				datetime DESC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aList = $res->result_array();
    	return $aList;
    }
    
    /**
     * 执行删除消息
     */
    function delNotice($iNotice) {
    	return $this->db->delete('notice',array('id'=>$iNotice));
    }
    /**
     * 修改消息状态
     */
    function updNotice($iNotice) {
    	$data = array();
    	$data['status'] = 'read';
    	$this->db->update('notice',$data,array('id'=>$iNotice));
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
}