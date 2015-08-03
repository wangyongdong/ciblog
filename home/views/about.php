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
			<div class="twelve columns">
				<?=$blogger['about_me']?>
			</div>
	</div>
	<div id="right">
		<div class="widget">
			<div class="avatar">
				<a href="about.html">
					<span>关于王永东</span>
				</a>
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
				<li><a href="#">分享网址</a></li>
				<li><a href="/contact">留言评论</a></li>
				<li><a href="/common/links">申请友链</a></li>
			</ul>
		</div>
	</div>
</div>