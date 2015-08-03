<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义评论相关类
 * @author WangYongdong
 */
class Comment extends MY_Controller {
	var $tokentype = 'comment';
	
	public function __construct() {
		parent::__construct();
	}
	/**
	 * 获取评论列表
	 */
	public function index() {
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("comment",'comment/index?',$pageId);
		//文章评论
		$data['list'] = $this->comment_model->getComment($arr['start'],$arr['pagenum']);
		//token
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('public/header',$data);
		$this->load->view('comment/comment_list',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 获取评论修改页
	 */
	public function update() {
		$iComment = $this->uri->segment(3);
		$data['list'] = $this->comment_model->getCommentInfo($iComment);
		
		$data['reply'] = $this->comment_model->getCommentReply($iComment);
		//token
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('public/header',$data);
		$this->load->view('comment/comment_edit',$data);
		$this->load->view('public/footer',$data);
	}
	/**
	 * 修改留言
	 */
	public function doComment() {
		$data = array();
		$data['id'] = sg($_POST['id']);				//id
		$data['author'] = sg($_POST['author']);		//评论人
		$data['email'] = sg($_POST['email']);		//email
		$data['url'] = sg($_POST['url']);			//url
		$data['content'] = sg($_POST['content']);	//内容
		$data['status'] = sg($_POST['status']);		//状态
		//数据验证
		//token验证
		checkToken($_POST['token'],$this->tokentype);
	
		$affect = $this->comment_model->doComment($data);
		if($affect) {
			//headers(site_url($successHref),'active_s','文章操作成功');
		}
	}
	/**
	 * 添加回复
	 */
	public function doReply() {
		$data = array();
		if(!empty($_POST['id'])) {
			$data['id'] = sg($_POST['id']);
		} else {
			$data['reply_id'] = sg($_POST['reply_id']);		//回复id
			$data['comment_id'] = sg($_POST['comment_id']);	//文章id
			//$data['userid'] = UserId();						//userid
			//$data['author'] = UserName();					//用户名
			$data['userid'] = 1;						//userid
			$data['author'] = '王永东';					//用户名
		}
		
		$data['content'] = sg($_POST['content']);			//内容
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
	
		//数据验证
		//token验证
		checkToken($_POST['token'],$this->tokentype);
	
		$affect = $this->comment_model->doReply($data);
		if($affect) {
			//headers(site_url($successHref),'active_s','文章操作成功');
		}
	
	}
	/**
	 * 删除操作
	 */
	public function doDel() {
		$iContact = sg($_POST['id']);
		$affect = $this->comment_model->doDel($iContact);
		echo $affect;
	}
	
	/**
	 * 批量删除
	 */
	public function doDelAll() {
		$sId = sg($_POST['id']);
		//将获取到的值进行拆分，重组
		$aId = explode(",",trim($sId,','));
		//遍历删除
		$affects = 0;
		for($i=0;$i<count($aId);$i++) {
			$affect = $this->comment_model->doDel($aId[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
}