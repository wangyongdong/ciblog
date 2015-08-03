<?php 
/**
 * 重新定义跳转信息
 * @author WangYongDong
 * @param $message：提示信息，或者是跳转url
 * @param $state ，默认500即可
 * @param $heading：这个跳转页面显示的信息，如“登录成功”，“删除失败！”，“警告：非法操作！”等等；
 */
function show_error($message,$status_code=500,$heading='An Error Was Encountered') {
	$_error =& load_class('Exceptions','core');
	echo $_error->show_error($heading,$message,'error_general',$status_code);
	exit;
}
