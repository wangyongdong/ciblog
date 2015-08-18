<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 网站统计</h2>
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
	              	<ul class="today-datas">
	                	<li>
		                  	<div><span id="todayspark1" class="spark"></span></div>
		                  	<div class="datas-text"><?=$data['Pageviews']?> Pageviews/day</div>
	                	</li>
	                	<li>
	                  		<div><span id="todayspark2" class="spark"></span></div>
	                  		<div class="datas-text"><?=$data['VisitorsDay']?> visitors/day</div>
	                	</li>
	                	<li>
	                  		<div><span id="todayspark3" class="spark"></span></div>
	                  		<div class="datas-text"><?=$data['VisitorsMonth']?> visitors/month</div>
	                	</li>
	                	<li>
	                  		<div><span id="todayspark4" class="spark"></span></div>
	                  		<div class="datas-text"><?=$data['NewVisits']?> New Visits/month</div>
	                	</li>
	                	<li>
	                  		<div><span id="todayspark5" class="spark"></span></div>
	                  		<div class="datas-text"><?=$data['total']?> visitors till date</div>
	                	</li>
	              	</ul> 
				</div>
			</div>
			<div class="row">
	        	<div class="col-md-8">
					<div class="widget">
	                	<div class="widget-head">
	                  		<div class="pull-left">图表</div>
	                  		<div class="widget-icons pull-right">
						        <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
						    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  		</div> 
	                  		<div class="clearfix"></div>
	                	</div>
                		<div class="widget-content referrer">
	                  		<table class="table table-striped table-bordered table-hover">
			                    <tr>
			                      	<th><center>#</center></th>
			                      	<th>Modular</th>
			                      	<th>Number</th>
			                    </tr>
			                    <tr>
			                      	<td class="tab-cen"><i class="icon-user"></i>
			                      	<td>用户</td>
			                      	<td><?=getStatis('member');?></td>
			                    </tr> 
			                    <tr>
			                      	<td class="tab-cen"><i class="icon-file-alt"></i>
			                      	<td>文章</td>
			                      	<td><?=getStatis('article');?></td>
			                    </tr> 
			                    <tr>
			                      	<td class="tab-cen"><i class="icon-bullhorn"></i>
			                      	<td>说说</td>
			                      	<td><?=getStatis('record');?></td>
			                    </tr> 
			                    <tr>
			                      	<td class="tab-cen"><i class="icon-comment"></i>
			                      	<td>评论</td>
			                      	<td><?=getStatis('comment');?></td>
			                    </tr> 
			                    <tr>
			                      	<td class="tab-cen"><i class="icon-pencil"></i>
			                      	<td>留言</td>
			                      	<td><?=getStatis('contact');?></td>
			                    </tr>
			                    <tr>
			                      	<td class="tab-cen"><i class="icon-link"></i>
			                      	<td>友链</td>
			                      	<td><?=getStatis('links');?></td>
			                    </tr>
							</table>
	                  		<div class="widget-foot"></div>
	                	</div>
	            	</div>
				</div>
				<div class="col-md-4">
					<div class="widget">
                		<div class="widget-head">
                  			<div class="pull-left">今天统计</div>
			                <div class="widget-icons pull-right">
			                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
			                	<a href="#" class="wclose"><i class="icon-remove"></i></a>
			                </div>  
                  			<div class="clearfix"></div>
                		</div>
			            <div class="widget-content">
			            	<div class="padd">
			                    <ul class="current-status">
			                    	<li>
			                        	<span id="status4"></span> <span class="bold">home : <?=$arr['homeViews']?></span>
			                      	</li>
				                	<li>
				                    	<span id="status1"></span> <span class="bold">article : <?=$arr['articleViews']?></span>
				                    </li>
				                    <li>
			                        	<span id="status6"></span> <span class="bold">cms : <?=$arr['cmsViews']?></span>
			                      	</li>
			                      	<li>
			                        	<span id="status2"></span> <span class="bold">record : <?=$arr['recordViews']?></span>
			                      	</li>
			                      	<li>
			                        	<span id="status3"></span> <span class="bold">contact : <?=$arr['contactViews']?></span>
			                      	</li>
			                      	<li>
			                        	<span id="status5"></span> <span class="bold">about : <?=$arr['aboutViews']?></span>
			                      	</li>
								</ul>
							</div>
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