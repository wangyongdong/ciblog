<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * token验证类
 * @author WangYongDong
 */
class Token {

	//令牌在session存储的名称，数组形式存在，键值是操作类型的编码，用于区分同页面不同form提交时的令牌
	const TOKEN_KEY = 'tokenKey';
	
	//用过的令牌在session中存储的名称，数组形式存在，数组的最后一个元素表示刚刚使用过的令牌
	const USED_TOKEN = 'tokenKeyUsed';
	
	//令牌的加密算法
	const ENCRYPT_KEY = 'blog';
	
	//验证令牌后得到的结果
	const TOKECHECK_EXTERNSUBMIT = -1;     //令牌验证未通过，因为检查到表单提交来自外部伪造
	const TOKECHECK_DUPLICATESUBMIT = -2;  //令牌验证未通过，因为检查到表单发生了重复提交的现象
	const TOKECHECK_VALIDATE = 1;          //令牌验证通过，可以执行后续动作

	//session会话对象，保存令牌的副本，用于验证令牌的合法性
	var $session;

	//本次生成的令牌副本，方便程序中的使用
	var $token = array();
	
	/**
	 * 构造方法，初始化session对象引用，同时判断session中需要保存的缓冲区是否初始化，如果没有，同时将缓冲区初始化
	 */
	function CheckToken() {
		$this->session = &$_SESSION;
		$this->session[Token::TOKEN_KEY] = is_array($this->session[Token::TOKEN_KEY]) ? $this->session[Token::TOKEN_KEY] : array();
		$this->session[Token::USED_TOKEN] = is_array($this->session[Token::USED_TOKEN]) ? $this->session[Token::USED_TOKEN] : array();
	}

	/**
	 * 生成一个令牌，并将其放入session和本类对象的缓冲区中
	 * @actiontype 令牌对象的标识，用于当同一个页面出现多个令牌时，区分不同的令牌时使用，要求每个令牌具有唯一的标识
	 * @return 生成的令牌
	 */
	public function granteToken($actiontype) {
		$token = $this->encrypt($actiontype . ':' . session_id(), Token::ENCRYPT_KEY);
		$this->setToken($token,$actiontype);
		return $token;
	}

	/**
	 * 检查令牌的特征，判断是否是合法的表单提交
	 * @$token 待验证的令牌，通常由提交的表单给出
	 * @actiontype 令牌对象的标识，用于当同一个页面出现多个令牌时，区分不同的令牌时使用，要求每个令牌具有唯一的标识
	 * @return 令牌验证的结果，其结果定义在本类的常量中，请参考
	 */
	public function checkValidateToken($token,$actiontype) {
		if(session_id() != $this->getSessionidFromToken($token)) {
			return Token::TOKECHECK_EXTERNSUBMIT;
		} else if (@in_array($token,$this->session[Token::USED_TOKEN])) {
			return Token::TOKECHECK_DUPLICATESUBMIT;
		}
		$this->pushToken($token,$actiontype);
		return Token::TOKECHECK_VALIDATE;
	}
	
	/**
	 * 私有方法，将令牌中附加的sessionid解析出来
	 * @$token 待验证的令牌
	 * @return 令牌中附加的sessionid
	 */
	private function getSessionidFromToken($token) {
		$source = explode(':', $this->decrypt($token, Token::ENCRYPT_KEY));
		$sid = $source[1];
		return $sid;
	}

	/**
	 * 私有方法，将令牌中附加的sessionid解析出来
	 * @$token 待验证的令牌
	 * @return 令牌中附加的sessionid
	 */
	private function setToken($token,$actiontype) {
		$this->session[Token::TOKEN_KEY][$actiontype] = $token;
		$this->token[$actiontype] = $token;
	}

	/**
	 * 私有方法，将用过的令牌放入历史缓冲区，可用于判断是否令牌是否被重复使用了
	 * @$token 待验证的令牌
	 * @$actiontype 令牌的标识
	 */
	private function pushToken($token,$actiontype) {
		@array_push($this->session[Token::USED_TOKEN],$token);
		$this->session[Token::TOKEN_KEY][$actiontype] = '';
	}

	/**
	 * 私有方法，令牌的加密算法
	 * @$txt   待加密的字符串
	 * @$encrypt_key 加密的密钥
	 * @return 加密后的字符串
	 */
	private function keyED($txt, $encrypt_key) {
		$encrypt_key = md5($encrypt_key);
		$ctr = 0;
		$tmp = '';
		for ($i = 0; $i < strlen($txt); $i++) {
			if ($ctr == strlen($encrypt_key))
				$ctr = 0;
			$tmp .= substr($txt, $i, 1) ^ substr($encrypt_key, $ctr, 1);
			$ctr++;
		}
		return $tmp;
	}

	/**
	 * 私有方法，对令牌进行加密
	 * @$txt   待加密的令牌
	 * @$key   加密的密钥
	 * @return 加密后得到的令牌
	 */
	private function encrypt($txt, $key) {
		$encrypt_key = md5(((float) date('YmdHis') + rand(10000000000000000, 99999999999999999)) . rand(100000, 999999));
		$ctr = 0;
		$tmp = '';
		for ($i = 0; $i < strlen($txt); $i++) {
			if ($ctr == strlen($encrypt_key))
				$ctr = 0;
			$tmp .= substr($encrypt_key, $ctr, 1) . (substr($txt, $i, 1) ^ substr($encrypt_key, $ctr, 1));
			$ctr++;
		}
		return base64_encode($this->keyED($tmp, $key));
	}

	/**
	 * 私有方法，对令牌进行解密
	 * @$txt   待解密的令牌
	 * @$key   加密的密钥
	 * @return 解密后得到的令牌
	 */
	private function decrypt($txt, $key) {
		$txt = $this->keyED(base64_decode($txt), $key);
		$tmp = '';
		for ($i = 0; $i < strlen($txt); $i++) {
			$md5 = substr($txt, $i, 1);
			$i++;
			$tmp .= (substr($txt, $i, 1) ^ $md5);
		}
		return $tmp;
	}

}
?>
