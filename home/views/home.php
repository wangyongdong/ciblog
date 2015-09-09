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
			<?php foreach($article_recom as $list):?>
			<div class="post">
				<header>
					<h2 class="posttitle">
						<a href="<?=site_url('article/view/'.$list['id'])?>" rel="bookmark"><?=$list['title']?></a>
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
				<?php foreach($archive as $list):?>
				<li><a href="<?=site_url('article/archive/'.$list['datetime'])?>"><?=engDate($list['datetime'],'yd')?></a>&nbsp;(<?=$list['num']?>)</li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">最新文章</h3>
		<div class="widget">
			<ul>
				<?php foreach($article_new as $list):?>
				<li><a href="<?=site_url('article/view/'.$list['id'])?>"><?=cutTab($list['title'],14)?></a></li>
				<?php endforeach;?>
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
		<h3 class="widgettitle">友情链接</h3>
		<div class="widget">
			<ul class="website">
				<?php foreach($links as $list):?>
				<li><a target="_blank" href="<?=$list['siteurl']?>"><?=$list['sitename']?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">分享网址</h3>
		<div class="widget fx_this">
			<!-- JiaThis Button BEGIN -->
			<div class="jiathis_style_24x24">
				<a class="jiathis_button_qzone"></a>
				<a class="jiathis_button_tsina"></a>
				<a class="jiathis_button_tqq"></a>
				<a class="jiathis_button_weixin"></a>
				<a class="jiathis_button_renren"></a>
				<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
				<a class="jiathis_counter_style"></a>
			</div>
			<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
			<script>
				var jiathis_config = {
					title:' 王永东博客 | 记录在学习和工作中遇到的技术与问题，见证一名网站开发人员的成长与体会。博客地址:<?=HOST?>。'
				}
			</script>
			<!-- JiaThis Button END -->
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