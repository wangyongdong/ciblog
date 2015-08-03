<!-- Main bar -->
<div class="mainbar">  
	<!-- Page heading -->
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 友情链接</h2>
        <div class="bread-crumb pull-right">
	    	<a href="index.html"><i class="icon-home"></i> 首页</a> 
	        <span class="divider">/</span> 
	        <a href="#" class="bread-current">控制台</a>
        </div>
		<div class="clearfix"></div>
	</div>
	<!-- Page heading ends -->
	<!-- Matter -->
	<div class="matter">
		<div class="container">
			<div class="row">
			    	<div class="col-md-12">
		          		<div class="widget">
		            		<div class="widget-head">
		              			<div class="pull-left">友情链接</div>
					            <div class="widget-icons pull-right">
					            	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
					                <a href="#" class="wclose"><i class="icon-remove"></i></a>
								</div>  
					            <div class="clearfix"></div>
							</div>
		            		<div class="widget-content medias">
		              			<table class="table table-striped table-bordered table-hover">
					            	<thead>
					                	<tr>
						                	<th>ID</th>
						                	<th>名称</th>
						                    <th>描述</th>
						                    <th>url</th>
						                    <th>状态</th>
						                    <th>添加时间</th>
						                    <th></th>
										</tr>
									</thead>
									<tbody>
		                    			<?php foreach($list as $list):?>
		                    			<tr>
		                      				<td><?=$list['id']?></td>
		                      				<td><?=$list['sitename']?></td>
		                      				<td><?=$list['description']?></td>
		                      				<td><a href="<?=$list['siteurl']?>"><?=$list['siteurl']?></a></td>
		                      				<td>
		                      					<?php if($list['status'] == 'show') { ?>
		                      					<span class="label label-success">显示</span>
		                      					<?php } else { ?>
		                      					<span class="label label-danger">不显示</span>
		                      					<?php } ?>
											</td>
		                      				<td><?=$list['datetime']?></td>
		                      				<td>
		                          				<a href="<?=site_url('links/update/'.$list['id'])?>">
		                          					<button class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </button>
		                          				</a>
		                          				<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('links/doDel')?>')">
		                          					<button class="btn btn-xs btn-danger"><i class="icon-remove"></i> </button>
		                          				</a>
		                          			</td>
		                    			</tr>
		                    			<?php endforeach;?>
		                      		</tbody>
		                    	</table>
		                		<div class="widget-foot">
		                			<div class="uni pull-left">
			                        	<div class="uni pull-left">
				                        	<a href="javascript:void(0);" onclick="newPage()">
			                        		<button class="btn btn-default">添加友链</button>
			                        	</a>
			                      	</div>
		                      	</div>
				            	<ul class="pagination pull-right">
					            	<?php 
										echo $this->pagination->create_links();
									?>
									</ul>
					                <div class="clearfix"></div>
								</div>
		            		</div>
		          		</div>
		        	</div>
		        	<div class="col-md-6" id="new_page" style="display:none;">
					<div class="widget">
						<div class="widget-head">
					    	<div class="pull-left">添加友链</div>
					        <div class="widget-icons pull-right">
					        	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
					            <a href="#" class="wclose"><i class="icon-remove"></i></a>
							</div>  
					        <div class="clearfix"></div>
						</div>
		                <div class="widget-content">
		                	<div class="padd">
		                    	<div class="form quick-post">
		                            <form class="form-horizontal" method="post" action="<?=site_url('links/doLinks')?>">
		                            	<input type="hidden" name="token" value="<?=$token?>" >
		                            	<div class="form-group">
		                                	<label class="control-label col-lg-3" for="name">名称</label>
		                                    <div class="col-lg-9"> 
		                                    	<input type="text" class="form-control" id="name" name="name">
											</div>
										</div>
										<div class="form-group">
		                                	<label class="control-label col-lg-3" for="url">链接</label>
		                                    <div class="col-lg-9"> 
		                                    	<input type="text" class="form-control" id="url" name="url">
		                                	</div>
		                                </div>
		                                <div class="form-group">
		                                	<label class="control-label col-lg-3" for="description">描述</label>
		                                    <div class="col-lg-9">
		                                    	<textarea class="form-control" id="description" name="description"></textarea>
											</div>
		                                </div>
										<div class="form-group">
											<label class="col-lg-4 control-label">状态</label>
											<div class="col-lg-8">
												<label>
													<input id="optionsRadios1" type="radio" value="show" name="status" checked="" >
													<span class="label label-success">显 示</span>
												</label>
												<label>
													<input id="optionsRadios2" type="radio" value="hide" name="status">
													<span class="label label-danger">隐 藏</span>
												</label>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-offset-2 col-lg-9">
												<button type="submit" class="btn btn-success">保存</button>
												<button type="reset" class="btn btn-default">取消</button>
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
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->