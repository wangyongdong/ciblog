<div id="main">
	<table id="article_table" style="100%" cellspacing="0">
		<tr>
			<th align="left">序号</th>
			<th align="left">名称</th>
			<th align="left">描述</th>
			<th align="left">别名</th>
			<th align="left">文章</th>
			<th align="left">操作</th>
		</tr>
		<?php foreach($list as $list):?>
		<tr>
			<td width="500px"><?=$list['id']?></td>
			<td width="500px">
				<a href="<?=site_url('sort/update/'.$list['id'])?>"><?=$list['name']?></a>
			</td>
			<td width="500px"><?=$list['description']?></td>
			<td width="500px"><?=$list['alias']?></td>
			<td width="500px"><a href="<?=site_url('sort/update/'.$list['id'])?>"><?=$list['nums']?></td>
			<td width="500px">
				<a href="<?=site_url('sort/update/'.$list['id'])?>"><img width="16" title="编辑" alt="编辑" src="<?=ADMIN_PUBLIC;?>images/common/page_edit.png"></a>  
				<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('sort/doDel')?>')"><img width="16" title="删除" alt="删除" src="<?=ADMIN_PUBLIC;?>images/common/delete.png"></a>
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
		<a href="javascript:void(0);" onclick="newPage()">添加分类+</a>
	</div>
	<div id="main_new" class="item_edit" style="display: none;line-height:40px;">
		<form method="post" action="<?=site_url('sort/doSort')?>">
			<input type="hidden" name="token" value="<?=$token?>" />
			<li>
				<input class="input" name="name" style="width:243px;" maxlength="200"> &nbsp;&nbsp;名称
				<span class="required">*</span>
			</li>
			<li>
				<input class="input" name="alias" style="width:243px;" maxlength="200"> &nbsp;&nbsp;别名 (用于URL的友好显示)
				<span class="required">*</span>
			</li>
			<li>
				分类描述<br>
				<textarea class="input_textarea" name="description"></textarea>
			</li>
			<li>
				<input id="button-save" type="submit" value="保存">
			</li>
		</form>
	</div>
</div>