<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array (
	'web_cache' => array (		//网页缓存
		"about" => 60*60*24,
		"archive" => 60*60*24,
		"article" => 60*60*24,
		"article_view" => 60*60*24,
		"cms" => 60*60*24,
		"cms_view" => 60*60*24,
		"contact" => 60*60*24,
		"history" => 60*60*24,
		"home" => 60*60*24,
		"links" => 60*60*24,
		"record" => 60*60*24
	),
	'data_cache' => array ( 	//数据缓存
		"time" => 60*60*24*7
	)
);