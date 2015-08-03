<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links_model extends CI_Model  {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。
    }
	/**
	 * 获取友链列表
	 * @param number $start
	 * @param number $pagenum
	 * @return unknown
	 */
    function getLinksList($iStart=0,$iPageNum=10) {
		$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_links
    			ORDER BY
    				datetime
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	return $list;
    }
    
    /**
     * 获取友链信息
     */
    function getLinksInfo($iLinks) {
    	if(empty($iLinks)) {
    		return false;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_links
    			WHERE
    				id='.$iLinks;
    	$res = $this->db->query($sql);
    	$list = $res->row_array();
    	return $list;
    }
    
    /**
     * 执行添加,修改
     */
    function doLinks($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('links', $data);
    	} else {
    		$this->db->update('links',$data,array('id'=>$data['id']));
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行删除
     */
    function doDel($iLinks) {
    	$affect = $this->db->delete('links',array('id'=>$iLinks));
    	return $affect;
    }
    
}