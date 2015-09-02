<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head" style="margin-top:-22px;">
		<h2 class="pull-left"><i class="icon-home"></i> 消息提醒</h2>
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
						<div class="pull-left">消息</div>
						<div class="widget-icons pull-right">
							<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
							<a href="#" class="wclose"><i class="icon-remove"></i></a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="widget-content">
						<ul class="task">
							<?php foreach($notice as $notice):?>
							<li <?php if($notice['status']=='unread'){echo 'class="un-weld"';}?>>
								<span class="uni"><input type='checkbox' name='select[]' id="<?=$notice['id']?>"/></span>
								<span class="label label-warning"><?=$notice['type']?></span>
								<?=$notice['content']?>
								<a href="#" class="pull-right"><i class="icon-remove"></i></a>
							</li>
							<?php endforeach;?>
						</ul>
						<div class="clearfix"></div>
						<div class="widget-foot">
							<div class="uni pull-left">
								<span class="acl">
									<input type='checkbox' id="checkall" />
								</span>	
								选中项：<a href="javascript:void(0);" onclick="doStatus('<?=site_url('site/updNotice')?>')">标记为已读</a> |
									 <a href="javascript:void(0);" onclick="doStatus('<?=site_url('site/delNotice')?>')">删除</a>
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
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->