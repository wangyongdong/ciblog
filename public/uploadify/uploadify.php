<?php
/**
 * Uploadify
 * Copyright (c) 2012 Reactive Apps, Ronnie Garcia
 * Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
 */

// Define a destination
$targetFolder = '/public/upload/article/';
$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;	//文件上传目录
$info = uploadFile($_FILES['Filedata'], $targetPath);
echo $info;

/**
 * 文件上传函数
 * @param array  $upfile 	上传文件信息： 如：$_FILES['filename']
 * @param string $path 		上传文件的存储路径： 如："./uploads";
 * @param array  $typelist 	允许上传文件的类型，默认为空数组表示不限制
 * @param int 	 $maxsize 	允许上传文件的大小 默认为0表示不限制
 * @return string $reset	成功返回文件名。失败返回错误信息
 */
function uploadFile($upfile,$path,$typelist = array(),$maxsize=0){
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
		return $info;
	}

	//指定上传文件类型
	$typelist = array('jpg','jpeg','gif','png');

	//获取上传文件扩展名
	$fileParts = pathinfo($upfile['name']);
	$fileExten = $fileParts['extension'];

	//过滤上传文件的类型
	if(count($typelist) > 0) { 				//判断是否执行类型过滤
		if(!in_array($fileExten,$typelist)){
			return "上传文件类型错误：".$upfile['type'];
		}
	}

	//过滤上传文件的大小
	if($maxsize > 0) {
		if($upfile['size'] > $maxsize) {
			return "上传文件大小超出了允许范围！".$maxsize;
		}
	}

	//上传文件名处理（随机名字,后缀名不变）
	do {
		$newname = time().rand(1000,9999).".".$fileExten;
	} while(file_exists($path.$newname)); //判断随机的文件名是否存在。

	//处理上传路径。
	$targetFile = rtrim($path,"/")."/".$newname;

	//判断并执行文件上传。
	if(is_uploaded_file($upfile['tmp_name'])) {
		if(move_uploaded_file($upfile['tmp_name'],$targetFile)) {
			$info = $newname;
		} else {
			$info = '执行上传文件移动失败！';
		}
	} else {
		$info = '不是一个有效的上传文件！';
	}
	return $info;
}