<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
	
    /**
     * 用户登录验证
     */
    public function checkUserLogin($name,$pass) {
    	$sql = 'SELECT
    				id,username,email,password,uniquely,role_id
    			FROM
    				blog_member
    			WHERE
    				username="'.$name.'"
    				OR email="'.$name.'"';
    	$res = $this->db->query($sql);
    	$info = $res->row_array();
    	
    	if(empty($info)) {
    		return -1; 	//用户信息不存在
    	}
    	
    	//获取密码
    	$password = buildPass($pass, $info['uniquely']);
    	if($password != $info['password']) {
    		return -2;	//密码不正确
    	}
    	
    	if($info['role_id'] == '5') {
    		return -3;	//黑名单
    	}
    	
    	return $info;
    }
    /**
     * 添加登录日志
     */
    public function addLoginLog($data) {
    	$this->db->insert('log_login', $data);
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
}