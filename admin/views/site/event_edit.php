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
			<div class="col-md-6">
      			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">事件记录</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>  
	                  	<div class="clearfix"></div>
	                </div>
        			<div class="widget-content">
          				<div class="padd">
              				<div class="form quick-post">
                              	<form class="form-horizontal" method="post" action="<?=site_url('site/doEvent')?>" onsubmit="return checkFormE()">
                              		<input type="hidden" name="id" value="<?=$list['id']?>" >
									<input type="hidden" name="token" value="<?=$token?>" >
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="name">主题</label>
                                    	<div class="col-lg-9"> 
                                      		<input type="text" class="form-control" id="title" name="title" value="<?=$list['title']?>">
                                    	</div>
                                  	</div>
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="description">摘要</label>
                                    	<div class="col-lg-9">
                                      		<textarea class="form-control" id="description" name="description"><?=$list['description']?></textarea>
                                    	</div>
                                  	</div>
                                  	<div class="form-group">
                                        <label class="control-label col-lg-3" for="alias">时间</label>
                                        <div class="col-lg-9"> 
                                        	<div id="datetimepicker1" class="input-append">
								            	<input data-format="yyyy-MM-dd" type="text" class="form-control dtpicker" name="time" id="time" value="<?=$list['time']?>">
								                <span class="add-on">
								                	<i data-time-icon="icon-time" data-date-icon="icon-calendar" class="btn btn-info btn-lg"></i>
								                </span>
											</div>
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