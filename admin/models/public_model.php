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
    
}