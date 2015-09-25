<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 对用户登录进行操作的工具类，包括了登录和注销时，cookies和session的设置
 * @author WangYongDong
 */
class Auth {
	
	//对登录后生成的key进行加密编码，以便于放到cookies里面的时候安全性
	static private function sid_encode($username) {
		$ip = sg($_SERVER['REMOTE_ADDR']);
		$agent = sg($_SERVER['HTTP_USER_AGENT']);
		$authkey = md5($ip.$agent);
		$check = substr(md5($ip.$agent), 0, 8);
		return rawurlencode(self::authcode("$username\t$check", 'ENCODE', $authkey, 0));
	}
	
	//对登录后生成的key进行解密，用于验证cookies中的key是否合法
	static private function sid_decode($sid) {
		$ip = sg($_SERVER['REMOTE_ADDR']);
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$authkey = md5($ip.$agent);
		$s = self::authcode(rawurldecode($sid), 'DECODE', $authkey, 0);
		if(empty($s)) {
			return FALSE;
		}
		@list($username, $check) = explode("\t", $s);
		if($check == substr(md5($ip.$agent), 0, 8)) {
			return $username;
		} else {
			return FALSE;
		}
	}
	
	//对登录后生成的key进行加密的算法实现
	static private function authcode($string,$operation='DECODE',$key='',$expiry=0){
		$ckey_length=4;
	 
		$key=md5($key?$key:'blog');
		$keya=md5(substr($key,0,16));
		$keyb=md5(substr($key,16,16));
		$keyc=$ckey_length ? ($operation=='DECODE' ? substr($string,0,$ckey_length):substr(md5(microtime()),-$ckey_length)):'';
	 
		$cryptkey=$keya.md5($keya.$keyc);
		$key_length=strlen($cryptkey);
	 
		$string=$operation=='DECODE' ? base64_decode(substr($string,$ckey_length)):sprintf('%010d',$expiry ? $expiry+time():0).substr(md5($string.$keyb),0,16).$string;
		$string_length=strlen($string);
	 
		$result='';
		$box=range(0,255);
	 
		$rndkey=array();
		for($i=0;$i<=255;$i++){
			$rndkey[$i]=ord($cryptkey[$i%$key_length]);
		}
	 
		for($j=$i=0;$i<256;$i++){
			$j=($j+$box[$i]+$rndkey[$i])%256;
			$tmp=$box[$i];
			$box[$i]=$box[$j];
			$box[$j]=$tmp;
		}
	 
		for($a=$j=$i=0;$i<$string_length;$i++){
			$a=($a+1)%256;
			$j=($j+$box[$a])%256;
			$tmp=$box[$a];
			$box[$a]=$box[$j];
			$box[$j]=$tmp;
			$result.=chr(ord($string[$i]) ^ ($box[($box[$a]+$box[$j])%256]));
		}
	 
		if($operation=='DECODE'){
			if((substr($result,0,10)==0||substr($result,0,10)-time()>0)&&substr($result,10,16)==substr(md5(substr($result,26).$keyb),0,16)){
				return substr($result,26);
			}else{
				return'';
			}
		}else{
			return $keyc.str_replace('=','',base64_encode($result));
		}
	 
	}
	
	//将登录后的key设置到cookies中
	static private function set_cookie($key,$value,$life=0,$httponly=false) {
		(!defined('UC_COOKIEPATH')) && define('UC_COOKIEPATH', '/');
		(!defined('UC_COOKIEDOMAIN')) && define('UC_COOKIEDOMAIN', '');
		
		if($value == '' || $life < 0) {
			$value = '';
			$life = -1;
		}
		
		$life = $life > 0 ? time() + $life : ($life < 0 ? time() - 31536000 : 0);
		$path = $httponly && PHP_VERSION < '5.2.0' ? UC_COOKIEPATH.'; HttpOnly' : UC_COOKIEPATH;
		$secure = $_SERVER['SERVER_PORT'] == 443 ? 1 : 0;
		if(PHP_VERSION < '5.2.0') {
			setcookie($key, $value, $life, $path, UC_COOKIEDOMAIN, $secure);
		} else {
			setcookie($key, $value, $life, $path, UC_COOKIEDOMAIN, $secure, $httponly);
		}
		
	}
	
	/**
	 * 用户登录时进行的cookies和session操作
	 * @param $uid        登录验证后返回的用户id
	 * @param $username   登录验证后返回的用户名
	 */
	static function userLoginSet($uid,$username) {
		if($uid>0 && !empty($username)) {
			$sid = self::sid_encode($uid.'-'.$username);
			self::set_cookie('sid',$sid,0);
			
			$_SESSION['uid'] = intval($uid);
			$_SESSION['username'] = $username;
		} else {
			self::set_cookie('sid', '');
			$_SESSION['uid'] = 0;
			$_SESSION['username'] = '';
		}
		return;
	}
	
	/**
	 * 用户注销时进行的cookies和session操作
	 */
	static function useLoginOut(){
		self::set_cookie('sid','');
		$_SESSION['uid'] = 0;
		$_SESSION['username'] = '';
	}
	
	/**
	 * 通过cookies和session中保存的变量，验证登录状态
	 */
	static function userLoginCheck(){
    	$sid = empty($_COOKIE['sid']) ? '' : $_COOKIE['sid'];
    	$arr = self::sid_decode($sid);
		$aUser = explode("-",$arr);
		if(intval($aUser[0]) > 0 && !empty($aUser[1])) {
			$_SESSION['uid'] = $aUser[0];
			$_SESSION['username'] = $aUser[1];
		} else {
			$_SESSION['uid'] = 0;
			$_SESSION['username'] = '';
		}
	}
}