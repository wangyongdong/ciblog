<div id="main" role="main" class="clearfix">
	<div id="left">
		<article>
			<?php foreach($article as $list):?>	
			<div class="post">
				<header>
					<h3 class="posttitle">
						<a href="<?=site_url('article/view/'.$list['id'])?>" rel="bookmark"><?=$list['title']?></a>
					</h3>
				</header>
				<div class="postdate">
					<p><span class="postdateno"><?=dateFor($list['datetime'],"d")?></span><br><?=engDate($list['datetime'],'m')?></p>
				</div>
				<div class="postcontent"><?=cutTab($list['content'],150)?></div>
				<div class="postdetails">
					<p class="meta-pos">
						<span class="meta-info author">
							Author: <a><?=getUserInfo($list['uid'],'username')?></a>
						</span>
						<span class="meta-info comments">
							Views: <a><?=$list['views']?></a>
						</span>
						<span class="meta-info category">
							Category: <a><?=getSortField($list['sortid'],'name');?></a>
						</span>
					</p>
					<p class="postcomments">
						<time class="entry-date"><?=dateFor($list['datetime'])?></time>
					</p>
				</div>
			</div>
			<?php endforeach;?>
		</article>
		<div class="pagination">
			<?php 
				echo $this->pagination->create_links();
			?>
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
		<h3 class="widgettitle">文章归档<span class="left-more"><a href="<?=site_url('archive')?>">更多>></a></h3>
		<div class="widget">
			<ul>
				<?php foreach($archive as $list):?>
				<li><a href="<?=site_url('article/archive/'.$list['datetime'])?>"><?=engDate($list['datetime'],'yd')?></a>&nbsp;(<?=$list['num']?>)</li>
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
				<li><a href="#">分享网址</a></li>
				<li><a href="/contact">给我留言</a></li>
				<li><a href="/links">申请友链</a></li>
			</ul>
		</div>
	</div>
</div>
