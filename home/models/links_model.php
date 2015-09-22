<?php
/**
 * 友情链接模型类
 * @author WangYongDong
 */
class Links_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 获取首页友情链接
	 */
	public function getLinks() {
		$cache_time = $this->config->item('data_cache');
		$cache_path = CacheModule('links_list');
		if(readCache($cache_path)) {
			@include $cache_path;
			$list = @$arr['info'];
		} else {
			$sql = 'SELECT 
					sitename,siteurl,description 
				FROM 
					blog_links 
				WHERE 
					status="show" 
				ORDER BY 
					id ASC 
				LIMIT 5';
			$res = $this->db->query($sql);
			$list = $res->result_array();
			//写入缓存
			writeCache($list, $cache_path, $cache_time['time']);
		}
		
		return $list;
	}
	/**
	 * 友情链接申请
	 */
	public function doLinks($data) {
		$this->db->insert('links',$data);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
}