<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 定义文章相关类
 * @author WangYongdong
 */
class Article extends MY_Controller {
	var $tokentype = 'article';
	
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 文章列表页
	 */
	public function index() {
		$data['aFilter']['keyword'] = sg($this->input->get('s'));
		$data['aFilter']['sort'] = sg($this->input->get('sort'));
		$data['aFilter']['author'] = sg($this->input->get('author'));
		
		$data['sort'] = $this->sort_model->getSortList();
		$data['member'] = $this->member_model->getMemberList();
		
		//分页执行
		$pageId = $this->input->get('page');
		$sFilter = '';
		if(!empty($data['aFilter']['keyword'])) {
			$sFilter = ' AND title LIKE"%'.$data['aFilter']['keyword'].'%" ';
		}
		if(!empty($data['aFilter']['sort'])) {
			$sFilter = ' AND sortid = '.$data['aFilter']['sort'];
		}
		if(!empty($data['aFilter']['author'])) {
			$sFilter = ' AND uid = '.$data['aFilter']['author'];
		}
		$arr = $this->public_model->getPage("article",'article?',$pageId,$sFilter);
		
		//执行查询
		$data['list'] = $this->article_model->getArticleList($arr['start'],$arr['pagenum'],$data['aFilter']);
		
		$this->load->view('public/header',$data);
		$this->load->view('article/article_list',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 文章发表页面
	 */
	public function create() {
		$data['sort'] = $this->sort_model->getSortList();
		//token
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('public/header',$data);
		$this->load->view('article/article_new',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 获取文章修改页
	 */
	public function update() {
		$iArticle = $this->uri->segment(3);
		$data['list'] = $this->article_model->getArticleInfo($iArticle);
		$data['sort'] = $this->sort_model->getSortList();
		//token
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('public/header',$data);
		$this->load->view('article/article_edit',$data);
		$this->load->view('public/footer',$data);
	}
	
	/**
	 * 执行文章发表，和修改
	 */
	public function doArticle() {
		$data = array();
		if(!empty($_POST['id'])) {
			$data['id'] = sg($_POST['id']);
		} else {
			$data['datetime'] = date("Y-m-d H:i:s",time());
		}
		$data['uid'] = 1;								//用户id
		$data['title'] = sg($_POST['title']);			//标题
		$data['content'] = sg($_POST['content']);		//内容
		$data['keyword'] = sg($_POST['keyword']);		//关键词
		$data['sortid'] = sg($_POST['sortid']);			//类型
		$data['img'] = '';								//配图
		$data['topway'] = sg($_POST['topway']);			//置顶方式
		$data['status'] = sg($_POST['status']);			//显示状态
		
		//数据验证
		$arr = array($data['title'],$data['content']);
		checkEmpty($arr);
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		$this->article_model->doArticle($data);
		succes(site_url('article'));
	}
	
	/**
	 * 删除操作
	 */
	public function doDel() {
		$iArticle = sg($_POST['id']);
		$affect = $this->article_model->doDel($iArticle);
		echo $affect;
	}
	
	/**
	 * 批量删除
	 */
	public function doDelAll() {
		$sId = sg($_POST['id']);
		//将获取到的值进行拆分，重组
		$aId = explode(",",trim($sId,','));
		//遍历删除
		$affects = 0;
		for($i=0;$i<count($aId);$i++) {
			$affect = $this->article_model->doDel($aId[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
	
	/**
	 * 文章置顶操作
	 */
	public function ArticleTop() {
		$sId = sg($_POST['id']);
		$sTop = sg($_POST['val']);
		if(empty($sTop)) {
			echo 'success';
		}
		//将获取到的值进行拆分，重组
		$aId = explode(",",trim($sId,','));
		//遍历查询出内容
		$affects = 0;
		for($i=0;$i<count($aId);$i++) {
			$affect = $this->article_model->ArticleTop($sTop,$aId[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
	
	/**
	 * 移动类别
	 */
	public function sortChange() {
		$sId = sg($_POST['id']);
		$iSort = sg($_POST['val']);
		if(empty($iSort)) {
			echo 'success';
		}
		//将获取到的值进行拆分，重组
		$aId = explode(",",trim($sId,','));
		//遍历查询出内容
		$affects = 0;
		for($i=0;$i<count($aId);$i++) {
			$affect = $this->article_model->sortChange($iSort,$aId[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
}