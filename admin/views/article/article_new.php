﻿<!-- Main bar -->
<div class="mainbar">  
	<!-- Page heading -->
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 发布文章</h2>
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
			<div class="col-md-12">
      			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">发布文章</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>  
	                  	<div class="clearfix"></div>
	                </div>
        			<div class="widget-content">
          				<div class="padd">
              				<div class="form quick-post">
                              	<form class="form-horizontal" method="post" action="<?=site_url('article/doArticle')?>">
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="title">标题</label>
                                    	<div class="col-lg-8"> 
                                      		<input type="text" class="form-control" id="title" name="title" >
                                    	</div>
                                  	</div>
                                  	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="content">内容</label>
                                    	<div class="col-lg-8"> 
                                      		<?=ArticleUedit();?>
                                    	</div>
                                  	</div>
									<div class="form-group">
                                    	<label class="control-label col-lg-3" for="keyword">关键词</label>
                                    	<div class="col-lg-8"> 
                                      		<input type="text" class="form-control" id="keyword" name="keyword">
                                    	</div>
                                  	</div>
									<div class="form-group">
                                    	<label class="control-label col-lg-3" for="img">配图</label>
                                    	<div class="col-lg-8"> 
                                      		<input type="text" class="form-control" id="img" name="img">
                                      		<?=Uploadify();?>
                                    	</div>
                                  	</div>
                                  	<div class="form-group">
	                                  	<label class="col-lg-4 control-label">分类</label>
	                                  	<div class="col-lg-8">
		                                    <select class="form-control" name="sortid">
		                                    	<?php foreach($sort as $slist):?>
						                    	<option value="<?=$slist['id']?>"><?=$slist['name']?></option>
						                    	<?php endforeach;?>
		                                    </select>
	                                  	</div>
	                                </div>
	                                <div class="form-group">
	                                	<label class="col-lg-4 control-label">置顶方式</label>
		                                <div class="col-lg-8">
											<label class="radio-inline">
												<input id="topway" type="radio"  value="home" name="topway">
												<span class="label label-primary">首页置顶</span>
											</label>
											<label class="radio-inline">
												<input id="topway" type="radio"  value="sort" name="topway">
												<span class="label label-info">分类置顶</span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-4 control-label">状态</label>
										<div class="col-lg-8">
											<label class="radio-inline">
												<input id="status" type="radio"  value="show" name="status">
												<span class="label label-success">显 示</span>
											</label>
											<label class="radio-inline">
												<input id="status" type="radio"  value="hide" name="status">
												<span class="label label-danger">隐 藏</span>
											</label>
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