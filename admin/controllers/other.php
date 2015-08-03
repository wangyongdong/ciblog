<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 相关统计类
 * @author WangYongdong
 */
class Other extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function info() {
		//网站信息
		$data['user'] = getStatis('user');
		$data['article'] = getStatis('article');
		$data['sort'] = getStatis('sort');
		$data['record'] = getStatis('record');
		$data['works'] = getStatis('works');
		$data['view'] = getStatis('log');
		$data['contact'] = getStatis('comment','where comment_type="contact" ');
		$data['comment'] = getStatis('comment','where comment_type="article" ');
		
		//系统信息
		
		//获取服务器标识的字串
		$arrSys['sysos'] = $_SERVER["SERVER_SOFTWARE"];
		//获取PHP服务器版本
		$arrSys['php'] = 'PHP '.PHP_VERSION;
		//mysql版本信息
		$arrSys['mysql'] = 'MySql '.mysql_get_server_info();
		//从服务器中获取GD库的信息
		if(function_exists("gd_info")){
			$gd = gd_info();
			$arrSys['gdinfo'] = $gd['GD Version'];
		}else {
			$arrSys['gdinfo'] = "未知";
		}
		//从PHP配置文件中获得是否可以远程文件获取
		$arrSys['allowurl']= ini_get("allow_url_fopen") ? "支持" : "不支持";
		//从PHP配置文件中获得最大上传限制
		$arrSys['max_upload'] = ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled";
		//从PHP配置文件中获得脚本的最大执行时间
		$arrSys['max_ex_time']= ini_get("max_execution_time")."秒";
		//以下两条获取服务器时间，中国大陆采用的是东八区的时间,设置时区写成Etc/GMT-8
		date_default_timezone_set("Etc/GMT-8");
		$arrSys['systemtime'] = date("Y-m-d H:i:s",time());
		
		$data['arr'] = $arrSys;
		$this->load->view('other/info',$data);
	}
	
	public function view() {
		$this->load->view('other/view',$data);
	}
	
	public function cache() {
		$this->load->view('other/cache',$data);
	}
	
	public function notice() {
		//分页执行
		$pageId = $this->input->get('page');
		$arr = $this->public_model->getPage("notice",'other/notice?',$pageId);
		//执行查询
		$data['notice'] = $this->public_model->getNotice($arr['start'],$arr['pagenum']);
		
		$this->load->view('other/notice',$data);
	}
	
	/**
	 * 删除消息
	 */
	public function delNotice() {
		$sId = sg($_POST['id']);
		//将获取到的值进行拆分，重组
		$var = explode(",",$sId);
		$len = count($var)-1;
		if($var[$len] == "" || $var[$len] == "," ) {
			array_pop($var);
		}
		$aId = $var;
		//遍历删除
		$affects = 0;
		for($i=0;$i<count($aId);$i++) {
			$affect = $this->public_model->delNotice($aId[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
	
	/**
	 * 修改消息状态
	 */
	public function updNotice() {
		$sId = sg($_POST['id']);
		//将获取到的值进行拆分，重组
		$var = explode(",",$sId);
		$len = count($var)-1;
		if($var[$len] == "" || $var[$len] == "," ) {
			array_pop($var);
		}
		$aId = $var;
		//遍历修改
		$affects = 0;
		for($i=0;$i<count($aId);$i++) {
			$affect = $this->public_model->updNotice($aId[$i]);
			$affects+=$affect;
		}
		echo $affects;
	}
}