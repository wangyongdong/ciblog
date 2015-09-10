<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 首页相关类
 * @author WangYongdong
 */
class Home extends MY_Controller {
	const ARTICLE_VIEWS = 'views';
	const ARTICLE_COM = 'comnum';
	const ARTICLE_NEW = 'datetime';
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data['article'] = $this->article_model->getArticleList(self::ARTICLE_COM);//首页推荐文章
		$data['left_new'] = $this->article_model->getArticleList(self::ARTICLE_NEW);//首页右侧最新文章
		$data['left_cms'] = $this->cms_model->getCmsList(self::ARTICLE_COM);//首页cms文章推荐
		$data['left_archive'] = $this->archive_model->getArchive(5);//文章归档
		$data['left_links'] = $this->links_model->getLinks();		//首页右侧友情链接
		$data['blogger'] = $this->public_model->getBloggerInfo();	//首页右侧个人信息
		
		//设置seo
		$seo_info = $this->config->item('index_seo');
		$aMeta['title'] = $seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'home';
		$this->public_model->loadView($aMeta,$sHeader,'home',$data);
	}
}