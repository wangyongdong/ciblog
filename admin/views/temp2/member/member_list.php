<div id="main">
	<table id="article_table" style="100%" cellspacing="0">
		<tr>
			<th align="left"></th>
			<th align="left">用户</th>
			<th align="left">权限</th>
			<th align="left">邮箱</th>
			<th align="left">文章</th>
			<th align="left">操作</th>
		</tr>
		<?php foreach($list as $list):?>
		<tr>
			<td width="100px">
			<img src="<?=LinkAvatar($list['id'])?>" class="user-avatar-small" />
			</td>
			<td width="200px"><a href="<?=site_url('member/update/'.$list['id'])?>"><?=$list['username']?></a></td>
			<td width="200px"><?=$list['role_name']?></td>
			<td width="400px"><?=$list['email']?></td>
			<td width="100px"><?=$list['nums']?></td>
			<td width="100px">
				<a href="<?=site_url('member/update/'.$list['id'])?>"><img width="16" title="编辑" alt="编辑" src="<?=ADMIN_PUBLIC;?>images/common/page_edit.png"></a>  
				<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('member/doDel')?>')"><img width="16" title="删除" alt="删除" src="<?=ADMIN_PUBLIC;?>images/common/delete.png"></a>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
	<div class="article-page">
		<?php 
			echo $this->pagination->create_links();
		?>
	</div>
	<div id="main_new_but">
		<a href="javascript:void(0);" onclick="newPage()">添加会员+</a>
	</div>
	<div id="main_new" class="item_edit" style="display:none;">
		<form method="post" action="<?=site_url('member/doUser')?>">
			<input type="hidden" name="token" value="<?=$token?>" />
			<li>
				<select class="input" name="role_id" id="role_id">
					<option value="3">会员</option>
					<option value="2">管理员</option>
				</select>
			</li>
			<li>
				<input class="input" type="text" name="username" style="width:243px;" maxlength="200"> &nbsp;&nbsp;用户名
				<span class="required">*</span>
			</li>
			<li>
				<input class="input" type="password" name="newpass" style="width:243px;" maxlength="200" value=""> &nbsp;&nbsp;新密码（不小于6位，不修改请留空）
				<span class="required">*</span>
			</li>
			<li>
				<input class="input" type="password" name="repass" style="width:243px;" maxlength="200" value=""> &nbsp;&nbsp;再输入一次新密码
				<span class="required">*</span>
			</li>
			<li>
				<input class="save" type="submit" value="保存">
			</li>
		</form>
	</div>
</div>