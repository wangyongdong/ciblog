<div id="main" role="main" class="clearfix">
	<div id="left">
		<article>
			<?php foreach($works as $list):?>	
			<div class="post">
				<header>
					<h3 class="posttitle w_t">
						<a href="<?=site_url('works/view/'.$list['id'])?>" rel="bookmark">
							<?=$list['title']?>
						</a>
					</h3>
				</header>
				<div class="postcontent">
					<p class="w_d">
						<?=$list['description']?>
					</p>
				</div>
				<div class="postdetails">
					<p class="meta-pos">
						<span class="meta-info author">
							Author: <a><?=getUserInfo($list['uid'],'username')?></a>
						</span>
						<span class="meta-info comments">
							Status: <a><?=getWorkStatus($list['status'])?></a>
						</span>
					</p>
					<p class="postcomments">
						<time class="entry-date" datetime="" pubdate="">
							<?=engMonth($list['datetime'])?> <?=date("d",strtotime($list['datetime']))?>, <?=date("Y",strtotime($list['datetime']))?>
						</time>
					</p>
				</div>
			</div>
			<?php endforeach;?>
		</article><!-- #post-188 -->
		<!-- #分页 -->
		<div class="pagination">
			<?php 
				echo $this->pagination->create_links();
			?>
		</div>
	</div>
	<div id="right">
		<h3 class="widgettitle">文章归档</h3>
		<div class="widget">
			<ul>
				<?php foreach($archive as $list):?>
				<li><a href="<?=site_url('article/archive/'.$list['datetime'])?>"><?=engDate($list['datetime'])?></a>&nbsp;(<?=$list['num']?>)</li>
				<?php endforeach;?>
			</ul>
		</div>
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
