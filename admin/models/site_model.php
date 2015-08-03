<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model  {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。
    }
    
    /**
     * 获取网站设置信息
     */
    function getSiteWeb() {
    	$sql = "SELECT
    				*
    			FROM
    				blog_options";
    	$res = $this->db->query($sql);
    	$result = $res->result_array();
    	foreach ($result as $row) {
    		$name = $row['option_name'];
    		$arr[$name] = $row['option_value'];
    		$list = $arr;
    	}
    	return $list;
    }
    
    /**
     * 执行网站信息配置修改
     */
    function doSiteWeb($aSite) {
    	foreach ($aSite as $key=>$value) {
    		$data = array('option_value'=>$value);
    		$this->db->update('options',$data,array('option_name'=>$key));
    		$affect = $this->db->affected_rows();
    	}
    	return $affect;
    }
    /**
     * 获取网站SEO设置
     */
    function getSiteSeo() {
    	$sql = "SELECT
    				*
    			FROM
    				blog_options
    			WHERE
    				id in('22','23','24')";
    	$res = $this->db->query($sql);
    	$result = $res->result_array();
    	foreach ($result as $row) {
    		$name = $row['option_name'];
    		$arr[$name] = $row['option_value'];	//已name值做键
    		$list = $arr;
    	}
    	return $list;
    }
    /**
     * 获取menu信息
     */
    function getSiteMenu($id='',$iStart=0,$iPageNum=10) {
    	$sLimit = ' LIMIT '.$iStart.','.$iPageNum;
    	$sWhere = ' 1=1 ';
    	if(!empty($id)) {
    		$sWhere = ' id= '.$id;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_menu
    			WHERE '.$sWhere . $sLimit;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	if(!empty($id)) {
    		return $list[0];
    	}
    	return $list;
    }
    
    /**
     * 添加,修改menu
     */
    function doMenu($data) {
    	if(!empty($data['id'])) {
    		$this->db->update('menu',$data,array('id'=>$data['id']));
    	} else {
    		$this->db->insert('menu',$data);
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行删除
     */
    function delMenu($id) {
    	$affect = $this->db->delete('menu',array('id'=>$id));
    	return $affect;
    }
    
}