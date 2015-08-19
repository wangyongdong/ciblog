<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head" style="margin-top:-22px;">
		<h2 class="pull-left"><i class="icon-home"></i> 首页</h2>
        <div class="bread-crumb pull-right">
	    	<a href="/admin"><i class="icon-home"></i> 首页</a> <span class="divider">/</span> 
	        <a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
        </div>
        <div class="clearfix"></div>
	</div>
	<div class="matter">
    	<div class="container">
			<div class="col-md-8">
              	<div class="widget">
                	<div class="widget-head">
                  		<div class="pull-left">欢迎登录</div>
                  		<div class="widget-icons pull-right">
                    		<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    		<a href="#" class="wclose"><i class="icon-remove"></i></a>
                  		</div>  
                  		<div class="clearfix"></div>
                	</div>
                	<div class="widget-content">
                  		<div class="padd">
	                        <div class="support-contact">
								<p>您好：<?=UserName()?></p>
		                        <p>所属角色：<?=getRole(UserId(),'name');?></p>
		                        <hr />
		                        <p>上次登录时间：<?=getLogin('datetime');?></p>
		                        <p>上次登录IP：<?=getLogin('ip');?></p>
		                    </div>
						</div>
	                </div>
				</div>
			</div>
			<div class="col-md-4">
              	<div class="widget">
                	<div class="widget-head">
                  		<div class="pull-left">联系方式</div>
                  		<div class="widget-icons pull-right">
                    		<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    		<a href="#" class="wclose"><i class="icon-remove"></i></a>
                  		</div>  
                  		<div class="clearfix"></div>
                	</div>
                	<div class="widget-content">
                  		<div class="padd">
                        	<div class="support-contact">
								<p><i class="icon-phone"></i> Phone<strong>:</strong> 13148491143</p>
			                    <hr />
			                    <p><i class="icon-envelope-alt"></i> Email<strong>:</strong> wydchn@gmail.com</p>
			                    <hr />
			                    <p><i class="icon-home"></i> Address<strong>:</strong> 北京市朝阳区</p>
			            	</div>
			        	</div>
			    	</div>
				</div>
			</div>
			<div class="col-md-10">
          		<div class="widget">
            		<div class="widget-head">
              			<div class="pull-left">系统信息</div>
				        <div class="widget-icons pull-right">
							<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
				            <a href="#" class="wclose"><i class="icon-remove"></i></a>
						</div>
						<div class="clearfix"></div>
            		</div>
            		<div class="widget-content">
						<table class="table table-striped table-bordered table-hover">
							<tr>
				            	<td>网站地址</td>
				                <td colspan="3">sitedomain.com</td>
							</tr>
			                <tr>
			                    <td>服务器版本</td>
			                    <td><?=$arr['sysos']?></td>
			                    <td>服务器时间</td>
			                    <td><?=$arr['systemtime']?></td>
			                </tr>
			                <tr>
			                    <td>PHP版本号</td>
			                    <td><?=$arr['php']?></td>
			                    <td>MySql版本</td>
			                    <td><?=$arr['mysql']?></td>
			                </tr>
							<tr>
			                    <td>远程文件获取</td>
			                    <td><?=$arr['allowurl']?></td>
			                    <td>GDLibrary</td>
			                    <td><?=$arr['gdinfo']?></td>
			                </tr>
							<tr>
								<td>最大执行时间</td>
			                    <td><?=$arr['max_ex_time']?></td>
			                    <td>最大上传限制</td>
			                    <td><?=$arr['max_upload']?></td>
			                </tr>
						</table>
						<div class="widget-foot">
			            	<p>System support information is automatically acquired by running server.</p>
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