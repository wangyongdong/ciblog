<?php
/*
 * 留言相关模型
 */
class Contact_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 执行留言添加
	 */
	function doContact($data) {
		$this->db->insert('comment',$data);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
	
	/**
	 * 获取最近评论信息
	 */
	public function getRecentComment() {
		$sql = 'SELECT
					id,comment_id,author,url,comment
				FROM
					blog_comment
				WHERE
					comment_type = "article"
				ORDER BY
					datetime DESC
				LIMIT
					10';
		$res = $this->db->query($sql);
		$list = $res->result_array();
		return $list;
	}
}