<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 定义后台素材文件为常量
 */
$host = "http://".$_SERVER['SERVER_NAME'];
define("HOST", $host);
define("ADMIN_PUBLIC","/public/admin/");	//后台公共目录
define("LOG",$_SERVER['DOCUMENT_ROOT']."/public/logs/"); 	//log目录
define("PLUGIN_UEDITOR",$host."/public/plugin/ueditor/"); 	//编辑器插件
define("PLUGIN_UPLOAD",$host."/public/plugin/uploadify/"); 	//图片上传插件
define("PLUGIN_QQFACE","/public/plugin/qqface/"); 	//表情插件
define("UPLOAD_PUBLIC","/public/upload/"); 							//上传文件位置
define("UPLOAD_PATH",$_SERVER['DOCUMENT_ROOT']."/public/upload/"); 	//文件上传目录

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
| These modes are used when working with fopen()/popen()
*/
define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/* End of file constants.php */
/* Location: ./application/config/constants.php */