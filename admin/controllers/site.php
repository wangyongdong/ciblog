<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义网站设置相关类
 * @author WangYongdong
 */
class Site extends MY_Controller {
	var $tokentype = 'site';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 网站设置
	 */
	public function web() {
		$data['list'] = $this->site_model->getSiteWeb();
		
		//token
		$data['token'] = getToken($this->tokentype);
		//导航
		$data['nav'] = 'site';
		
		$this->load->view('public/header',$data);
		$this->load->view('site/site_web',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 执行网站信息修改
	 */
	public function doSiteWeb() {
		$data = array();
		$sType = sg($_POST['type']);
		if($sType == 'basic') {
			$data['sitename'] = sg($_POST['sitename']);
			$data['sitesign'] = sg($_POST['sitesign']);
			$data['siteauthor'] = sg($_POST['siteauthor']);
			$data['article_nums'] = sg($_POST['article_nums']);
			$data['copr_info'] = sg($_POST['copr_info']);
			$data['icp'] = sg($_POST['icp']);
			$data['footer_info'] = sg($_POST['footer_info']);
			$data['web_status'] = sg($_POST['web_status']);
			$data['close_info'] = sg($_POST['close_info']);
		}
		if($sType == 'att') {
			$data['img_type'] = sg($_POST['img_type']);
			$data['img_size'] = sg($_POST['img_size']);
		}
		if($sType == 'rc') {
			$data['is_record'] = sg($_POST['is_record']);
			$data['record_nums'] = sg($_POST['record_nums']);
			$data['record_comment'] = sg($_POST['record_comment']);
			$data['record_comment_nums'] = sg($_POST['record_comment_nums']);
			$data['record_check'] = sg($_POST['record_check']);
		}
		if($sType == 'ac') {
			$data['is_comment'] = sg($_POST['is_comment']);
			$data['comment_interval'] = sg($_POST['comment_interval']);
			$data['comment_check'] = sg($_POST['comment_check']);
			$data['comment_nums'] = sg($_POST['comment_nums']);
		}
		
		$this->site_model->doSiteWeb($data);
		succes(site_url('site/web'));
	}
	
	/**
	 * Menu设置
	 */
	public function menu() {
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("menu",'site/menu?',$pageId);
		//执行查询
		$data['list'] = $this->site_model->getSiteMenu('',$arr['start'],$arr['pagenum']);
		//token
		$data['token'] = getToken($this->tokentype);
		//导航
		$data['nav'] = 'site';
		
		$this->load->view('public/header',$data);
		$this->load->view('site/site_menu',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 获取修改导航页面
	 */
	public function updateMenu() {
		$id = $this->uri->segment(3);
		$data['list'] = $this->site_model->getSiteMenu($id);
		//token
		$data['token'] = getToken($this->tokentype);
		//导航
		$data['nav'] = 'site';
		
		$this->load->view('public/header',$data);
		$this->load->view('site/site_menu_edit',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 添加,修改 menu
	 */
	public function doMenu() {
		$data = array();
		if(!empty($_POST['id'])) {
			$data['id'] = sg($_POST['id']);
		}
		$data['menu_name'] = sg($_POST['name']);
		$data['menu_alias'] = sg($_POST['alias']);
		$data['menu_desc'] = sg($_POST['desc']);
		$data['status'] = sg($_POST['status']);
		
		//数据验证
		$arr = array($data['menu_name'],$data['menu_alias']);
		checkEmpty($arr);
		
		$this->site_model->doMenu($data);
		succes(site_url('site/menu'));
	}
	
	/**
	 * 删除menu
	 */
	public function delMenu() {
		$id = sg($_POST['id']);
		$affect = $this->site_model->delMenu($id);
		echo $affect;
	}
	
	/**
	 * 信息统计
	 */
	public function statistic() {
		//获取统计信息
		$data['record'] = getStatis('record');
		$data['comment'] = getStatis('comment');
		$data['contact'] = getStatis('contact',' WHERE userid=0 ');
		$data['links'] = getStatis('links');
		$data['view'] = getStatis('log');
		
		$data['data'] = $this->site_model->getVisitStatistic();
		$data['arr'] = $this->site_model->getmoduleStatistic();
		//导航
		$data['nav'] = 'site';
		
		$this->load->view('public/header',$data);
		$this->load->view('site/site_statistic',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 操作日志
	 */
	public function action() {
		$data['aFilter']['start'] = sg($this->input->get('ds'));
		$data['aFilter']['end'] = sg($this->input->get('de'));
		//执行查询
		$data['list'] = $this->site_model->getAction($data['aFilter']);
		//导航
		$data['nav'] = 'site';
		
		$this->load->view('public/header',$data);
		$this->load->view('site/site_log_action',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 删除操作日志
	 */
	public function delActionLog() {
		$affect = $this->site_model->delActionLog();
		return $affect;
	}
	
	/**
	 * notice
	 */
	public function notice() {
		$data['data'] = 1;
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("notice",'site/notice?',$pageId);
		//执行查询
		$data['notice'] = $this->site_model->getNotice($arr['start'],$arr['pagenum']);
		//导航
		$data['nav'] = 'site';
		
		$this->load->view('public/header',$data);
		$this->load->view('site/site_notice',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 删除notice
	 */
	public function delNotice() {
		$sId = sg($_POST['id']);
		//将获取到的值进行拆分，重组
		$aId = explode(",",trim($sId,','));
		//遍历删除
		$affects = 0;
		for($i=0;$i<count($aId);$i++) {
			$affect = $this->site_model->delNotice($aId[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
	
	/**
	 * 修改notice
	 */
	public function updNotice() {
		$sId = sg($_POST['id']);
		//将获取到的值进行拆分，重组
		$aId = explode(",",trim($sId,','));
		//遍历删除
		$affects = 0;
		for($i=0;$i<count($aId);$i++) {
			$affect = $this->site_model->updNotice($aId[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
	
	/**
	 * 数据备份
	 */
	public function backup() {
		$data['data'] = 1;
		//导航
		$data['nav'] = 'site';
		
		$this->load->view('public/header',$data);
		$this->load->view('site/site_backup',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 执行备份
	 */
	public function doBackup() {
		$module = $this->uri->segment(3);
		if($module == 'db') {
			$this->site_model->dbBackup();
		}
		if($module == 're') {
			$this->site_model->reBackup();
		}
		if($module == 'up') {
			$this->site_model->upBackup();
		}
	}
	
	/**
	 * 缓存
	 */
	public function cache() {
		$data['data'] = 1;
		//导航
		$data['nav'] = 'site';
		
		$this->load->view('public/header',$data);
		$this->load->view('site/site_cache',$data);
		$this->load->view('public/footer',$data);
	}
	
}