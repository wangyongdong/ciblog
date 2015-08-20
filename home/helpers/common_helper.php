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
function getSortField($id,$field='') {
	$db = DB('default');
	$sql = 'SELECT '.$field.' FROM blog_sort WHERE id='.$id;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return $aList[$field];
}
/**
 * 获取文章所属分类
 */
function getSortByArticle($id) {
	$db = DB('default');
	$sql = 'SELECT sortid FROM blog_article WHERE id='.$id;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return $aList['sortid'];
}
/**
 * 获取作品状态
 */
function getWorkStatus($str) {
	switch ($str) {
		case 'learn':
			return '未上线';
			break;
		case 'online':
			return '已上线';
			break;
	}
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
 * 获取说说标题
 */
function getRecordTitle($iRecord) {
	$db = DB('default');
	$sql = 'SELECT content FROM blog_record WHERE id='.$iRecord;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return cutStr(strip_tags($aList['content']),12);
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
 * 生成作品上传文件链接
 */
function LinkWorks($str) {
	if(empty($str)) {
		return '';
	}
	return UPLOAD_PUBLIC.'works/'.$str;
}
/**
 * 过滤用户输入的数据
 */
function sg($str,$fit='') {
	if(!is_array($str)) {
		$str = trim($str);
		$str = addslashes($str);
	}
	return empty($str) ? $fit : $str;
}
/**
 * 截取函数
 */
function cutStr($str,$length,$dot = '......') {
	$len = mb_strlen($str,'utf8');
	$str = mb_substr($str,0,$length,'UTF-8');
	if($len>$length) {
		return $str.$dot;
	} else {
		return $str;
	}
}
/**
 * 去除img标签
 */
function imgReplace($str) {
	return strip_tags($str,'img');
}
/**
 * 获取页面介绍
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
 * 信息统计
 */
function getStatis($table) {
	$sql = 'SELECT count(*) as num FROM blog_'.$table;
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['num'];
}
/**
 * 时间友好显示
 */
function dateFor($time) {
	return date("Y-m-d",strtotime($time));
}
/**
 * 英文月份转换
 */
function engMonth($time) {
	$month = date("m",strtotime($time));
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
	return $Month_E[intval($month)];
}
/**
 * 英文日期转换
 */
function engDate($time) {
	$arr = explode('/', $time);
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
	$eng_month = $Month_E[intval($arr[1])];
	$engTime = $eng_month.' '.$arr[0];
	return $engTime;
}







