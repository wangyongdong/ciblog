<div id="main">
	<table id="article_table" style="100%" cellspacing="0">
		<tr>
			<th align="left">网站名称</th>
			<th align="left">描述</th>
			<th align="left">url</th>
			<th align="left">状态</th>
			<th align="left">添加时间</th>
			<th align="left">操作</th>
		</tr>
		<?php foreach($list as $list):?>
		<tr>
			<td width="300px"><a href="<?=site_url('links/update/'.$list['id'])?>"><?=$list['sitename']?></a></td>
			<td width="700px"><?=$list['description']?></td>
			<td width="400px"><?=$list['siteurl']?></td>
			<td width="100px">
				<a href="">
					<img border="0" align="absbottom" src="<?=ADMIN_PUBLIC;?>images/common/vlog.gif">
				</a>
			</td>
			<td width="500px"><?=$list['datetime']?></td>
			<td width="300px">
				<a href="<?=site_url('links/update/'.$list['id'])?>"><img width="16" title="编辑" alt="编辑" src="<?=ADMIN_PUBLIC;?>images/common/page_edit.png"></a>  
				<a href="javascript:void(0);" onclick="doDel(<?=$list['id']?>,'<?=site_url('links/doDel')?>')"><img width="16" title="删除" alt="删除" src="<?=ADMIN_PUBLIC;?>images/common/delete.png"></a>
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
		<a href="javascript:void(0);" onclick="newPage()">添加友情链接+</a>
	</div>
	<div id="main_new" class="item_edit" style="display:none;">
		<form method="post" action="<?=site_url('links/doLinks')?>">
				<input type="hidden" name="token" value="<?=$token?>">
			<li>
				<input id="sitename" class="input" name="sitename" style="width:243px;" maxlength="200"> &nbsp;&nbsp;网站名称
				<span class="required">*</span>
			</li>
			<li>
				<input id="siteurl" class="input" name="siteurl" style="width:243px;" maxlength="200"> &nbsp;&nbsp;url
				<span class="required">*</span>
			</li>
			<li>
				<textarea class="textarea" style="width:240px;height:60px;overflow:auto;" type="text" name="description"></textarea>
				<span class='r_text'>网站描述</span>
				<span class="required">*</span>
			</li>
			<li>
				显示<input id="status" class="input" name="status" value="show" type="radio" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				隐藏<input id="status" class="input" name="status" value="hide" type="radio">
				<span class='r_radio'>是否显示</span>
			</li>
			<li>
				<input id="button-save" class="save" type="submit" value="保存">
			</li>
		</form>
	</div>
</div>