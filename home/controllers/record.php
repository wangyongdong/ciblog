<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Record extends MY_Controller {
	var $tokentype = 'record';
	
	public function __construct() {
		parent::__construct();
	}
	/**
	 * 说说列表
	 */
	public function index() {
		//分页执行
		$pageId = $this->input->get('page');
		$sPageNum = getSet('record_nums');
		$arr = $this->public_model->getPage("record",'record/index?',$pageId,$sPageNum);
		$data['record'] = $this->record_model->getRecordList($arr['start'],$arr['pagenum']);
		
		//token
		$data['token'] = getToken($this->tokentype);
		
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '碎言碎语'.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'record';
		$this->public_model->loadView($aMeta,$sHeader,'record',$data);
		
	}
	
	/**
	 * 获取评论信息
	 */
	public function getComment() {
		$iRecord = sg($_POST['id']);
		//查询回复
		$aRtn['comment'] = $this->record_model->getComment($iRecord);
		echoAjax($aRtn);
	}
	
	/**
	 * 执行评论
	 */
	public function doComment() {
		$data = array();
		$data['comment_id'] = sg($this->input->post('id', TRUE));
		$data['comment_type'] = 'record';
		$data['userid'] = 0;
		$data['author'] = sg($this->input->post('name', TRUE));
		$data['email'] = sg($this->input->post('email', TRUE));
		$data['url'] = prep_url(sg($this->input->post('url', TRUE)));
		$data['comment'] = sg($this->input->post('comment', TRUE));
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		if (empty($data['comment_id']) || empty($data['author']) || empty($data['email']) || empty($data['comment'])) {
			$aRtn['error'] = '数据信息不完整';
			echoAjax($aRtn);
		} else if (mb_strlen($data['author']) < 2 || mb_strlen($data['author']) > 16) {
			$aRtn['error'] = '用户名在2-16个字符';
			echoAjax($aRtn);
		} else if (!is_email($data['email'])) {
			$aRtn['error'] = '邮箱格式不正确';
			echoAjax($aRtn);
		} else if (mb_strlen($data['comment']) < 2 || mb_strlen($data['comment']) > 500) {
			$aRtn['error'] = '评论内容在2-500个字符';
			echoAjax($aRtn);
		}
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		$iInsert = $this->record_model->doComment($data);
		if(!empty($iInsert)) {
			$this->record_model->updRecord($data['comment_id'],'1');//执行数量增加
			$aNotice = array();
			$aNotice['type'] = 'record';
			$aNotice['comment_id'] = $data['comment_id'];
			$aNotice['author'] = $data['author'];
			$aNotice['id'] = $iInsert;
			$this->public_model->addNotice($aNotice);
		}
		$name = $data['userid'] ? getUserInfo($data['userid'],'username') : $data['author'];
		$aRtn['comment'] = '';
		$aRtn['comment'] .= "<li id=\"reply_{$iInsert}\">
					  	<a class=\"name\" href=\"{$data['url']}\">{$name}：</a>
						<span class=\"cont\">".stripcslashes($data['comment'])."</span><br/>
						<span class=\"time\">{$data['datetime']}</span>
					  </li>";
		echoAjax($aRtn);
	}
}