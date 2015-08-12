<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /**
     * 获取留言
     */
    function getContact($type,$iStart=0,$iPageNum=10,$aFilter='') {
    	$sLimit = ' LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_contact
    			WHERE
    				reply_id=0 ';
    	if(!empty($aFilter['keyword'])) {
    		$sql .= ' AND author LIKE"%'.$aFilter['keyword'].'%"';
    	}
    	$sql .= ' ORDER BY
    				id DESC '.$sLimit;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	return $list;
    }
    
    /**
     * 获取留言详情
     */
    function getContactInfo($iContact) {
    	if(empty($iContact)) {
    		return false;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_contact
    			WHERE
    				id='.$iContact;
    	$res = $this->db->query($sql);
    	$list = $res->row_array();
    	return $list;
    }
    
    /**
     * 获取回复信息
     */
    function getContactReply($iContact) {
    	$sql = 'SELECT
    				id,reply_id,content
    			FROM
    				blog_contact
    			WHERE
    				reply_id='.$iContact;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	return $list;
    }
    
    /**
     * 修改留言
     */
    function doContact($data) {
    	$this->db->update('contact',$data,array('id'=>$data['id']));
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 添加回复
     */
    function doReply($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('contact', $data);
    	} else {
    		$this->db->update('contact',$data,array('id'=>$data['id']));
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行删除
     */
    function doDel($iContact) {
    	$affect = $this->db->delete('contact',array('id'=>$iContact));
    	return $affect;
    }
    
    /**
     * 标记已读状态
     */
    function doRead() {
    	$sql = 'UPDATE
    				blog_contact
    			SET
    				is_read="Y"
    			WHERE
    				is_read="N"';
    	$res = $this->db->query($sql);
    	return $res;
    }
}