<?php
/**
 * 友情链接模型类
 * @author WangYongDong
 */
class Links_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 获取首页友情链接
	 */
	public function getLinks() {
		$sql = 'SELECT 
					sitename,siteurl,description 
				FROM 
					blog_links 
				WHERE 
					status="show" 
				ORDER BY 
					id ASC 
				LIMIT 5';
		$res = $this->db->query($sql);
		$list = $res->result_array();
		return $list;
	}
	
	/**
	 * 友情链接申请
	 */
	public function doLinks($data) {
		$this->db->insert('links',$data);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
}