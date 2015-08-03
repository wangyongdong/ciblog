<div id="main">
	<div id="main_new" class="item_edit">
		<form method="post" action="<?=site_url('member/doUser')?>">
			<input type="hidden" value="<?=$list['id']?>" name="id">
			<input type="hidden" name="token" value="<?=$token?>" />
			<li>
				<input id="username" class="input" name="username" value="<?=$list['username']?>" style="width:243px;" maxlength="200"> &nbsp;&nbsp;用户名
				<span class="required">*</span>
			</li>
			<li>
				<input type="text" class="input" name="nickname" style="width:243px;" maxlength="200" value="<?=$list['nickname']?>"> &nbsp;&nbsp;昵称
			</li>
			<li>
				<input id="sign" class="input" name="sign" style="width:243px;" maxlength="200" value="<?=$list['sign']?>"> &nbsp;&nbsp;个人签名
			</li>
			<li>
				<input type="text" class="input" name="email" style="width:243px;" maxlength="200" value="<?=$list['email']?>"> &nbsp;&nbsp;电子邮件
			</li>
			<li>
				<input type="password" class="input" name="newpass" style="width:243px;" maxlength="200" value=""> &nbsp;&nbsp;新密码（不小于6位，不修改请留空）
			</li>
			<li>
				<input type="password" class="input" name="repass" style="width:243px;" maxlength="200" value=""> &nbsp;&nbsp;再输入一次新密码
			</li>
			<li>
				<select class="input" name="role_id">
					<option value="3" <?php if($list['role_id']=='3'){echo'selected';}?>>会员</option>
					<option value="2" <?php if($list['role_id']=='2'){echo'selected';}?>>管理员</option>
					<option value="4" <?php if($list['role_id']=='4'){echo'selected';}?>>黑名单</option>
				</select>
			</li>
			<li>
				<input id="button-save" type="submit" value="保存">
				<input id="button-cancel" type="button" onclick="javascript: window.history.back();" value="取 消">
			</li>
		</form>
	</div>
</div>