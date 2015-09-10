<?php
/**
 * 评论相关模型
 * @author WangYongdong
 */
class Comment_model extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 获取最近评论信息
	 */
	public function getNewComment($iSort='') {
		if(!empty($iSort)) {
			$sWhere = ' AND a.sortid = "2" ';
		} else {
			$sWhere = ' AND a.sortid != "2" ';
		}
		$sql = 'SELECT
					c.id,c.comment_id,c.author,c.url,c.content
				FROM
					blog_comment c,blog_article a
				WHERE
					c.comment_id = a.id
					AND c.userid = 0
					'.$sWhere.'
				ORDER BY
					c.datetime DESC
				LIMIT
					10';
		$res = $this->db->query($sql);
		$list = $res->result_array();
		return $list;
	}
	/**
	 * 修改文章评论数量
	 */
	function updArticle($iArticle) {
		$sql = 'UPDATE
    				blog_article
    			SET
    				 comnum=comnum+1
    			WHERE
    				id='.$iArticle;
		$res = $this->db->query($sql);
	}
	/**
	 * 获取评论信息
	 */
	function getComment($iArticle,$iComment,$iStart=0,$iPageNum=5) {
		$sLimit = ' LIMIT '.$iStart.','.$iPageNum;
		$sql = 'SELECT
    				*
    			FROM
    				blog_comment
    			WHERE
    				1=1';
		if(!empty($iArticle) && empty($iComment)) {
			$sWhere = ' AND reply_id=0 AND comment_id='.$iArticle;
		}
		if(!empty($iComment)) {
			$sWhere = ' AND reply_id='.$iComment;
		}
		$sql .= $sWhere.' ORDER BY id DESC '.$sLimit;
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