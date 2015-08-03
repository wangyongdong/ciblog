<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Record_model extends CI_Model  {
    function __construct() {
        parent::__construct();		//构造函数里面要调用父类的构造方法
        $this->load->database();	//加载数据库,数据库名称在Config文件里面配置。
    }
    
 	/**
     * 执行说说添加
     */
    function doRecord($data) {
    	$this->db->insert('record',$data);
   	 	$iInsert = $this->db->insert_id();
    	return $iInsert;
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
    				AND uid='.$_SESSION['uid'].' 
    			ORDER BY 
    				id DESC
    			'.$sLimit;
    	$res = $this->db->query($sql);
    	$aRecord = $res->result_array();
    	return $aRecord;
    }
    
	/**
     * 删除说说
     */
    function delRecord($iRecord) {
    	$affect = $this->db->delete('record',array('id'=>$iRecord));
    	if(!empty($affect)) {
    		//删除说说下的评论
    		$this->db->delete('comment',array('comment_id'=>$iRecord,comment_type=>'record'));
    	}
    	return $affect;	//成功返回1
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
    /**
     * 添加评论
     */
    function doComment($data) {
    	$this->db->insert('comment',$data);
    	$iInsert = $this->db->insert_id();
    	return $iInsert;
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
				$name = $val['userid'] ? getUser($val['userid'],'username') : $val['author'];
				$sComment .= "
							 <li id=\"reply_{$val['id']}\" style=\"\">
							 	<a class=\"name\">{$name}：</a> {$val['comment']}
							 	<span class=\"time\">{$val['datetime']}</span>
							 	<a href=\"javascript: delComment({$val['id']},{$iRecord});\">删除</a> 
							 	<em><a href=\"javascript:reply({$iRecord}, '@{$name}：');\">评论</a></em>
							 </li>";
			}
    	}
		return $sComment;
    }
	/**
     * 删除回复
     */
    function delComment($iComment) {
    	$affect = $this->db->delete('comment',array('id'=>$iComment));
    	return $affect;
    }
    
}