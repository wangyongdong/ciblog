<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends MY_Controller {
	var $tokentype = 'article';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 获取文章评论
	 */
	public function getComment($iArticle='',$iStart=0,$iPageNum=5) {
		if(empty($iArticle)) {
			$iArticle = $_POST['id'];
		}
		if(!empty($_POST['start'])) {
			$iStart = $_POST['start'];
		}
		if(!empty($_POST['limit'])) {
			$iPageNum = $_POST['limit'];
		}
		//查询回复
		$aComment = $this->comment_model->getComment($iArticle,$iStart,$iPageNum);
		if(!empty($_POST['type'])) {
			$str = '';
			$i = 0;
			foreach ($aComment as $key=>$value) {
				$str .= '<li>
							<a class="author" href="'.$value['url'].'">'.$value['author'].'：</a>
							<span class="cont">'.$value['comment'].'</span><br>
							<span class="time">'.$value['datetime'].'</span>
						 </li>';
				$i++;
			}
			$aRtn['comment'] = $str;
			$aRtn['num'] = $i;
			echoAjax($aRtn);
		}
		return $aComment;
	}
	
	/**
	 * 文章评论
	 */
	public function doComment() {
		$data = array();
		$data['comment_id'] = sg($this->input->post('id', TRUE));
		$data['comment_type'] = 'article';
		$data['author'] = sg($this->input->post('name', TRUE));
		$data['email'] = sg($this->input->post('email', TRUE));
		$data['url'] = prep_url(sg($this->input->post('url', TRUE)));
		$data['comment'] = sg($this->input->post('comment', TRUE));
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		if (empty($data['comment_id']) || empty($data['author']) || empty($data['email']) || empty($data['comment'])) {
			localCommon('数据信息不完整。');
		} else if (mb_strlen($data['author']) < 2 || mb_strlen($data['author']) > 16) {
			localCommon('用户名在2-16个字符。');
		} else if (!is_email($data['email'])) {
			localCommon('邮箱格式不正确。');
		} else if (mb_strlen($data['comment']) < 2 || mb_strlen($data['comment']) > 500) {
			localCommon('评论内容在2-500个字符。');
		}
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		$iInsert = $this->comment_model->doComment($data);
		if(!empty($iInsert)) {
			$this->comment_model->updArticle($data['comment_id'],'1');//执行数量增加
			//添加提醒
			$aNotice = array();
			$aNotice['type'] = 'article';
			$aNotice['author'] = $data['author'];
			$aNotice['id'] = $iInsert;
			$this->public_model->addNotice($aNotice);
			//跳转
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
}