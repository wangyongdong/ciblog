<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 获取留言相关信息模型
 * @author WangYongdong
 */
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
    	//添加操作log
    	$this->site_model->addActionLog('contact','update');
    	return $affect;
    }
    /**
     * 添加回复
     */
    function doReply($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('contact', $data);
    		//邮件发送
    		$arr = $this->public_model->contactEmail($data['reply_id'],$data['author'],$data['content']);
    		if(!empty($arr['email'])) {
    			$this->public_model->sendMail($arr['email'],$arr['subject'],$arr['content']);
    		}
    	} else {
    		$this->db->update('contact',$data,array('id'=>$data['id']));
    	}
    	$affect = $this->db->affected_rows();
    	//添加操作log
    	$this->site_model->addActionLog('contact','add');
    	return $affect;
    }
    /**
     * 执行删除
     */
    function doDel($iContact) {
    	$affect = $this->db->delete('contact',array('id'=>$iContact));
    	//添加操作log
    	$this->site_model->addActionLog('contact','delete');
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