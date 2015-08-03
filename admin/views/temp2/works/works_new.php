<div id="main">
	<form action="<?=site_url('works/doWorks')?>" method="post">
		<table class="cv_table">
			<tbody>
				<input type="hidden" name="token" value="<?=$token?>">
				<tr>
					<td class="cv_td_l"><span class="required">*</span>项目标题：</td>
					<td class="cv_td_r"><input type="text" name='title' value=""></td>
				</tr>
				<tr>
					<td class="cv_td_l_h"><span class="required">*</span>项目描述：</td>
					<td class="cv_td_r_h"><textarea name='description'></textarea></td>
				</tr>
				<tr>
					<td class="cv_td_l_h"><span class="required">*</span>项目职责：</td>
					<td class="cv_td_r_h"><textarea name='respon'></textarea></td>
				</tr>
				<tr>
					<td class="cv_td_l_h"><span class="required">*</span>项目总结：</td>
					<td class="cv_td_r_h"><textarea name='respon'></textarea></td>
				</tr>
				<tr>
					<td class="cv_td_l">项目链接：</td>
					<td class="cv_td_r"><input type="text" name='link' value=""></td>
				</tr>
				<tr>
					<td class="cv_td_l"><span class="required">*</span>开发周期：</td>
					<td class="cv_td_r">
						<input class="s_r" type="text" name='date_start' value="">--
						<input class="s_r" type="text" name='date_end' value="">
						<span class="s_s">(2015年1月--2015年3月)</span>
					</td>
				</tr>
				<tr>
					<td class="cv_td_l">上传图片：</td>
					<td class="cv_td_r"><input type="file" name='img' value=""></td>
				</tr>
				<tr>
					<td class="cv_td_l">项目状态：</td>
					<td class="cv_td_r">
						上线：<input class="r_r" type="radio" name='status' value="online" checked="checked">
						未上线：<input class="r_r" type="radio" name='status' value="learn">
					</td>
				</tr>
				<tr>
					<td class="cv_td_l"></td>
					<td class="cv_td_r">
						<input id="button-save" type="submit" value="保存">
						<input id="button-cancel" type="button" value="取消">
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>