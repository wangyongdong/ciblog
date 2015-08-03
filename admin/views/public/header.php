<!DOCTYPE html>
<html lang="chn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<!-- Title and other stuffs -->
		<title>Mac风格响应式后台管理模版演示 - 源码之家</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="">
		<!-- Stylesheets -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/bootstrap.css">
		<!-- Font awesome icon -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/font-awesome.css"> 
		<!-- jQuery UI -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/jquery-ui.css"> 
		<!-- Calendar -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/fullcalendar.css">
		<!-- prettyPhoto -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/prettyPhoto.css">  
		<!-- Star rating -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/rateit.css">
		<!-- Date picker -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/bootstrap-datetimepicker.min.css">
		<!-- CLEditor -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/jquery.cleditor.css"> 
		<!-- Bootstrap toggle -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/bootstrap-switch.css">
		<!-- Main stylesheet -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/style.css">
		<!-- Widgets stylesheet -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/widgets.css">   
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/blog.css">   
		<!-- HTML5 Support for IE -->
		<!--[if lt IE 9]>
		<script src="<?=ADMIN_PUBLIC?>js/html5shim.js"></script>
		<![endif]-->
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?=ADMIN_PUBLIC?><?=ADMIN_PUBLIC?>img/favicon/favicon.png">
	</head>
	<body>
	<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
	    <div class="conjtainer">
			<!-- Menu button for smallar screens -->
			<div class="navbar-header">
				<button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
					<span>菜单</span>
			  	</button>
			  	<!-- Site name for smallar screens -->
			  	<a href="index.html" class="navbar-brand hidden-lg">首页</a>
			</div>
	      	<!-- Navigation starts -->
	      	<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         
	        	<ul class="nav navbar-nav">
	          		<li class="dropdown">
	            		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	            			<span class="label label-success"><i class="icon-random"></i></span> 
							更新缓存
						</a>
					</li>
					<!-- Sync to server link -->
					<li class="dropdown">
	            		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	            			<span class="label label-danger"><i class="icon-refresh"></i></span> 同步数据库
						</a>
	          		</li>
	        	</ul>
		        <!-- Search form -->
		        <form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
				</form>
	        	<!-- Links -->
	        	<ul class="nav navbar-nav pull-right">
	          		<li class="dropdown pull-right">            
	            		<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<img alt="" src="<?=ADMIN_PUBLIC?>img/avatar_small.jpg">管理员 <b class="caret"></b>
	            		</a>
	            		<ul class="dropdown-menu">
			              	<li><a href="<?=site_url('member/profile')?>"><i class="icon-user"></i> 资料</a></li>
			              	<li><a href="#"><i class="icon-cogs"></i> 设置</a></li>
			              	<li><a href="login.html"><i class="icon-off"></i> 退出</a></li>
	            		</ul>
	          		</li>
	        	</ul>
	      	</nav>
		</div>
	</div>
	<!-- Header starts -->
	<header>
		<div class="container">
			<div class="row">
	        	<!-- Logo section -->
	        	<div class="col-md-4">
	          		<div class="logo">
						<h1><a href="#">Mac<span class="bold"></span></a></h1><p class="meta">后台管理系统</p>
	          		</div>
	        	</div>
				<!-- Logo ends -->
	        	<!-- News section -->
	        	<div class="col-md-4">
	          		<ul class="nav nav-pills">
	            		<li class="dropdown dropdown-big">
	              			<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-comments"></i> 评论 <span class="label label-info">6</span></a>
	                		<ul class="dropdown-menu">
	                  			<li>
				                    <h6><a href="#">你好 :)</a> <span class="label label-warning pull-right">10:42</span></h6><div class="clearfix"></div><hr />
	                  			</li>
	                  			<li>
				                    <h6><a href="#">你怎么样?</a> <span class="label label-warning pull-right">20:42</span></h6><div class="clearfix"></div><hr />
	                  			</li>
	                  			<li>
				                    <h6><a href="#">你在干撒呢?</a> <span class="label label-warning pull-right">14:42</span></h6><div class="clearfix"></div><hr />
	                  			</li>                  
	                  			<li><div class="drop-foot"><a href="#">查看所有</a></div></li>                                    
	                		</ul>
	            		</li>
	            		<!-- Message button with number of latest messages count-->
	            		<li class="dropdown dropdown-big">
	              			<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-envelope-alt"></i> 留言 <span class="label label-primary">6</span></a>
	                		<ul class="dropdown-menu">
		                  		<li>
				                    <h6><a href="#">你好啊?</a></h6><p>最近咋样啊...</p><hr />
		                  		</li>
		                  		<li>
				                    <h6><a href="#">今天很好啊?</a></h6><p>相当好...</p><hr />
		                  		</li>
		                  		<li><div class="drop-foot"><a href="#">查看所有</a></div></li>                                    
		                	</ul>
						</li>
	            		<!-- Members button with number of latest members count -->
	            		<li class="dropdown dropdown-big">
			              	<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-volume-up"></i> 提醒 <span class="label label-success">6</span></a>
	               			<ul class="dropdown-menu">
	                  			<li>
				                    <h6><a href="#">Ravi Kumar</a> <span class="label label-warning pull-right">免费</span></h6><div class="clearfix"></div><hr />
	                  			</li>
	                  			<li>
				                    <h6><a href="#">Balaji</a> <span class="label label-important pull-right">高级</span></h6><div class="clearfix"></div><hr />
	                  			</li>
	                  			<li>
				                    <h6><a href="#">Kumarasamy</a> <span class="label label-warning pull-right">免费</span></h6><div class="clearfix"></div><hr />
	                  			</li>                  
	                  			<li><div class="drop-foot"><a href="#">查看所有</a></div></li>                                    
	                		</ul>
	            		</li>
	          		</ul>
	        	</div>
				<!-- News section end -->
	        	<!-- Data section -->
	        	<div class="col-md-4">
	          		<div class="header-data">
	            		<div class="hdata">
	              			<div class="mcol-left"><i class="icon-signal bred"></i></div>
	              			<div class="mcol-right"><p><a href="#">7000</a> <em>访问</em></p></div>
	              			<div class="clearfix"></div>
	            		</div>
	            		<div class="hdata">
			              	<div class="mcol-left"><i class="icon-user bblue"></i></div>
			              	<div class="mcol-right"><p><a href="#">3000</a> <em>用户</em></p></div>
			              	<div class="clearfix"></div>
			            </div>
			            <div class="hdata">
			              	<div class="mcol-left"><i class="icon-file-alt bgreen"></i></div>
			              	<div class="mcol-right"><p><a href="#">5000</a><em>文章</em></p></div>
			              	<div class="clearfix"></div>
			            </div>
	          		</div>
	        	</div>
				<!-- Data section end -->
	      	</div>
		</div>
	</header>
	<!-- Header ends -->
	
	<!-- Main content starts -->
	<div class="content">
	  	<!-- Sidebar -->
	    <div class="sidebar">
	        <div class="sidebar-dropdown"><a href="#">导航</a></div>
	        <!--- Sidebar navigation -->
	        <ul id="nav">
	          	<li>
	          		<a href="/admin" class="open"><i class="icon-home"></i> 首页</a>
				</li>
	          	<li>
	          		<a href="<?=site_url('record')?>"><i class="icon-bullhorn"></i> 碎言碎语 </a>
	          	</li>
	          	<li class="has_sub">
	          		<a href="#"><i class="icon-file-alt"></i> 学无止境 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
		            <ul>
		              	<li><a href="article_new.html">发布文章</a></li>
		              	<li><a href="article_list.html">文章列表</a></li>
		              	<li><a href="<?=site_url('sort')?>">文章分类</a></li>
		            </ul>
	          	</li>
	          	<li class="has_sub">
	          		<a href="#"><i class="icon-comment"></i> 评论留言 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
		            <ul>
		              	<li><a href="<?=site_url('comment')?>">文章评论</a></li>
		              	<li><a href="<?=site_url('contact')?>">用户留言</a></li>
		            </ul>
	          	</li>
				<li>
	          		<a href="<?=site_url('links')?>"><i class="icon-link"></i> 友情链接 </a>
	          	</li>
				<li class="has_sub">
	          		<a href="#"><i class="icon-user"></i> 用户管理 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
		            <ul>
		              	<li><a href="<?=site_url('member/create')?>">添加用户</a></li>
		              	<li><a href="<?=site_url('member')?>">用户列表</a></li>
		            </ul>
	          	</li>
				<li class="has_sub">
	          		<a href="#"><i class="icon-cogs"></i> 控制中心 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
		            <ul>
		              	<li><a href="<?=site_url('site/web')?>">网站设置</a></li>
		              	<li><a href="<?=site_url('site/menu')?>">导航管理</a></li>
		              	<li><a href="<?=site_url('site/templet')?>">模板设置</a></li>
						<li><a href="<?=site_url('site/statistic')?>">信息统计</a></li>
						<li><a href="<?=site_url('site/backup')?>">数据备份</a></li>
						<li><a href="<?=site_url('site/error')?>">错误日志</a></li>
		              	<li><a href="<?=site_url('site/cache')?>">更新缓存</a></li>
		            </ul>
	          	</li>
	        </ul>
		</div>
	    <!-- Sidebar ends -->