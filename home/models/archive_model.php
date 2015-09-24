<?php
/**
 * 获取归档相关信息模型
 * @author WangYongdong
 */
class Archive_model extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 获取文章归档信息
	 */
	function getArchive($sLimit='') {
		$cache_time = $this->config->item('data_cache');
		$cache_path = CacheModule('archive_limit');
		if(readCache($cache_path)) {
			@include $cache_path;
			$list = @$arr['info'];
		} else {
			$sql = 'select 
					FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y/%m") as datetime, count(*) as num 
				from 
					blog_article 
				WHERE
					status="show" 
				GROUP BY 
					FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y/%m")
				ORDER BY 
					datetime DESC';
			if(!empty($sLimit)) {
				$sql .= ' LIMIT '.$sLimit;
			}
			$res = $this->db->query($sql);
			$list = $res->result_array();
			//写入缓存
			writeCache($list, $cache_path, $cache_time['time']);
		}
		return $list;
	}
	/**
	 * 获取全部归档列表
	 */
	function getArchiveList() {
		$cache_time = $this->config->item('data_cache');
		$cache_path = CacheModule('archive_list');
		if(readCache($cache_path)) {
			@include $cache_path;
			$list = @$arr['info'];
		} else {
			$aYear = $this->getYearArchive();
			foreach ($aYear as $key=>$value) {
				$aList = $this->getMonthArchive($value['year']);
				foreach ($aList as $k=>$v) {
					$sTime = $value['year'].'/'.$v['month'];
					$arr['article'] = $this->getArticleByArchive($sTime);
					$arr['month'] = $v['month'];
					$arr['num'] = $v['num'];
					$arr['year'] = $value['year'];
					$aLists[$value['year']][] = $arr;
					$arr = '';
				}
				$list = $aLists;
			}
			//写入缓存
			writeCache($list, $cache_path, $cache_time['time']);
		}
		return $list;
	}
	/**
	 * 获取归档年份
	 */
	function getYearArchive() {
		$sql = 'select
					FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y") as year
				from
					blog_article
				WHERE 
					status="show" 
				GROUP BY
					FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y")
				ORDER BY
					datetime DESC';
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	/**
	 * 获取归档月份
	 */
	function getMonthArchive($sYear) {
		$sql = 'select 
					FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%m") as month, count(*) as num 
				from 
					blog_article 
				WHERE
					status="show"  
					AND FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y") = "'.$sYear.'"
				GROUP BY 
					FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%m")
				ORDER BY 
					datetime DESC';
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	/**
	 * 根据归档时间获取文章列表
	 */
	function getArticleByArchive($sTime,$iStart=0,$iPageNum=100) {
		$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
		$sql = 'SELECT
					*
				FROM
					blog_article
				WHERE
					status="show"
					AND FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y/%m") = "'.$sTime.'"
				ORDER BY
					datetime DESC
				'.$sLimit;
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	/**
	 * 获取统计信息
	 */
	function getSiteStatis() {
		$data['sort'] = getStatis('sort');
		$data['article'] = getStatis('article');
		$data['contact'] = getStatis('contact',' WHERE userid=0 ');
		$data['comment'] = getStatis('comment');
		return $data;
	}
}