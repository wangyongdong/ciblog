<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Record_model extends CI_Model  {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。
    }
 	/**
     * 获取说说列表
     */
    function getRecordList($iStart=0,$iPageNum=10) {
    	$sLimit = 'LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT 
    				* 
    			FROM 
    				blog_record
    			WHERE 
    				reply_id=0 
    				AND uid=1
    			ORDER BY 
    				id DESC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aRecord = $res->result_array();
    	return $aRecord;
    }
    
    /**
     * 获取评论信息
     */
    function getComment($iRecord) {
		$sql = 'SELECT
    				*
    			FROM
    				blog_comment
    			WHERE
    				comment_type="record"
    				AND comment_id=" '.$iRecord.' "
    			ORDER BY
    				id DESC';
		$res = $this->db->query($sql);
		$aComment = $res->result_array();
		$sComment = '';
		if(!empty($aComment)) {
			foreach ($aComment as $val) {
				if($val['userid'] > 0) {
					$name = getUserInfo($val['userid'],'username');
				} else {
					$name = $val['author'];
				}
				$sComment .= "<li id=\"reply_{$val['id']}\">
		    				<a class=\"name\" href=\"{$val['url']}\">{$name}：</a>
		    				<span class=\"cont\">".stripcslashes($val['comment'])."</span><br/>
		    				<span class=\"time\">{$val['datetime']}</span>
		    			 </li>";
			}
		}
		return $sComment;
    }
    
    /**
     * 执行评论添加
     */
    function doComment($data) {
    	$this->db->insert('comment',$data);
    	$iInsert = $this->db->insert_id();
    	return $iInsert;
    }
    
    /**
     * 修改说说评论数量
     */
    function updRecord($iRecord,$sNum) {
    	$sql = 'UPDATE
    				blog_record
    			SET
    				 comnum=comnum+'.$sNum.'
    			WHERE
    				id='.$iRecord;
    	$res = $this->db->query($sql);
    }
}