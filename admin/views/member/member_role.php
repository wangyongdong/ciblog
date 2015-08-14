<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head">
	<h2 class="pull-left"><i class="icon-home"></i> 用户角色</h2>
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
              			<div class="pull-left">角色列表</div>
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
		                          	<th>role</th>
		                          	<th>角色名</th>
		                          	<th></th>
	                        	</tr>
	                      	</thead>
                  			<tbody>
                  				<?php
                  				 foreach($list as $list):?>
                    			<tr>
				                	<td><?=$list['id']?></td>
                      				<td><?=$list['role']?></td>
                      				<td><?=$list['name']?></td>
                      				<td>
                      					<a href="<?=site_url('member/updrole/'.$list['id'])?>">
                          					<button class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </button>
                          				</a>
                          				<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('member/roleDel')?>')">
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
		                        	<a href="#myModal" data-toggle="modal">
                  						<button class="btn btn-default">添加角色</button>
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
      		<!-- Modal -->
			<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title"> &nbsp;</h4>
						</div>
						<form class="form-horizontal" method="post" action="<?=site_url('member/doRole')?>" onsubmit="return checkPopR()">
							<div class="modal-body">
		          				<div class="padd">
			                    	<div class="form quick-post">
		                            	<input type="hidden" name="token" value="<?=$token?>" >
		                            	<div class="form-group">
		                                	<label class="control-label col-lg-3" for="role">角色</label>
		                                    <div class="col-lg-9"> 
		                                    	<input type="text" class="form-control" id="role" name="role">
											</div>
										</div>
		                            	<div class="form-group">
		                                	<label class="control-label col-lg-3" for="name">名称</label>
		                                    <div class="col-lg-9"> 
		                                    	<input type="text" class="form-control" id="name" name="name">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
								<button type="submit" class="btn btn-primary">添加</button>
							</div>
						</form>
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