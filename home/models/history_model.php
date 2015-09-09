<?php
/**
 * 博客事件模型类
 * @author WangYongDong
 */
class History_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 获取时间轴
	 */
	public function getEvent() {
		$list = $this->getYearList();
		foreach ($list as $key=>$value) {
			$arr['year'] = $value['year'];
			$arr['list'] = $this->getMonthByYear($value['year']);
			
			$aList[] = $arr;
				
		}
		return $aList;
	}
	
	/**
	 * 获取年份
	 */
	function getYearList() {
		$sql = 'select
					FROM_UNIXTIME(UNIX_TIMESTAMP(time), "%Y") as year
				from
					blog_event
				GROUP BY
					FROM_UNIXTIME(UNIX_TIMESTAMP(time), "%Y")
				ORDER BY
					time DESC';
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
	/**
	 * 根据年份获取列表
	 */
	function getMonthByYear($sYear) {
		$sql = 'select
					title,description,FROM_UNIXTIME(UNIX_TIMESTAMP(time), "%m.%d") as md,FROM_UNIXTIME(UNIX_TIMESTAMP(time), "%Y") as y
				from
					blog_event
				WHERE
					time like "%'.$sYear.'%"
				ORDER BY
					time DESC';
		$res = $this->db->query($sql);
		$aList = $res->result_array();
		return $aList;
	}
}