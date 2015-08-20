<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 密码加密类
 * @author WangYongDong
 */
class Encrypt {
	const key = 'yy_blog';
	static function encryptcode($str,$uniquely) {
		if(empty($str)) {
			return false;
		}
		return self::encode($str,$uniquely);
	}
	
	static function encode($str,$uniquely) {
		$sMd5 = self::md5encode($str,$uniquely);
		$sCry = self::cryptencode($sMd5);
		$sha1 = self::sha1encode($sCry);
		return substr($sha1,0,24);
	}
	
	static function md5encode($str,$uniquely) {
		$st1md = md5($str.$uniquely);
		return md5($st1md);
	}
	
	static function cryptencode($str) {
		$strkey = strlen(self::key);
		$scr1 = crypt(self::key,substr($str,0,$strkey));
		$scr2 = crypt($str,substr(self::key,0,$strkey));
		return crypt($scr1,substr($scr2,0,$strkey));
	}
	
	static function sha1encode($str) {
		return sha1($str).sha1(self::key);
	}
	
}