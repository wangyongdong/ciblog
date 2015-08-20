<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works extends MY_Controller {
	const ARTICLE_VIEWS = 'views';
	const ARTICLE_COM = 'comnum';
	const ARTICLE_NEW = 'datetime';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		//执行分页
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("works",'works/index?',$pageId);
		//作品列表
		$data['works'] = $this->works_model->getWorksList($arr['start'],$arr['pagenum']);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleList(self::ARTICLE_VIEWS);
		
		//文章分类
		$data['sort'] = $this->sort_model->getSort();
		
		//文章归档
		$data['archive'] = $this->article_model->getArchive();
		
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '我的作品'.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'works';
		$this->public_model->loadView($aMeta,$sHeader,'works',$data);
	}
	
	public function view() {
		$iWorks = $this->uri->segment(3);
		$data['works'] = $this->works_model->getWorksInfo($iWorks);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleList(self::ARTICLE_VIEWS);
		
		//文章分类
		$data['sort'] = $this->sort_model->getSort();
		
		//文章归档
		$data['archive'] = $this->article_model->getArchive();
		
		//设置seo
		$seo_info = $this->config->item('works_seo');
		$aMeta['title'] = $data['works']['title'].$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'works';
		$this->public_model->loadView($aMeta,$sHeader,'works_view',$data);
	}
	
}