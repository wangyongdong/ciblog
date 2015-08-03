<?php
/*
 * 获取文章相关信息模型
 */
class Article_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 获取文章信息
	 */
	public function getArticleAct($sType,$iLimit=10) {
		$sLimit = ' LIMIT '.$iLimit;
		if($sType == 'index_rec') {
			$sOrder = ' ORDER BY views DESC ';
		}
		if($sType == 'index_new') {
			$sOrder = ' ORDER BY datetime DESC';
		}
		$sql = 'SELECT 
					* 
				FROM 
					blog_article 
				'.$sOrder.$sLimit;
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	
	/**
	 * 获取文章列表
	 */
	function getArticleList($iStart=0,$iPageNum=10) {
		$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
		$sql = 'SELECT
    				*
    			FROM
    				blog_article
    			ORDER BY
    				datetime DESC
    			'.$sLimit;
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	
	/**
	 * 获取文章详情
	 */
	public function getArticleInfo($iArticle) {
		if(empty($iArticle)) {
			return false;
		}
		$sql = 'SELECT
    				*
    			FROM
    				blog_article
    			WHERE
    				id='.$iArticle;
		$res = $this->db->query($sql);
		$aList = $res->row_array();
		return $aList;
	}
	
	/**
	 * 获取上一篇、下一篇
	 */
	function getLastNext($iArticle) {
		//下一篇
		$sql = 'SELECT id,title FROM blog_article WHERE id<'.$iArticle.' ORDER BY id DESC limit 0,1';
		$res = $this->db->query($sql);
		$next = $res->row_array();
		
		//上一篇
		$sql = 'SELECT id,title FROM blog_article WHERE id>'.$iArticle.' ORDER BY id DESC limit 0,1';
		$res = $this->db->query($sql);
		$last = $res->row_array();
		
		$list = '';
		$list['next'] = sg($next);
		$list['last'] = sg($last);
		return $list;
	}
	
	/**
	 * 获取相关文章
	 */
	function getRelated($iArticle,$iLimit=6) {
		//获取文章所属分类
		$iType = getSortByArticle($iArticle);
		$list = $this->getArticleBySort($iType,$iStart=0,$iLimit);
		$iLength = count($list);
		if($iLength < $iLimit) {
			//随机一个分类填充数量
			$sort_list = $this->public_model->getSort();
			$sortNum = count($sort_list);
			$iOtherType = rand(1,$sortNum);
			$iOtherLimit = $iLimit - $iLength;
			$otherList = $this->getArticleBySort($iOtherType,$iOtherStart=0,$iOtherLimit);
			
			if($iLength > 0) {
				$list = array_merge($list,$otherList);
			} else {
				$list = $otherList;
			}
		}
		return $list;
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
					type='.$iType.'
				ORDER BY
					datetime DESC '.$sLimit;
		$res = $this->db->query($sql);
		$list = $res->result_array();
		return $list;
	}
	
	/**
	 * 获取文章归档信息
	 */
	function getArchive() {
		$sql = 'select 
					FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y/%m") as datetime, count(*) as num 
				from 
					blog_article 
				GROUP BY 
					FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y/%m")';
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	
	/**
	 * 根据归档时间获取文章列表
	 */
	function getArticleByArchive($sTime,$iStart=0,$iPageNum=10) {
		$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
		$sql = 'SELECT
					*
				FROM
					blog_article
				WHERE
					FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y/%m") = "'.$sTime.'"
				ORDER BY
					datetime DESC
				'.$sLimit;
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	
	/**
	 * 文章访问数+1
	 */
	function addArticleViews($iArticle) {
		$sql = 'UPDATE
    				blog_article
    			SET
    				 views=views+1
    			WHERE
    				id='.$iArticle;
		$res = $this->db->query($sql);
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
    				comment_type="article"
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