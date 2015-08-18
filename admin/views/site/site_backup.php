<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 数据备份</h2>
		<div class="bread-crumb pull-right">
			<a href="/admin"><i class="icon-home"></i> 首页</a>
			<span class="divider">/</span>
			<a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="matter">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="widget wred">
		                <div class="widget-head">
		                  <div class="pull-left"></div>
		                  <div class="widget-icons pull-right">
		                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
		                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
		                  </div>
		                  <div class="clearfix"></div>
		                </div>
		                <div class="widget-content">
		                  	<div class="padd">
			                    <h5>数据备份</h5>
			                    <div class="alert alert-warning">
			                      	备份数据库，数据库备份文件将会被下载到本地.
			                    </div>
			                    <a href="<?=site_url('site/doBackup')?>" class="btn btn-info">点击备份</a>
			                    <hr />
			                    
			                    <h5>资源备份</h5>
			                    <div class="alert alert-success">
			                      	上传的图片.
			                    </div>
			                    <a href="#myModal" class="btn btn-info" data-toggle="modal">Launch demo modal</a>
			                    <!-- Modal -->
								<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">&nbsp;</h4>
											</div>
											<div class="modal-body">
												<p></p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">取消</button>
												<button type="button" class="btn btn-primary">确定</button>
											</div>
										</div>
									</div>
								</div>
			                    <hr />
			                    
			                    <h5>代码备份</h5>
			                    <div class="alert alert-info">
			                      	备份整站代码和插件
			                    </div>
			                    <a href="#myModal" class="btn btn-info" data-toggle="modal">Launch demo modal</a>                                     
			                    <hr />
		                  	</div>
		                </div>
	                  	<div class="widget-foot"></div>
	              	</div>
            	</div>
			</div>
		</div>
	</div>
	<!-- Mainbar ends -->
	<div class="clearfix"></div>
</div>
<!-- Content ends -->