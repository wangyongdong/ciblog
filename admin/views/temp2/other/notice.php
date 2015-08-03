<div id="main">
	<table id="article_table" class="article_table" style="100%" cellspacing="0">
		<tr>
			<th align="left"></th>
			<th align="left" width="500px">内容</th>
			<th align="left" width="180px">时间</th>
		</tr>
		<?php if(empty($notice)) {?>
		<tr>
			<td width="1120px" align="center" colspan="7">最近没有收到任何通知。</td>
		</tr>
		<?php 
		} else {
			foreach($notice as $list):?>
			
		<tr>
			<td width="20px"><input type="checkbox" name="select[]" id="<?=$list['id']?>"></td>
			<td <?php if($list['status'] == 'unread') {echo ' style="font-weight:bold;"';}?>><?=$list['content']?></td>
			<td><?=$list['datetime']?></td>
		</tr>
		<?php 
			endforeach;
		} ?>
	</table>
	<div id="search_bottom">
		<a id="select_all" href="javascript:void(0);" onclick="selectAll()">全选</a>
		 选中项：<a class="care" href="javascript:void(0);" onclick="updNotice()">标记为已读</a> | 
		 		<a class="care" href="javascript:void(0);" onclick="delNotice()">删除</a>
	</div>
	<div class="article-page">
		<?php 
			echo $this->pagination->create_links();
		?>
	</div>
</div>