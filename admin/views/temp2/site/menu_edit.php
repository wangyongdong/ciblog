<div id="main">
	<div id="w_create">
		<form action="<?=site_url('site/doMenu')?>" method="post">
			<table class="cv_table">
				<tbody>
					<input type="hidden" name="id" value="<?=$list['id']?>">
					<tr>
						<td class="cv_td_l">导航名称：</td>
						<td class="cv_td_r"><input type="text" name='menu_name' value="<?=$list['menu_name']?>"></td>
					</tr>
					<tr>
						<td class="cv_td_l">导航别名：</td>
						<td class="cv_td_r"><input type="text" name='menu_alias' value="<?=$list['menu_alias']?>"></td>
					</tr>
					<tr>
						<td class="cv_td_l_h">导航描述：</td>
						<td class="cv_td_r_h"><textarea name='menu_desc'><?=$list['menu_desc']?></textarea></td>
					</tr>
					<tr>
						<td class="cv_td_l">导航状态：</td>
						<td class="cv_td_r">
							显示：<input class="r_r" type="radio" name='status' value="show" <?php if($list['status']=='show'){echo 'checked="checked"';}?>>
							不显示：<input class="r_r" type="radio" name='status' value="hide" <?php if($list['status']=='hide'){echo 'checked="checked"';}?>>
						</td>
					</tr>
					<tr>
						<td class="cv_td_l"></td>
						<td class="cv_td_r">
							<input id="button-save" class="save" type="submit" value="保存">
							<input id="button-cancel" class="cancel" type="button" value="取消">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>