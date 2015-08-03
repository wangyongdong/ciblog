<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {
	const INDEX_REC = 'index_rec';
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
		$sPageNum = getSet('article_nums');
		$arr = $this->public_model->getPage("article",'article/index?',$pageId,$sPageNum);
		//文章列表
		$data['article'] = $this->article_model->getArticleList($arr['start'],$arr['pagenum']);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleAct(self::INDEX_REC,10);
		
		//文章分类
		$data['sort'] = $this->public_model->getSort();
		
		//最近评论
		$data['comment'] = $this->contact_model->getRecentComment();

		//文章归档
		$data['archive'] = $this->article_model->getArchive();
		
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
		$data['article_view'] = $this->article_model->getArticleAct(self::INDEX_REC,10);
		
		//文章分类
		$data['sort'] = $this->public_model->getSort();
		
		//文章归档
		$data['archive'] = $this->article_model->getArchive();
		
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
		$sFilter = ' AND type='.$iType;
		$arr = $this->public_model->getPage("article",'article/sort/'.$iType.'?',$pageId,$sPageNum,$sFilter);
		
		//根据分类获取文章列表
		$data['article'] = $this->article_model->getArticleBySort($iType,$arr['start'],$arr['pagenum']);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleAct(self::INDEX_REC,10);
		
		//文章分类
		$data['sort'] = $this->public_model->getSort();
		
		//文章归档
		$data['archive'] = $this->article_model->getArchive();
		
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
		$data['article'] = $this->article_model->getArticleByArchive($sTime,$arr['start'],$arr['pagenum']);
		
		//文章点击排行榜
		$data['article_view'] = $this->article_model->getArticleAct(self::INDEX_REC,10);
		
		//文章分类
		$data['sort'] = $this->public_model->getSort();
		
		//文章归档
		$data['archive'] = $this->article_model->getArchive();
		
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
		$aComment = $this->article_model->getComment($iArticle,$iStart,$iPageNum);
		if(!empty($_POST['type'])) {
			$str = '';
			$i = 0;
			foreach ($aComment as $key=>$value) {
				$str .= '<li>
							<a class="author" href="'.$value['url'].'">'.$value['author'].'：</a>
							<span class="cont">'.$value['comment'].'</span><br>
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
	
	/**
	 * 文章评论
	 */
	public function doComment() {
		$data = array();
		$data['comment_id'] = sg($this->input->post('id', TRUE));
		$data['comment_type'] = 'article';
		$data['author'] = sg($this->input->post('name', TRUE));
		$data['email'] = sg($this->input->post('email', TRUE));
		$data['url'] = prep_url(sg($this->input->post('url', TRUE)));
		$data['comment'] = sg($this->input->post('comment', TRUE));
		$data['ip'] = $this->input->ip_address();
		$data['useragent'] = $this->input->user_agent();
		$data['datetime'] = date("Y-m-d H:i:s",time());
		
		if (empty($data['comment_id']) || empty($data['author']) || empty($data['email']) || empty($data['comment'])) {
			localCommon('数据信息不完整。');
		} else if (mb_strlen($data['author']) < 2 || mb_strlen($data['author']) > 16) {
			localCommon('用户名在2-16个字符。');
		} else if (!is_email($data['email'])) {
			localCommon('邮箱格式不正确。');
		} else if (mb_strlen($data['comment']) < 2 || mb_strlen($data['comment']) > 500) {
			localCommon('评论内容在2-500个字符。');
		}
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		$iInsert = $this->article_model->doComment($data);
		if(!empty($iInsert)) {
			$this->article_model->updArticle($data['comment_id'],'1');//执行数量增加
			//添加提醒
			$aNotice = array();
			$aNotice['type'] = 'article';
			$aNotice['author'] = $data['author'];
			$aNotice['id'] = $iInsert;
			$this->public_model->addNotice($aNotice);
			//跳转
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
}