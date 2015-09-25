<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 获取文章相关信息模型
 * @author WangYongdong
 */
class Article_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('sort_model');
    }
    /**
     * 获取文章列表
     */
    function getArticleList($iStart=0,$iPageNum=10,$aFilter='') {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_article
    			WHERE
    				1 = 1 ';
    	if(!empty($aFilter['keyword'])) {
    		$sql .= ' AND title LIKE"%'.$aFilter['keyword'].'%"';
    	}
    	if(!empty($aFilter['sort'])) {
    		$sql .= ' AND sortid = '.$aFilter['sort'];
    	}
    	if(!empty($aFilter['author'])) {
    		$sql .= ' AND uid = '.$aFilter['author'];
    	}
    	$sql .= ' ORDER BY
    				id DESC '.$sLimit;
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
    	if(empty($data['id'])) {
    		$this->db->insert('article',$data);
    		$this->updSortNum($data['sortid'],'1');				//修改类别数量
    		$this->site_model->addActionLog('article','add');	//添加操作log
    	} else {
    		changeImg('article', $data['id'], $data['img']);
    		//获取文章原分类
    		$iSort = getArticleField($data['id'],'sortid');
    		$this->db->update('article',$data,array('id'=>$data['id']));
    		//原类别数量减少和新类别数量增加
    		$this->updSortNum($iSort,'-1');
    		$this->updSortNum($data['sortid'],'1');
    		$this->site_model->addActionLog('article','update');//添加操作log
    	}
   	 	$affect = $this->db->affected_rows();
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
    		$affects = $this->updSortNum($iSort,'-1'); 	//执行类别数量减少
    	}
    	$this->site_model->addActionLog('article','delete');//添加操作log
    	return $affect;	
    }
    /**
     * 执行文章置顶
     */
    function ArticleTop($sTop,$iArticle) {
    	$data = array('topway'=>$sTop);
    	$this->db->update('article',$data,array('id'=>$iArticle));
    	$affect = $this->db->affected_rows();
    	$this->site_model->addActionLog('article','update');//添加操作log
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
    		$this->updSortNum($iSort,'1');
    		$this->updSortNum($sortid,'-1');
    	}
    	//添加操作log
    	$this->site_model->addActionLog('article','update');
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