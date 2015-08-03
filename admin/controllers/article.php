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
	public function alist() {
		$data['sort_list'] = $this->sort_model->getSortList();
		$data['user_list'] = $this->member_model->getMemberList();
		
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("article",'article/alist?',$pageId);
		//执行查询
		$data['list'] = $this->article_model->getArticleList($arr['start'],$arr['pagenum']);
		
		$this->load->view('article/article_list',$data);
	}
	
	/**
	 * 文章发表页面
	 */
	public function anew() {
		$data['uedit'] = getUeditForBig();
		$data['list'] = $this->sort_model->getSortList();
		//token
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('article/article_new',$data);	
	}
	
	/**
	 * 获取文章修改页
	 */
	public function update() {
		$iArticle = $this->uri->segment(3);
		$data['article'] = $this->article_model->getArticleInfo($iArticle);
		$data['list'] = $this->sort_model->getSortList();
		$data['uedit'] = getUeditForBig($data['article']['content']);
		//token
		$data['token'] = getToken($this->tokentype);
		
		$this->load->view('article/article_edit',$data);
	}
	
	/**
	 * 执行文章发表，和修改
	 */
	public function doArticle() {
		$data = array();
		if(!empty($_POST['id'])) {			//修改
			$data['id'] = sg($_POST['id']);
		} else {							//添加
			$data['views'] = 0;				//访问量
			$data['comnum'] = 0;			//评论数
			$data['datetime'] = date("Y-m-d H:i:s",time());		//发表时间
		}
		$data['uid'] = $_SESSION['uid'];						//用户id
		$data['title'] = sg($_POST['article_title']);			//文章标题
		$data['content'] = sg($_POST['content']);				//文章内容
		$data['keyword'] = sg($_POST['article_keyword']);		//文章标签
		$data['type'] = sg($_POST['type']);						//文章类型
		$data['img'] = sg($_POST['img']);						//文章配图
		$data['password'] = sg($_POST['password']);				//加密密码
		$data['hometop'] = @sg($_POST['hometop'],'n');			//是否首页置顶
		$data['sorttop'] = @sg($_POST['sorttop'],'n');			//是否分类置顶
		$data['allow_remark'] = sg($_POST['allow_remark'],'n');	//是否允许评论
		
		//token验证
		checkToken($_POST['token'],$this->tokentype);
		
		//输入数据验证
		$arr = array($data['uid'],$data['title'],$data['content']);
		checkEmpty($arr,$data['id'],'article/anew','article/update/');
		
		$affect = $this->article_model->doArticle($data);
		if($affect) {
			headers(site_url('article/alist'),'active_s','文章操作成功');
		}
	}
	
	/**
	 * 删除操作
	 */
	public function doDel() {
		$sId = sg($_POST['id']);
		//将获取到的值进行拆分，重组
		$var = explode(",",$sId);
		$len = count($var)-1;
		if($var[$len] == "" || $var[$len] == "," ) {
			array_pop($var);
		}
		$aId = $var;
		//遍历查询出内容
		$affects = 0;
		for($i=0;$i<count($aId);$i++){
			$affect = $this->article_model->doDel($aId[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
	
	/**
	 * 文章置顶操作
	 */
	public function doArticleTop() {
		$sId = sg($_POST['id']);
		$sTop = sg($_POST['val']);
		
		//将获取到的值进行拆分，重组
		$var = explode(",",$sId);
		$len = count($var)-1;
		if($var[$len] == "" || $var[$len] == "," ) {
			array_pop($var);
		}
		$aId = $var;
		//遍历查询出内容
		$affects = 0;
		for($i=0;$i<count($aId);$i++){
			$affect = $this->article_model->doArticleTop($sTop,$aId[$i]); //执行修改
			$affects+=$affect;
		}
		echo $affects;
	}
}