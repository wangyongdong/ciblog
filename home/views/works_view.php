<div class="t_title">
	<h1 class="t_nav"><span><?=getPageDesc('works');?></span></h1>
</div>
<div id="main" role="main" class="clearfix">
	<div id="left" class="t_d">
		<article>
			<div class="tables_d">
				<h2><?=$works['title']?></h2>
				<table class="table table-bordered table-striped">
			    	<tbody>
			      		<tr>
			        		<td class="t_td"><strong>项目描述</strong></td>
			        		<td>
			          			<p class="p_indet"><?=nl2br($works['description'])?></p>
			        		</td>
			      		</tr>
			      		<tr>
			        		<td class="t_td"><strong>项目职责</strong></td>
			        		<td>
			         	 		<p class="p_indet"><?=nl2br($works['respon'])?></p>
			        		</td>
			      		</tr>
			      		<tr>
			        		<td class="t_td"><strong>项目总结</strong></td>
			        		<td>
			         	 		<p class="p_indet"><?=nl2br($works['summary'])?></p>
			        		</td>
			      		</tr>
			      		<tr>
					        <td class="t_td"><strong>项目链接</strong></td>
					        <td>
					          	<p><a href="<?=$works['link']?>"><?=$works['link']?></a></p>
					        </td>
			      		</tr>
			      		<tr>
					        <td class="t_td"><strong>开发周期</strong></td>
					        <td>
					          	<?=$works['date_start']?> -- <?=$works['date_end']?>
					        </td>
			      		</tr>
			      		<tr>
					        <td class="t_td"><strong>项目状态</strong></td>
					        <td>
					          	<p><?=getWorkStatus($works['status'])?></p>
					        </td>
			      		</tr>
					</tbody>
				</table>
			</div>
		</article><!-- #post-188 -->
	</div>
	<div id="right">
		<h3 class="widgettitle">栏目导航</h3>
		<div class="rnav">
			<ul>
				<?php foreach($sort as $list):?>
				<li><a href="<?=site_url('article/sort/'.$list['id'])?>"><?=$list['name']?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">文章归档</h3>
		<div class="widget">
			<ul>
				<?php foreach($archive as $list):?>
				<li><a href="<?=site_url('article/archive/'.$list['datetime'])?>"><?=engDate($list['datetime'])?></a>&nbsp;(<?=$list['num']?>)</li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">点击排行</h3>
		<div class="widget">
			<ul>
				<?php 
				$i=0;
				foreach($article_view as $list):
					$i++;
					if($i<=3) {
				?>
				<li>
					<span class="num1"><?php echo $i;?></span>
					<a href="<?=site_url('article/view/'.$list['id'])?>"><?=cutStr($list['title'],14,'...')?></a>
				</li>
				<?php 
					} else {
				?>
				<li>
					<span><?php echo $i;?></span>
					<a href="<?=site_url('article/view/'.$list['id'])?>"><?=cutStr($list['title'],14,'...')?></a>
				</li>
				<?php 
					}
				endforeach;
				?>
			</ul>
		</div>
		<h3 class="widgettitle">Meta</h3>
		<div class="widget">
			<ul>
				<li><a href="/admin">登录blog</a></li>
				<li><a href="#">分享网址</a></li>
				<li><a href="/contact">留言评论</a></li>
				<li><a href="/common/links">申请友链</a></li>
			</ul>
		</div>
	</div>
</div>
