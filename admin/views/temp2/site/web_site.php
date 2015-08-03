<div id="main">
	<form name="input" method="post" action="<?=site_url('site/doUpdate')?>">
		<table id="table_input" width="95%" cellspacing="8" cellpadding="4" border="0" align="center">
			<tbody>
				<tr>
					<td width="18%" align="right">站点标题：</td>
					<td width="82%">
						<input class="input" name="sitename" value="<?=$list['sitename'];?>" style="width:390px;" maxlength="200">
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">站点副标题：</td>
					<td>
						<textarea class="textarea" style="width:386px;" rows="3" cols="" name="sitesign"><?=$list['sitesign'];?></textarea>
					</td>
				</tr>
				<tr>
					<td align="right">每页显示：</td>
					<td>
						<input class="input" name="article_nums" value="<?=$list['article_nums'];?>" size="4" maxlength="5">篇文章
					</td>
				</tr>
				<tr>
					<td width="18%" valign="top" align="right">
						功能开关：<br>
					</td>
					<td width="82%">
						<input id="login_code" type="checkbox" name="login_code" value="y" <?php if($list['login_code']){ echo "checked='checked'";};?> style="vertical-align:middle;"> 登录验证码
						<br>
					</td>
				</tr>
				<tr> </tr>
			</tbody>
		</table>
		<div class="setting_line"></div>
		<table width="95%" cellspacing="8" cellpadding="4" border="0" align="center">
			<tbody>
				<tr>
					<td width="18%" valign="top" align="right">
						微语：<br>
					</td>
					<td width="82%">
						<input id="isrecord" type="checkbox" checked="checked" name="is_record" value="y" <?php if($list['is_record']){ echo "checked='checked'";};?> style="vertical-align:middle;">
						开启微语， 每页显示
						<input class="input" type="text" style="width:40px;" value="<?=$list['record_nums'];?>" maxlength="5" name="record_nums">
						条微语
						<br>
						<input id="istreply" type="checkbox" name="is_treply" value="y" <?php if($list['is_treply']){ echo "checked='checked'";};?> style="vertical-align:middle;">
						开启微语回复，
						<input id="ischkreply" type="checkbox" name="is_chkreply" value="y" <?php if($list['is_chkreply']){ echo "checked='checked'";};?> style="vertical-align:middle;">
						回复审核
						<br>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="setting_line"></div>
		<table width="95%" cellspacing="8" cellpadding="4" border="0" align="center">
			<tbody>
				<tr>
					<td width="18%" valign="top" align="right">
						评论：<br>
					</td>
					<td width="82%">
						<input id="iscomment" type="checkbox" checked="checked" name="is_comment" value="y" <?php if($list['is_comment']){ echo "checked='checked'";};?> style="vertical-align:middle;">
						开启评论，发表评论间隔
						<input class="input" name="comment_interval" value="<?=$list['comment_interval'];?>" size="2" maxlength="5">
						秒
						<br>
						<input id="ischkcomment" type="checkbox" checked="checked" name="is_chkcomment" value="y" <?php if($list['is_chkcomment']){ echo "checked='checked'";};?> style="vertical-align:middle;">
						评论审核
						<br>
						
						<input id="comment_paging" type="checkbox" checked="checked" name="comment_paging" value="y" <?php if($list['comment_paging']){ echo "checked='checked'";};?> style="vertical-align:middle;">
						评论分页， 每页显示
						<input class="input" name="comment_pnum" value="<?=$list['comment_pnum'];?>" size="4" maxlength="5">
						条评论
					</td>
				</tr>
			</tbody>
		</table>
		<div class="setting_line"></div>
		<table width="95%" cellspacing="8" cellpadding="4" border="0" align="center">
			<tbody>
				<tr>
					<td width="18%" valign="top" align="right">
						附件：<br>
					</td>
					<td width="82%">
						<input id="isthumbnail" type="checkbox" checked="checked" name="is_thumbnail" value="y" <?php if($list['is_thumbnail']){ echo "checked='checked'";};?> style="vertical-align:middle;">
						上传图片生成缩略图，最大尺寸：
						<input class="input" name="att_imgmaxw" value="<?=$list['att_imgmaxw'];?>" size="4" maxlength="5">
						x
						<input class="input" name="att_imgmaxh" value="<?=$list['att_imgmaxh'];?>" size="4" maxlength="5">
						（单位：像素）
						<br>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="setting_line"></div>
		<table width="95%" cellspacing="8" cellpadding="4" border="0" align="center">
			<tbody>
				<tr>
					<td align="right">ICP备案号：</td>
					<td>
						<input class="input" name="icp" value="<?=$list['icp'];?>" style="width:390px;" maxlength="200">
					</td>
				</tr>
				<tr>
					<td width="18%" valign="top" align="right">
						首页底部信息：
						<br>
					</td>
					<td width="82%">
						<textarea class="textarea" style="width:386px;" rows="6" cols="" name="footer_info"><?=$list['footer_info'];?></textarea>
						<br>
						(支持html，可用于添加流量统计代码)
					</td>
				</tr>
			</tbody>
		</table>
		<div class="setting_line"></div>
		<table width="95%" cellspacing="8" cellpadding="4" border="0" align="center">
			<tbody>
				<tr>
					<td align="center" colspan="2">
						<input id="token" type="hidden" value="f7589517611fc2e1cd78c22a3622571a" name="token">
						<input id="button-save" type="submit" value="保存" style="margin-left:235px;">
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>