<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 定义搜索信息相关类
 * @author WangYongdong
 */
class Search extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$iSort = $this->input->get('sort');
		$iUser = $this->input->get('user');
		$sKeyWord = $this->input->get('q');
		
		$aFilter = '';
		$sFilter = '';
		$url = '';
		if(!empty($iSort)) {
			$aFilter['sort'] = $iSort;
			$sFilter .= 'AND type='.$iSort;
			$url .= '&sort='.$iSort;
		}
		if(!empty($iUser)) {
			$aFilter['user'] = $iUser;
			$sFilter .= 'AND uid='.$iUser;
			$url .= '&user='.$iUser;
		}
		if(!empty($sKeyWord)) {
			$aFilter['q'] = $sKeyWord;
			$sFilter .= 'AND title like "%'.$sKeyWord.'%" ';
			$url .= '&q='.$sKeyWord;
		}
		$sUrl = 'search/index?'.$url;
		
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("article",$sUrl,$pageId,$sFilter);
		
		$this->load->model('search_model');
		$article_list = $this->search_model->getSearchArticle($aFilter,$arr['start'],$arr['pagenum']);
		$data['list'] = $article_list;
		
		$sort_list = $this->sort_model->getSortList();
		$data['sort_list'] = $sort_list;
		
		$user_list = $this->member_model->getMemberList();
		$data['user_list'] = $user_list;
		
		$data['aFilter'] = $aFilter;
		
		$this->load->view('article/article_list',$data);
	}
}