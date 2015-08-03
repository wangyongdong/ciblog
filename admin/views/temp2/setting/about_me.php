<script type="text/javascript" src="<?=UEDITOR_PLUGIN;?>ueditor.config.js"></script>
<script type="text/javascript" src="<?=UEDITOR_PLUGIN;?>ueditor.all.js"></script>
<div id="main">
	<form action="<?=site_url('setting/updAbout')?>" method="post">
		<input type="hidden" name="token" value="<?=$token?>" />
		<?=$uedit?>
	    <input type="submit" value="修改" id="button-save" style="margin-left:400px;"/>
	</form>
</div>

