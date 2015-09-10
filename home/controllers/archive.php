<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 文章归档相关类
 * @author WangYongdong
 */
class Archive extends MY_Controller {
	const ARTICLE_VIEWS = 'views';
	const ARTICLE_COM = 'comnum';
	const ARTICLE_NEW = 'datetime';
	public function __construct() {
		parent::__construct();
	}
	/**
	 * 文章归档
	 */
	public function index() {
		$data['list'] = $this->archive_model->getArchiveList();	//文章归档
		$data['sort'] = $this->sort_model->getSort();			//文章分类
		$data['left_view'] = $this->article_model->getArticleList(self::ARTICLE_VIEWS);//文章点击排行榜
		$data['left_cms'] = $this->cms_model->getCmsList(self::ARTICLE_COM);//首页cms文章推荐
		$data['left_comment'] = $this->comment_model->getNewComment();		//最新评论
		$data['static'] = $this->archive_model->getSiteStatis();			//统计
		
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '文章归档'.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'archive';
		$this->public_model->loadView($aMeta,$sHeader,'archive',$data);
	}
	
}