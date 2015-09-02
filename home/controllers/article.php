<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {
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
		$data['aFilter']['q'] = sg($this->input->get('q'));
		//执行分页
		$pageId = $this->input->get('page');
		//获取系统变量，文章数量
		$sPageNum = getSet('article_nums');
		$sFilter = 'AND sortid != "2" ';
		if(!empty($data['aFilter']['q'])) {
			$sFilter .= ' AND title LIKE"%'.$data['aFilter']['q'].'%" ';
		}
		if(empty($data['aFilter']['q'])) {
			$sUrl = 'article?';
		} else {
			$sUrl = 'article?q='.$data['aFilter']['q'];
		}
		$arr = $this->public_model->getPage("article",$sUrl,$pageId,$sPageNum,$sFilter);
		//文章列表
		$data['article'] = $this->article_model->getArticleList(self::ARTICLE_NEW,$arr['start'],$arr['pagenum'],$data['aFilter']);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleList(self::ARTICLE_VIEWS);
		
		//首页cms文章推荐
		$data['cms_recom'] = $this->cms_model->getCmsList(self::ARTICLE_COM);
		
		//文章分类
		$data['sort'] = $this->sort_model->getSort();
		
		//最新评论
		$data['comment'] = $this->comment_model->getNewComment();

		//文章归档
		$data['archive'] = $this->archive_model->getArchive(5);
		
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '学无止境'.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'article';
		$this->public_model->loadView($aMeta,$sHeader,'article',$data);
	}
	/**
	 * 文章详情页
	 */
	public function view() {
		//获取文章详情
		$iArticle = $this->uri->segment(3);
		$data['article'] = $this->article_model->getArticleInfo($iArticle);
		
		//上一篇文章,下一篇文章
		$data['article_near'] = $this->article_model->getLastNext($iArticle);
		
		//获取相关文章
		$data['article_related'] = $this->article_model->getRelated($iArticle);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleList(self::ARTICLE_VIEWS);
		
		//首页cms文章推荐
		$data['cms_recom'] = $this->cms_model->getCmsList(self::ARTICLE_COM);
		
		//文章分类
		$data['sort'] = $this->sort_model->getSort();
		
		//文章归档
		$data['archive'] = $this->archive_model->getArchive(5);
		
		//文章评论
		$data['comment'] = $this->getComment($iArticle);
		//文章评论数量
		
		//token
		$data['token'] = getToken($this->tokentype);
		
		//文章访问+1
		$this->article_model->addArticleViews($iArticle);
		
		//设置seo
		$seo_info = $this->config->item('info_seo');
		$aMeta['title'] = $data['article']['title'].$seo_info['title'];
		$aMeta['keywords'] = $data['article']['keyword'].$seo_info['keywords'];
		$aMeta['description'] = $data['article']['title'].$data['article']['keyword'];
		$sHeader = 'article';
		$this->public_model->loadView($aMeta,$sHeader,'article_view',$data);
		
	}
	
	/**
	 * 根据分类获取文章
	 */
	public function sort() {
		//文章类别
		$iType = $this->uri->segment(3);
		//分页执行
		$pageId = $this->input->get('page');
		$sPageNum = getSet('article_nums');
		$sFilter = ' AND sortid='.$iType;
		$arr = $this->public_model->getPage("article",'article/sort/'.$iType.'?',$pageId,$sPageNum,$sFilter);
		
		//根据分类获取文章列表
		$data['article'] = $this->sort_model->getArticleBySort($iType,$arr['start'],$arr['pagenum']);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleList(self::ARTICLE_VIEWS);
		
		//文章分类
		$data['sort'] = $this->sort_model->getSort();
		
		//首页cms文章推荐
		$data['cms_recom'] = $this->cms_model->getCmsList(self::ARTICLE_COM);
		
		//最新评论
		$data['comment'] = $this->comment_model->getNewComment();
		
		//文章归档
		$data['archive'] = $this->archive_model->getArchive(5);
		
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '学无止境 - '.getSortField($iType,'name').$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'article';
		$this->public_model->loadView($aMeta,$sHeader,'article',$data);
		
	}
	
	/**
	 * 按归档时间查看文章
	 */
	public function archive() {
		$sYear = $this->uri->segment(3);
		$sMonth = $this->uri->segment(4);
		$sTime = $sYear.'/'.$sMonth;
		//分页执行
		$pageId = $this->input->get('page');
		$sPageNum = getSet('article_nums');
		$sFilter = 'AND FROM_UNIXTIME(UNIX_TIMESTAMP(datetime), "%Y/%m") = "'.$sTime.'"';
		$arr = $this->public_model->getPage("article",'article/archive/'.$sTime.'?',$pageId,$sPageNum,$sFilter);
		
		//根据时间获取文章列表
		$data['article'] = $this->archive_model->getArticleByArchive($sTime,$arr['start'],$arr['pagenum']);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleList(self::ARTICLE_VIEWS);
		
		//文章分类
		$data['sort'] = $this->sort_model->getSort();
		
		//文章归档
		$data['archive'] = $this->archive_model->getArchive();
		
		//首页cms文章推荐
		$data['cms_recom'] = $this->cms_model->getCmsList(self::ARTICLE_COM);
		
		//最新评论
		$data['comment'] = $this->comment_model->getNewComment();
		
		//设置seo
		$seo_info = $this->config->item('list_seo');
		$aMeta['title'] = '学无止境'.$seo_info['title'];
		$aMeta['keywords'] = $seo_info['keywords'];
		$aMeta['description'] = $seo_info['description'];
		$sHeader = 'article';
		$this->public_model->loadView($aMeta,$sHeader,'article',$data);
	}
	
	/**
	 * 获取文章评论
	 */
	public function getComment($iArticle='',$iComment='',$iStart=0,$iPageNum=5) {
		if(empty($iArticle)) {
			$iArticle = sg($_POST['id']);
			//$iComment = '';
		}
		if(!empty($_POST['start'])) {
			$iStart = sg($_POST['start']);
		}
		if(!empty($_POST['limit'])) {
			$iPageNum = sg($_POST['limit']);
		}
		$aComments = $this->getReply($iArticle,$iComment,$iStart,$iPageNum);
		//ajax获取处理
		if(!empty($_POST['type'])) {
			$arr = $this->ajaxComment($aComments);
			echoAjax($arr);
		}
		return $aComments;
	}
	
	/**
	 * 获取文章回复
	 */
	public function getReply($iArticle='',$iComment='',$iStart=0,$iPageNum=5) {
		//查询评论
		$aComment = $this->comment_model->getComment($iArticle,$iComment,$iStart,$iPageNum);
		if(!empty($aComment)) {
			foreach ($aComment as $key=>$value) {
				$arr = $value;
				$arr['children'] = $this->getReply('',$value['id'],0,100);
				$aList[] = $arr;
			}
			return $aList;
		} else {
			return $aComment;
		}
	}
	
	/**
	 * ajax处理评论
	 */
	public function ajaxComment($aComments) {
		$str = '';
		$i = 0;
		foreach ($aComments as $key=>$value) {
			$str .= '<li>
							<div class="com_top"><a class="author" href="'.$value['url'].'" target="_black">'.$value['author'].'：</a></div>
							<span class="cont">'.stripcslashes($value['content']).'</span><br>
							<span class="time">'.$value['datetime'].'</span>
							<span class="com"><a class="btn" onclick="getReply('.$value['id'].',"'.$value['author'].'");">评论</a></span>
							<ul class="children">';
			if(!empty($value['children'])) {
				foreach ($value['children'] as $k=>$v) {
					$str .= '<li class="comrep-list">
										<div class="com_top">
											<a class="author" href="'.$v['url'].'" target="_black">'.$v['author'].'：</a>
										</div>
										<div class="cont">'.stripcslashes($v['content']).'</div>
										<div class="time">'.$v['datetime'].'</div>
										<span class="com"><a class="btn" onclick="getReply('.$v['id'].',"'.$v['author'].'");">评论</a></span>
										<ul class="children">';
					if(!empty($v['children'])) {
						foreach ($v['children'] as $kr=>$vr) {
							$str .= '<li class="comrep-list">
												<div class="com_top">
													<a class="author" href="'.$vr['url'].'" target="_black">'.$vr['author'].'：</a>
												</div>
												<div class="cont">'.stripcslashes($vr['content']).'</div>
												<div class="time">'.$vr['datetime'].'</div>
											</li>';
						}
					}
					$str .= ' </ul> </li>';
				}
			}
			$str .= ' </ul> </li>';
			$i++;
		}
		$aRtn['comment'] = $str;
		$aRtn['num'] = $i;
		return $aRtn;
		
	}
	
}