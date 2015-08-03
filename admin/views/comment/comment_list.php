﻿<!-- Main bar -->
<div class="mainbar">  
    <div class="page-head">
      	<h2 class="pull-left"><i class="icon-home"></i> 文章评论</h2>
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
      		<div class="col-md-12" id="list-box">
  				<div class="widget">
    				<div class="widget-head">
      					<div class="pull-left">文章评论</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
	                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
	                  	</div>
	                  	<div class="clearfix"></div>
	                </div>
    				<div class="widget-content medias">
    					<div class="widget-head">
	                      	<div class="uni pull-left">
								<a class="btn btn-default" href="#">
									<i class="icon-ok-sign"></i>查看全部
								</a>
	                      	</div>
	                        <div class="widget-icons pull-right">
	                    		<div class="form-group">
									<input class="form-control search" type="text" placeholder="用户名、文章ID">
								</div>
	                  		</div>
	                      <div class="clearfix"></div>
						</div>
      					<table class="table table-striped table-bordered table-hover">
	                    	<thead>
	                        	<tr>
	                          		<th>
	                            		<span class="uni">
	                              			<input type='checkbox' id="checkall" />
	                            		</span>
	                          		</th>
									<th>ID</th>
									<th>父ID</th>
		                          	<th>内容</th>
		                          	<th>评论者</th>
		                          	<th>所属文章</th>
		                          	<th>日期</th>
		                          	<th></th>
	                        	</tr>
	                      	</thead>
          					<tbody>
          						<?php foreach($list as $list):?>
            					<tr>
		                          	<td>                            
		                            	<span class="uni">
		                              		<input type='checkbox' name='select[]' id="<?=$list['id']?>"/>
		                            	</span>
		                          	</td>
									<td><?=$list['id']?></td>
              						<td><?=$list['reply_id']?></td>
              						<td><?=stripcslashes($list['content'])?></td>
              						<td><?=$list['author']?></td>
              						<td><?=$list['comment_id']?>：<?=getTitle($list['comment_id'])?></td>
              						<td><?=$list['datetime']?></td>
              						<td>
              							<a href="javascript:void(0);" onclick="doCommentReply(<?=$list['id']?>,<?=$list['comment_id']?>)">
              								<button class="btn btn-xs btn-primary" title="回复"><i class="icon-reply"></i></button>
                  						</a>
                  						<a href="<?=site_url('comment/update/'.$list['id'])?>">
                  							<button class="btn btn-xs btn-warning" title="编辑"><i class="icon-pencil"></i> </button>
                  						</a>
                  						<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('comment/doDel')?>')">
                  							<button class="btn btn-xs btn-danger" title="删除"><i class="icon-remove"></i> </button>
                  						</a>
                  					</td>
            					</tr>
            					<?php endforeach;?>
              				</tbody>
            			</table>
        				<div class="widget-foot">
	                      	<div class="uni pull-left">
								选中项：<a href="javascript:void(0);" onclick="delAll('<?=site_url('comment/doDelAll')?>')">删除</a> |
									 <a href="">隐藏</a>
	                      	</div>
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
			
			<div class="col-md-5" id="replay-box">
      			<div class="widget">
	                <div class="widget-head">
	                  	<div class="pull-left">回复留言</div>
	                  	<div class="widget-icons pull-right">
	                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
	                    	<a href="#" class="wclose" onclick="closePop();"><i class="icon-remove"></i></a>
	                  	</div>  
	                  	<div class="clearfix"></div>
	                </div>
        			<div class="widget-content">
          				<div class="padd">
              				<div class="form quick-post">
                              	<form class="form-horizontal" method="post" action="<?=site_url('comment/doReply')?>">
                              		<input type="hidden" name="comment_id" id="comment_id" >
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
											<button type="reset" class="btn btn-default" onclick="closePop();">取消</button>
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
			<div id="cover">
				<div class="z-cover"></div>
			</div>
		</div>
	</div><!-- Matter ends -->
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->