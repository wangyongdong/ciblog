<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 获取用户相关信息模型
 * @author WangYongdong
 */
class Member_model extends CI_Model  {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /**
     * 获取用户信息
     */
    function getMemberList($iStart=0,$iPageNum=20) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT 
    				* 
    			FROM 
    				blog_member 
    			ORDER BY 
    				id DESC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$user_list = $res->result_array();
    	foreach ($user_list as $row) {
    		$arr['id'] = $row['id'];
    		$arr['username'] = $row['username'];
    		$arr['email'] = $row['email'];
    		$arr['nums'] = getArticleNums($row['id']);
    		$arr['role'] = getRole($row['id'],'name');
    		$list[] = $arr;
    	}
    	return $list;
    }
    /**
     * 执行用户信息添加/修改
     */
    function doUser($data) {
    	if(!empty($data['id'])) {
    		changeImg('user', $data['id'], $data['img']);
    		$this->db->update('member',$data,array('id'=>$data['id']));
    		//添加操作log
    		$this->site_model->addActionLog('member','update');
    	} else {
    		$this->db->insert('member',$data);
    		//添加操作log
    		$this->site_model->addActionLog('member','add');
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    /**
     * 执行删除
     */
    function doDel($iUser) {
    	$affect = $this->db->delete('member',array('id'=>$iUser));
    	//添加操作log
    	$this->site_model->addActionLog('member','delete');
    	return $affect;
    }
    /**
     * 获取角色列表
     */
    function getRoleList($iStart=0,$iPageNum=20) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_role
    			ORDER BY
    				id ASC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	return $list;
    }
    /**
     * 获取角色信息
     */
    function getRoleInfo($iRole) {
    	if(empty($iRole)) {
    		return false;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_role
    			WHERE
    				id='.$iRole;
    	$res = $this->db->query($sql);
    	$list = $res->row_array();
    	if(!empty($list['function'])) {
    		$list['function'] = json_decode($list['function'],true);
    	}
    	return $list;
    }
    /**
     * 执行角色添加,修改
     */
    function doRole($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('role', $data);
    		//添加操作log
    		$this->site_model->addActionLog('role','add');
    	} else {
    		$this->db->update('role',$data,array('id'=>$data['id']));
    		//添加操作log
    		$this->site_model->addActionLog('role','update');
    	}
    	$affect = $this->db->affected_rows();
    	
    	return $affect;
    }
    /**
     * 执行删除
     */
    function roleDel($iRole) {
    	$affect = $this->db->delete('role',array('id'=>$iRole));
    	//添加操作log
    	$this->site_model->addActionLog('role','delete');
    	return $affect;
    }
}