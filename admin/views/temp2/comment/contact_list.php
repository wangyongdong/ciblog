<div id="main">
	<table id="article_table" class="article_table" style="100%" cellspacing="0">
		<tr>
			<th align="left"></th>
			
			<th align="left" width="180px">标题</th>
			<th align="left" width="200px">内容</th>
			<th align="left" width="180px">评论者</th>
			<th align="left" width="120px">邮箱</th>
			<th align="left" width="120px">链接</th>
			<th align="left" width="200px">时间</th>
		</tr>
		<?php if(empty($comment)) {?>
		<tr>
			<td width="1120px" align="center" colspan="7">还没有评论</td>
		</tr>
		<?php } else {?>
		<?php foreach($comment as $list):?>
		<tr>
			<td width="20px"><input type="checkbox" name="select[]" id="<?=$list['id']?>"></td>
			<td><a href="<?=site_url('comment/update/'.$list['id'])?>"><?=$list['subject']?></a></td>
			<td width="300px"><a href="<?=site_url('comment/update/'.$list['id'])?>"><?=cutStr($list['comment'],18)?></a></td>
			<td><?=cutStr($list['author'],6)?></td>
			<td><?=$list['email']?></td>
			<td><a href="<?=$list['url']?>"  target="_blank"><?=$list['url']?></a></td>
			<td><?=$list['datetime']?></td>
		</tr>
		<?php endforeach;?>
		<?php } ?>
	</table>
	<div id="search_bottom">
		<a id="select_all" href="javascript:void(0);" onclick="selectAll()">全选</a>
		 选中项：<a class="care" href="javascript:void(0);" onclick="delSelect('contact')">删除</a>
	</div>
	<div class="article-page">
		<?php 
			echo $this->pagination->create_links();
		?>
	</div>
</div>