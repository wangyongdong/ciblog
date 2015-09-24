<?php
/**
 * 分类相关信息模型
 * @author WangYongdong
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
		$cache_time = $this->config->item('data_cache');
		$cache_path = CacheModule('sort_list');
		if(readCache($cache_path)) {
			@include $cache_path;
			$list = @$arr['info'];
		} else {
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
			$list = $res->result_array();
			//写入缓存
			writeCache($list, $cache_path, $cache_time['time']);
		}
		return $list;
	}
	/**
	 * 根据类别获取文章
	 */
	function getArticleBySort($iType,$iStart='',$iPageNum='') {
		$data_cache = $this->config->item('data_cache');
		$cache_time = $data_cache['time'];
		$cache_path = CacheModule('sort_article_'.$iType.'('.$iStart.'-'.$iPageNum.')');
		if(readCache($cache_path)) {
			@include $cache_path;
			$list = @$arr['info'];
		} else {
			$sLimit = '';
			if(!empty($iPageNum)) {
				$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
			}
			$sql = 'SELECT
						*
					FROM
						blog_article
					WHERE
						status="show" 
						AND sortid='.$iType.'
					ORDER BY
						datetime DESC '.$sLimit;
			$res = $this->db->query($sql);
			$list = $res->result_array();
			//写入缓存
			writeCache($list, $cache_path, $cache_time);
		}
		return $list;
	}
}