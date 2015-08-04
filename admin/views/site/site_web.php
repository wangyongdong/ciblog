<!-- Main bar -->
<div class="mainbar">  
	<!-- Page heading -->
	<div class="page-head">
	  	<h2 class="pull-left"><i class="icon-home"></i> 网站设置</h2>
		<div class="bread-crumb pull-right">
	      	<a href="index.html"><i class="icon-home"></i> 首页</a> 
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
	                  	<div class="pull-left">基本设置</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>
	                  	<div class="clearfix"></div>
	                </div>
	    			<div class="widget-content">
	      				<div class="padd">
	          				<div class="form quick-post">
	                          	<form class="form-horizontal" method="post" action="<?=site_url('site/doSiteWeb')?>" >
	                          		<input type="hidden" name="token" value="<?=$token?>" >
	                          		<input type="hidden" name="type" value="basic" >
	                              	<div class="form-group">
	                                	<label class="control-label col-lg-3" for="sitename">站点名称</label>
	                                	<div class="col-lg-9"> 
	                                  		<input type="text" class="form-control" id="sitename" name="sitename" value="<?=$list['sitename']?>">
	                                	</div>
	                              	</div>
									<div class="form-group">
										<label class="control-label col-lg-3" for="sitesign">站点标题</label>
										<div class="col-lg-9">
											<textarea id="content" class="form-control" id="sitesign" name="sitesign"><?=$list['sitesign']?></textarea>
										</div>
									</div>
									<div class="form-group">
	                                	<label class="control-label col-lg-3" for="siteauthor">网站作者</label>
	                                	<div class="col-lg-9"> 
	                                  		<input type="text" class="form-control" id="siteauthor" name="siteauthor" value="<?$list['siteauthor']?>">
	                                	</div>
	                              	</div>
									<div class="form-group">
	                                	<label class="control-label col-lg-3" for="article_nums">每页显示</label>
	                                	<div class="col-lg-9"> 
	                                  		<input type="text" class="form-control min-size" id="article_nums" name="article_nums" value="<?=$list['article_nums'];?>"> 篇文章
	                                	</div>
	                              	</div>
									<div class="form-group">
										<label class="control-label col-lg-3" for="copr_info">版权信息</label>
										<div class="col-lg-9">
											<textarea id="content" class="form-control" id="copr_info" name="copr_info"><?=$list['copr_info'];?></textarea>
										</div>
									</div>
									<div class="form-group">
	                                	<label class="control-label col-lg-3" for="icp">ICP备案号</label>
	                                	<div class="col-lg-9"> 
	                                  		<input type="text" class="form-control" id="icp" name="icp" value="<?=$list['icp'];?>">
	                                	</div>
	                              	</div>
									<div class="form-group">
										<label class="control-label col-lg-3" for="footer_info">页脚信息</label>
										<div class="col-lg-9">
											<textarea id="content" class="form-control" id="footer_info" name="footer_info"><?=$list['footer_info'];?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-4 control-label">启用站点</label>
										<div class="col-lg-8">
											<label class="radio-inline">
												<input id="web_status" type="radio" value="y" name="web_status" <?php if($list['web_status']=='y'){echo 'checked';}?>> 是
											</label>
											<label class="radio-inline">
												<input id="web_status" type="radio" value="n" name="web_status" <?php if($list['web_status']=='y'){echo 'checked';}?>> 否
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-3" for="close_info">关闭说明</label>
										<div class="col-lg-9">
											<textarea id="content" class="form-control" id="close_info" name="close_info"><?=$list['close_info']?></textarea>
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
			<div class="col-md-5">
	  			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">附件设置</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>
	                  	<div class="clearfix"></div>
	                </div>
	    			<div class="widget-content">
	      				<div class="padd">
	          				<div class="form quick-post">
	                          	<form class="form-horizontal" method="post" action="<?=site_url('site/doSiteWeb')?>" >
	                          		<input type="hidden" name="token" value="<?=$token?>" >
	                          		<input type="hidden" name="type" value="att" >
	                              	<div class="form-group">
	                                	<label class="control-label col-lg-3" for="img_type">图片类型</label>
	                                	<div class="col-lg-9"> 
	                                  		<input type="text" class="form-control" id="img_type" name="img_type" value="<?=$list['img_type']?>" placeholder="例:gif|png|jpg|bmp">
	                                	</div>
	                              	</div>
									<div class="form-group">
	                                	<label class="control-label col-lg-3" for="img_size">图片大小</label>
	                                	<div class="col-lg-9"> 
	                                  		<input type="text" class="form-control" id="img_size" name="img_size" value="<?=$list['img_size']?>" placeholder="例:2M">
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
			<div class="col-md-5">
	  			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">说说设置</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>
	                  	<div class="clearfix"></div>
	                </div>
	    			<div class="widget-content">
	      				<div class="padd">
	          				<div class="form quick-post">
	                          	<form class="form-horizontal" method="post" action="<?=site_url('site/doSiteWeb')?>" >
	                          		<input type="hidden" name="token" value="<?=$token?>" >
	                          		<input type="hidden" name="type" value="rc" >
	                              	<div class="form-group">
		                                <div class="col-lg-8">
		                                    <input type="checkbox" name="is_record" value="y" <?php if($list['is_record']=='y'){ echo "checked";}?>> 开启说说，
											每页显示 <input class="form-control min-size" type="text" name="record_nums" value="<?=$list['record_nums'];?>"> 条说说
										</div>
									</div>
									<div class="form-group">
		                                <div class="col-lg-8">
		                                    <input type="checkbox" name="record_comment" value="y" <?php if($list['record_comment']){ echo "checked";}?>> 开启说说评论，
											 每页显示 <input class="form-control min-size" type="text" name="record_comment_nums" value="<?=$list['record_comment_nums']?>"> 条评论 
										</div>
									</div>
									<div class="form-group">
		                                <div class="col-lg-8">
		                                    <input type="checkbox" name="record_check" value="y" <?php if($list['record_check']){ echo "checked";}?>> 开启评论审核
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
			<div class="col-md-5">
	  			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">文章评论</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>
	                  	<div class="clearfix"></div>
	                </div>
	    			<div class="widget-content">
	      				<div class="padd">
	          				<div class="form quick-post">
	                          	<form class="form-horizontal" method="post" action="<?=site_url('site/doSiteWeb')?>" >
	                          		<input type="hidden" name="token" value="<?=$token?>" >
	                          		<input type="hidden" name="type" value="ac" >
	                              	<div class="form-group">
		                                <div class="col-lg-8">
		                                    <input type="checkbox" name="is_comment" value="y" <?php if($list['is_comment']){ echo "checked";}?>> 开启评论，
											发表评论间隔 <input class="form-control min-size" type="text" name="comment_interval" value="<?=$list['comment_interval']?>"> 秒 
										</div>
									</div>
									<div class="form-group">
		                                <div class="col-lg-8">
		                                    <input type="checkbox" name="comment_check" value="y" <?php if($list['comment_check']){ echo "checked";}?>> 评论审核
											每页显示 <input class="form-control min-size" type="text" name="comment_nums" value="<?=$list['comment_nums']?>"> 条评论 
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
	</div><!-- Matter ends -->
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->