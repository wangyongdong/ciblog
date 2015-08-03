<script type="text/javascript" src="<?=UEDITOR_PLUGIN;?>ueditor.config.js"></script>
<script type="text/javascript" src="<?=UEDITOR_PLUGIN;?>ueditor.all.js"></script>
<div id="article_new">
	<form action="<?=site_url('article/doArticle')?>" method="post">
		<input type="text" maxlength="200" name="article_title" id="article_title" value="<?=$article['title'];?>" placeholder="输入文章标题"/>
		<?=$uedit?>
		<div id="article_keyword">
			关键词：<input type="text" name="article_keyword" class="article_keyword" placeholder="文章关键词，使用逗号分隔" value="<?=$article['keyword'];?>"/>
	    </div>
	    <div id="article_upload">
			上传配图：
			<script src="<?=UPLOAD_PLUGIN?>jquery-1.8.0.min.js" type="text/javascript"></script>
			<script src="<?=UPLOAD_PLUGIN?>jquery.uploadify.min.js" type="text/javascript"></script>
			<link href="<?=UPLOAD_PLUGIN?>uploadify.css" rel="stylesheet" type="text/css" >
			<input id="file_upload" name="file_upload" type="file" multiple="true">
			<div id="image" class="image">
				<img width="50px" height="50px" src="<?=LinkArticle($article['img'])?>" data-ke-src="<?=LinkArticle($article['img'])?>" height=80 width=80 />
			</div>
			<input type="hidden" name="img" id="img" value="<?=$article['img']?>">
			<script type="text/javascript">
				<?php $timestamp = time();?>
				var img_id_upload = new Array();//初始化数组，存储已经上传的图片名
				var i=0;//初始化数组下标
				$(function() {
					$('#file_upload').uploadify({
						'formData'     : {
							'timestamp' : '<?php echo $timestamp;?>',
							'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
						},
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
							$('#image').html('');
							$('#image').append(
								'<img width="50px" height="50px" src="/public/upload/article/'+data+'" data-ke-src="/public/upload/article/'+data+'" height=80 width=80 />'
							);
							$("#img").val('');
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
					<option value ="<?=$list['id']?>" <?php if($article['type'] == $list['id']) { echo 'selected';}?>>
						<?=$list['name']?>
					</option>
					<?php endforeach;?>
				</select>
			</div>
			<div id="select_top">
				<input type="checkbox" name="hometop" value="y" <?php if($article['hometop'] == 'y') {echo 'checked';}?> >首页置顶
				<input type="checkbox" name="sorttop" value="y" <?php if($article['sorttop'] == 'y') {echo 'checked';}?> >分类置顶
				<input type="checkbox" name="allow_remark" value="y" <?php if($article['allow_remark'] == 'y') {echo 'checked';}?> >允许评论
			</div>
			<div style="float:left;">
				是否公开：<input type="radio" name="pass" value="1" <?php if(empty($article['password'])) {echo 'checked="checked"';}?> class="rad">是
					  <input type="radio" name="pass" value="0" <?php if(!empty($article['password'])) {echo 'checked="checked"';}?> class="rad">否
			</div>
			<div id="password" <?php if(!empty($article['password'])) {echo 'style="display:block;"';} else {echo 'style="display:none;"';}?> >
				<input type="password" name="password" value='<?=$article['password']?>'>
			</div>
		</div>
		<input type="hidden" name='uid' value="<?=$article['uid']?>">
		<input type="hidden" name='id' value="<?=$article['id']?>">
	    <input type="hidden" name="token" value="<?=$token?>" />
	    <div id="sub_artdiv">
	    	<input type="submit" id="button-save-big" value="修改文章"/>
	    </div>
	</form>
</div>

