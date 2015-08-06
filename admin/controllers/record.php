<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义说说相关类
 * @author WangYongdong
 */
class Record extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 说说
	 */
	public function index() {
		//获取用户信息
		$data['user'] = getUser(1);
		
		//分页执行
		$pageId = $this->input->get('page');
		$sFilter = ' AND reply_id=0 ';
		$arr = $this->public_model->getPage("record",'record/index?',$pageId,$sFilter);
		//执行查询
		$data['list'] = $this->record_model->getRecordList($arr['start'],$arr['pagenum']);
		
		$this->load->view('public/header',$data);
		$this->load->view('record/index',$data);
		$this->load->view('public/footer',$data);		
	}
	
	/**
	 * 执行发布
	 */
	public function doRecord() {
		$data = array();
		$data['uid'] = 1;
		$data['content'] = sg($_POST['content']);
		$data['datetime'] = date("Y-m-d H:i:s",time());
		//输入数据验证
		//$arr = array($data['uid'],$data['content']);
		//checkEmpty($arr,'','record/rnew','record/rnew/');
		$affect = $this->record_model->doRecord($data);
		if($affect) {
			//header("Location:".$_SERVER["HTTP_REFERER"]);
		}
	}
	
	/**
	 * 删除说说
	 */
	public function doDel($iRecord) {
		$iRecord = sg($_POST['id']);
		$affect = $this->record_model->delRecord($iRecord);
		echo $affect;
	}
	
	/**
	 * 获取评论信息
	 */
	public function getComment() {
		$iRecord = sg($_POST['id']);
		$list = $this->record_model->getComment($iRecord);
		echo $list;
	}
	
	/**
	 * 删除评论
	 */
	public function delComment() {
		$iComment = sg($_POST['cid']);
		$iRecord = sg($_POST['id']);
		$affect = $this->record_model->delComment($iComment);
		//执行数量减少
		$affect = $this->record_model->updRecord($iRecord,'-1');
		echo $affect;
	}
	
	/**
	 * 发布回复
	 */
	public function doComment() {
		$data = array();
		$data['comment_id'] = sg($_POST['id']);
		$data['comment_type'] = 'record';
		$data['userid'] = sg($_SESSION['uid'],'');
		$data['author'] = getUser($_SESSION['uid'],'username');
		$data['email'] = '';
		$data['url'] = '';
		$data['comment'] = sg($_POST['comment']);
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		if (empty($data['comment']) || strlen($data['comment']) > 420) {
			exit('err1');	//长度问题
		}
		
		$iInsert = $this->record_model->doComment($data);
		if(!empty($iInsert)) {
			$this->record_model->updRecord($data['comment_id'],'1');//执行数量增加
		}
		$name = getUser($data['userid'],'username');
		$response = '';
		$response .= "
			<li id=\"reply_{$iInsert}\" style=\"\">
			<span class=\"name\">{$name}：</span> {$data['comment']}<span class=\"time\">{$data['datetime']}</span>
			<a href=\"javascript: delComment({$iInsert},{$data['comment_id']});\">删除</a>
			<em><a href=\"javascript:reply({$data['comment_id']}, '@{$name}：');\">评论</a></em>
			</li>";
		echo $response;
		
	}
}