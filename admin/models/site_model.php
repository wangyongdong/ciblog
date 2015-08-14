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
    	//添加操作log
    	$this->public_model->addActionLog('site_web','update');
    	return $affect;
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
    		//添加操作log
    		$this->public_model->addActionLog('site_menu','update');
    	} else {
    		$this->db->insert('menu',$data);
    		//添加操作log
    		$this->public_model->addActionLog('site_menu','add');
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行menu删除
     */
    function delMenu($id) {
    	$affect = $this->db->delete('menu',array('id'=>$id));
    	//添加操作log
    	$this->public_model->addActionLog('site_menu','delete');
    	return $affect;
    }
    
    /**
     * 获取notice列表
     */
    function getNotice($iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_notice
    			ORDER BY
    				datetime DESC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aList = $res->result_array();
    	return $aList;
    }
    /**
     * 执行删除notice
     */
    function delNotice($iNotice) {
    	return $this->db->delete('notice',array('id'=>$iNotice));
    	//添加操作log
    	$this->public_model->addActionLog('notice','delete');
    }
    /**
     * 修改notice状态
     */
    function updNotice($iNotice) {
    	$data = array();
    	$data['status'] = 'read';
    	$this->db->update('notice',$data,array('id'=>$iNotice));
    	$affect = $this->db->affected_rows();
    	//添加操作log
    	$this->public_model->addActionLog('notice','update');
    	return $affect;
    }
    
    /**
     * 获取操作日志
     */
    function getAction($iStart=0,$iPageNum=10,$aFilter='') {
    	$sLimit = ' LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_action_log
    			WHERE
    				1=1 ';
    	if(!empty($aFilter['start'])) {
    		$sql .= ' AND datetime > '.$aFilter['start'];
    	}
    	if(!empty($aFilter['end'])) {
    		$sql .= ' AND datetime < '.$aFilter['end'];
    	}
    	$sql .= ' ORDER BY
    				id DESC '.$sLimit;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	return $list;
    }
    
}