<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model  {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。
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
    		$arr['role'] = roleName(getRole($row['role_id'],'role_name'));
    		$list[] = $arr;
    	}
    	return $list;
    }
    
    /**
     * 执行用户信息添加,修改
     */
    function doUser($data) {
    	if(!empty($data['id'])) {
    		$this->db->update('member',$data,array('id'=>$data['id']));
    	} else {
    		$this->db->insert('member',$data);
    	}
    	
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行删除
     */
    function doDel($iUser) {
    	$affect = $this->db->delete('member',array('id'=>$iUser));
    	return $affect;
    }
}