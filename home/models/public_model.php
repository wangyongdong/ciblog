<?php
/**
 * 获取公共信息模型
 * @author WangYongDong
 */
class Public_model extends CI_Model{
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 加载页面
	 * @param string $sTitle
	 * @param string $sHeader
	 * @param string $sView
	 * @param array $aData
	 */
	public function loadView($aMeta,$sHeader,$sView,$aData='') {
		//获取首页站点标题信息，和导航信息
		$info = $this->getWebInfo();
		$data['webinfo'] = $info;
		$data['title'] = $aMeta['title'];
		$data['keywords'] = $aMeta['keywords'];
		$data['description'] = $aMeta['description'];
		$data['header'] = $sHeader;
		$this->load->view('public/header',$data);
		$this->load->view($sView,$aData);
		$this->load->view('public/footer');
	}
	
	/**
	 * 获取网站标题和说明
	 */
	public function getWebInfo() {
		$sql = 'SELECT 
					option_name,option_value 
				FROM 
					blog_options 
				LIMIT 2';
		$res = $this->db->query($sql);
    	$result = $res->result_array();
    	foreach ($result as $row) {
    		$name = $row['option_name'];
    		$arr[$name] = $row['option_value'];	//已name值做键
    		$list = $arr;
    	}
    	return $list;
	}
	
	/**
	 * 获取首页个人信息
	 */
	public function getBloggerInfo() {
		$uid = empty($_SESSION['uid']) ? 1 : $_SESSION['uid'];
		$sql = 'SELECT 
					username,job,address,email,qq,about_me 
				FROM 
					blog_member 
				WHERE 
					id='.$uid;
		$res = $this->db->query($sql);
		$list = $res->row_array();
		return $list;
	}
	
	/**
	 * 调用分页类
	 */
	public function getPage($sTable,$sUrl,$pageId,$iPageNum=10,$sFilter='') {
		//调用page类
		$this->load->library('page');
		$iCount = getPageCount($sTable,$sFilter);
		$iPageSize = $iPageNum;
		$this->page->loadPage($iCount,$iPageSize,$sUrl);
		
		//总页数
		$num_pages = ceil($iCount/$iPageSize);
		if($pageId>$num_pages) {
			$pageId = $num_pages;
		}
		if($pageId<0) {
			$pageId = 1;
		}
		$arr = $this->page->getParam($iPageSize,$pageId);
		return $arr;
	}
	/**
	 * 添加消息提醒
	 */
	public function addNotice($aNotice) {
		$arr = array();
		$arr['type'] = $aNotice['type'];
		if($arr['type'] == 'record') {
			//获取说说标题
			$title = getRecordTitle($aNotice['comment_id']);
			$sRtnUrl = HOST.'/admin/record/rnew';
			$arr['content'] = '用户  <font color="blue">'.$aNotice['author'].'</font> 评论了您的说说 "'.$title.'"，<a href="' . $sRtnUrl . '" target="_blank">去看看>></a>';
		}
		if($arr['type'] == 'article') {
			$sRtnUrl = HOST.'/admin/comment/update/'.$aNotice['id'];
			$arr['content'] = '用户  <font color="blue">'.$aNotice['author'].'</font> 评论了您的文章，<a href="' . $sRtnUrl . '" target="_blank">去看看>></a>';
		}
		if($arr['type'] == 'contact') {
			$sRtnUrl = HOST.'/admin/comment/update/'.$aNotice['id'];
			$arr['content'] = '用户  <font color="blue">'.$aNotice['author'].'</font> 给你留言了，<a href="' . $sRtnUrl . '" target="_blank">去看看>></a>';
		}
		if($arr['type'] == 'links') {
			$sRtnUrl = HOST.'/admin/links/update/'.$aNotice['id'];
			$arr['content'] = '有新的友情链接申请，请审核，<a href="' . $sRtnUrl . '" target="_blank">去看看>></a>';
		}
		$arr['status'] = 'unread';
		$arr['datetime'] = date("Y-m-d H:i:s",time());
		$this->db->insert('notice',$arr);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
	
	/**
	 * 添加访问log
	 */
	public function addLog() {
		$data = array();
		$data['url'] = uri_string();
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		$this->db->insert('log',$data);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
	
	/**
	 * 友情链接申请
	 */
	public function doLinks($data) {
		$this->db->insert('links',$data);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
}