<script type="text/javascript" src="<?=UEDITOR_PLUGIN;?>ueditor.config.js"></script>
<script type="text/javascript" src="<?=UEDITOR_PLUGIN;?>ueditor.all.js"></script>
<script type="text/javascript" src="/public/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
<script type="text/javascript" src="/public/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css"></script>
<script>
SyntaxHighlighter.all();
SyntaxHighlighter.highlight();
</script>
<div id="article_new">
	<form action="<?=site_url('article/doArticle')?>" method="post">
		<input type="text" maxlength="200" name="article_title" id="article_title" placeholder="输入文章标题"/>
		<?=$uedit?>
		<div id="article_keyword">
			文章标签：<input type="text" name="article_keyword" class="article_keyword" placeholder="文章关键词，使用逗号分隔"/>
	    </div>
	    <div id="article_upload">
			上传配图：
			<script src="<?=UPLOAD_PLUGIN?>jquery-1.8.0.min.js" type="text/javascript"></script>
			<script src="<?=UPLOAD_PLUGIN?>jquery.uploadify.min.js" type="text/javascript"></script>
			<link href="<?=UPLOAD_PLUGIN?>uploadify.css" rel="stylesheet" type="text/css" >
			<input id="file_upload" name="file_upload" type="file" multiple="true">
			<div id="image" class="image"></div>
			<input type="hidden" name="img" id="img" value="">
			<script type="text/javascript">
				var img_id_upload = new Array();//初始化数组，存储已经上传的图片名
				var i=0;//初始化数组下标
				$(function() {
					$('#file_upload').uploadify({
						'swf'      : '<?=UPLOAD_PLUGIN?>uploadify.swf',
						'uploader' : '<?=UPLOAD_PLUGIN?>uploadify.php',
						'method' : 'post',  						//服务端可以用$_POST数组获取数据
						'buttonText' : '选择图片',						//设置按钮文本
						'multi':true,								//设置为true时可以上传多个文件
						'auto': true,								//不自动上传
						'uploadLimit' : 10,							//一次最多只允许上传10张图片
						'fileTypeDesc' : 'Image Files',				//只允许上传图像
						'fileTypeExts' : '*.gif; *.jpg; *.png',		//限制允许上传的图片后缀
						'fileSizeLimit' : '2000KB',					//限制上传的图片大小
						//文件上传失败
						'onUploadError' : function(file, errorCode, errorMsg, errorString) {
							alert(file.name + '上传失败原因:' + errorMsg);
						},
						'onUploadSuccess' : function(file, data, response) { 	//每次成功上传后执行的回调函数，从服务端返回数据到前端
							$('#image').append(
								'<img width="50px" height="50px" src="/public/upload/article/'+data+'" data-ke-src="/public/upload/article/'+data+'" height=80 width=80 />'
							);
							$("#img").val(data);
							img_id_upload[i]=data;
							i++;
							//alert(data);
						}
					});
				});
			</script>
	    </div>
	    <div id="article_site">
		    <div id="select_type">
				<select name="type">
					<?php foreach($list as $list):?>
					<option value ="<?=$list['id']?>">
						<?=$list['name']?>
					</option>
					<?php endforeach;?>
				</select>
			</div>
			<div id="select_top">
				<input type="checkbox" name="hometop" value="y" >首页置顶
				<input type="checkbox" name="sorttop" value="y" >分类置顶
				<input type="checkbox" name="allow_remark" value="y" checked >允许评论
			</div>
			<div style="float:left;">
				是否公开：<input type="radio" name="pass" value="1" checked="checked" class="rad">是
					  <input type="radio" name="pass" value="0" class="rad">否
			</div>
			<div id="password" style="display:none;" >
				<input type="password" name="password" value=''>
			</div><br/>
	    </div>
	    <input type="hidden" name="token" value="<?=$token?>" />
	    <div id="sub_artdiv">
	    	<input type="submit" value="发布文章" id="button-save-big"/>
	    </div>
	</form>
</div>