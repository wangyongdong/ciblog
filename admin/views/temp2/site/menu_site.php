<div id="site_menu" class="item_edit">
	<?php foreach($list as $list):?>
		<div class="widget-title">
			<a class="button" href="<?=site_url('site/updateMenu/'.$list['id'])?>">
				<img class="more-action" width="16" alt="编辑" title="编辑" src="../../public/admin/images/common/brick_edit.png">
			</a>
			<?=$list['menu_name']?>
			<span id="ch<?=$list['id']?>" <?php if($list['status']=='show'){echo 'class="imgcheck-on"';} else {echo 'class="imgcheck"';}?> onclick="changeClass(<?=$list['id']?>)"></span>
			<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('site/delMenu')?>')"><img class="del_img" title="删除" alt="删除" src="../../public/admin/images/common/delete.png"></a>
		</div>
	<?php endforeach;?>
</div>
<div class="ss_menu"></div>
<div class="site_add">
	<div style="margin:30px 0px 10px 0px;">
		<a href="javascript:void(0);" onclick="newPage()">添加导航+</a>
	</div>
	<div id="main_new" class="item_edit" style="display: none;line-height:40px;">
		<form method="post" action="<?=site_url('site/doMenu')?>">
			<li>
				<input id="menu_name" class="input" name="menu_name" style="width:243px;" maxlength="200"> &nbsp;&nbsp;导航名称<span class="required">*</span>
			</li>
			<li>
				<input id="menu_alias" class="input" name="menu_alias" style="width:243px;" maxlength="200"> &nbsp;&nbsp;导航别名<span class="required">*</span>
			</li>
			<li>
				<textarea class="textarea" style="width:240px;height:60px;overflow:auto;" type="text" name="menu_desc"></textarea>
				&nbsp;&nbsp;导航描述<br>
			</li>
			<li>
				显示：<input class="r_r" type="radio" name='status' value="show" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				不显示：<input class="r_r" type="radio" name='status' value="hide">
			</li>
			<li>
				<input id="addsort" class="button" type="submit" value="添加新导航">
			</li>
		</form>
	</div>
</div>