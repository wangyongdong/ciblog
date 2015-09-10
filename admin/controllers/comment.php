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
		$data['list'] = $this->comment_model->getComment($arr['start'],$arr['pagenum'],$data['aFilter']);
		$data['token'] = getToken($this->tokentype);
		$data['nav'] = 'comcon';
		$data['footer'] = 'upload';
		$this->comment_model->doRead();//标记已读
		
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
		$data['token'] = getToken($this->tokentype);
		$data['nav'] = 'comcon';
		
		$this->load->view('public/header',$data);
		$this->load->view('comment/comment_edit',$data);
		$this->load->view('public/footer',$data);
	}
	/**
	 * 修改留言
	 */
	public function doComment() {
		$data = array();
		$data['id'] = sg($_POST['id']);
		$data['author'] = sg($_POST['author']);
		$data['email'] = sg($_POST['email']);
		$data['url'] = sg($_POST['url']);
		$data['content'] = sg($_POST['content']);
		$data['status'] = sg($_POST['status']);
		
		$arr = array($data['content']);//数据验证
		checkEmpty($arr);
		checkToken($_POST['token'],$this->tokentype);//token验证
	
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
			$data['reply_id'] = sg($_POST['reply_id']);
			$data['comment_id'] = sg($_POST['comment_id']);
			$data['userid'] = UserId();
			$data['author'] = UserName();
		}
		$data['content'] = sg($_POST['reply_content']);
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		$arr = array($data['content']);//数据验证
		checkEmpty($arr);
		
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
		//遍历执行
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
		//遍历执行
		$affects = 0;
		for($i=0;$i<count($aComment);$i++) {
			$affect = $this->comment_model->doHide($aComment[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
}