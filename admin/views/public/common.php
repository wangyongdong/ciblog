<!-- Main bar -->
<div class="mainbar">
	<div class="page-head">
		<h2 class="pull-left"><i class="icon-home"></i> 提示</h2>
        <div class="bread-crumb pull-right">
	    	<a href="/admin"><i class="icon-home"></i> 首页</a> <span class="divider">/</span> 
	        <a href="<?=site_url('site/web')?>" class="bread-current">控制台</a>
        </div>
        <div class="clearfix"></div>
	</div>
	<div class="matter">
    	<div class="container">
			<div class="col-md-12">
              	<div class="widget">
                	<div class="widget-content">
                  		<div class="padd">
	                        <div class="support-contact center">
								<?=$info?>
								<p><a href="<?=$refer?>">如果没有跳转，请点这里跳转</a></p>
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
<script type="text/javascript">
	setTimeout("window.opener=null;window.location.href='<?=$refer?>'",2000);
</script>
<!-- Content ends -->