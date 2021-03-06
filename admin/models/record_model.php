<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 获取说说相关信息模型
 * @author WangYongdong
 */
class Record_model extends CI_Model  {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
 	/**
     * 获取说说列表
     */
    function getRecordList($iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT 
    				* 
    			FROM 
    				blog_record
    			WHERE 
    				reply_id = 0 
    				AND uid = 1 
    			ORDER BY 
    				id DESC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aRecord = $res->result_array();
    	return $aRecord;
    }
    /**
     * 执行说说添加
     */
    function doRecord($data) {
    	$this->db->insert('record',$data);
    	$iInsert = $this->db->insert_id();
    	//添加操作log
    	$this->site_model->addActionLog('record','add');
    	return $iInsert;
    }
	/**
     * 删除说说
     */
    function doDel($iRecord) {
    	$affect = $this->db->delete('record',array('id'=>$iRecord));
    	//添加操作log
    	$this->site_model->addActionLog('record','delete');
    	return $affect;
    }
}