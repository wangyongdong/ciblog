<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works_model extends CI_Model {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。，还有其他信息，例如密码等
    }
    /**
     * 获取作品列表
     */
    function getWorksList($iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_works
    			WHERE
    				uid='.$_SESSION['uid'].'
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
    function getWorksInfo($iWorks='') {
    	if(empty($iWorks)) {
    		return false;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_works
    			WHERE
    				uid='.$_SESSION['uid'].'
    				AND id='.$iWorks;
    	$res = $this->db->query($sql);
    	$aList = $res->row_array();
    	return $aList;
    }
    
    /**
     * 执行添加,修改
     */
    function doWorks($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('works', $data);
    	} else {
    		$this->db->update('works',$data,array('id'=>$data['id']));
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行删除
     */
    function delWorks($iWorks) {
    	$affect = $this->db->delete('works',array('id'=>$iWorks));
    	return $affect;
    }
    
}