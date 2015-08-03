<div id="person" class="item_edit" >
	<form method="post" action="<?=site_url('setting/doPersonal')?>" enctype="multipart/form-data">
		<li>
			<input type="hidden" class="input" name="id" value="<?=$list['id']?>">
			<input type="hidden" name="token" value="<?=$token?>" />
		</li>
		<li>
			<img class='user-avatar-middle' src="<?=LinkAvatar($list['id'])?>"/>
			<input type="file" name="picname" value="">  (支持JPG、PNG、GIF格式图片)
			<input type="hidden" name="oldpic" value="<?=$list['picname']?>"/><br />
		</li><div id="li_div"></div>
		<li>
			<input class="input" name="username" style="width:243px;" maxlength="200" value="<?=$list['username']?>"> &nbsp;&nbsp;用户名<span class="required">*</span>
		</li><div id="li_div"></div>
		<li>
			<input class="input" name="nickname" style="width:243px;" maxlength="200" value="<?=$list['nickname']?>"> &nbsp;&nbsp;昵称
		</li><div id="li_div"></div>
		<li>
			<input class="input" name="email" style="width:243px;" maxlength="200" value="<?=$list['email']?>"> &nbsp;&nbsp;email
		</li><div id="li_div"></div>
		<li>
			<input class="input" name="qq" style="width:243px;" maxlength="200" value="<?=$list['qq']?>"> &nbsp;&nbsp;qq
		</li><div id="li_div"></div>
		<li>
			<input class="input" name="address" style="width:243px;" maxlength="200" value="<?=$list['address']?>"> &nbsp;&nbsp;地址
		</li><div id="li_div"></div>
		<li>
			<input class="input" name="job" style="width:243px;" maxlength="200" value="<?=$list['job']?>"> &nbsp;&nbsp;职业
		</li><div id="li_div"></div>
		<li>
			<input id="sign" class="input" name="sign" style="width:243px;" maxlength="200" value="<?=$list['sign']?>"> &nbsp;&nbsp;签名
		</li><div id="li_div"></div>
		<li>
			<input id="oldpassword" type="password" class="input" name="oldpass" style="width:243px;" maxlength="200" value=""> &nbsp;&nbsp;旧密码
		</li><div id="li_div"></div>
		<li>
			<input id="newpass" type="password" class="input" name="newpass" style="width:243px;" maxlength="200" value=""> &nbsp;&nbsp;新密码（不小于6位，不修改请留空）
		</li><div id="li_div"></div>
		<li>
			<input id="repass" type="password" class="input" name="repass" style="width:243px;" maxlength="200" value=""> &nbsp;&nbsp;再输入一次新密码
		</li><div id="li_div"></div>
		<li>
			<input id="button-save" class="save" type="submit" value="保存">
		</li>
	</form>
</div>