<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head" style="margin-top:-22px;">
	<h2 class="pull-left"><i class="icon-home"></i> 用户列表</h2>
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
              			<div class="pull-left">用户列表</div>
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
	                          		<th></th>
		                          	<th>用户身份</th>
		                          	<th>用户名</th>
		                          	<th>邮箱</th>
		                          	<th>文章数</th>
		                          	<th></th>
	                        	</tr>
	                      	</thead>
                  			<tbody>
                  				<?php
                  				 foreach($list as $list):?>
                    			<tr>
				                	<td>                            
				                    	<div class="avatar pull-left">
                          					<img alt="" src="<?=LinkAvatar($list['id'])?>" height=40 width=40>
                        				</div>
				                    </td>
                      				<td><?=$list['role']?></td>
                      				<td><?=$list['username']?></td>
                      				<td><?=$list['email']?></td>
                      				<td><?=$list['nums']?></td>
                      				<td>
                      					<a href="<?=site_url('member/update/'.$list['id'])?>">
                          					<button class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </button>
                          				</a>
                          				<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('member/doDel')?>')">
                          					<button class="btn btn-xs btn-danger"><i class="icon-remove"></i> </button>
                          				</a>
                          			</td>
                    			</tr>
                    			<?php endforeach;?>
                      		</tbody>
                    	</table>
                		<div class="widget-foot">
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
		</div>
	</div>
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->