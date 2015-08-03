<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model  {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。
    }
    
    /**
     * 获取用户信息
     */
    function getPersonal() {
    	$id = $_SESSION['uid'];
    	$sql = 'SELECT * FROM blog_member WHERE id='.$id;
    	$res = $this->db->query($sql);
    	$list = $res->row_array();
    	return $list;
    }
    
    /**
     * 执行会员信息添加,修改
     */
    function doPersonal($data) {
    	if(!empty($data['id'])) {
    		$this->db->update('member',$data,array('id'=>$data['id']));
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 获取about me
     */
    function getAboutMe() {
    	$iUser = $_SESSION['uid'];
    	$sql = "SELECT
    				about_me
    			FROM
    				blog_member
    			WHERE
    				id='$iUser'";
    	$res = $this->db->query($sql);
    	$info = $res->row_array();
    	return $info['about_me'];
    }
    
    /**
     * 修改about me
     */
    function updAbout($sContent) {
    	$iUser = $_SESSION['uid'];
    	$sql = 'UPDATE
    				blog_member
    			SET
    				about_me="'.$sContent.'"
    			WHERE
    				id ='.$iUser;
    	$affect = $this->db->query($sql);
    	return $affect;
    }
}