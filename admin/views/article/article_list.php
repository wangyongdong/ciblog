<!-- Main bar -->
<div class="mainbar">  
	<!-- Page heading -->
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 文章列表</h2>
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
        	<div class="row">
            	<div class="col-md-12">
              		<div class="widget">
                		<div class="widget-head">
                  			<div class="pull-left">文章</div>
				            <div class="widget-icons pull-right">
				            	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
				                <a href="#" class="wclose"><i class="icon-remove"></i></a>
							</div>
				            <div class="clearfix"></div>
						</div>
						<div class="widget-content medias">
                			<div class="widget-head">
				            	<div class="uni pull-left">
									<a href="<?=site_url('article')?>">全部</a>
									<select name="bysort" onchange="searchSort(this.value);">
				                    	<option value=''>按分类查看</option>
				                    	<?php foreach($sort as $slist):?>
				                    	<option value="<?=$slist['id']?>"><?=$slist['name']?></option>
				                    	<?php endforeach;?>
									</select> | 
									<select name="byuser" onchange="searchUser(this.value);">
				                        <option value=''>按作者查看</option>
				                        <?php foreach($member as $member):?>
				                    	<option value="<?=$member['id']?>"><?=$member['username']?></option>
				                    	<?php endforeach;?>
				                    </select>
								</div>
				                <div class="widget-icons pull-right">
				                	<div class="form-group">
										<input class="form-control search" type="text" placeholder="Search">
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
					                    <th>标题</th>
					                    <th>作者</th>
					                    <th>分类</th>
					                    <th>置顶</th>
					                    <th>评论</th>
					                    <th>阅读</th>
					                    <th>状态</th>
					                    <th>时间</th>
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
                          				<td><?=$list['title']?></td>
                          				<td><?=beName($list['uid'])?></td>
                          				<td><?=beSort($list['sortid'])?></td>
                          				<td><?=beTop($list['topway'])?></td>
                          				<td><?=$list['comnum']?></td>
                          				<td><?=$list['views']?></td>
                          				<td>公开</td>
	                          			<td>
	                  						<a href="<?=site_url('article/update/'.$list['id'])?>">
	                  							<button class="btn btn-xs btn-warning" title="编辑"><i class="icon-pencil"></i> </button>
	                  						</a>
	                  						<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('article/doDel')?>')">
	                  							<button class="btn btn-xs btn-danger" title="删除"><i class="icon-remove"></i> </button>
	                  						</a>
	                  					</td>
									</tr>
									<?php endforeach;?>
	                      		</tbody>
	                    	</table>
                    		<div class="widget-foot">
				            	<div class="uni pull-left">
									选中项：<a href="javascript:void(0);" onclick="delAll('<?=site_url('article/doDelAll')?>')">删除</a> |
									<select name="f_order" onchange="changeTop(this.value);">
				                        <option value="">置顶操作</option>
				                        <option value="home">首页</option>
				                    	<option value="sort">分类</option>
				                    	<option value="none">取消</option>
				                    </select> | 
									<select name="f_sort" onchange="changeSort(this.value);">
				                        <option value="">移动到分类</option>
				                        <?php foreach($sort as $slist):?>
				                    	<option value="<?=$slist['id']?>"><?=$slist['name']?></option>
				                    	<?php endforeach;?>
				                    </select>
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
          	</div>
        </div>
	</div>
	<!-- Matter ends -->
</div>
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->