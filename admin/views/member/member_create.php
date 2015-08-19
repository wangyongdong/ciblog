<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head" style="margin-top:-22px;">
		<h2 class="pull-left"><i class="icon-home"></i> 添加用户</h2>
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
			        	<div class="pull-left">添加用户信息</div>
			            <div class="widget-icons pull-right">
			            	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
			                <a href="#" class="wclose"><i class="icon-remove"></i></a>
						</div>
			            <div class="clearfix"></div>
					</div>
                	<div class="widget-content">
                  		<div class="padd">
                      		<div class="form quick-post">
								<form class="form-horizontal" autocomplete="off" method="post" action="<?=site_url('member/doUser')?>" onsubmit="return checkFormM()">
                                	<input type="hidden" name="token" value="<?=$token?>">
                                	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="name">用户名</label>
                                        <div class="col-lg-9"> 
                                        	<input type="text" class="form-control" id="name" name="name" autocomplete="off" >
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-4 control-label">密码</label>
										<div class="col-lg-8">
											<input class="form-control" type="password" name="password" placeholder="新密码（不小于6位，不修改请留空）" autocomplete="off">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-4 control-label">确认密码</label>
										<div class="col-lg-8">
											<input class="form-control" type="password" name="repassword" placeholder="重复密码" autocomplete="off" >
										</div>
									</div>
									<div class="form-group">
                                    	<label class="control-label col-lg-3" for="email">邮箱</label>
                                        <div class="col-lg-9"> 
                                        	<input type="email" class="form-control" id="email" name="email">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-4 control-label">用户身份</label>
										<div class="col-lg-8">
											<select class="form-control" name="role_id">
												<option value="3">普通用户</option>
												<option value="4">游客</option>
												<option value="2">管理员</option>
												<option value="5">黑名单</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-9">
											<button type="submit" class="btn btn-primary">添加</button>
											<button type="reset" class="btn btn-default" onclick="javascript: window.history.back();">取消</button>
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