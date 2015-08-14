<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 修改角色</h2>
        <div class="bread-crumb pull-right">
	    	<a href="/admin"><i class="icon-home"></i> 首页</a> 
	        <span class="divider">/</span> 
	        <a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
        </div>
		<div class="clearfix"></div>
	</div>
	<div class="matter">
		<div class="container">
	    	<div class="col-md-6">
            	<div class="widget">
			    	<div class="widget-head">
			        	<div class="pull-left">修改角色权限</div>
		            	<div class="widget-icons pull-right">
		                	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
		                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
						</div>
		                <div class="clearfix"></div>
					</div>
                	<div class="widget-content">
                  		<div class="padd">
                    		<div class="form quick-post">
                            	<form class="form-horizontal" method="post" action="<?=site_url('member/doRole')?>" onsubmit="return checkFormM()">
									<input type="hidden" name="id" value="<?=$list['id']?>">
									<input type="hidden" name="token" value="<?=$token?>">
                                	<div class="form-group">
                                    	<label class="control-label col-lg-3" for="role">角色</label>
                                        <div class="col-lg-9">
                                        	<input type="text" class="form-control" id="role" name="role" value="<?=$list['role']?>">
										</div>
									</div>
									<div class="form-group">
                                    	<label class="control-label col-lg-3" for="name">角色名</label>
                                        <div class="col-lg-9">
                                        	<input type="text" class="form-control" id="name" name="name" value="<?=$list['name']?>">
										</div>
									</div>
                                    <div class="form-group">
										<div class="col-lg-offset-2 col-lg-9">
											<button type="submit" class="btn btn-primary">完成</button>
											<button type="reset" class="btn btn-default" onclick="javascript:window.history.back();">取消</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="widget-foot"></div>
                	</div>
              	</div>
            </div>
            <div class="col-md-5">
	  			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">访问权限</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>
	                  	<div class="clearfix"></div>
	                </div>
	    			<div class="widget-content">
	      				<div class="padd">
	          				<div class="form quick-post">
	                          	<form class="form-horizontal" method="post" action="<?=site_url('member/doAcc')?>" >
	                          		<input type="hidden" name="id" value="<?=$list['id']?>">
									<ul class="form-ul">
										<li>
											<span>查看权限</span>
										</li>
                                        <li>
                                        	<input type="checkbox" name="select[]" value="article" <?php if(!empty($list['function']['select']) && in_array('article',$list['function']['select'])){echo 'checked';}?>> 文章
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="select[]" value="sort" <?php if(!empty($list['function']['select']) && in_array('sort',$list['function']['select'])){echo 'checked';}?>> 分类
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="select[]" value="record" <?php if(!empty($list['function']['select']) && in_array('record',$list['function']['select'])){echo 'checked';}?>> 说说
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="select[]" value="comment" <?php if(!empty($list['function']['select']) && in_array('comment',$list['function']['select'])){echo 'checked';}?>> 评论
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="select[]" value="contant" <?php if(!empty($list['function']['select']) && in_array('contant',$list['function']['select'])){echo 'checked';}?>> 留言
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="select[]" value="links" <?php if(!empty($list['function']['select']) && in_array('links',$list['function']['select'])){echo 'checked';}?>> 友链
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="select[]" value="member" <?php if(!empty($list['function']['select']) && in_array('member',$list['function']['select'])){echo 'checked';}?>> 用户
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="select[]" value="site" <?php if(!empty($list['function']['select']) && in_array('site',$list['function']['select'])){echo 'checked';}?>> 设置
                                        </li>
									</ul>
                                    <ul class="form-ul">
                                    	<li>
											<span>操作权限</span>
										</li>
                                    	<li>
                                        	<input type="checkbox" name="update[]" value="article" <?php if(!empty($list['function']['update']) && in_array('article',$list['function']['update'])){echo 'checked';}?>> 文章
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="update[]" value="sort" <?php if(!empty($list['function']['update']) && in_array('sort',$list['function']['update'])){echo 'checked';}?>> 分类
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="update[]" value="record" <?php if(!empty($list['function']['update']) && in_array('record',$list['function']['update'])){echo 'checked';}?>> 说说
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="update[]" value="comment" <?php if(!empty($list['function']['update']) && in_array('comment',$list['function']['update'])){echo 'checked';}?>> 评论
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="update[]" value="contant" <?php if(!empty($list['function']['update']) && in_array('contant',$list['function']['update'])){echo 'checked';}?>> 留言
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="update[]" value="links" <?php if(!empty($list['function']['update']) && in_array('links',$list['function']['update'])){echo 'checked';}?>> 友链
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="update[]" value="member" <?php if(!empty($list['function']['update']) && in_array('member',$list['function']['update'])){echo 'checked';}?>> 用户
                                        </li>
                                        <li>
                                        	<input type="checkbox" name="update[]" value="site" <?php if(!empty($list['function']['update']) && in_array('site',$list['function']['update'])){echo 'checked';}?>> 设置
                                        </li>
                                    </ul>
	                              	<div class="form-group">
									 	<div class="col-lg-offset-2 col-lg-9">
									 		<button type="submit" class="btn btn-primary">保存</button>
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
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->