<?php
/**
 * 文章编辑器定制
 */
function ArticleUedit($sContent='') {
	$ss = '
			<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'third-party/SyntaxHighlighter/shCore.js"></script>
			<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'third-party/SyntaxHighlighter/shCoreDefault.css"></script>
			<script type="text/javascript">
				SyntaxHighlighter.all();
				//SyntaxHighlighter.highlight();
			</script>
			';
	$sUedit = '
    		<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'ueditor.config.js"></script>
    		<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'ueditor.all.min.js"> </script>
			
    		<script type="text/javascript">
			    var ue = UE.getEditor("editor",{
	    			maximumWords:50000,
			    	//编辑器宽高设置
					initialFrameWidth : null,
					initialFrameHeight: 400
	    		});
			</script>
			<script id="editor" name="content" type="text/plain">
			'.$sContent.'		
			</script>';
	echo $sUedit;
}
/**
 * 说说编辑器定制
 */
function RecordUedit($sContent='') {
	$sUedit = '
    		<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'ueditor.config.js"></script>
    		<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'ueditor.all.min.js"> </script>
			<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'third-party/SyntaxHighlighter/shCore.js"></script>
			<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'third-party/SyntaxHighlighter/shCoreDefault.css"></script>
			<script type="text/javascript">
				SyntaxHighlighter.all();
				//SyntaxHighlighter.highlight();
			</script>
    		<script type="text/javascript">
			    var ue = UE.getEditor("editor",{
					toolbars: [
						[
							"emotion", 		//表情
				       		"insertimage", 	//多图上传
				       		"music", 		//音乐
							"insertvideo", 	//视频
						]
					],
					//编辑器宽高设置
					initialFrameWidth : null,
					initialFrameHeight: 80,
					wordCount:false
		    	});
			</script>
			<script id="editor" name="content" type="text/plain">
			'.$sContent.'
			</script>';
	echo $sUedit;
}
/**
 * 生成密码
 * @param string $sPass
 * @param string $sUnique
 * @return string
 */
function buildPass($sPass,$sUnique) {
	$CI =& get_instance();
	$CI->load->library('encrypt');
	$newPass = $CI->encrypt->encryptcode($sPass,$sUnique);
	
	return $newPass;
}
/**
 * 获取token
 * @param string $tokentype
 * @return string
 */
function getToken($tokentype) {
	$CI =& get_instance();
	$CI->load->library('token');
	$tokenvalue = $CI->token->granteToken($tokentype);
	return $tokenvalue;
}
/**
 * token验证
 * @param string $token
 * @param string $tokentype
 * @return string
 */
function checkToken($token,$tokentype) {
	$CI =& get_instance();
	$CI->load->library('token');
	$token_result = $CI->token->checkValidateToken($token,$tokentype);
	$referer = $_SERVER['HTTP_REFERER'];
	if(Token::TOKECHECK_EXTERNSUBMIT == $token_result) {
		$info = '禁止从外部网站提交数据，请检查...';
		errors($info);
	} elseif(Token::TOKECHECK_DUPLICATESUBMIT == $token_result) {
		$info = '请不要重复提交，请检查...';
		errors($info);
	}
}
/**
 * 验证数据是否为空，并提示
 * @param array  $arr 	需要验证的数据
 * @param string $sInfo	提示信息
 */
function checkEmpty($arr,$sInfo='数据为空') {
	if(!empty($arr)) {
		$res = 0;
		for($i=0;$i<=count($arr)-1;$i++) {
			if(empty($arr[$i])) {
				$res = 1;
			}
		}
	} else {
		$res = 1;
	}
	if($res>0) {
		errors($sInfo);
	}
}
/**
 * 验证密码
 */
function checkPass($val1,$val2) {
	if(empty($val1) || empty($val2)) {
		errors('密码字段为空');
	}
	if($val1 !== $val2) {
		errors('两次密码不一致');
	}
}
/**
 * 跳转到错误页
 */
function errors($sInfo) {
	$sInfo = urlencode($sInfo);
	header("Location:".site_url('show/error/'.$sInfo));
	exit;
}
/**
 * 跳转成功
 */
function succes($sUrl) {
	header("Location:".$sUrl);
	exit;
}
/**
 * 获取用户信息
 */
function getUser($iUser,$type='list') {
	if($type == 'list') {
		$sql = 'SELECT * FROM blog_member WHERE id='.$iUser;
	} else {
		$sql = 'SELECT '.$type.' FROM blog_member WHERE id='.$iUser;
	}
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	if($type == "list") {
		return $list;
	} else {
		return $list[$type];
	}
}
/**
 * 获取用户名
 */
function beName($iUser) {
	$db = DB('default');
	$sql = 'SELECT username FROM blog_member WHERE id='.$iUser;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return $aList['username'];
}
/**
 * 获取登录用户ID
 */
function UserId() {
	return sg($_SESSION['uid'],1);
}
/**
 * 获取登录用户名
 */
function UserName() {
	$iUser = UserId();
	return getUser($iUser,'username');
}
/**
 * 获取用户权限状态
 */
function getRole($iUser='',$sField='list') {
	if(empty($iUser)) {
		$iUser = UserId();
	}
	$aUserInfo = getUser($iUser);
	if($sField == 'list') {
		$sql = 'SELECT * FROM blog_role WHERE id='.$aUserInfo['role_id'];
	} else {
		$sql = 'SELECT '.$sField.' FROM blog_role WHERE id='.$aUserInfo['role_id'];
	}
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	if($sField == "list") {
		return $list;
	} else {
		return $list[$sField];
	}
}
/**
 * 判断权限是否显示menu
 * @param string $sPass
 * @param string $sUnique
 * @return string
 */
function roleMenu($sAction,$sModel) {
	$CI =& get_instance();
	$CI->load->library('access');
	$result = $CI->access->getAccessMenu($sAction,$sModel);
	if(!$result) {
		return false;
	} else {
		return true;
	}
}
/**
 * 获取登录信息
 */
function getLogin($sField='') {
	$iUser = UserId();
	if(empty($sField)) {
		$sql = 'SELECT * FROM blog_log_login WHERE userid='.$iUser.' ORDER BY datetime DESC ';
	}else {
		$sql = 'SELECT '.$sField.' FROM blog_log_login WHERE userid='.$iUser.' ORDER BY datetime DESC ';
	}
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	if(empty($sField)) {
		return $list;
	} else {
		return $list[$sField];
	}
}
/**
 * 根据用户id获取用户所发文章数量
 */
function getArticleNums($uid) {
	$db = DB('default');
	$sql = "SELECT count(*) as nums FROM blog_article WHERE uid='$uid'";
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['nums'];
}
/**
 * 获取文章标题
 */
function getTitle($iArticle) {
	$sql = 'SELECT title FROM blog_article WHERE id='.$iArticle;
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['title'];
}
/**
 * 获取文章所属分类
 */
function getArticleField($iArticle,$sField) {
	$db = DB('default');
	$sql = 'SELECT '.$sField.' FROM blog_article WHERE id='.$iArticle;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return $aList[$sField];
}
/**
 * 获取分类名
 */
function beSort($iSort) {
	$db = DB('default');
	$sql = 'SELECT name FROM blog_sort WHERE id='.$iSort;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return $aList['name'];
}
/**
 * 获取置顶方式
 */
function beTop($sType) {
	switch ($sType) {
		case 'home':
			$name = '首页';
			break;
		case 'sort':
			$name = '分类';
			break;
		default:
			$name = '无';
			break;
	}
	return $name;
}
/**
 * 生成用户头像
 */
function LinkAvatar($iUser='') {
	if(empty($iUser)) {
		$iUser = UserId();
	}
	$sql = 'SELECT picname FROM blog_member WHERE id='.$iUser;
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	if(!empty($list['picname'])) {
		$url = UPLOAD_PUBLIC.'user/'.$list['picname'];
	} else {
		$url = UPLOAD_PUBLIC.'user/avatar.jpg';
	}
	return $url;
}
/**
 * 过滤用户输入的数据
 */
function sg(&$str,$fit='') {
	if(!is_array($str) && !empty($str)) {
		$str = trim($str);
		$str = addslashes($str);
	}
	return empty($str) ? $fit : $str;
}
/**
 * 截取函数
 */
function cutStr($string,$length,$dot='…') {
	$len = mb_strlen($string,'utf8');
	$string = mb_substr($string,0,$length,'UTF-8');
	if($len > $length) {
		return $string.$dot;
	} else {
		return $string;
	}
}
/**
 * 简单截取+过滤
 * 去掉img标签并截取
 */
function cutShes($string,$length) {
	$string = preg_replace("/<img.*?>/si","",$string);
	return cutStr($string,$length);
}
/**
 * 字符串切割+过滤+转换
 *
 * 功能：截取字符串（支持中文）
 * 如果截取的字符串中不包含html标签，则正常截取
 * 如果字符串中包括img标签，则先进行过去标签，截取后，将标签位置放回,截取的字符串则会保留完整的html标签
 *
 * @param string $string
 * @param unknown $length
 * @param string $replace
 * @return string
 */
function cutTab($string, $length='15', $dot = '…') {
	$_lenth = mb_strlen($string, "utf-8");
	$text_str = preg_replace("/<img.*?>/si","",$string);
	$text_lenth = mb_strlen($text_str, "utf-8") - 1;
	
	if($text_lenth <= $length) {
		return stripcslashes($string);
	}
	
	if(strpos($string, '<img') === false){
		$res = mb_substr($string, 0, $length, 'UTF-8');
		return stripcslashes($res).$dot;
	}
	
	//计算标签位置
	$html_start = ceil(strpos($string, '<img') / 3);
	$html_end = ceil(strpos($string, '/>') / 3);
	
	if($length < $html_start) {
		$res = mb_substr($string, 0, $length, 'UTF-8');
		return stripcslashes($res).$dot;
	}
	
	if($length > $html_start) {
		
		$res_html = mb_substr($text_str, 0, $length-1, 'UTF-8');
		
		preg_match('/<img[^>]*\>/',$string,$result_html);
		$before = mb_substr($res_html, 0, $html_start, 'UTF-8');
		$after = mb_substr($res_html, $html_start, mb_strlen($res_html, "utf-8"), 'UTF-8');
		$res = $before.$result_html[0].$after;
		return stripcslashes($res).$dot;
	}
	
}
/**
 * 获取数据总条数（用户分页）
 */
function getPageCount($table,$sFilter='') {
	$sQuery = 'SELECT
                    count(*) as num
               FROM
					blog_'.$table.'
               WHERE
                    1 = "1" ';
	if (!empty($sFilter)) {
		$sQuery .= $sFilter;
	}
	$db = DB('default');
	$res = $db->query($sQuery);
	$list = $res->row_array();
	return $list['num'];
}
/**
 * 数据信息统计
 */
function getStatis($table,$sWhere='') {
	$sql = 'SELECT count(*) as num FROM blog_'.$table.' '.$sWhere;
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['num'];
}
/**
 * 未读信息统计
 */
function dynamicCou($sTable) {
	$sql = 'SELECT count(*) as num FROM blog_'.$sTable.' WHERE reply_id = 0 AND is_read = "N"';
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['num'];
}
/**
 * 未读提醒统计
 */
function noticeCou() {
	$sql = 'SELECT count(*) as num FROM blog_notice WHERE status = "unread"';
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['num'];
}
/**
 * 获取未浏览前几条动态
 */
function getDynamic($sTable) {
	$sql = 'SELECT 
				content,datetime 
			FROM 
				blog_'.$sTable.' 
			WHERE 
				reply_id = 0 
				AND is_read = "N"
			ORDER BY
				datetime DESC
			LIMIT 3';
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->result_array();
	return $list;
}
/**
 * 获取未读消息前几条
 */
function getNotice() {
	$sql = 'SELECT
				content,datetime
			FROM
				blog_notice
			WHERE
				status = "unread"
			ORDER BY
				datetime DESC
			LIMIT 3';
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->result_array();
	return $list;
}
/**
 * 时间转换函数
 */
function timeTran($sTime) {
	$now_time = date("Y-m-d H:i:s", time());
	$now_time = strtotime($now_time);
	$show_time = strtotime($sTime);
	$dur = $now_time - $show_time;
	if ($dur < 0) {
		return date("Y-m-d",$show_time);
	} else {
		if ($dur < 60) {
			return $dur . '秒前';
		} else {
			if ($dur < 3600) {
				return floor($dur / 60) . '分钟前';
			} else {
				if ($dur < 86400) {
					return floor($dur / 3600) . '小时前';
				} else {
					if ($dur < 259200) {		//3天内
						return floor($dur / 86400) . '天前';
					} else {
						return date("Y-m-d",$show_time);
					}
				}
			}
		}
	}
}
/**
 * 打印数据信息
 */
function pl($var) {
	$value = print_r($var, TRUE);
	$fileName = 'ciblog_admin.'.date('Ymd').'.run.log';
	$file = LOG.$fileName;
	$prefix = '[' . date('c') . '] ';
	@file_put_contents($file, $prefix . $value . "\n", FILE_APPEND);
}

/**
 * 文件上传函数
 * @param array  $upfile 	上传文件信息： 如：$_FILES['filename']
 * @param string $path 		上传文件的存储路径： 如："./uploads";
 * @param array  $typelist 	允许上传文件的类型，默认为空数组表示不限制
 * @param int 	 $maxsize 	允许上传文件的大小 默认为0表示不限制
 * @return string $reset	成功返回文件名。失败返回错误信息
 */
function uploadFile($upfile,$path,$typelist = array(),$maxsize=0) {
	//定义返回值信息
	$res = array('status'=>false,'info'=>"");

	//判断上传的错误信息
	if($upfile['error'] > 0) {
		switch($upfile['error']) {
			case 1: $info = "上传文件大小超出PHP配置文件的设置"; break;
			case 2: $info = "上传文件大小超过了表单中MAX_FILE_SIZE指定的值"; break;
			case 3: $info = "文件只有部分被上传。"; break;
			case 4: $info = "没有文件被上传。"; break;
			case 6: $info = "找不到临时文件夹。"; break;
			case 7: $info = "文件写入失败。"; break;
			default: $info = "未知错误"; break;
		}
		$res['info']=$info;
		return $res;
	}

	//指定上传文件类型
	$typelist = array('jpg','jpeg','gif','png');

	//获取上传文件扩展名
	$fileParts = pathinfo($upfile['name']);
	$fileExten = $fileParts['extension'];

	//过滤上传文件的类型
	if(count($typelist) > 0) { 				//判断是否执行类型过滤
		if(!in_array($fileExten,$typelist)){
			$res['info']="上传文件类型错误：".$upfile['type'];
			return $res;
		}
	}

	//过滤上传文件的大小
	if($maxsize > 0) {
		if($upfile['size'] > $maxsize) {
			$res['info']="上传文件大小超出了允许范围！".$maxsize;
			return $res;
		}
	}

	//上传文件名处理（随机名字,后缀名不变）
	do {
		$newname = time().rand(1000,9999).".".$fileExten;
	} while (file_exists($path.$newname)); //判断随机的文件名是否存在。

	//处理上传路径。
	$targetFile = rtrim($path,"/")."/".$newname;

	//判断并执行文件上传。
	if(is_uploaded_file($upfile['tmp_name'])) {
		if(move_uploaded_file($upfile['tmp_name'],$targetFile)) {
			$res['info'] = $newname;
			$res['status'] = true;
		}else{
			$res['info']='执行上传文件移动失败！';
		}
	}else{
		$res['info']='不是一个有效的上传文件！';
	}
	return $res;
}
/**
 * 加载图片上传插件
 */
function Uploadify() {
	$str = '<script src="'.PLUGIN_UPLOAD.'jquery-1.8.0.min.js" type="text/javascript"></script>
			<script src="'.PLUGIN_UPLOAD.'jquery.uploadify.min.js" type="text/javascript"></script>
			<link href="'.PLUGIN_UPLOAD.'uploadify.css" rel="stylesheet" type="text/css" >
			<div id="queue"></div>
			<input id="file_upload" name="file_upload" type="file" multiple="true">
			<div id="image" class="image">
				\'<div style="float:left;margin:2px 0 0 2px"><img width="50px" height="50px" src="/public/uploads/user/14325411746706.jpg" data-ke-src="/public/uploads/user/14325411746706.jpg" height=60 width=60 />\'
			</div>
			<script type="text/javascript">
				var img_id_upload = new Array();	//初始化数组，存储已经上传的图片名
				var i=0;							//初始化数组下标
				$(function() {
					$("#file_upload").uploadify({
						"swf"      : "'.PLUGIN_UPLOAD.'uploadify.swf",
						"uploader" : "'.PLUGIN_UPLOAD.'uploadify.php",
						"method" : "post",  						//服务端可以用$_POST数组获取数据
						"buttonText" : "选择图片",						//设置按钮文本
						"multi" : true,								//设置为true时可以上传多个文件
						"auto" : true,								//不自动上传
						"uploadLimit" : 10,							//一次最多只允许上传10张图片
						"fileTypeDesc" : "Image Files",				//只允许上传图像
						"fileTypeExts" : "*.gif; *.jpg; *.png",		//限制允许上传的图片后缀
						"fileSizeLimit" : "2000KB",					//限制上传的图片大小
						//文件上传失败
						"onUploadError" : function(file, errorCode, errorMsg, errorString) {
							alert(file.name + "上传失败原因:" + errorString);
						},
						//每次成功上传后执行的回调函数，从服务端返回数据到前端
						"onUploadSuccess" : function(file, data, response) {
							$(\'#image\').append(
								\'<div style="float:left;margin:2px 0 0 2px"><img width="50px" height="50px" src="/public/uploads/user/\'+data+\'" data-ke-src="/public/uploads/user/\'+data+\'" height=80 width=80 />\'
							);
							img_id_upload[i]=data;
							i++;
						}
					});
				});
			</script>';
	return $str;
}
/**
 * 生成作品上传文件链接
 */
function LinkWorks($str) {
	if(empty($str)) {
		return '';
	}
	return UPLOAD_PUBLIC.'works/'.$str;
}


