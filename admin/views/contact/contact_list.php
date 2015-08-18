<!-- Main bar -->
<div class="mainbar">  
    <div class="page-head">
      	<h2 class="pull-left"><i class="icon-home"></i> 用户留言</h2>
    	<div class="bread-crumb pull-right">
          	<a href="/admin"><i class="icon-home"></i> 首页</a> 
          	<span class="divider">/</span> 
          	<a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
    	</div>
    	<div class="clearfix"></div>
    </div>
    <div class="matter">
    	<div class="container">
      		<div class="col-md-10">
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
								<a class="btn btn-default" href="<?=site_url('contact')?>">
									<i class="icon-ok-sign"></i>查看全部
								</a>
	                      	</div>
	                        <div class="widget-icons pull-right">
	                    		<div class="form-group">
									<input class="form-control search" type="text" placeholder="按用户名搜索" name="keyword" id="s_keyword" value="<?=$aFilter['keyword']?>">
									<a class="search-btn" href="javascript:void(0)" onclick="searchF('<?=site_url('contact')?>');"><i class="icon-search"></i></a>
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
			                          	<div class="recent-ctn <?php if($list['is_read']=='N'){echo 'un-weld';}?>"><?=$list['content']?></div>
			                          	<div class="btn-group">
			                            	<a href="<?=site_url('contact/update/'.$list['id'])?>">
			                            		<button class="btn btn-xs btn-default"><i class="icon-pencil"></i> </button>
			                            	</a>
			                            	<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('contact/doDel')?>')">
			                            		<button class="btn btn-xs btn-default"><i class="icon-remove"></i> </button>
			                          		</a>
			                          	</div>
			                          	<a href="#myModal<?=$list['id']?>" data-toggle="modal">
                  							<button class="btn btn-xs btn-success pull-right">回复</button>
                  						</a>
                  						<!-- Modal -->
										<div id="myModal<?=$list['id']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h4 class="modal-title"> &nbsp;</h4>
													</div>
													<form class="form-horizontal" method="post" action="<?=site_url('contact/doReply')?>" onsubmit="return checkPopC(<?=$list['id']?>)">
														<div class="modal-body">
									          				<div class="padd">
									              				<div class="form quick-post">
								                              		<input type="hidden" name="reply_id" value="<?=$list['id']?>" >
																	<input type="hidden" name="token" value="<?=$token?>" >
								                                  	<div class="form-group">
								                                    	<label class="control-label col-lg-3" for="content">回复内容</label>
								                                    	<div class="col-lg-9">
								                                      		<textarea class="form-control" id="content" name="content"></textarea>
								                                    	</div>
								                                  	</div>
									                            </div>
									          				</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
															<button type="submit" class="btn btn-primary">回复</button>
														</div>
													</form>
												</div>
											</div>
										</div>
			                          	<div class="clearfix"></div>
			                        </div>
			                    </li>
								<?php endforeach;?>
            				</ul>
          				</div>
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