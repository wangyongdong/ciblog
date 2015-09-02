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
	 * 获取文章列表
	 * @param string $sOrder	排序方式：时间，阅读量，评论数
	 * @param number $iStart
	 * @param number $iPageNum
	 * @return array
	 */
	function getArticleList($sOrder='datetime',$iStart=0,$iPageNum=10,$aFilter='') {
		$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
		$sql = 'SELECT
    				*
    			FROM
    				blog_article
    			WHERE
    				sortid != "2" ';
		if(!empty($aFilter['q'])) {
			$sql .= ' AND title LIKE"%'.$aFilter['q'].'%"';
		}
		$sql .= ' ORDER BY
    				'.$sOrder.' DESC '.$sLimit;
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
		
		$list['next'] = sg($next);
		$list['last'] = sg($last);
		return $list;
	}
	
	/**
	 * 获取相关文章
	 */
	function getRelated($iArticle,$iLimit=6) {
		//获取文章所属分类
		$iSort = getSortByArticle($iArticle);
		$list = $this->sort_model->getArticleBySort($iSort,$iStart=0,$iLimit);
		$iLength = count($list);
		if($iLength < $iLimit) {
			//如果数量不够，随机一个分类填充数量
			$sort_list = $this->sort_model->getSort();
			$sortNum = count($sort_list);
			$iOtherType = rand(1,$sortNum);
			$iOtherLimit = $iLimit - $iLength;
			$otherList = $this->sort_model->getArticleBySort($iOtherType,$iOtherStart=0,$iOtherLimit);
			
			if($iLength > 0) {
				$list = array_merge($list,$otherList);
			} else {
				$list = $otherList;
			}
		}
		return $list;
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
	
	
}