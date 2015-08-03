<?php
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
function getUploadPlug() {
	$str = '<script src="'.UPLOADIFY_PATH.'jquery-1.8.0.min.js" type="text/javascript"></script>
			<script src="'.UPLOADIFY_PATH.'jquery.uploadify.min.js" type="text/javascript"></script>
			<link href="'.UPLOADIFY_PATH.'uploadify.css" rel="stylesheet" type="text/css" >
		
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
						"swf"      : "'.UPLOADIFY_PATH.'uploadify.swf",
						"uploader" : "'.UPLOADIFY_PATH.'uploadify.php",
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
 * 编辑器定制
 */
function getUeditForBig($content='') {
	$editorInfo = '
    		<br/>
    		<!-- 加载编辑器的容器 -->
		    <script id="container" name="content" type="text/plain">
		    '.$content.'
    		</script>
		    <!-- 实例化编辑器 -->
		    <script type="text/javascript">
		        var ue = UE.getEditor("container",{
    			maximumWords:50000,
		    	//编辑器宽高设置
				initialFrameWidth : 800,
				initialFrameHeight: 400
    		});
		    </script>';
	return $editorInfo;
}
/**
 * 说说编辑器定制
 */
function getUeditForRecord() {
	$editorInfo = '
		<!-- 加载编辑器的容器 -->
	    <script id="container" name="content" type="text/plain">
	    </script>
	    <!-- 实例化编辑器 -->
	    <script type="text/javascript">
			var ue = UE.getEditor("container",{
				toolbars: [
					[
			       		"simpleupload", //单图上传
			       		"insertimage", 	//多图上传
			       		"link", 		//超链接
			       		"emotion", 		//表情
			       		"map", 			//Baidu地图
			       		"insertvideo", 	//视频
			       		"forecolor", 	//字体颜色
			       		"attachment", 	//附件
			       		"music", 		//音乐
					]
				],
				//编辑器宽高设置
				initialFrameWidth : 600,
				initialFrameHeight: 80,
				wordCount:false
			});
	    </script>
	';
	return $editorInfo;
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
	$info = '';
	$CI->load->library('token');
	$token_result = $CI->token->checkValidateToken($token,$tokentype);
	$referer = $_SERVER['HTTP_REFERER'];
	if(Token::TOKECHECK_EXTERNSUBMIT == $token_result){
		$info = '禁止从外部网站提交数据，请检查...';
		headers($referer,'error_e',$info);
	} elseif(Token::TOKECHECK_DUPLICATESUBMIT == $token_result){
		$info = '请不要重复提交，请检查...';
		headers($referer,'error_e',$info);
	}
	return $info;
}

/**
 * 验证数据是否为空，并提示
 * @param array $arr 需要验证的数据
 * @param int 	$id
 * @param string $firstUrl  用户新建表单返回地址
 * @param string $secondURl 用户修改表单返回地址
 */
function checkEmpty($arr,$id,$firstUrl='',$secondURl='',$info='数据为空') {
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
		if(empty($id)) {
			headers(site_url($firstUrl),'error_e',$info);
		} else {
			headers(site_url($secondURl.$id.''),'error_e',$info);
		}
	}
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
 * 获取分类信息
 */
function makeSort($id) {
	$db = DB('default');
	$sql = 'SELECT name FROM blog_sort WHERE id='.$id;
	$res = $db->query($sql);
	$aList = $res->row_array();
	return $aList['name'];
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
 * 获取用户权限状态
 */
function getRole($id,$type='list') {
	if(empty($id)) {
		return;
	}
	if($type == 'list') {
		$sql = 'SELECT * FROM blog_role WHERE id='.$id;
	} else {
		$sql = 'SELECT '.$type.' FROM blog_role WHERE id='.$id;
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
 * 获取权限名
 */
function roleName($name) {
	switch ($name) {
		case 'admin':
			$str = "管理员";break;
		case 'super':
			$str = "超级管理员";break;
		case 'ban':
			$str = "禁止用户";break;
		default: $str = "普通用户";
	}
	return $str;
}
/**
 * 生成文章配图
 */
function LinkArticle($sName) {
	return '/public/upload/article/'.$sName;
}
/**
 * 生成用户头像
 */
function LinkAvatar($uid) {
	$sql = 'SELECT picname FROM blog_member WHERE id='.$uid;
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->result_array();
	$picname = $list['0']['picname'];
	if(!empty($picname)) {
		$url = UPLOAD_PUBLIC.'user/'.$picname;
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
 * 添加httpd
 */
function addHttpd($str) {
	if (!preg_match("/^(http|ftp):/",$str)){
		$str = 'http://'.$str;
	}
	return $str;
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
 * 页面跳转
 */
function headers($sUrl,$act,$info) {
	header("Location:".$sUrl."?".$act."=1&i=".$info);
	exit;
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
function getStatis($table,$sWhere='') {
	$sql = 'SELECT count(*) as num FROM blog_'.$table.' '.$sWhere;
	$db = DB('default');
	$res = $db->query($sql);
	$list = $res->row_array();
	return $list['num'];
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
 * 获取登录用户ID
 */
function UserId() {
	return $_SESSION['uid'] ? $_SESSION['uid'] : '1';
}
/**
 * 获取登录用户名
 */
function UserName() {
	$iUser = UserId();
	return getUser($iUser,'username');
}

/**
 * 验证密码
 */
function checkPasss($val1,$val2) {
	if(empty($val1) || empty($val2)) {
		return '1';//数据为空
	}
	if($val1 !== $val2) {
		return '2';//两次密码不一致
	}
	
	$UserInfo = getUser(UserId());
	
	$this->load->library('encrypt');
	$newPass = $this->encrypt->encryptcode($UserInfo['password'],$UserInfo['uniquely']);
	if($newPass != $UserInfo['password']) {
		return '3'; //旧密码输入不正确
	}
	return $newPass;
}
//新建用户生成密码
function checkPass($val1,$val2) {
	if(empty($val1) || empty($val2)) {
		return '1';//数据为空
	}
	if($val1 !== $val2) {
		return '2';//两次密码不一致
	}
	/* $data['uniquely'] = rand(1,100);
	$this->load->library('encrypt');
	$data['newpass'] = $this->encrypt->encryptcode($val1,$data['uniquely']);
	return $data; */
}






