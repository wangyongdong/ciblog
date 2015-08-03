<div id="main">
	<table id="article_table" style="100%" cellspacing="0">
		<tr>
			<th align="left">标题</th>
			<th align="left">链接</th>
			<th align="left">状态</th>
			<th align="left">查看</th>
			<th align="left">操作</th>
		</tr>
		<?php foreach($list as $list):?>
		<tr>
			<td width="300px"><a href="<?=site_url('works/update/'.$list['id'])?>"><?=cutStr($list['title'],22)?></a></td>
			<td width="400px"><?=$list['link']?></td>
			<td width="200px"><?=$list['status']?></td>
			<td width="100px">
				<a href="">
					<img border="0" align="absbottom" src="<?=ADMIN_PUBLIC;?>images/common/vlog.gif">
				</a>
			</td>
			<td width="500px">
				<a href="<?=site_url('works/update/'.$list['id'])?>"><img width="16" title="编辑" alt="编辑" src="<?=ADMIN_PUBLIC;?>images/common/page_edit.png"></a>&nbsp;&nbsp;  
				<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('works/doDel')?>')"><img width="16" title="删除" alt="删除" src="<?=ADMIN_PUBLIC;?>images/common/delete.png"></a>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
	<div class="article-page">
		<?php 
			echo $this->pagination->create_links();
		?>
	</div>
</div>