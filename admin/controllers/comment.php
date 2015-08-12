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
		$data['aFilter']['keyword'] = sg($this->input->get('s'));
		//分页执行
		$pageId = $this->input->get('page');
		//搜索条件
		$sFilter = '';
		if(!empty($data['aFilter']['keyword'])) {
			if(is_numeric($data['aFilter']['keyword'])) {
				$sFilter = ' AND comment_id = '.$data['aFilter']['keyword'];
			} else {
				$sFilter = ' AND author LIKE"%'.$data['aFilter']['keyword'].'%"';
			}
		}
		$arr = $this->public_model->getPage("comment",'comment?',$pageId,$sFilter);
		//文章评论
		$data['list'] = $this->comment_model->getComment($arr['start'],$arr['pagenum'],$data['aFilter']);
		//token
		$data['token'] = getToken($this->tokentype);
		
		//标记已读
		$this->comment_model->doRead();
		
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
		$arr = array($data['content']);
		checkEmpty($arr);
		//token验证
		checkToken($_POST['token'],$this->tokentype);
	
		$this->comment_model->doComment($data);
		succes(site_url('comment'));
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
		$arr = array($data['content']);
		checkEmpty($arr);
		//token验证
		checkToken($_POST['token'],$this->tokentype);
	
		$this->comment_model->doReply($data);
		succes(site_url('comment'));
	}
	/**
	 * 删除操作
	 */
	public function doDel() {
		$iComment = sg($_POST['id']);
		$affect = $this->comment_model->doDel($iComment);
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
	
	/**
	 * 标记隐藏状态
	 */
	public function doHide() {
		$sId = sg($_POST['id']);
		//将获取到的值进行拆分，重组
		$aComment = explode(",",trim($sId,','));
		//遍历删除
		$affects = 0;
		for($i=0;$i<count($aComment);$i++) {
			$affect = $this->comment_model->doHide($aComment[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
}