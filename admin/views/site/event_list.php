<!-- Main bar -->
<div class="mainbar">  
    <div class="page-head" style="margin-top:-22px;">
      	<h2 class="pull-left"><i class="icon-home"></i> 博客事件</h2>
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
				<div class="col-md-12">
	  				<div class="widget">
	    				<div class="widget-head">
	      					<div class="pull-left">事件记录</div>
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
			                          	<th>主题</th>
			                          	<th>内容</th>
			                          	<th>时间</th>
			                          	<th></th>
		                        	</tr>
		                      	</thead>
	          					<tbody>
	          						<?php foreach($list as $list):?>
	            					<tr>
	              						<td><?=$list['title']?></td>
	              						<td><?=$list['description']?></td>
	              						<td><?=$list['time']?></td>
	              						<td>
	              							<a href="<?=site_url('site/updEvent/'.$list['id'])?>">
	                  							<button class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </button>
	                  						</a>
	                  						<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('site/delEvent')?>')">
	                  							<button class="btn btn-xs btn-danger"><i class="icon-remove"></i> </button>
	                  						</a>
	                  					</td>
	            					</tr>
	            					<?php endforeach;?>
	              				</tbody>
	            			</table>
	        				<div class="widget-foot">
	        					<div class="uni pull-left">
		                        	<a href="#myModal" data-toggle="modal">
										<button class="btn btn-default">新增事件</button>
									</a>
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
							<form class="form-horizontal" method="post" action="<?=site_url('site/doEvent')?>" onsubmit="return checkPopE()">
								<input type="hidden" name="token" value="<?=$token?>" >
								<div class="modal-body">
			          				<div class="padd">
				                    	<div class="form quick-post">
											<div class="form-group">
	                                        	<label class="control-label col-lg-3" for="name">主题</label>
	                                        	<div class="col-lg-9"> 
	                                          		<input type="text" class="form-control" id="title" name="title">
	                                        	</div>
	                                      	</div>
	                                      	<div class="form-group">
	                                        	<label class="control-label col-lg-3" for="description">描述</label>
	                                        	<div class="col-lg-9">
	                                          		<textarea class="form-control" id="description" name="description"></textarea>
	                                        	</div>
	                                      	</div>
											<div class="form-group">
	                                        	<label class="control-label col-lg-3" for="alias">时间</label>
	                                        	<div class="col-lg-9"> 
	                                          		<div id="datetimepicker1" class="input-append">
									                	<input data-format="yyyy-MM-dd" type="text" class="form-control dtpicker" name="time" id="time" value="">
									                    <span class="add-on">
									                    	<i data-time-icon="icon-time" data-date-icon="icon-calendar" class="btn btn-info btn-lg"></i>
									                    </span>
													</div>
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
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->