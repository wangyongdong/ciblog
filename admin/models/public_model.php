<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 获取公共信息模型
 * @author WangYongdong
 */
class Public_model extends CI_Model  {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /**
     * 调用分页类
     */
    public function getPage($sTable,$sUrl,$pageId,$sFilter='',$iPageNum=10) {
    	//调用page类
    	$this->load->library('page');
    	$iCount = getPageCount($sTable,$sFilter);
    	$iPageSize = $iPageNum;
    	$this->page->loadPage($iCount,$iPageSize,$sUrl);
    
    	//总页数
    	$num_pages = ceil($iCount/$iPageSize);
    	if($pageId > $num_pages) {
    		$pageId = $num_pages;
    	}
    	if($pageId < 0) {
    		$pageId = 1;
    	}
    	$arr = $this->page->getParam($iPageSize,$pageId);
    	return $arr;
    }
    /**
     * 邮件发送
     */
    public function sendMail($sEmail,$sSubject,$sContent) {
    	$this->load->library('email');
    	$config['protocol'] = 'smtp';
    	$config['smtp_host'] = 'smtp.163.com';
    	$config['smtp_port'] = 25;
    	$config['smtp_user'] = 'wydchn@163.com';	//163邮箱账户
    	$config['smtp_pass'] = '1BEIZIkuaile';		//163邮箱密码
    	$config['mailtype'] = 'html';				//邮件类型
    	$config['validate'] = true;					//验证邮件地址
    	$config['crlf'] = "\r\n";
    	$config['charset'] = 'utf-8';
    	
    	$this->email->initialize($config);
    	
    	$this->email->from('wydchn@163.com', '王永东博客');			//发件人
    	$this->email->to($sEmail);								//收件人
    	$this->email->subject($sSubject);
    	$this->email->message($sContent);
    	$this->email->set_alt_message(strip_tags($sContent));	//设置纯txt内容
    	$this->email->send();
    	$s = $this->email->print_debugger(array('headers'));
    }
    /**
     * 拼接评论回复内容
     */
    public function commentEmail($iComment,$sAuthor,$sContent) {
    	//添加邮件提醒
    	$list = getEmail('comment',$iComment);
    	$arr['email'] = sg($list['email'],'');
    	$arr['subject'] = ' [王永东博客] 评论回复';
    	$arr['subject'] = "=?UTF-8?B?".base64_encode($arr['subject'])."?=";
    	$arr['content'] = '
    				<p><strong>'.sg($list['author']).'，你好</strong>！</p>
    				<p>感谢您关注本博客，并进行互动讨论。</p>
					<p> 你在：【王永东博客】 文章 “<strong>'.getTitle($list['comment_id']).'</strong>” 发表的评论有新回复</p>
					<strong><p>这里是你的原始评论:</strong>
					'.stripcslashes($list['content']).'</p><br />
					~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					<strong><p>这里是新的回复:</strong>
					'.stripcslashes($sContent).'</p>
					<p><strong>回复者：'.$sAuthor.'</strong></p>
					↓↓↓↓↓↓↓↓
					<p><strong>你可以点击下面的链接关注更多关于这话题的评论:</strong><br />
					<a href="'.linkArticle($list['comment_id']).'">'.getTitle($list['comment_id']).'</a></p>
					<p><strong>感谢您的评论，欢迎再次光临 <a href="'.HOST.'">王永东博客</a></strong>
					</a></p>
					<p><strong>(此邮件由系统自动发出, 请勿回复)</strong></p>'
    	;
    	return $arr;
    }
    /**
     * 拼接留言回复内容
     */
    public function contactEmail($iContact,$sAuthor,$sContent) {
    	//添加邮件提醒
    	$list = getEmail('contact',$iContact);
    	$arr['email'] = sg($list['email'],'');
    	$arr['subject'] = ' [王永东博客] 留言回复';
    	$arr['subject'] = "=?UTF-8?B?".base64_encode($arr['subject'])."?=";
    	$arr['content'] = '
    				<p><strong>'.sg($list['author']).'，你好</strong>！</p>
    				<p>感谢您关注本博客，并进行互动讨论。</p>
					<p> 你在：【王永东博客】  的留言有新回复</p>
					<strong><p>这里是你的留言内容:</strong>
					'.stripcslashes($list['content']).'</p><br />
					~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					<strong><p>这里是新的回复内容:</strong>
					'.stripcslashes($sContent).'</p>
					<p><strong>回复者：'.$sAuthor.'</strong></p>
					↓↓↓↓↓↓↓↓
					<p><strong>你可以点击下面的链接查看更多关于本博客的内容</strong><br />
					<p><strong>感谢您的评论，欢迎再次光临 <a href="'.HOST.'">王永东博客</a></strong>
					</a></p>
					<p><strong>(此邮件由系统自动发出, 请勿回复)</strong></p>'
    	;
    	return $arr;
    }
}