<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sort_model extends CI_Model  {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。
    }
    /**
     * 获取类别列表
     */
    function getSortList($iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_sort
    			ORDER BY
    				id
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aList = $res->result_array();
    	return $aList;
    }
    /**
     * 获取类别信息
     */
	function getSortInfo($iSort='') {
		if(empty($iSort)) {
			return false;
		}
		$sql = 'SELECT
    				*
    			FROM
    				blog_sort
				WHERE
					id='.$iSort;
		$res = $this->db->query($sql);
		$aList = $res->row_array();
		return $aList;
	}
	
    /**
     * 执行类别添加修改
     */
    function doSort($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('sort', $data);
    	} else {
    		$this->db->update('sort',$data,array('id'=>$data['id']));
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行删除
     */
    function doDel($iSort) {
    	$affect = $this->db->delete('sort',array('id'=>$iSort));
    	return $affect;
    }
    
    /**
     * 执行类别移动
     */
    function sortChange($sType,$iArticle) {
    	$sArticleType = getArticleField($iArticle,'type'); //获取该文章原属于的类别
    	
    	$data = array('type'=>$sType);
    	$this->db->update('article',$data,array('id'=>$iArticle));
    	$affect = $this->db->affected_rows();
    	if($affect) {
    		$add = $this->sort_model->doSortNum($sType,"add"); 			//执行类别数量修改
    		$cut = $this->sort_model->doSortNum($sArticleType,"cut"); 	//执行类别数量修改
    	}
    	return $affect;
    }
    
	/**
     * 执行文章类别数量增加和减少
     * @param string $type：add,cut
     */
    function doSortNum($iSort,$sType) {
    	$sql = 'SELECT nums FROM blog_sort WHERE id='.$iSort;	//查询出该类别下的文章数量
    	$query = $this->db->query($sql);
    	$res = $query->row_array();
    	if($sType == "add") {
    		$num = $res['nums'] + 1;
    	} else {
    		$num = $res['nums'] - 1;
    	}
    	$data = array('nums'=>$num);
    	$this->db->update('sort',$data,array('id'=>$iSort));
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
}