<?php
/**
 * 获取token
 * @param string $tokentype
 * @return string
 */
function getToken($tokentype) {
	$CI = & get_instance();
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
	$info = '';
	$CI->load->library('token');
	$token_result = $CI->token->checkValidateToken($token,$tokentype);
	$referer = $_SERVER['HTTP_REFERER'];
	if(Token::TOKECHECK_EXTERNSUBMIT == $token_result){
		$info = '禁止从外部网站提交数据，请检查...';
		localCommon($info);
	} elseif(Token::TOKECHECK_DUPLICATESUBMIT == $token_result){
		$info = '请不要重复提交，请检查...';
		localCommon($info);
	}
	return $info;
}
/**
 * 跳转方法
 * @param unknown $sMessage
 * @param string $sUrl
 */
function localCommon($sMessage,$sUrl='') {
	$url = site_url('common/index?mess='.urlencode($sMessage).'&url='.urlencode($sUrl));
	redirect($url);
}
/**
 * ajax 输出方法
 */
function echoAjax($aRtn) {
	echo json_encode($aRtn);
	exit;
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
 * 获取配置信息
 */
function getSet($sField) {
	$sql = 'SELECT
    			option_value
    		FROM
    			blog_options
			WHERE
				option_name="'.$sField.'"';
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['option_value'];
}
/**
 * 获取页面title
 */
function getPageDesc($sName) {
	$sql = 'SELECT menu_desc FROM blog_menu WHERE menu_alias="'.$sName.'"';
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['menu_desc'];
}
/**
 * 获取数据总条数
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
 * 获取用户信息
 */
function getUserInfo($iUser,$type='list') {
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
 * 获取分类信息
 */
function getSortField($iSort,$sField='') {
	$db = DB('default');
	$sql = 'SELECT '.$sField.' FROM blog_sort WHERE id='.$iSort;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return $aList[$sField];
}
/**
 * 获取文章所属分类
 */
function getSortByArticle($iArticle) {
	$db = DB('default');
	$sql = 'SELECT sortid FROM blog_article WHERE id='.$iArticle;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return $aList['sortid'];
}
/**
 * 判断email格式是否正确
 * @param $email
 */
function is_email($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}
/**
 * 生成用户头像
 */
function LinkAvatar($uid) {
	$sql = 'SELECT img FROM blog_member WHERE id='.$uid;
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	$img = $list['img'];
	if(!empty($img)) {
		$url = UPLOAD_PUBLIC.'user/'.$img;
	} else {
		$url = ADMIN_PUBLIC.'images/common/avatar.jpg';
	}
	return $url;
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
 * 时间友好显示
 */
function dateFor($time,$val='') {
	if(!empty($val)) {
		return date($val,strtotime($time));
	} else {
		return date("Y-m-d",strtotime($time));
	}
}
/**
 * 英文日期转换
 */
function engDate($time,$val='') {
	$Month_E = array(
		1 => "January",
		2 => "February",
		3 => "March",
		4 => "April",
		5 => "May",
		6 => "June",
		7 => "July",
		8 => "August",
		9 => "September",
		10 => "October",
		11 => "November",
		12 => "December"
	);
	if($val == 'm') {
		$month = date("m",strtotime($time));
		return $Month_E[intval($month)];
	} else if($val == 'yd') {
		$arr = explode('/', $time);
		$eng_month = $Month_E[intval($arr[1])];
		$engTime = $eng_month.' '.$arr[0];
		return $engTime;
	}
}
/**
 * 表情替换
 * @param unknown $str
 * @return mixed
 */
function ubbReplace($str) {
	$str = str_replace ( ">", '<；', $str );
	$str = str_replace ( ">", '>；', $str );
	$str = str_replace ( "\n", '>；br/>；', $str );
	$str = preg_replace ( "[\[em_([0-9]*)\]]",'<img src="'.PLUGIN_QQFACE.'face/$1.gif" border="0" />', $str );
	
	return $str;
}







