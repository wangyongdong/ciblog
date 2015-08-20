<?php
/*
 * 评论相关模型
 */
class Comment_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 获取最近评论信息
	 */
	public function getNewComment() {
		$sql = 'SELECT
					id,comment_id,author,url,content
				FROM
					blog_comment
				WHERE
					userid = 0
				ORDER BY
					datetime DESC
				LIMIT
					10';
		$res = $this->db->query($sql);
		$list = $res->result_array();
		return $list;
	}
	
	/**
	 * 修改文章评论数量
	 */
	function updArticle($iArticle,$sNum) {
		$sql = 'UPDATE
    				blog_article
    			SET
    				 comnum=comnum+'.$sNum.'
    			WHERE
    				id='.$iArticle;
		$res = $this->db->query($sql);
	}
	
	/**
	 * 获取评论信息
	 */
	function getComment($iArticle,$iStart=0,$iPageNum=5) {
		$sLimit = ' LIMIT '.$iStart.','.$iPageNum;
		$sql = 'SELECT
    				*
    			FROM
    				blog_comment
    			WHERE
    				userid=0
    				AND comment_id=" '.$iArticle.' "
    			ORDER BY
    				id DESC
    			'.$sLimit;
		$res = $this->db->query($sql);
		$aComment = $res->result_array();
		return $aComment;
	}
	
	/**
	 * 执行评论添加
	 */
	function doComment($data) {
		$this->db->insert('comment',$data);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
}