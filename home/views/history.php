<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<meta name="keywords" content="王永东博客|时间轴" />
		<meta name="description" content="王永东博客|王永东博客，关注网站开发及互联网方向，Web开发，热衷PHP技术，记录生活和学习路上的点点滴滴。" />
		<title>王永东博客 | 记录在学习和工作中遇到的技术与问题，见证一名网站开发人员的成长与体会。</title>
		<link rel="stylesheet" href="<?=PATH_PUBLIC;?>css/history.css">
	</head>
	<body>
		<div class="head-warp">
			<div class="head">
		        <div class="nav-box">
					<ul><li class="cur"><a href="/">王永东博客</a> | 发展时间轴</li></ul>
		        </div>
			</div>
		</div>
		<div class="main">
			<div class="history">
				<div class="history-date">
					<ul>
					<?php 
						$i = 1;
						foreach($list as $key=>$value):
					?>
						<h2 id="<?=$value['year']?>" <?php if($i==1){echo 'class="first"';}else{echo 'class="date02"';} ?>><a href="#nogo"><?=$value['year']?>年</a></h2>
						<?php foreach($value['list'] as $k=>$v):?>
							<li id="<?=$value['year']?>">
								<h3><?=$v['md']?><span><?=$v['y']?></span></h3>
								<dl>
									<dt><?=$v['title']?>
										<span><?=$v['description']?></span>
									</dt>
								</dl>
							</li>
						<?php endforeach;?>
					<?php 
						$i++;
						endforeach;
					?>
					</ul>
				</div>
			</div>
		</div>
		<script src="<?=PATH_PUBLIC;?>js/jquery.js" type="text/javascript"></script>
		<script src="<?=PATH_PUBLIC;?>js/history.js" type="text/javascript"></script>
	</body>
</html>