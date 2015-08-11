<!-- Main bar -->
	  	<div class="mainbar">  
		    <!-- Page heading -->
		    <div class="page-head">
		      	<h2 class="pull-left"><i class="icon-home"></i> 添加用户</h2>
	        	<!-- Breadcrumb -->
	        	<div class="bread-crumb pull-right">
		          	<a href="/admin"><i class="icon-home"></i> 首页</a> 
		          	<!-- Divider -->
		          	<span class="divider">/</span> 
		          	<a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
	        	</div>
	        	<div class="clearfix"></div>
		    </div>
		    <!-- Page heading ends -->

		    <!-- Matter -->
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
			                      		<div class="date-float">
			                      			操作时间：
										</div>
									 	<div id="datetimepicker1" class="input-append">
				                        	<input data-format="yyyy-MM-dd" type="text" class="form-control dtpicker">
				                        	<span class="add-on">
				                          		<i data-time-icon="icon-time" data-date-icon="icon-calendar" class="btn btn-info btn-lg"></i>
				                        	</span>&nbsp; ~ &nbsp;&nbsp;
				                      	</div>
										<div id="datetimepicker3" class="input-append">
											<input data-format="yyyy-MM-dd" type="text" class="form-control dtpicker">
				                        	<span class="add-on">
				                          		<i data-time-icon="icon-time" data-date-icon="icon-calendar" class="btn btn-info btn-lg"></i>
				                        	</span>
				                      	</div>
										<div class="date-float">
			                      			<button class="btn btn-default">查询</button>
											<button class="btn btn-default">全部</button>
											<button class="btn btn-default">清空日志信息</button>
										</div>
										
			                      	</div>
				                    <div class="clearfix"></div>
								</div>
		                  		<div class="padd">
		                    		<div class="error-log">
		                    			<table class="table table-striped table-bordered table-hover">
					                      	<thead>
					                        	<tr>
					                          		<th>用户</th>
					                          		<th>模块</th>
					                          		<th>文件</th>
					                          		<th>时间</th>
					                          		<th>IP</th>
					                        	</tr>
					                      	</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>Ashok</td>
													<td>India</td>
													<td>23</td>
													<td>B.Tech</td>
												</tr>
												<tr>
													<td>2</td>
													<td>Kumarasamy</td>
													<td>USA</td>
													<td>22</td>
													<td>BE</td>
												</tr>
												<tr>
													<td>3</td>
													<td>Babura</td>
													<td>UK</td>
													<td>43</td>
													<td>PhD</td>
												</tr>
												<tr>
													<td>4</td>
													<td>Ravi Kumar</td>
													<td>China</td>
													<td>73</td>
													<td>PUC</td>
												</tr>
												<tr>
													<td>5</td>
													<td>Santhosh</td>
													<td>Japan</td>
													<td>43</td>
													<td>M.Tech</td>
												</tr>                                                                        
											</tbody>
										</table>
                    				</div>
                  				</div>
	                  			<div class="widget-foot">
	                    		<!-- Footer goes here -->
								只允许超级管理员查看操作日志<br/>
								模块一分钟内多次操作只记录一次
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