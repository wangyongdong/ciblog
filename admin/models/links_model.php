<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 获取友链相关信息模型
 * @author WangYongdong
 */
class Links_model extends CI_Model  {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
	/**
	 * 获取友链列表
	 */
    function getLinksList($iStart=0,$iPageNum=10) {
		$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_links
    			ORDER BY
    				datetime
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	return $list;
    }
    /**
     * 获取友链信息
     */
    function getLinksInfo($iLinks) {
    	if(empty($iLinks)) {
    		return false;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_links
    			WHERE
    				id='.$iLinks;
    	$res = $this->db->query($sql);
    	$list = $res->row_array();
    	return $list;
    }
    /**
     * 执行添加/修改
     */
    function doLinks($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('links', $data);
    		//添加操作log
    		$this->site_model->addActionLog('links','add');
    	} else {
    		$this->db->update('links',$data,array('id'=>$data['id']));
    		//添加操作log
    		$this->site_model->addActionLog('links','update');
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    /**
     * 执行删除
     */
    function doDel($iLinks) {
    	$affect = $this->db->delete('links',array('id'=>$iLinks));
    	//添加操作log
    	$this->site_model->addActionLog('links','delete');
    	return $affect;
    }
}