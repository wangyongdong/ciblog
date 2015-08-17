<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义友情链接类别相关类
 * @author WangYongdong
 */
class Links extends MY_Controller {
	var $tokentype = 'links';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 获取列表
	 */
	public function index() {
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("links",'links?',$pageId);
		//执行查询
		$data['list'] = $this->links_model->getLinksList($arr['start'],$arr['pagenum']);

		//token
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('public/header',$data);
		$this->load->view('links/links_list',$data);
		$this->load->view('public/footer',$data);
		
	}
	
	/**
	 * 获取修改页
	 */
	public function update() {
		$iLinks = $this->uri->segment(3);
		$data['list'] = $this->links_model->getLinksInfo($iLinks);
		//token
		$data['token'] = getToken($this->tokentype);
		$this->load->view('public/header',$data);
		$this->load->view('links/links_edit',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 新增信息
	 */
	public function doLinks() {
		$data = array();
		if(!empty($_POST['id'])) {		//修改
			$data['id'] = sg($_POST['id']);
		} else {						//添加
			$data['datetime'] =  date("Y-m-d H:i:s",time());
		}
		$data['sitename'] = sg($_POST['name']);
		$data['siteurl'] = prep_url(sg($_POST['url']));
		$data['description'] = sg($_POST['description']);
		$data['status'] = sg($_POST['status']);
		
		//数据验证
		$arr = array($data['sitename'],$data['siteurl']);
		checkEmpty($arr);
		
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		$this->links_model->doLinks($data);
		succes(site_url('links'));
	}
	
	/**
	 * 删除类别
	 */
	public function doDel() {
		$id = sg($_POST['id']);
		$affect = $this->links_model->doDel($id);
		return $affect;
	}
	
}