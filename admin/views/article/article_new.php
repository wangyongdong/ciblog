<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head" style="margin-top:-22px;">
		<h2 class="pull-left"><i class="icon-home"></i> 发布文章</h2>
		<div class="bread-crumb pull-right">
			<a href="/admin"><i class="icon-home"></i> 首页</a> 
			<span class="divider">/</span> 
			<a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="matter">
		<div class="container">
			<div class="col-md-12">
      			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">发布文章</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>  
	                  	<div class="clearfix"></div>
	                </div>
        			<div class="widget-content">
          				<div class="padd">
              				<div class="form quick-post">
                              	<form class="form-horizontal" method="post" action="<?=site_url('article/doArticle')?>" onsubmit="return checkFormA()">
                              		<input type="hidden" name="token" value="<?=$token?>">
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="title">标题</label>
                                    	<div class="col-lg-9"> 
                                      		<input type="text" class="form-control" id="title" name="title" >
                                    	</div>
                                  	</div>
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="content">内容</label>
                                    	<div class="col-lg-9">
                                      		<?=ArticleUedit();?>
                                    	</div>
                                  	</div>
									<div class="form-group">
                                    	<label class="control-label col-lg-3" for="keyword">关键词</label>
                                    	<div class="col-lg-9"> 
                                      		<input type="text" class="form-control" id="keyword" name="keyword">
                                    	</div>
                                  	</div>
									<div class="form-group">
                                    	<label class="control-label col-lg-3" for="img">配图</label>
                                    	<div class="col-lg-9"> 
											<script type="text/javascript" src="<?=PLUGIN_UPLOAD?>jquery-1.8.0.min.js"></script>
											<script type="text/javascript" src="<?=PLUGIN_UPLOAD?>jquery.uploadify.min.js"></script>
											<link type="text/css" rel="stylesheet" href="<?=PLUGIN_UPLOAD?>uploadify.css">
											<div id="queue"></div>
											<input id="file_upload" name="file_upload" type="file" multiple="true">
											<div id="image" style="float:left;margin:2px 0 0 2px"></div>
											<input type="hidden" id="post-img" name="img" value="">
											<script type="text/javascript">
												<?php $timestamp = time();?>
												var img_id_upload = new Array();//初始化数组，存储已经上传的图片名
												var i=0;//初始化数组下标
												$(function() {
													$('#file_upload').uploadify({
														'formData'     : {
															'timestamp' : '<?php echo $timestamp;?>',
															'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
															'type'		: 'article'
														},
														'swf'      : '<?=PLUGIN_UPLOAD?>uploadify.swf',
														'uploader' : '<?=PLUGIN_UPLOAD?>uploadify.php',
														'method' : 'post',  						//服务端可以用$_POST数组获取数据
														'buttonText' : '选择图片',					//设置按钮文本
														'multi':true,								//设置为true时可以上传多个文件
														'auto': true,								//不自动上传
														'uploadLimit' : 10,							//一次最多只允许上传10张图片
														'fileTypeDesc' : 'Image Files',				//只允许上传图像
														'fileTypeExts' : '*.gif; *.jpg; *.png',		//限制允许上传的图片后缀
														'fileSizeLimit' : '2000KB',					//限制上传的图片大小
														//文件上传失败
														'onUploadError' : function(file, errorCode, errorMsg, errorString) {
															alert(file.name + '上传失败原因:' + errorString);
														},
														'onUploadSuccess' : function(file, data, response) { 	//每次成功上传后执行的回调函数，从服务端返回数据到前端
															$('#image').text("");
															$('#image').append(
																'<img src="<?=UPLOAD_PUBLIC?>article/'+data+'" data-ke-src="<?=UPLOAD_PUBLIC?>article/'+data+'" height=80 width=80 />'
															);
															$('#post-img').val(data);
															img_id_upload[i]=data;
															i++;
															//alert(data);
														}
													});
												});
											</script>
                                  		</div>
                                  	</div>
                                  	<div class="form-group">
	                                  	<label class="col-lg-4 control-label">分类</label>
	                                  	<div class="col-lg-9">
		                                    <select class="form-control" name="sortid" id="sortid">
		                                    	<?php foreach($sort as $slist):?>
						                    	<option value="<?=$slist['id']?>"><?=$slist['name']?></option>
						                    	<?php endforeach;?>
		                                    </select>
	                                  	</div>
	                                </div>
	                                <div class="form-group">
	                                	<label class="col-lg-4 control-label">置顶方式</label>
		                                <div class="col-lg-9">
		                                	<label class="radio-inline">
												<input id="topway" type="radio" value="none" name="topway" checked="checked">
												<span class="label label-default">无置顶</span>
											</label>
											<label class="radio-inline">
												<input id="topway" type="radio" value="home" name="topway">
												<span class="label label-primary">首页置顶</span>
											</label>
											<label class="radio-inline">
												<input id="topway" type="radio" value="sort" name="topway">
												<span class="label label-info">分类置顶</span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-4 control-label">状态</label>
										<div class="col-lg-9">
											<label class="radio-inline">
												<input id="status" type="radio" value="show" name="status" checked="checked">
												<span class="label label-success">显 示</span>
											</label>
											<label class="radio-inline">
												<input id="status" type="radio" value="hide" name="status">
												<span class="label label-danger">隐 藏</span>
											</label>
										</div>
									</div>
                                  	<div class="form-group">
									 	<div class="col-lg-offset-2 col-lg-9">
											<button type="submit" class="btn btn-success">保存</button>
											<button type="reset" class="btn btn-default" onclick="javascript:window.history.back();">取消</button>
									 	</div>
                                  	</div>
                              	</form>
                            </div>
          				</div>
						<div class="widget-foot"></div>
        			</div>
      			</div> 
    		</div>
		</div>
	</div>
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->