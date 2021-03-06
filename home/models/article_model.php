<?php
/**
 * 获取文章相关信息模型
 * @author WangYongdong
 */
class Article_model extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 获取文章列表
	 */
	function getArticleList($sOrder='datetime',$iStart=0,$iPageNum=10,$aFilter='') {
		$cache_time = $this->config->item('data_cache');
		$cache_path = CacheModule('article_list_'.$sOrder.'('.$iStart.'-'.$iPageNum.')_'.$aFilter);
		if(readCache($cache_path)) {
			@include $cache_path;
			$list = @$arr['info'];
		} else {
			$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
			$sql = 'SELECT
	    				*
	    			FROM
	    				blog_article
	    			WHERE
	    				status = "show"
						AND sortid != "2" ';
			if(!empty($aFilter['q'])) {
				$sql .= ' AND title LIKE"%'.$aFilter['q'].'%"';
			}
			$sql .= ' ORDER BY
	    				'.$sOrder.' DESC '.$sLimit;
			$res = $this->db->query($sql);
			$list = $res->result_array();
			//写入缓存
			writeCache($list, $cache_path, $cache_time['time']);
		}
		return $list;
	}
	/**
	 * 获取文章详情
	 */
	public function getArticleInfo($iArticle) {
		$cache_time = $this->config->item('data_cache');
		$cache_path = CacheModule('article_view_'.$iArticle);
		if(readCache($cache_path)) {
			@include $cache_path;
			$list = @$arr['info'];
		} else {
			if(empty($iArticle)) {
				return false;
			}
			$sql = 'SELECT
	    				*
	    			FROM
	    				blog_article
	    			WHERE
						status = "show"
						AND id='.$iArticle;
			$res = $this->db->query($sql);
			$list = $res->row_array();
			//写入缓存
			writeCache($list, $cache_path, $cache_time['time']);
		}
		return $list;
	}
	/**
	 * 获取置顶文章
	 */
	public function getTopArticle() {
		$cache_time = $this->config->item('data_cache');
		$cache_path = CacheModule('article_top');
		if(readCache($cache_path)) {
			@include $cache_path;
			$list = @$arr['info'];
		} else {
			$sql = 'SELECT
    				id,title,img
    			FROM
    				blog_article
    			WHERE
					topway = "home"
					AND img <> ""
				ORDER BY
					datetime DESC 
				LIMIT 5';
			$res = $this->db->query($sql);
			$list = $res->result_array();
			//写入缓存
			writeCache($list, $cache_path, $cache_time['time']);
		}
		return $list;
	}
	/**
	 * 获取上一篇、下一篇
	 */
	function getLastNext($iArticle,$sType='') {
		if($sType == 'cms') {
			$sWhere = ' AND sortid = "2" ';
		} else {
			$sWhere = ' AND sortid != "2" ';
		}
		//下一篇
		$sql = 'SELECT 
					id,title 
				FROM 
					blog_article 
				WHERE 
					status="show" 
					'.$sWhere.'
					AND id<'.$iArticle.' 
				ORDER BY 
					id DESC 
				limit 0,1';
		$res = $this->db->query($sql);
		$next = $res->row_array();
		
		//上一篇
		$sql = 'SELECT 
					id,title 
				FROM 
					blog_article 
				WHERE 
					status="show" 
					'.$sWhere.'
					AND id>'.$iArticle.' 
				ORDER BY 
					id DESC 
				limit 0,1';
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
		if($iSort == 2) {
			return '';
		}
		$list = $this->sort_model->getArticleBySort($iSort,$iStart=0,$iLimit);
		if(empty($list)) {
			return '';
		}
		if(!empty($list)) {
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