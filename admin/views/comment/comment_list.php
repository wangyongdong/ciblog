<!-- Main bar -->
<div class="mainbar">  
    <div class="page-head" style="margin-top:-22px;">
      	<h2 class="pull-left"><i class="icon-home"></i> 文章评论</h2>
    	<div class="bread-crumb pull-right">
          	<a href="/admin"><i class="icon-home"></i> 首页</a> 
          	<span class="divider">/</span> 
          	<a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
    	</div>
    	<div class="clearfix"></div>
    </div>
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
								<a class="btn btn-default" href="<?=site_url('contact')?>">
									<i class="icon-ok-sign"></i>查看全部
								</a>
	                      	</div>
	                        <div class="widget-icons pull-right">
	                    		<div class="form-group">
	                    			<input class="form-control search" type="text" placeholder="用户名、文章ID" name="keyword" id="sl_keyword" value="<?=$aFilter['keyword']?>">
									<a class="search-btn" href="javascript:void(0)" onclick="searchFL('<?=site_url('comment')?>');"><i class="icon-search"></i></a>
								</div>
	                  		</div>
	                      <div class="clearfix"></div>
						</div>
      					<table class="table table-striped table-bordered table-hover">
	                    	<thead>
	                        	<tr>
	                          		<th>
	                            		<span class="uni"><input type='checkbox' id="checkall" /></span>
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
            					<tr <?php if($list['is_read']=='N'){echo 'class="un-weld"';}?>>
		                          	<td>                            
		                            	<span class="uni">
		                              		<input type='checkbox' name='select[]' id="<?=$list['id']?>"/>
		                            	</span>
		                          	</td>
									<td><?=$list['id']?></td>
              						<td><?=$list['reply_id']?></td>
              						<td><?=cutTab($list['content'],20)?></td>
              						<td><?=$list['author']?></td>
              						<td><?=$list['comment_id']?>：<?=getTitle($list['comment_id'])?></td>
              						<td><?=$list['datetime']?></td>
              						<td>
                  						<a href="#myModalC" data-toggle="modal" id="<?=$list['id']?>" name="<?=$list['comment_id']?>" class="btn-cc">
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
									 <a href="javascript:void(0);" onclick="doStatus('<?=site_url('comment/doHide')?>')">隐藏</a>
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
			<!-- Modal -->
			<div id="myModalC" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title"> &nbsp;</h4>
						</div>
						<form class="form-horizontal" method="post" action="<?=site_url('comment/doReply')?>" onsubmit="return checkPopCom()">
							<div class="modal-body">
		          				<div class="padd">
		              				<div class="form quick-post">
		              				<script src="<?=ADMIN_PUBLIC?>js/jquery.js"></script> <!-- jQuery -->
		              				<script type="text/javascript" src="<?=PLUGIN_QQFACE?>browser.js"></script>
		              				<script type="text/javascript" src="<?=PLUGIN_QQFACE?>jquery.qqFace.js"></script>
		              					<script type="text/javascript">
											//表情js
											$(function(){
												$('.emotion').qqFace({
													id : 'facebox', 	//表情盒子的ID
													assign:'reply_content', 	//给那个控件赋值
													path:'../../public/plugin/qqface/face/'	//表情存放的路径
												});
												$(".sub_btn").click(function(){
													var str = $("#saytext").val();
													$("#show").html(replace_em(str));
												});
											});
											//查看结果
											function replace_em(str){
												str = str.replace(/\</g,'&lt;');
												str = str.replace(/\>/g,'&gt;');
												str = str.replace(/\n/g,'<br/>');
												str = str.replace(/\[em_([0-9]*)\]/g,'<img src="<?=PLUGIN_QQFACE?>face/$1.gif" border="0" />');
												return str;
											}
										</script>
	                              		<input type="hidden" name="comment_id" id="comment_id" value="">
	                              		<input type="hidden" name="reply_id" id="reply_id" value="" >
	                                  	<div class="form-group">
	                                    	<label class="control-label col-lg-3" for="reply_content">回复内容</label>
	                                    	<div class="col-lg-9">
	                                      		<textarea class="form-control" id="reply_content" name="reply_content"></textarea>
	                                    		<span class="emotion"></span>
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
		</div>
	</div>
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->