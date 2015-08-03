<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	const INDEX_REC = 'index_rec';
	const INDEX_NEW = 'index_new';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		//首页推荐文章
		$data['article_recom'] = $this->article_model->getArticleAct(self::INDEX_REC);
		
		//首页右侧最新文章
		$data['article_new'] = $this->article_model->getArticleAct(self::INDEX_NEW);
		
		//首页右侧友情链接
		$data['links'] = $this->public_model->getLinks();
		
		//首页右侧个人信息
		$data['blogger'] = $this->public_model->getBloggerInfo();
		
		//文章归档
		$data['archive'] = $this->article_model->getArchive();
		
		//设置seo
		$seo_info = $this->config->item('index_seo');
		$aMeta['title'] = $seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'home';
		$this->public_model->loadView($aMeta,$sHeader,'home',$data);
		
	}
}