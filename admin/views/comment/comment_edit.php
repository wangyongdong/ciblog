<!-- Main bar -->
<div class="mainbar">  
    <!-- Page heading -->
    <div class="page-head">
      	<h2 class="pull-left"><i class="icon-home"></i> 文章评论</h2>
    	<div class="bread-crumb pull-right">
          	<a href="/admin"><i class="icon-home"></i> 首页</a> 
          	<span class="divider">/</span> 
          	<a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
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
	                  	<div class="pull-left">编辑评论</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>  
	                  	<div class="clearfix"></div>
	                </div>
        			<div class="widget-content">
          				<div class="padd">
              				<div class="form quick-post">
                              	<form class="form-horizontal" method="post" action="<?=site_url('comment/doComment')?>">
									<input type="hidden" name="id" value="<?=$list['id']?>" >
									<input type="hidden" name="token" value="<?=$token?>" >
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="author">评论人</label>
                                    	<div class="col-lg-9"> 
                                      		<input type="text" class="form-control" id="author" name="author" value="<?=$list['author']?>">
                                    	</div>
                                  	</div>
									<div class="form-group">
                                    	<label class="control-label col-lg-3" for="email">邮箱</label>
                                    	<div class="col-lg-9"> 
                                      		<input type="text" class="form-control" id="email" name="email" value="<?=$list['email']?>">
                                    	</div>
                                  	</div>
									<div class="form-group">
                                    	<label class="control-label col-lg-3" for="url">主页</label>
                                    	<div class="col-lg-9"> 
                                      		<input type="text" class="form-control" id="url" name="url" value="<?=$list['url']?>">
                                    	</div>
                                  	</div>
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="content">内容</label>
                                    	<div class="col-lg-9">
                                      		<textarea class="form-control" id="content" name="content"><?=stripcslashes($list['content'])?></textarea>
                                    	</div>
                                  	</div>
									<div class="form-group">
										<label class="col-lg-4 control-label">状态</label>
										<div class="col-lg-8">
											<label class="radio-inline rad-margin">
												<input id="optionsRadios1" type="radio" <?php if($list['status']=='show'){echo 'checked';}?> value="show" name="status">
												<span class="label label-success">显 示</span>
											</label>
											<label class="radio-inline">
												<input id="optionsRadios2" type="radio" <?php if($list['status']=='hide'){echo 'checked';}?> value="hide" name="status">
												<span class="label label-danger">隐 藏</span>
											</label>
										</div>
									</div>
                                  	<div class="form-group">
									 	<div class="col-lg-offset-2 col-lg-9">
											<button type="submit" class="btn btn-primary">保存</button>
											<button type="reset" class="btn btn-default" onclick="javascript:window.history.back();">取消</button>
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
    		<?php 
			if(!empty($reply)) {
				foreach($reply as $reply):
			?>
			<div class="col-md-5">
      			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">回复内容</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>
	                  	<div class="clearfix"></div>
	                </div>
        			<div class="widget-content">
          				<div class="padd">
              				<div class="form quick-post">
                              	<form class="form-horizontal" method="post" action="<?=site_url('comment/doReply')?>">
                              		<input type="hidden" name="id" value="<?=$reply['id']?>" >
                              		<input type="hidden" name="reply_id" value="<?=$reply['reply_id']?>" >
                              		<input type="hidden" name="comment_id" value="<?=$reply['comment_id']?>" >
									<input type="hidden" name="token" value="<?=$token?>" >
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="content">回复内容</label>
                                    	<div class="col-lg-9">
                                      		<textarea class="form-control" id="content" name="content"><?=stripcslashes($reply['content'])?></textarea>
                                    	</div>
                                  	</div>
                                  	<div class="form-group">
									 	<div class="col-lg-offset-2 col-lg-9">
											<button type="submit" class="btn btn-success">保存</button>
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
    		<?php 
    			endforeach;
    		}
    		?>
		</div>
	</div><!-- Matter ends -->
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->