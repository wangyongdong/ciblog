<div id="main">
	<table class="tableBorder" id="article_table"  cellspacing="0">
		<tr>
			<th align="left" colspan="4">网站信息统计</th>
		</tr>
		<tr>
			<td width="500px">当前用户</td>
			<td width="500px"><?=$_SESSION['username']?></td>
			<td width="500px">用户总数</td>
			<td width="500px"><?=$user?></td>
		</tr>
		<tr>
			<td width="500px">文章总数</td>
			<td width="500px"><?=$article?></td>
			<td width="500px">分类总数</td>
			<td width="500px"><?=$sort?></td>
		</tr>
		<tr>
			<td width="500px">说说总数</td>
			<td width="500px"><?=$record?></td>
			<td width="500px">照片总数</td>
			<td width="500px"></td>
		</tr>
		<tr>
			<td width="500px">留言总数</td>
			<td width="500px"><?=$contact?></td>
			<td width="500px">评论总数</td>
			<td width="500px"><?=$comment?></td>
		</tr>
		<tr>
			<td width="500px">作品数量</td>
			<td width="500px"><?=$works?></td>
			<td width="500px">访问量</td>
			<td width="500px"><?=$view?></td>
		</tr>
	</table>
	<br/><br/><br/>
	<table class="tableBorder" id="article_table"  cellspacing="0">
		<tr>
			<th align="left" colspan="4">系统信息</th>
		</tr>
		<tr>
			<td width="500px">Web服务器</td>
			<td width="500px"><?=$arr['sysos']?></td>
			<td width="500px">PHP版本</td>
			<td width="500px"><?=$arr['php']?></td>
		</tr>
		<tr>
			<td width="500px">MySQL版本</td>
			<td width="500px"><?=$arr['mysql']?></td>
			<td width="500px">GD库版本</td>
			<td width="500px"><?=$arr['gdinfo']?></td>
		</tr>
		<tr>
			<td width="500px">最大执行时间</td>
			<td width="500px"><?=$arr['max_ex_time']?></td>
			<td width="500px">最大上传限制</td>
			<td width="500px"><?=$arr['max_upload']?></td>
		</tr>
		<tr>
			<td width="500px">远程文件获取</td>
			<td width="500px"><?=$arr['allowurl']?></td>
			<td width="500px">服务器时间</td>
			<td width="500px"><?=$arr['systemtime']?></td>
		</tr>
	</table>
</div>