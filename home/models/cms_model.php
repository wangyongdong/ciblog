<?php
/**
 * 获取cms文章相关信息模型
 * @author WangYongdong
 */
class Cms_model extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 获取cms文章列表
	 */
	function getCmsList($sOrder='datetime',$iStart=0,$iPageNum=10) {
		$cache_time = $this->config->item('data_cache');
		$cache_path = CacheModule('cms_list('.$iStart.'-'.$iPageNum.')');
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
						status="show" 
						AND sortid = "2" 
	    			ORDER BY 
	    			'.$sOrder.' DESC
	    			'.$sLimit;
			$res = $this->db->query($sql);
			$list = $res->result_array();
			//写入缓存
			writeCache($list, $cache_path, $cache_time['time']);
		}
		return $list;
	}
	
}