<!-- Main bar -->
<div class="mainbar">  
	<!-- Page heading -->
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 个人资料</h2>
        <div class="bread-crumb pull-right">
	    	<a href="/admin"><i class="icon-home"></i> 首页</a> 
	        <span class="divider">/</span> 
	        <a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
        </div>
		<div class="clearfix"></div>
	</div>
	<!-- Page heading ends -->
    <!-- Matter -->
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
                      		<div class="form quick-post">
								<form class="form-horizontal">
                                    <div class="form-group">
		                            	<label class="control-label col-lg-3" for="content">关于我</label>
		                                <div class="col-lg-9">
		                                	<textarea class="form-control" id="content" name="content"></textarea>
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
								<form class="form-horizontal">
                                    <div class="form-group">
		                            	<label class="control-label col-lg-3" for="content">关于我</label>
		                                <div class="col-lg-9">
		                                	<textarea class="form-control" id="content" name="content"></textarea>
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
                            	<form class="form-horizontal" method="post" action="<?=site_url('member/doUser')?>">
									<input type="hidden" name="id" value="<?=$list['id']?>">
									<input type="hidden" name="token" value="<?=$token?>">
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
                            	<form class="form-horizontal">
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
						<div class="widget-foot">
				        	<!-- Footer goes here -->
				        </div>
                	</div>
              	</div> 
            </div>
			
		</div>
	</div>
	<!-- Matter ends -->
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->