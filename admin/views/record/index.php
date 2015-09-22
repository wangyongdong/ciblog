<!-- Main bar -->
<div class="mainbar">  
	<div class="page-head" style="margin-top:-22px;">
		<h2 class="pull-left"><i class="icon-home"></i> 碎言碎语</h2>
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
						<div class="pull-left">说说</div>
						<div class="widget-icons pull-right">
							<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
							<a href="#" class="wclose"><i class="icon-remove"></i></a>
						</div>  
						<div class="clearfix"></div>
					</div>
					<div class="widget-content">
						<div class="padd">
							<div class="avatar pull-left big-avatar">
								<img src="<?=LinkAvatar()?>" height=80 width=80/>
							</div>
							<div class="chat-content" style="width: 85%;padding-left:90px;">
								<form class="form-horizontal" method="post" action="<?=site_url('record/doRecord')?>">
									<?=RecordUedit()?>
									<div class="buttons">
										<input type="submit" class="btn btn-info btn-record" value="发表">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div> 
			</div>
			<div class="col-md-10">
				<div class="widget">
					<div class="widget-content">
						<div class="padd">
							<ul class="chats record-cont">
								<?php foreach($list as $list):?>
								<li class="by-me">
									<div class="avatar pull-left">
										<img src="<?=LinkAvatar()?>" height=40 width=40/>
									</div>
									<div class="chat-content">
										<div class="chat-meta">
											王永东 <span class="pull-right"><?=timeTran($list['datetime'])?></span>
										</div>
										<?=stripcslashes($list['content'])?>
										<div class="pull-right">
											<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('record/doDel')?>')">
												删除
											</a>
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