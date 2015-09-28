<div class="t_title">
	<h1 class="t_nav"><span><?=getPageDesc('about');?></span></h1>
</div>
<div id="main" role="main" class="clearfix">
	<div id="left">
		<div class="row">
			<div class="twelve columns">
				<div class="mod modSectionHeader" data-connectors="1">
					<h2>About Me</h2>
					<p>A history of the me</p>
				</div>
			</div>
		</div>
		<div class="twelve columns"><?=$blogger['about_me']?></div>
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
		<h3 class="widgettitle">分享网址</h3>
		<div class="widget fx_this">
			<!-- Baidu Button BEGIN -->
			<div class="bdsharebuttonbox"><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到豆瓣网" href="#" class="bds_douban" data-cmd="douban"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
			<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"王永东博客 | 记录在学习和工作中遇到的技术与问题，见证一名网站开发人员的成长与体会。博客地址:<?=HOST?>。","bdMini":"2","bdMiniList":["mshare","qzone","tsina","weixin","renren","tqq","kaixin001","tieba","sqq","douban","ty","twi","fbook","mail","copy","print"],"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
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
				<li><a href="/archive">文章归档</a></li>
				<li><a href="/history">博客事件</a></li>
				<li><a href="/contact">给我留言</a></li>
				<li><a href="/links">申请友链</a></li>
			</ul>
		</div>
	</div>
</div>