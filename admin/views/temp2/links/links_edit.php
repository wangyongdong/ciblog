<div id="main">
	<div id="main_new" class="item_edit">
		<form method="post" action="<?=site_url('links/doLinks')?>">
			<input type="hidden" value="<?=$list['id']?>" name="id">
			<input type="hidden" name="token" value="<?=$token?>" >
			<li>
				<input id="sitename" class="input" name="sitename" style="width:243px;" value="<?=$list['sitename']?>" maxlength="200"> &nbsp;&nbsp;网站名称
				<span class="required">*</span>
			</li>
			<li>
				<input id="siteurl" class="input" name="siteurl" style="width:243px;" value="<?=$list['siteurl']?>" maxlength="200"> &nbsp;&nbsp;url
				<span class="required">*</span>
			</li>
			<li>
				<textarea class="textarea" style="width:240px;height:60px;overflow:auto;" type="text" name="description"><?=$list['description']?></textarea>
				<span class='r_text'>网站描述</span>
				<span class="required">*</span>
			</li>
			<li>
				显示<input id="status" class="input" name="status" value="show" type="radio" <?php if($list['status']=='show'){echo 'checked="checked"';}?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				隐藏<input id="status" class="input" name="status" value="hide" type="radio" <?php if($list['status']=='hide'){echo 'checked="checked"';}?>>
				<span class='r_radio'>是否显示</span>
			</li>
			<li>
				<input id="button-save" class="save" type="submit" value="保存">
				<input id="button-cancel" type="button" onclick="javascript: window.history.back();" value="取 消">
			</li>
		</form>
	</div>
</div>