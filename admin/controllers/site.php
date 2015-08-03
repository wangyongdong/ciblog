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
		
		$affect = $this->site_model->doSiteWeb($data);
		if($affect) {
			echo 'success';
		}
		//headers(site_url('site/web_site'),'active_s','操作成功');
		
	}
	
	/**
	 * 获取SEO设置页面
	 */
	public function seo_site() {
		$data['list'] = $this->site_model->getSiteSeo();
		$this->load->view('site/seo_site',$data);
	}
	
	/**
	 * 执行SEO信息修改
	 */
	public function seoUpdate() {
		$site_list = array();
		$site_list['site_title'] = sg($_POST['site_title']);
		$site_list['site_key'] = sg($_POST['site_key']);
		$site_list['site_description'] = sg($_POST['site_description']);
	
		$affect = $this->site_model->updateSiteWeb($site_list);
		headers(site_url('site/seo_site'),'active_s','操作成功');
		
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
		
		//输入数据验证
		//$arr = array($data['menu_name'],$data['menu_alias']);
		//checkEmpty($arr,$data['id'],'site/menu_site','site/updateMenu/');
		
		$affect = $this->site_model->doMenu($data);
		if($affect) {
			//headers(site_url('site/menu_site'),'active_s','操作成功');
			echo 'success';
		}
	}
	
	/**
	 * 删除menu
	 */
	public function delMenu() {
		$id = sg($_POST['id']);
		$affect = $this->site_model->delMenu($id);
		echo $affect;
	}
	
}