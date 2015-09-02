<script>
function cutStatus(obj) {
	$("#"+obj).toggle();
}
</script>
<div id="main" role="main" class="clearfix">
	<div id="left">
		<div class="archives">
			<header class="entry-header">
				<h2 class="single-title">文章归档</h2>
				<div class="archives-meta">
					站点统计:<?=$static['sort']?>个分类 &nbsp;&nbsp;<?=$static['article']?>篇文章&nbsp;&nbsp;<?=$static['contact']?>条留言 &nbsp;&nbsp;<?=$static['comment']?>条评论&nbsp;&nbsp;博客运行:
					<span id="run_time" style="color: #888a13;">1年256天15时36分52秒</span>
				</div>
			</header>
			<?php foreach($archive_list as $key=>$arlist):?>
			<h3 class="year"><?=$key?> 年</h3>
			<ul class="mon_list">
				<?php foreach($arlist as $k=>$v):?>
				<li>
					<span class="mon" onclick="cutStatus('<?=$v['month']?>');"><?=$v['month']?> 月 ( <?=$v['num']?> 篇文章 )</span>
					<ul class="post_list" id="<?=$v['month']?>" style="display: none;">
						<?php foreach($v['article'] as $aK=>$aV):?>
						<li>
							<span class='i-ico'></span>
							<?=dateFor($aV['datetime'],'d')?>日:
							<a target="_blank" href="<?=site_url('article/view/'.$aV['id'])?>" style="color: #888a13;">
								<?=$aV['title']?>
							</a>
							<span class="ac">
								<span class='i-com'> </span>
								<?=$aV['comnum']?>
							</span>
						</li>
						<?php endforeach;?>
					</ul>
				</li>
				<?php endforeach;?>
			</ul>
			<?php endforeach;?>
		</div>
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
					<a href="<?=site_url('cms/view/'.$list['id'])?>"><?=cutTab($list['title'],14)?></a>
				</li>
				<?php 
					} else {
				?>
				<li>
					<span><?php echo $i;?></span>
					<a href="<?=site_url('cms/view/'.$list['id'])?>"><?=cutTab($list['title'],14)?></a>
				</li>
				<?php 
					}
				endforeach;
				?>
			</ul>
		</div>
		<h3 class="widgettitle">业内新闻</h3>
		<div class="widget">
			<ul>
				<?php foreach($cms_recom as $list):?>
				<li><a href="<?=site_url('cms/view/'.$list['id'])?>"><?=cutTab($list['title'],14)?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">最新评论</h3>
		<div class="widget">
			<ul class="c_comment">
				<?php foreach($comment as $list):?>
				<li>
					<a href="<?=$list['url']?>"><?=cutTab($list['author'],5)?></a>：<?=cutTab($list['content'],14)?>
					<a href="<?=site_url('cms/view/'.$list['comment_id'])?>">查看>></a>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">Meta</h3>
		<div class="widget">
			<ul>
				<li><a href="/admin">登录blog</a></li>
				<li><a href="<?=site_url('archive')?>">文章归档</a></li>
				<li><a href="/contact">给我留言</a></li>
				<li><a href="/links">申请友链</a></li>
			</ul>
		</div>
	</div>
</div>
