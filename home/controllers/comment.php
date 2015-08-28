<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends MY_Controller {
	var $tokentype = 'article';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 添加文章评论
	 */
	public function doComment() {
		$data = array();
		$data['comment_id'] = sg($this->input->post('id', TRUE));
		$data['author'] = sg($this->input->post('name', TRUE));
		$data['email'] = sg($this->input->post('email', TRUE));
		$data['url'] = prep_url(sg($this->input->post('url', TRUE)));
		$data['content'] = sg($this->input->post('comment', TRUE));
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		if (empty($data['comment_id']) || empty($data['author']) || empty($data['email']) || empty($data['content'])) {
			localCommon('数据信息不完整。');
		} else if (mb_strlen($data['author']) < 2 || mb_strlen($data['author']) > 16) {
			localCommon('用户名在2-16个字符。');
		} else if (!is_email($data['email'])) {
			localCommon('邮箱格式不正确。');
		} else if (mb_strlen($data['content']) < 2 || mb_strlen($data['content']) > 500) {
			localCommon('评论内容在2-500个字符。');
		}
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		$iInsert = $this->comment_model->doComment($data);
		if(!empty($iInsert)) {
			$this->comment_model->updArticle($data['comment_id'],'1');
			//添加提醒
			$aNotice = array();
			$aNotice['type'] = 'comment';
			$aNotice['author'] = $data['author'];
			$aNotice['id'] = $iInsert;
			$this->public_model->addNotice($aNotice);
			//跳转
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
}