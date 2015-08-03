<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。，还有其他信息，例如密码等
        
    }
	
    /**
     * 用户登录验证
     */
    function checkUserLogin($name,$pass) {
    	$sql = 'SELECT
    				id,username,email,password,uniquely,role_id
    			FROM
    				blog_member
    			WHERE
    				username="'.$name.'"
    				OR email="'.$name.'"';
    	$res = $this->db->query($sql);
    	$info = $res->result_array();
    	if(empty($info)) {
    		return -1; 	//用户信息不存在
    	}
    	//执行密码加密
    	$this->load->library('encrypt');
    	$password = $this->encrypt->encryptcode($pass,$info[0]['uniquely']);
    	
    	if($password != $info[0]['password']) {
    		return -2;	//密码不正确
    	}
    	if($info[0]['role_id'] == '4') {
    		return -3;	//黑名单
    	}
    	return $info[0];
    }
    
}