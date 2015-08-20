<?php
/*
 * 分类相关信息模型
 */
class Sort_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 获取文章分类
	 */
	public function getSort() {
		$sql = 'SELECT
					*
				FROM
					blog_sort
				ORDER BY
					id ASC';
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	
}