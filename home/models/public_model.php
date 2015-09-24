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
		$all_cache = getSet('all_cache');
		$view_cache = getSet('view_cache');
		if($all_cache == 'y' && $view_cache == 'y') {
			//开启网页缓存
			$cache_time = $this->config->item('web_cache');
			$this->output->cache($cache_time[$sView]);
		}
		
		//获取首页站点标题信息，和导航信息
		$info = $this->getWebInfo();
		$data['webinfo'] = $info;
		$data['title'] = $aMeta['title'];
		$data['keywords'] = $aMeta['keywords'];
		$data['description'] = $aMeta['description'];
		$data['header'] = $sHeader;
		if(!empty($aData['aFilter']['q'])) {
			$data['aFilter']['q'] = $aData['aFilter']['q'];
		}
		$this->load->view('public/header',$data);
		$this->load->view($sView,$aData);
		$this->load->view('public/footer');
	}
	/**
	 * 获取网站标题和说明
	 */
	public function getWebInfo() {
    	$cache_time = $this->config->item('data_cache');
    	$cache_path = CacheModule('web_info');
    	if(readCache($cache_path)) {
    		@include $cache_path;
    		$list = @$arr['info'];
    	} else {
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
    		//写入缓存
    		writeCache($list, $cache_path, $cache_time['time']);
    	}
    	return $list;
	}
	/**
	 * 获取首页个人信息
	 */
	public function getBloggerInfo() {
		$cache_time = $this->config->item('data_cache');
		$cache_path = CacheModule('blogger_info');
		if(readCache($cache_path)) {
			@include $cache_path;
			$list = @$arr['info'];
		} else {
			$uid = empty($_SESSION['uid']) ? 1 : $_SESSION['uid'];
			$sql = 'SELECT
					username,job,address,email,qq,about_me
				FROM
					blog_member
				WHERE
					id='.$uid;
			$res = $this->db->query($sql);
			$list = $res->row_array();
			//写入缓存
			writeCache($list, $cache_path, $cache_time['time']);
		}
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
		if($arr['type'] == 'comment') {
			$arr['content'] = '用户  <font color="blue">'.$aNotice['author'].'</font> 评论了您的文章.';
		}
		if($arr['type'] == 'contact') {
			$arr['content'] = '用户  <font color="blue">'.$aNotice['author'].'</font> 给你留言了.';
		}
		if($arr['type'] == 'links') {
			$arr['content'] = '有新的友情链接申请，请审核.';
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
		$data['referer_url'] = sg($_SERVER['HTTP_REFERER'],'');
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		$this->db->insert('log',$data);
		$iInsert = $this->db->insert_id();
		return $iInsert;
	}
	
}