<?php
/**
 * 文章编辑器定制
 */
function ArticleUedit($sContent='') {
	$sContent = stripcslashes($sContent);
	$sUedit = '
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
			<script id="editor" name="content" type="text/plain">'.$sContent.'</script>';
	echo $sUedit;
}
/**
 * 说说编辑器定制
 */
function RecordUedit($sContent='') {
	$sUedit = '
    		<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'ueditor.config.js"></script>
    		<script type="text/javascript" charset="utf-8" src="'.PLUGIN_UEDITOR.'ueditor.all.min.js"> </script>
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
			<script id="editor" name="content" type="text/plain">'.$sContent.'</script>';
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
 * 生成文章链接
 */
function linkArticle($iArticle) {
	return HOST.'/article/view/'.$iArticle;
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
 * 获取分类level
 */
function sortLevel($iSort) {
	$db = DB('default');
	$sql = 'SELECT level FROM blog_sort WHERE id='.$iSort;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return sg($aList['level'],0);
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
	$sql = 'SELECT img FROM blog_member WHERE id='.$iUser;
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	if(!empty($list['img'])) {
		$url = UPLOAD_PUBLIC.'user/'.$list['img'];
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
 * 未读提醒统计
 */
function noticeCou() {
	$sql = 'SELECT count(*) as num FROM blog_notice WHERE status = "unread" AND type != "contact" AND type != "comment"';
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['num'];
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
				AND type != "contact" 
				AND type != "comment"
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
 * 删除旧图片
 * 修改资料时，若图片被修改，则删除旧图
 */
function changeImg($sType,$id,$sFile) {
	//此处删除使用真实路径
	if($sType == 'article') {
		$sql = 'SELECT img FROM blog_article WHERE id='.$id;
		$path = UPLOAD_PATH.'article/';
	}
	if($sType == 'user') {
		$sql = 'SELECT img FROM blog_member WHERE id='.$id;
		$path = UPLOAD_PATH.'user/';
	}
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	if(!empty($list) && $list['img'] != $sFile) {
		$res = @unlink($path.$list['img']);
	}
}
/**
 * 获取评论和留言的email
 */
function getEmail($sType,$id) {
	$sql = 'SELECT * FROM blog_'.$sType.' WHERE id='.$id;
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	if(!empty($list)) {
		return $list;
	}
}
/**
 * 获取文件数量
 */
function FileCount($dir) {
	$count = 0;
	if(is_dir($dir) && file_exists($dir)) {
		$ob = scandir($dir);
		foreach($ob as $file) {
			if($file=="." || $file==".." || $file==".htaccess") {
				continue;
			}
			$file = $dir."/".$file;
			if(is_file($file)) {
				$count++;
			}
		}
	}
	return $count;
}
/**
 * 删除文件
 */
function delFile($dir,$type,$module='') {
	$count = 0;
	if(is_dir($dir) && file_exists($dir)) {
		$ob = scandir($dir);
		foreach($ob as $file) {
			if($file=="." || $file==".." || $file==".htaccess") {
				continue;
			}
			$sfile = $dir."/".$file;
			if(is_file($sfile)) {
				if($type == 'all') {
					@unlink($sfile);
					$count++;
				} else if($type == 'view') {
					@unlink($sfile);
					$count++;
				} else {
					if(!empty($module)) {
						for ($i=0;$i<=count($module);$i++) {
							if(strpos($file, $module[$i]) !== false) {
								@unlink($sfile);
								$count++;
							}
						}
					}
				}
			}
		}
	}
	return $count;
}
