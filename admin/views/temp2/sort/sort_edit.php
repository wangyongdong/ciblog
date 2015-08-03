<div id="main">
	<div id="main_new" class="item_edit">
		<form method="post" action="<?=site_url('sort/doSort')?>">
			<input type="hidden" value="<?=$list['id']?>" name="id">
			<input type="hidden" name="token" value="<?=$token?>">
			<li>
				<input class="input" name="name" value="<?=$list['name']?>" style="width:243px;" maxlength="200"> &nbsp;&nbsp;名称
				<span class="required">*</span>
			</li>
			<li>
				<input class="input" name="alias" value="<?=$list['alias']?>" style="width:243px;" maxlength="200"> &nbsp;&nbsp;别名 (用于URL的友好显示)
				<span class="required">*</span>
			</li>
			<li>
				分类描述<br>
				<textarea class="input_textarea" name="description"><?=$list['description']?></textarea>
			</li>
			<li>
				<input id="button-save" type="submit" value="保存">
				<input id="button-cancel" type="button" onclick="javascript:window.history.back();" value="取 消">
			</li>
		</form>
	</div>
</div>