<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义搜索信息相关类
 * @author WangYongdong
 */
class Search extends MY_Controller {
	const ARTICLE_VIEWS = 'views';
	const ARTICLE_COM = 'comnum';
	const ARTICLE_NEW = 'datetime';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$sKeyWord = $this->input->get('q');
		
		$aFilter = '';
		$sFilter = '';
		$url = '';
		if(!empty($sKeyWord)) {
			$aFilter['q'] = $sKeyWord;
			$sFilter .= 'AND title like "%'.$sKeyWord.'%" ';
			$url .= '&q='.$sKeyWord;
		}
		$sUrl = 'search/index?'.$url;
		
		//分页执行
		$pageId = $this->input->get('page');
		$sPageNum = getSet('article_nums');
		$arr = $this->public_model->getPage("article",$sUrl,$pageId,$sPageNum,$sFilter);
		
		$this->load->model('search_model');
		$data['article'] = $this->search_model->getSearchArticle($aFilter,$arr['start'],$arr['pagenum']);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleList(self::ARTICLE_VIEWS);
		
		//文章分类
		$data['sort'] = $this->sort_model->getSort();
		
		//文章归档
		$data['archive'] = $this->article_model->getArchive();
		
		$data['aFilter'] = $aFilter;
		
		//设置seo
		$seo_info = $this->config->item('search_seo');
		$aMeta['title'] = $sKeyWord.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'article';
		$this->public_model->loadView($aMeta,$sHeader,'article',$data);
		
	}
}