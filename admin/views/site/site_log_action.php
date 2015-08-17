<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 日志信息</h2>
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
			        	<div class="pull-left">后台操作日志</div>
			            <div class="widget-icons pull-right">
			            	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
			                <a href="#" class="wclose"><i class="icon-remove"></i></a>
						</div>  
			            <div class="clearfix"></div>
					</div>
		            <div class="widget-content">
		            	<div class="widget-head">
			            	<div class="uni pull-left">
			                	<div class="date-float">操作时间：</div>
								<div id="datetimepicker1" class="input-append">
				                	<input data-format="yyyy-MM-dd" type="text" class="form-control dtpicker" id="date_start" value="<?=$aFilter['start']?>">
				                    <span class="add-on">
				                    	<i data-time-icon="icon-time" data-date-icon="icon-calendar" class="btn btn-info btn-lg"></i>
				                    </span>&nbsp; ~ &nbsp;&nbsp;
								</div>
								<div id="datetimepicker3" class="input-append">
									<input data-format="yyyy-MM-dd" type="text" class="form-control dtpicker" id="date_end" value="<?=$aFilter['start']?>">
				                    <span class="add-on">
				                    	<i data-time-icon="icon-time" data-date-icon="icon-calendar" class="btn btn-info btn-lg"></i>
				                	</span>
				                </div>
								<div class="date-float">
			                      	<button class="btn btn-default" onclick="searchActionLog();">查询</button>
									<a href="<?=site_url('site/action')?>"><button class="btn btn-default">全部</button></a>
									<button class="btn btn-default" onclick="delActionLog();">清空日志信息</button>
								</div>	
							</div>
				            <div class="clearfix"></div>
						</div>
		                <div class="padd">
		                	<div class="error-log">
								<ul>
									<?php foreach($list as $list):?>
			                        <li>
			                        	<span class="green">[<?=$list['datetime']?>]</span> 
			                        	<span class="red">[<?=$list['function']?>]</span> <?=$list['action']?>  [<?=$list['ip']?>] operation by <?=beName($list['userid'])?>
			                        </li>
									<?php endforeach;?>
								</ul>
                    		</div>
                  		</div>
	                  	<div class="widget-foot">
	                  		只允许超级管理员查看操作日志<br/>
							<div class="clearfix"></div>
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