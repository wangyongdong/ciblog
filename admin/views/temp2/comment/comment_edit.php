<div id="main" class="main">
	<form action="<?=site_url('comment/doComment')?>" method="post">
		<table class="cv_table">
			<tbody>
				<input type="hidden" name="token" value="<?=$token?>">
				<input type="hidden" name="reply_id" value="<?=$comment['id']?>">
				<?php 
				if($comment['comment_type'] == 'contact') {
				?>
				<tr>
					<td class="cv_td_l">标题：</td>
					<td class="cv_td_r"><input type="text" name='subject' value="<?=$comment['subject']?>"></td>
				</tr>
				<?php } ?>
				<?php 
				if($comment['comment_type'] == 'article') {
				?>
				<tr>
					<td class="cv_td_l">所属文章id：</td>
					<td class="cv_td_r"><input type="text" name='comment_id' value="<?=$comment['comment_id']?>"></td>
				</tr>
				<?php } ?>
				<tr>
					<td class="cv_td_l">类别：</td>
					<td class="cv_td_r"><input type="text" name='comment_type' value="<?=$comment['comment_type']?>"></td>
				</tr>
				<tr>
					<td class="cv_td_l">昵称：</td>
					<td class="cv_td_r"><input type="text" name='author' value="<?=$comment['author']?>"></td>
				</tr>
				<tr>
					<td class="cv_td_l">邮箱：</td>
					<td class="cv_td_r"><input type="text" name='email' value="<?=$comment['email']?>"></td>
				</tr>
				<tr>
					<td class="cv_td_l">链接：</td>
					<td class="cv_td_r"><input type="text" name='url' value="<?=$comment['url']?>"></td>
				</tr>
				<tr>
					<td class="cv_td_l_h">内容：</td>
					<td class="cv_td_r_h small_text"><textarea name='comment'><?=$comment['comment']?></textarea></td>
				</tr>
				<?php 
				if(!empty($reply)) {
					foreach($reply as $reply):?>
				<tr>
					<td class="cv_td_l_h">回复评论：</td>
					<td class="cv_td_r_h small_text"><textarea name='hasreply'><?=$reply['comment']?></textarea></td>
				</tr>
				<?php 
					endforeach;
				}
				?>
				<tr>
					<td class="cv_td_l_h">添加回复：</td>
					<td class="cv_td_r_h small_text"><textarea name='reply'></textarea></td>
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
