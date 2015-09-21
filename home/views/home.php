<!-- 首页轮播图设定 start -->
<script type="text/javascript" src="<?=PATH_PUBLIC;?>js/jquery_cycle.js"></script>
<script type="text/javascript">
	jQuery('#featured_slider ul').cycle({ 
		fx: 'fade',
		prev: '.feat_prev',
		next: '.feat_next',
		speed:  3000, 
		timeout: 2000, 
		pager:  null
	});
</script>
<div id="main" role="main" class="clearfix">
	<div id="left">
		<div id="sliderwrap">
			<div id="featured_slider">
				<ul style="position: relative;" id="slider">
					<li>
						<h2><a href="#">Welcome to Busby – This is the Layout Test</a></h2>
						<a href="#"><img src="<?=PATH_PUBLIC;?>img/skater.jpg"></a>
					</li>
					<li>
						<h2><a href="#">Look here for a Readability Test</a></h2>
						<a href="#"><img src="<?=PATH_PUBLIC;?>img/skater-in-air.jpg"></a>
					</li>
					<li>
						<h2><a href="#">How about an Images Test ?</a></h2>
						<a href="#"><img src="<?=PATH_PUBLIC;?>img/skaters.jpg"></a>
					</li>
					<li>
						<h2><a href="#">Comment Test</a></h2>
						<a href="#"><img src="<?=PATH_PUBLIC;?>img/south-bank-graffiti.jpg"></a>
					</li>
					<li>
						<h2><a href="#">Many Tags Many Tags Many Tags</a></h2>
						<a href="#"><img src="<?=PATH_PUBLIC;?>img/spray-paint.jpg"></a>
					</li>
				</ul>
				<div class="feat_next"></div>
				<div class="feat_prev"></div>
			</div>
		</div>
		<article>
			<?php foreach($article as $list):?>
			<div class="post">
				<header>
					<h2 class="posttitle">
						<a href="<?=site_url('article/'.$list['id'])?>" rel="bookmark"><?=$list['title']?></a>
					</h2>
				</header>
				<div class="postdate">
					<p><span class="postdateno"><?=dateFor($list['datetime'],"d")?></span><br><?=engDate($list['datetime'],'m')?></p>
				</div>
				<div class="postcontent"><?=cutTab($list['content'],120)?></div>
				<div class="postdetails">
					<p class="postedby">
						<span class="sep">Posted on</span>
						<a class="bookmark" rel="bookmark"><time class="entry-date"><?=dateFor($list['datetime'])?></time></a>
						<span class="sep">by</span>
						<span class="author vcard"><a class="url fn n"><?=getUserInfo($list['uid'],'username')?></a></span>
					</p>
					<p class="postcomments"><span>Views &nbsp;<?=$list['views']?></span></p>
				</div>
			</div>
			<?php endforeach;?>
		</article>
	</div>
	<div id="right">
		<div class="widget">
			<div class="avatar">
				<a href="<?=site_url('about')?>"><span>关于<?=$blogger['username']?></span></a>
			</div>
			<ul>
				<li>姓名：<?=$blogger['username']?></li>
				<li>职业：<?=$blogger['job']?></li>
				<li>地址：<?=$blogger['address']?></li>
				<li>QQ：<?=$blogger['qq']?></li>
				<li>邮箱：<?=$blogger['email']?></li>
			</ul>
		</div>
		<h3 class="widgettitle">文章归档</h3>
		<div class="widget">
			<ul>
				<?php foreach($left_archive as $list):?>
				<li><a href="<?=site_url('archive/'.$list['datetime'])?>"><?=engDate($list['datetime'],'yd')?></a>&nbsp;(<?=$list['num']?>)</li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">最新文章</h3>
		<div class="widget">
			<ul>
				<?php foreach($left_new as $list):?>
				<li><a href="<?=site_url('article/'.$list['id'])?>"><?=cutTab($list['title'],14)?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">业内新闻</h3>
		<div class="widget">
			<ul>
				<?php foreach($left_cms as $list):?>
				<li><a href="<?=site_url('cms/'.$list['id'])?>"><?=cutTab($list['title'],14)?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">友情链接</h3>
		<div class="widget">
			<ul class="website">
				<?php foreach($left_links as $list):?>
				<li><a target="_blank" href="<?=$list['siteurl']?>"><?=$list['sitename']?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">分享网址</h3>
		<div class="widget fx_this">
			<!-- Baidu Button BEGIN -->
			<div class="bdsharebuttonbox"><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到豆瓣网" href="#" class="bds_douban" data-cmd="douban"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
			<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["mshare","qzone","tsina","weixin","renren","tqq","kaixin001","tieba","sqq","douban","ty","twi","fbook","mail","copy","print"],"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
			<!-- Baidu Button END -->
		</div>
		<h3 class="widgettitle">关注博主</h3>
		<div class="widget">
			<div class="attention">
				<a href="#" class="sina" title="新浪微博" target="_blank">sina</a>
				<a href="#" class="tencent" title="腾讯微博" target="_blank">tencent</a>
				<a href="#" class="wechat" title="微信" target="_blank">wechat</a>
			</div>
		</div>
		<h3 class="widgettitle">Meta</h3>
		<div class="widget">
			<ul>
				<li><a href="/admin">登录blog</a></li>
				<li><a href="/archive">文章归档</a></li>
				<li><a href="/history">博客事件</a></li>
				<li><a href="/contact">给我留言</a></li>
				<li><a href="/links">申请友链</a></li>
			</ul>
		</div>
	</div>
</div>