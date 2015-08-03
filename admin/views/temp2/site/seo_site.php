<div id="main">
	<div id="site_list">
		<b>meta信息设置：</b>
	</div>
	<div id="site_con" class="item_edit">
		<form name="input" method="post" action="<?=site_url('site/seoUpdate')?>">
			<li>
				站点浏览器标题(title)
				<br>
				<input class="input" name="site_title" value="<?=$list['site_title'];?>" style="width:300px;" maxlength="200">
			</li><br>
			<li>
				站点关键字(keywords)
				<br>
				<input class="input" name="site_key" value="<?=$list['site_key'];?>" style="width:300px;" maxlength="200">
			</li><br>
			<li>
				站点浏览器描述(description)
				<br>
				<textarea class="textarea" style="width:300px;" rows="4" name="site_description"><?=$list['site_description'];?></textarea>
			</li><br>
			<li style="margin-top:10px;">
				<input id="button-save" type="submit" value="保存" style="margin-left:25px;">
			</li>
		</form>
	</div>
	<div class="setting_line"></div>
</div>