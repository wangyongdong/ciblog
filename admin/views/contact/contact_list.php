<!-- Main bar -->
<div class="mainbar">  
    <!-- Page heading -->
    <div class="page-head">
      	<h2 class="pull-left"><i class="icon-home"></i> 用户留言</h2>
    	<div class="bread-crumb pull-right">
          	<a href="/admin"><i class="icon-home"></i> 首页</a> 
          	<span class="divider">/</span> 
          	<a href="#" class="bread-current">控制台</a>
    	</div>
    	<div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->

    <!-- Matter -->
    <div class="matter">
    	<div class="container">
      		<div class="col-md-7">
  				<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">用户留言</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>  
	                  	<div class="clearfix"></div>
	                </div>
        			<div class="widget-content">
        				<div class="widget-head">
	                      	<div class="uni pull-left">
								<a class="btn btn-default" href="#">
									<i class="icon-ok-sign"></i>查看全部
								</a>
	                      	</div>
	                        <div class="widget-icons pull-right">
	                    		<div class="form-group">
									<input class="form-control search" type="text" placeholder="按用户名搜索">
								</div>
	                  		</div>
	                      <div class="clearfix"></div>
						</div>
          				<div class="padd">
            				<ul class="recent">
              					<?php foreach($list as $list):?>
              					<li>
			                        <div class="recent-content">
			                          	<div class="recent-meta"><?=$list['author']?> 发布于 <?=$list['datetime']?> </div>
			                          	<div><?=$list['content']?></div>
			                          	<div class="btn-group">
			                            	<a href="<?=site_url('contact/update/'.$list['id'])?>">
			                            		<button class="btn btn-xs btn-default"><i class="icon-pencil"></i> </button>
			                            	</a>
			                            	<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('contact/doDel')?>')">
			                            		<button class="btn btn-xs btn-default"><i class="icon-remove"></i> </button>
			                          		</a>
			                          	</div>
			                          	<a href="javascript:void(0);" onclick="doContactReply(<?=$list['id']?>)">
			                          		<button class="btn btn-xs btn-success pull-right">回复</button>
			                          	</a>
			                          	<div class="clearfix"></div>
			                        </div>
			                    </li>
								<?php endforeach;?>
            				</ul>
          				</div>
		                <!-- Widget footer -->
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
			
			<div class="col-md-5" id="replay-box" style="display:none;">
      			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">回复留言</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>  
	                  	<div class="clearfix"></div>
	                </div>
        			<div class="widget-content">
          				<div class="padd">
              				<div class="form quick-post">
                              	<form class="form-horizontal" method="post" action="<?=site_url('contact/doReply')?>">
                              		<input type="hidden" name="reply_id" id="reply_id" >
									<input type="hidden" name="token" value="<?=$token?>" >
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="content">回复内容</label>
                                    	<div class="col-lg-9">
                                      		<textarea class="form-control" id="content" name="content"></textarea>
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
	</div>
	<!-- Matter ends -->
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->