<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head" style="margin-top:0px;">
		<h2 class="pull-left"><i class="icon-home"></i> 个人资料</h2>
        <div class="bread-crumb pull-right">
	    	<a href="/admin"><i class="icon-home"></i> 首页</a> 
	        <span class="divider">/</span> 
	        <a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
        </div>
		<div class="clearfix"></div>
	</div>
	<div class="matter">
		<div class="container">
			<div class="col-md-7">
              	<div class="widget">
					<div class="widget-head">
			        	<div class="pull-left">用户头像</div>
			            <div class="widget-icons pull-right">
			            	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
			                <a href="#" class="wclose"><i class="icon-remove"></i></a>
			            </div>
			        	<div class="clearfix"></div>
					</div>
                	<div class="widget-content">
                  		<div class="padd">
							<div class="avatar pull-left" id="image">
								<img alt="" src="<?=LinkAvatar()?>" height=80 width=80>
							</div>
                      		<div class="post-avatar pull-left">
								<script type="text/javascript" src="<?=PLUGIN_UPLOAD?>jquery-1.8.0.min.js"></script>
								<script type="text/javascript" src="<?=PLUGIN_UPLOAD?>jquery.uploadify.min.js"></script>
								<link type="text/css" rel="stylesheet" href="<?=PLUGIN_UPLOAD?>uploadify.css">
								<div id="queue"></div>
								<input id="file_upload" name="file_upload" type="file" multiple="true">
								<input type="hidden" name="id" id="id" value="<?=$list['id']?>">
								<p>
									<a href="javascript:$('#file_upload').uploadify('upload','*')">上传</a>
								</p><br />
								<script type="text/javascript">
									<?php $timestamp = time();?>
									var img_id_upload = new Array();//初始化数组，存储已经上传的图片名
									var i=0;//初始化数组下标
									$(function() {
										$('#file_upload').uploadify({
											'formData'     : {
												'timestamp' : '<?php echo $timestamp;?>',
												'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
												'type'		: 'avatar'
											},
											'swf'      : '<?=PLUGIN_UPLOAD?>uploadify.swf',
											'uploader' : '<?=PLUGIN_UPLOAD?>uploadify.php',
											'method' : 'post',  						//服务端可以用$_POST数组获取数据
											'buttonText' : '选择图片',					//设置按钮文本
											'multi':true,								//设置为true时可以上传多个文件
											'auto': false,								//不自动上传
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
													'<img src="<?=UPLOAD_PUBLIC?>user/'+data+'" data-ke-src="<?=UPLOAD_PUBLIC?>user/'+data+'" height=80 width=80 />'
												);
												saveImg(data);
												img_id_upload[i]=data;
												i++;
												alert(data);
											}
										});
									});
								</script>
                        	</div>
                  		</div>
						<div class="widget-foot">
				        	<!-- Footer goes here -->
				    	</div>
                	</div>
            	</div> 
            </div>
            <div class="col-md-5">
              	<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">密码设置</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>
	                  	<div class="clearfix"></div>
	                </div>
                	<div class="widget-content">
                  		<div class="padd">
                      		<div class="form quick-post">
                            	<form class="form-horizontal" method="post" action="<?=site_url('member/doProfile')?>">
                                	<input type="hidden" name="id" value="<?=$list['id']?>">
									<input type="hidden" name="token" value="<?=$token?>">
									<input type="hidden" name="type" value="pass">
                                	<div class="form-group">
										<label class="col-lg-4 control-label">密码</label>
										<div class="col-lg-8">
											<input class="form-control" type="password" name="password" placeholder="新密码（不小于6位，不修改请留空）" >
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-4 control-label">确认密码</label>
										<div class="col-lg-8">
											<input class="form-control" type="password" name="repassword" placeholder="重复密码" >
										</div>
									</div>
                                    <div class="form-group">
										<div class="col-lg-offset-2 col-lg-9">
											<button type="submit" class="btn btn-primary">保存</button>
										</div>
									</div>
								</form>
							</div>
                  		</div>
						<div class="widget-foot"></div>
                	</div>
              	</div>
            </div>
	    	<div class="col-md-7">
            	<div class="widget">
			    	<div class="widget-head">
			        	<div class="pull-left">设置个人信息</div>
		            	<div class="widget-icons pull-right">
		                	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
		                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
						</div>
		                <div class="clearfix"></div>
					</div>
                	<div class="widget-content">
                  		<div class="padd">
                    		<div class="form quick-post">
                            	<form class="form-horizontal" method="post" action="<?=site_url('member/doProfile')?>" onsubmit="return checkFormM()">
									<input type="hidden" name="id" value="<?=$list['id']?>">
									<input type="hidden" name="token" value="<?=$token?>">
									<input type="hidden" name="type" value="data">
                                	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="name">用户名</label>
                                        <div class="col-lg-9">
                                        	<input type="text" class="form-control" id="name" name="name" value="<?=$list['username']?>">
										</div>
									</div>
									<div class="form-group">
                                    	<label class="control-label col-lg-3" for="email">邮箱</label>
                                        <div class="col-lg-9"> 
                                        	<input type="text" class="form-control" id="email" name="email" value="<?=$list['email']?>">
										</div>
									</div>
									<div class="form-group">
                                        <label class="control-label col-lg-3" for="qq">QQ</label>
                                        <div class="col-lg-9"> 
                                        	<input type="text" class="form-control" id="qq" name="qq" value="<?=$list['qq']?>">
                                    	</div>
                                    </div>
									<div class="form-group">
                                        <label class="control-label col-lg-3" for="address">地址</label>
                                        <div class="col-lg-9"> 
                                        	<input type="text" class="form-control" id="address" name="address" value="<?=$list['address']?>">
                                    	</div>
                                    </div>
									<div class="form-group">
                                        <label class="control-label col-lg-3" for="job">职业</label>
                                        <div class="col-lg-9"> 
                                        	<input type="text" class="form-control" id="job" name="job" value="<?=$list['job']?>">
                                    	</div>
                                    </div>
									<div class="form-group">
										<label class="col-lg-4 control-label">用户身份</label>
										<div class="col-lg-8">
											<select class="form-control" name="role_id">
												<option value="3" <?php if($list['role_id']=='3'){echo'selected';}?>>普通用户</option>
												<option value="4" <?php if($list['role_id']=='4'){echo'selected';}?>>游客</option>
												<option value="2" <?php if($list['role_id']=='2'){echo'selected';}?>>管理员</option>
												<option value="1" <?php if($list['role_id']=='1'){echo'selected';}?>>超级管理员</option>
												<option value="5" <?php if($list['role_id']=='5'){echo'selected';}?>>黑名单</option>
											</select>
										</div>
									</div>
                                    <div class="form-group">
										<div class="col-lg-offset-2 col-lg-9">
											<button type="submit" class="btn btn-primary">完成</button>
											<button type="reset" class="btn btn-default" onclick="javascript:window.history.back();">取消</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="widget-foot">
				        	<!-- Footer goes here -->
			            </div>
                	</div>
              	</div>
            </div>
            <div class="col-md-5">
              	<div class="widget">
					<div class="widget-head">
			        	<div class="pull-left">About Me</div>
			            <div class="widget-icons pull-right">
			            	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
			                <a href="#" class="wclose"><i class="icon-remove"></i></a>
			            </div>
			        	<div class="clearfix"></div>
					</div>
                	<div class="widget-content">
                  		<div class="padd">
                      		<div class="form quick-post">
								<form class="form-horizontal" method="post" action="<?=site_url('member/doProfile')?>">
                                	<input type="hidden" name="id" value="<?=$list['id']?>">
									<input type="hidden" name="token" value="<?=$token?>">
									<input type="hidden" name="type" value="about">
                                    <div class="form-group">
		                            	<label class="control-label col-lg-3" for="content">关于我</label>
		                                <div class="col-lg-9">
		                                	<textarea class="form-control" id="content" name="content"><?=$list['about_me']?></textarea>
										</div>
		                            </div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-9">
											<button type="submit" class="btn btn-primary">保存</button>
										</div>
                                	</div>
                            	</form>
                        	</div>
                  		</div>
						<div class="widget-foot">
				        	<!-- Footer goes here -->
				    	</div>
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