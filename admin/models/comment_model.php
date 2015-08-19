<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /**
     * 获取评论
     */
    function getComment($iStart=0,$iPageNum=10,$aFilter='') {
    	$sLimit = ' LIMIT '.$iStart.','.$iPageNum;
    	$sql = 'SELECT
    				*
    			FROM
    				blog_comment
    			WHERE
    				1=1 ';
    	if(!empty($aFilter['keyword'])) {
    		if(is_numeric($aFilter['keyword'])) {
    			$sql .= ' AND comment_id = '.$aFilter['keyword'];
    		} else {
    			$sql .= ' AND author LIKE"%'.$aFilter['keyword'].'%"';
    		}
    	}
    	$sql .= ' ORDER BY
    				id DESC '.$sLimit;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	return $list;
    }
    
    /**
     * 获取评论详情
     */
    function getCommentInfo($iComment) {
    	if(empty($iComment)) {
    		return false;
    	}
    	$sql = 'SELECT
    				*
    			FROM
    				blog_comment
    			WHERE
    				id='.$iComment;
    	$res = $this->db->query($sql);
    	$list = $res->row_array();
    	return $list;
    }
    
    /**
     * 获取回复信息
     */
    function getCommentReply($iComment) {
    	$sql = 'SELECT
    				id,reply_id,comment_id,content
    			FROM
    				blog_comment
    			WHERE
    				reply_id='.$iComment;
    	$res = $this->db->query($sql);
    	$list = $res->result_array();
    	return $list;
    }
    
    /**
     * 修改评论信息
     */
    function doComment($data) {
    	$this->db->update('comment',$data,array('id'=>$data['id']));
    	$affect = $this->db->affected_rows();
    	//添加操作log
    	$this->site_model->addActionLog('comment','update');
    	return $affect;
    }
    
    /**
     * 添加评论回复
     */
    function doReply($data) {
    	if(empty($data['id'])) {
    		$this->db->insert('comment', $data);
    		//添加操作log
    		$this->site_model->addActionLog('comment','add');
    		
    		//修改评论数量
    		$this->updArticle($data['comment_id']);
    		
    		//邮件发送
    		$arr = $this->public_model->commentEmail($data['reply_id'],$data['author'],$data['content']);
    		$this->public_model->sendMail($arr['email'],$arr['subject'],$arr['content']);
    	} else {
    		$this->db->update('comment',$data,array('id'=>$data['id']));
    		//添加操作log
    		$this->site_model->addActionLog('comment','update');
    	}
    	$affect = $this->db->affected_rows();
    	return $affect;
    }
    
    /**
     * 执行删除
     */
    function doDel($iComment) {
    	$affect = $this->db->delete('comment',array('id'=>$iComment));
    	//添加操作log
    	$this->site_model->addActionLog('comment','delete');
    	return $affect;
    }
    
    /**
	 * 修改文章评论数量
	 */
	function updArticle($iArticle) {
		$sql = 'UPDATE
    				blog_article
    			SET
    				 comnum=comnum+1
    			WHERE
    				id='.$iArticle;
		$res = $this->db->query($sql);
	}
	
	/**
	 * 标记已读状态
	 */
	function doRead() {
		$sql = 'UPDATE
    				blog_comment
    			SET
    				is_read="Y"
    			WHERE
    				is_read="N"';
		$res = $this->db->query($sql);
		return $res;
	}
	
	/**
	 * 标记隐藏状态
	 */
	function doHide($iComment) {
		$sql = 'UPDATE
    				blog_comment
    			SET
    				 status="hide"
    			WHERE
    				id='.$iComment;
		$res = $this->db->query($sql);
		return $res;
	}
}