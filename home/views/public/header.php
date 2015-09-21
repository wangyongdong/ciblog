<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="Cache-Control" content="no-transform" />
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noarchive" />
		<meta name="keywords" content="<?=$keywords?>" />
		<meta name="description" content="<?=$description?>" />
		<title><?=$title?></title>
		<link rel="stylesheet" href="<?=PATH_PUBLIC;?>css/style.css">
		<link rel="stylesheet" href="<?=PATH_PUBLIC;?>css/css.css">
		<link rel="stylesheet" href="<?=PATH_PUBLIC;?>css/common.css">
		<script src="<?=PATH_PUBLIC;?>js/jquery-1.8.0.min.js"></script>
		<script src="<?=PATH_PUBLIC;?>js/modernizr-1.js"></script>
		<script src="<?=PATH_PUBLIC;?>js/jquery_easing.js" type="text/javascript"></script>
		<script src="<?=PATH_PUBLIC;?>js/jquery_toTop.js" type="text/javascript"></script>
		<script src="<?=PATH_PUBLIC;?>js/blog.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$().UItoTop({ easingType: 'easeOutQuart' });
			});
			var __A = "<?php echo base_url(); ?>";
		</script>
	</head>
	<body class="home blog">
		<div id="container">
			<header id="top">
				<p class="sitesign"><?=getSet('sitesign');?></p>
				<p>
					<a href="/" rel="home">
						<img src="<?=PATH_PUBLIC;?>img/logo.png" class="logo" alt="logo" height="69" width="299">
					</a>
				</p>
			</header>
			<nav>
				<div id="access" role="navigation">
					<div class="menu">
						<ul>
							<li <?php if($header == 'home') {echo 'class="current"';}?>><a href="/">Home</a></li>
							<li <?php if($header == 'record') {echo 'class="current"';}?>><a href="<?=site_url('record')?>">闲言碎语</a></li>
							<li <?php if($header == 'article') {echo 'class="current"';}?>><a href="<?=site_url('article')?>">学无止境</a></li>
							<li <?php if($header == 'cms') {echo 'class="current"';}?>><a href="<?=site_url('cms')?>">业内新闻</a></li>
							<li <?php if($header == 'contact') {echo 'class="current"';}?>><a href="<?=site_url('contact')?>">contact</a></li>
							<li <?php if($header == 'about') {echo 'class="current"';}?>><a href="<?=site_url('about')?>">关于我</a></li>
						</ul>
					</div>
				</div>
				<form id="navsearchform" role="search" method="get" action="<?=site_url("article")?>">
					<input placeholder="文章快速搜索" value="<?=sg($aFilter['q'])?>" name="q" id="navs" type="text">
					<input id="navsearchsubmit" value="" type="submit">
				</form>
			</nav>