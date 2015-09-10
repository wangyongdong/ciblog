<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 获取分类相关信息模型
 * @author WangYongdong
 */
class Sort_model extends CI_Model  {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /**
     * 获取类别列表
     */
    function getSortList($iStart=0,$iPageNum=100) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_sort
    			ORDER BY
    				id
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aList = $res->result_array();
    	return $aList;
    }
    /**
     * 获取类别信息
     */
	function getSortInfo($iSort='') {
		if(empty($iSort)) {
			return false;
		}
		$sql = 'SELECT
    				*
    			FROM
    				blog_sort
				WHERE
					id='.$iSort;
		$res = $this->db->query($sql);
		$aList = $res->row_array();
		return $aList;
	}
    /**
     * 执行类别添加修改
     */
    function doSort($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('sort', $data);
    		//添加操作log
    		$this->site_model->addActionLog('sort','add');
    	} else {
    		$this->db->update('sort',$data,array('id'=>$data['id']));
    		//添加操作log
    		$this->site_model->addActionLog('sort','update');
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    /**
     * 执行删除
     */
    function doDel($iSort) {
    	$affect = $this->db->delete('sort',array('id'=>$iSort));
    	//添加操作log
    	$this->site_model->addActionLog('sort','delete');
    	return $affect;
    }
    
}