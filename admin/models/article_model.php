<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('sort_model');
    }
	
    /**
     * 获取文章列表
     */
    function getArticleList($iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_article
    			ORDER BY
    				id DESC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aList = $res->result_array();
    	return $aList;
    }
    
    /**
     * 获取文章详情
     */
    function getArticleInfo($iArticle) {
    	if(empty($iArticle)) {
    		return false;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_article
    			WHERE
    				id='.$iArticle;
    	$res = $this->db->query($sql);
    	$list = $res->row_array();
    	return $list;
    }
    
    /**
     * 执行文章添加,修改
     */
    function doArticle($data) {
    	if(empty($data['id'])) {	//添加
    		$this->db->insert('article',$data);
    	} else {					//修改
    		//获取文章原分类
    		$sType = getArticleField($data['id'],'type');
    		//修改文章
    		$this->db->update('article',$data,array('id'=>$data['id']));
    	}
   	 	$affect = $this->db->affected_rows();
    	if(!empty($affect)) {
    		if(empty($data['id'])) {	//添加类别数量
    			$this->doSortNum($data['type'],"add");
    		} else {
    			//先减去原类别数量
    			$this->doSortNum($sType,"cut");
    			//增加新类别数量
    			$this->doSortNum($data['type'],"add");
    			
    		}
    	}
    	return $affect;
    }
    
    /**
     * 执行删除
     */
    function doDel($iArticle) {
    	//类别统计数减一
    	$iSort = getArticleField($iArticle,'sortid'); //获取该文章原属于的类别
    	$affect = $this->db->delete('article',array('id'=>$iArticle));
    	if($affect) {
    		$affects = $this->updSortNum($iSort,"-1"); 	//执行类别数量减少
    	}
    	return $affect;	
    }
    /**
     * 执行文章置顶
     */
    function ArticleTop($sTop,$iArticle) {
    	$data = array('topway'=>$sTop);
    	$this->db->update('article',$data,array('id'=>$iArticle));
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    /**
     * 执行类别移动
     */
    function sortChange($iSort,$iArticle) {
    	$sortid = getArticleField($iArticle,'sortid'); //获取文章原类别id
    	$data = array('sortid'=>$iSort);
    	$this->db->update('article',$data,array('id'=>$iArticle));
    	$affect = $this->db->affected_rows();
    	if($affect) {
    		$this->updSortNum($iSort,"1");
    		$this->updSortNum($sortid,"-1");
    	}
    	return $affect;
    }
    /**
     * 执行文章类别数量增加和减少
     */
    function updSortNum($iSort,$iNums) {
    	$sql = 'UPDATE
    				blog_sort
    			SET
    				 nums=nums+'.$iNums.'
    			WHERE
    				id='.$iSort;
    	$res = $this->db->query($sql);
    	return $res;
    }
}