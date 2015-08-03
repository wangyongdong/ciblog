<div id="main">
	<div id="search_top">
		<div class="f_filters">
			<a href="<?=site_url('article/alist')?>">全部</a>
			<select name="bysort" onchange="searchSort(this.value);">
				<option value=''>按分类查看...</option>
				<?php foreach($sort_list as $sort):?>
				<option value="<?=$sort['id']?>" <?php if(!empty($aFilter['sort']) && @$aFilter['sort']==$sort['id']){echo"selected='selected'";}?> ><?=$sort['name']?></option>
				<?php endforeach;?>
			</select>
			<select name="byuser" onchange="searchUser(this.value);">
				<option value=''>按作者查看...</option>
				<?php foreach($user_list as $user):?>
				<option value="<?=$user['id']?>" <?php if(!empty($aFilter['user']) && @$state['user']==$user['id']){echo"selected='selected'";}?> ><?=$user['username']?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div class="f_filters_right">
			<input id="search_input" type="text" name="q" value="<?php echo @$aFilter['q'];?>">
			<input type="image" src="<?=ADMIN_PUBLIC;?>images/common/search.png" id="search_img" onclick="searchKeyWord();">
		</div>
		<div class="clear"></div>
	</div>
	<table id="article_table" style="100%" cellspacing="0">
		<tr>
			<th colspan=2  align="left">标题</th>
			<th align="left" width="60px">查看</th>
			<th align="left" width="120px">作者</th>
			<th align="left" width="100px">分类</th>
			<th align="left" width="180px">时间</th>
			<th align="left" width="110px">首页置顶</th>
			<th align="left" width="110px">分类置顶</th>
			<th align="left" width="60px">评论</th>
			<th align="left" width="60px">阅读</th>
		</tr>
		<?php
			if(empty($list)) {
		?>
		<tr>
			<td width="1120px" align="center" colspan="7">还没有文章</td>
		</tr>
		<?php 
			} else {
		 		foreach($list as $list):
		?>
		<tr>
			<td width="20px"><input type="checkbox" name="select[]" id="<?=$list['id']?>"></td>
			<td width="500px"><a href="<?=site_url('article/update/'.$list['id'])?>"><?=cutStr($list['title'],22)?></a></td>
			<td>
				<a href="<?=site_url('article/update/'.$list['id'])?>">
					<img border="0" align="absbottom" src="<?=ADMIN_PUBLIC;?>images/common/vlog.gif">
				</a>
			</td>
			<td><a><?=getUser($list['uid'],'username')?></a></td>
			<td><a href="<?=site_url('sort/slist')?>"><?=makeSort($list['type']);?></a></td>
			<td><?=$list['datetime']?></td>
			<td><?=$list['hometop']?></td>
			<td><?=$list['sorttop']?></td>
			<td><?=$list['comnum']?></td>
			<td><?=$list['views']?></td>
		</tr>
		<?php 
				endforeach;
			}
		?>
	</table>
	<div id="search_bottom">
		<a href="javascript:void(0);" onclick="selectAll()">全选</a>
		 选中项：<a href="javascript:void(0);" onclick="delAll()">删除</a> | 
		<select name="f_order" onchange="changeTop(this.value);">
			<option value ="">置顶操作...</option>
			<option value ="hometop">首页置顶</option>
			<option value ="sorttop">分类置顶</option>
			<option value="notop">取消置顶</option>
		</select>
		<select name="f_sort_move" onchange="changeSort(this.value);">
			<option value ="">移动到分类...</option>
			<?php foreach($sort_list as $sort):?>
			<option value ="<?=$sort['id']?>"><?=$sort['name']?></option>
			<?php endforeach;?>
		</select>		
	</div>
	<div class="article-page">
		<?php 
			echo $this->pagination->create_links();
		?>
	</div>
</div>