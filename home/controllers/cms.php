<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller {
	const ARTICLE_VIEWS = 'views';
	const ARTICLE_COM = 'comnum';
	const ARTICLE_NEW = 'datetime';
	var $tokentype = 'article';
	
	public function __construct() {
		parent::__construct();
		$this->load->model('contact_model');
	}
	/**
	 * 文章列表页
	 */
	public function index() {
		//执行分页
		$pageId = $this->input->get('page');
		//获取系统变量，文章数量
		$sPageNum = getSet('article_nums');
		$sFilter = 'AND sortid="2" ';
		$arr = $this->public_model->getPage("article",'cms?',$pageId,$sPageNum,$sFilter);
		//文章列表
		$data['cms'] = $this->cms_model->getCmsList(self::ARTICLE_NEW,$arr['start'],$arr['pagenum']);
		
		//cms文章点击排行
		$data['cms_view'] = $this->cms_model->getCmsList(self::ARTICLE_VIEWS);
		
		//首页cms文章推荐
		$data['cms_recom'] = $this->cms_model->getCmsList(self::ARTICLE_COM);
		
		//最新评论
		$data['comment'] = $this->comment_model->getNewComment();

		//文章归档
		$data['archive'] = $this->archive_model->getArchive(5);
		
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '学无止境'.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'cms';
		$this->public_model->loadView($aMeta,$sHeader,'cms',$data);
	}
	/**
	 * 文章详情页
	 */
	public function view() {
		//获取文章详情
		$iArticle = $this->uri->segment(3);
		$data['cms'] = $this->article_model->getArticleInfo($iArticle);
		
		//上一篇文章,下一篇文章
		$data['cms_near'] = $this->cms_model->getLastNext($iArticle);
		
		//获取相关文章
		$data['cms_related'] = $this->cms_model->getRelated($iArticle);
		
		//文章点击排行榜
		$data['cms_view'] = $this->cms_model->getcmsList(self::ARTICLE_VIEWS);
		
		//首页cms文章推荐
		$data['cms_recom'] = $this->cms_model->getCmsList(self::ARTICLE_COM);
		
		//文章归档
		$data['archive'] = $this->archive_model->getArchive(5);
		
		//文章评论
		$data['comment'] = $this->getComment($iArticle);
		
		//token
		$data['token'] = getToken($this->tokentype);
		
		//文章访问+1
		//$this->article_model->addArticleViews($iArticle);
		
		//设置seo
		$seo_info = $this->config->item('info_seo');
		$aMeta['title'] = $data['cms']['title'].$seo_info['title'];
		$aMeta['keywords'] = $data['cms']['keyword'].$seo_info['keywords'];
		$aMeta['description'] = $data['cms']['title'].$data['cms']['keyword'];
		$sHeader = 'cms';
		$this->public_model->loadView($aMeta,$sHeader,'cms_view',$data);
		
	}
	
	/**
	 * 获取文章评论
	 */
	public function getComment($iArticle='',$iStart=0,$iPageNum=5) {
		if(empty($iArticle)) {
			$iArticle = $_POST['id'];
		}
		if(!empty($_POST['start'])) {
			$iStart = $_POST['start'];
		}
		if(!empty($_POST['limit'])) {
			$iPageNum = $_POST['limit'];
		}
		//查询回复
		$aComment = $this->comment_model->getComment($iArticle,$iStart,$iPageNum);
		if(!empty($_POST['type'])) {
			$str = '';
			$i = 0;
			foreach ($aComment as $key=>$value) {
				$str .= '<li>
							<div class="com_top"><a class="author" href="'.$value['url'].'">'.$value['author'].'：</a></div>
							<span class="cont">'.stripcslashes($value['content']).'</span><br>
							<span class="time">'.$value['datetime'].'</span>
						 </li>';
				$i++;
			}
			$aRtn['comment'] = $str;
			$aRtn['num'] = $i;
			echoAjax($aRtn);
		}
		return $aComment;
	}
	
	
}