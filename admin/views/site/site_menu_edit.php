<!-- Main bar -->
<div class="mainbar">  
	<!-- Page heading -->
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 导航管理</h2>
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
			<div class="col-md-6">
            	<div class="widget">
			    	<div class="widget-head">
			        	<div class="pull-left">编辑导航</div>
			            <div class="widget-icons pull-right">
			                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
							<a href="#" class="wclose"><i class="icon-remove"></i></a>
						</div>  
			            <div class="clearfix"></div>
					</div>
                	<div class="widget-content">
                  		<div class="padd">
                      		<div class="form quick-post">
                                <form class="form-horizontal" method="post" action="<?=site_url('site/doMenu')?>" >
                                	<input type="hidden" name="id" value="<?=$list['id']?>" >
									<input type="hidden" name="token" value="<?=$token?>" >
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="name">名称</label>
                                        <div class="col-lg-9"> 
                                            <input type="text" class="form-control" id="name" name="name" value="<?=$list['menu_name']?>">
                                        </div>
									</div>
									<div class="form-group">
                                        <label class="control-label col-lg-3" for="alias">别名</label>
                                        <div class="col-lg-9"> 
                                           	<input type="text" class="form-control" id="alias" name="alias" value="<?=$list['menu_alias']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="desc">描述</label>
                                        <div class="col-lg-9">
                                        	<textarea class="form-control" id="desc" name="desc"><?=$list['menu_desc']?></textarea>
                                    	</div>
                                    </div>
									<div class="form-group">
										<label class="col-lg-4 control-label">状态</label>
										<div class="col-lg-8">
											<label class="radio-inline rad-margin">
												<input type="radio" value="show" name="status" <?php if($list['status']=='show'){echo 'checked';} ?> >
												<span class="label label-success">显 示</span>
											</label>
											<label class="radio-inline">
												<input type="radio" value="hide" name="status" <?php if($list['status']=='hide'){echo 'checked';} ?>>
												<span class="label label-danger">隐 藏</span>
											</label>
										</div>
									</div>
                                    <div class="form-group">
										<div class="col-lg-offset-2 col-lg-9">
											<button type="submit" class="btn btn-primary">保存</button>
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
		</div>
	</div><!-- Matter ends -->
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->