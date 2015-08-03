<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。，还有其他信息，例如密码等
    }
	
    /**
     * 获取文章列表
     */
    function getSearchArticle($aFilter,$iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
                        *
                    FROM
                       	blog_article
                    WHERE
                       	1 = "1" ';
    	if (!empty($aFilter['q'])) {
    		$sql .= ' AND title like "%'.$aFilter['q'].'%"';
    	}
    	$sql .= ' ORDER BY
        				id DESC '.$sLimit;
    	$res = $this->db->query($sql);
    	$aList = $res->result_array();
    	return $aList;
    }
    
}