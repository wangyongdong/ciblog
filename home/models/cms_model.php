<?php
/**
 * 获取cms文章相关信息模型
 * @author WangYongdong
 */
class Cms_model extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 获取cms文章列表
	 */
	function getCmsList($sOrder='datetime',$iStart=0,$iPageNum=10) {
		$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
		$sql = 'SELECT
    				*
    			FROM
    				blog_article
				WHERE
					status="show" 
					AND sortid = "2" 
    			ORDER BY 
    			'.$sOrder.' DESC
    			'.$sLimit;
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	
}