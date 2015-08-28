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
				WHERE
					nums>0
					AND id != "2"
				ORDER BY
					id ASC';
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	/**
	 * 根据类别获取文章
	 */
	function getArticleBySort($iType,$iStart='',$iPageNum='') {
		$sLimit = '';
		if(!empty($iPageNum)) {
			$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
		}
	
		$sql = 'SELECT
					*
				FROM
					blog_article
				WHERE
					sortid='.$iType.'
				ORDER BY
					datetime DESC '.$sLimit;
		$res = $this->db->query($sql);
		$list = $res->result_array();
		return $list;
	}
}