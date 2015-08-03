<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works_model extends CI_Model {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。，还有其他信息，例如密码等
    }
    /**
     * 获取作品列表
     */
    function getWorksList($start=0,$pagenum=10) {
    	$sLimit = 'LIMIT '.$start.','.$pagenum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_works
    			ORDER BY
    				id DESC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aList = $res->result_array();
    	return $aList;
    }
    
    /**
     * 获取作品信息
     */
    function getWorksInfo($iProject='') {
    	if(empty($iProject)) {
    		return false;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_works
    			WHERE
    				id='.$iProject;
    	$res = $this->db->query($sql);
    	$aList = $res->row_array();
    	return $aList;
    }
    
   
    
}