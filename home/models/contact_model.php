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
		$this->db->insert('contact',$data);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
	
}