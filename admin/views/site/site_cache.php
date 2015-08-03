﻿<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<!-- Title and other stuffs -->
		<title>Mac风格响应式后台管理模版演示 - 源码之家</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="">
		<!-- Stylesheets -->
		<link href="style/bootstrap.css" rel="stylesheet">
		<!-- Font awesome icon -->
		<link rel="stylesheet" href="style/font-awesome.css"> 
		<!-- jQuery UI -->
		<link rel="stylesheet" href="style/jquery-ui.css"> 
		<!-- Calendar -->
		<link rel="stylesheet" href="style/fullcalendar.css">
		<!-- prettyPhoto -->
		<link rel="stylesheet" href="style/prettyPhoto.css">  
		<!-- Star rating -->
		<link rel="stylesheet" href="style/rateit.css">
		<!-- Date picker -->
		<link rel="stylesheet" href="style/bootstrap-datetimepicker.min.css">
		<!-- CLEditor -->
		<link rel="stylesheet" href="style/jquery.cleditor.css"> 
		<!-- Uniform -->
		<link rel="stylesheet" href="style/uniform.default.css"> 
		<!-- Bootstrap toggle -->
		<link rel="stylesheet" href="style/bootstrap-switch.css">
		<!-- Main stylesheet -->
		<link href="style/style.css" rel="stylesheet">
		<!-- Widgets stylesheet -->
		<link href="style/widgets.css" rel="stylesheet">   
		<!-- HTML5 Support for IE -->
		<!--[if lt IE 9]>
		<script src="js/html5shim.js"></script>
		<![endif]-->
		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon/favicon.png">
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
	          		<!-- Upload to server link. Class "dropdown-big" creates big dropdown -->
	          		<li class="dropdown dropdown-big">
	            		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-success"><i class="icon-cloud-upload"></i></span> 上传到云服务器</a>
	            		<!-- Dropdown -->
	            		<ul class="dropdown-menu">
	              			<li>
	                			<!-- Progress bar -->
	                			<p>图片上传进度</p>
	                			<!-- Bootstrap progress bar -->
				                <div class="progress progress-striped active">
									<div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
										<span class="sr-only">完成40%</span>
									</div>
							    </div>
	                			<hr />
				                <!-- Progress bar -->
				                <p>视频上传进度</p>
				                <!-- Bootstrap progress bar -->
				                <div class="progress progress-striped active">
									<div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
										<span class="sr-only">完成80%</span>
									</div>
							    </div>
				                <hr />
				                <!-- Dropdown menu footer -->
				                <div class="drop-foot">
				                  <a href="#">查看所有</a>
				                </div>
							</li>
						</ul>
					</li>
					<!-- Sync to server link -->
					<li class="dropdown dropdown-big">
	            		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-danger"><i class="icon-refresh"></i></span> 同步到服务器</a>
	            		<!-- Dropdown -->
	            		<ul class="dropdown-menu">
	              			<li>
	                			<!-- Using "icon-spin" class to rotate icon. -->
	                			<p><span class="label label-info"><i class="icon-cloud"></i></span>同步会员到服务器</p>
	                			<hr />
	                			<p><span class="label label-warning"><i class="icon-cloud"></i></span>同步书签到云端</p>
								<hr />
				                <!-- Dropdown menu footer -->
				                <div class="drop-foot">
				                  <a href="#">查看所有</a>
				                </div>
	              			</li>
	            		</ul>
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
	              			<i class="icon-user"></i> 管理员 <b class="caret"></b>              
	            		</a>
	            		<!-- Dropdown menu -->
	            		<ul class="dropdown-menu">
			              	<li><a href="#"><i class="icon-user"></i> 资料</a></li>
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
	          		<!-- Logo. -->
	          		<div class="logo">
						<h1><a href="#">Mac<span class="bold"></span></a></h1>
	            		<p class="meta">后台管理系统</p>
	          		</div>
	          		<!-- Logo ends -->
	        	</div>
	        	<!-- Button section -->
	        	<div class="col-md-4">
					<!-- Buttons -->
	          		<ul class="nav nav-pills">
	            		<!-- Comment button with number of latest comments count -->
	            		<li class="dropdown dropdown-big">
	              			<a class="dropdown-toggle" href="#" data-toggle="dropdown">
	                			<i class="icon-comments"></i> 聊天 <span   class="label label-info">6</span> 
	              			</a>
	                		<ul class="dropdown-menu">
	                  			<li>
				                    <!-- Heading - h5 -->
				                    <h5><i class="icon-comments"></i> 聊天</h5>
				                    <!-- Use hr tag to add border -->
				                    <hr />
	                  			</li>
	                  			<li>
	                    			<!-- List item heading h6 -->
				                    <h6><a href="#">你好 :)</a> <span class="label label-warning pull-right">10:42</span></h6>
				                    <div class="clearfix"></div>
				                    <hr />
	                  			</li>
	                  			<li>
				                    <h6><a href="#">你怎么样?</a> <span class="label label-warning pull-right">20:42</span></h6>
				                    <div class="clearfix"></div>
				                    <hr />
	                  			</li>
	                  			<li>
				                    <h6><a href="#">你在干撒呢?</a> <span class="label label-warning pull-right">14:42</span></h6>
				                    <div class="clearfix"></div>
				                    <hr />
	                  			</li>                  
	                  			<li>
				                    <div class="drop-foot">
				                      <a href="#">查看所有</a>
				                    </div>
	                  			</li>                                    
	                		</ul>
	            		</li>
	            		<!-- Message button with number of latest messages count-->
	            		<li class="dropdown dropdown-big">
	              			<a class="dropdown-toggle" href="#" data-toggle="dropdown">
	                			<i class="icon-envelope-alt"></i> 收件箱 <span class="label label-primary">6</span> 
	              			</a>
	                		<ul class="dropdown-menu">
		                  		<li>
				                    <!-- Heading - h5 -->
				                    <h5><i class="icon-envelope-alt"></i> 消息</h5>
				                    <!-- Use hr tag to add border -->
				                    <hr />
		                  		</li>
		                  		<li>
				                    <!-- List item heading h6 -->
				                    <h6><a href="#">你好啊?</a></h6>
				                    <!-- List item para -->
				                    <p>最近咋样啊...</p>
				                    <hr />
		                  		</li>
		                  		<li>
				                    <h6><a href="#">今天很好啊?</a></h6>
				                    <p>相当好...</p>
				                    <hr />
		                  		</li>
		                  		<li>
				                    <div class="drop-foot">
				                      <a href="#">查看所有</a>
				                    </div>
		                  		</li>                                    
		                	</ul>
						</li>
	            		<!-- Members button with number of latest members count -->
	            		<li class="dropdown dropdown-big">
			              	<a class="dropdown-toggle" href="#" data-toggle="dropdown">
			                	<i class="icon-user"></i> 用户 <span   class="label label-success">6</span> 
			              	</a>
	               			<ul class="dropdown-menu">
	                  			<li>
				                    <!-- Heading - h5 -->
				                    <h5><i class="icon-user"></i> 用户</h5>
				                    <!-- Use hr tag to add border -->
				                    <hr />
	                  			</li>
	                  			<li>
				                    <!-- List item heading h6-->
				                    <h6><a href="#">Ravi Kumar</a> <span class="label label-warning pull-right">免费</span></h6>
				                    <div class="clearfix"></div>
				                    <hr />
	                  			</li>
	                  			<li>
				                    <h6><a href="#">Balaji</a> <span class="label label-important pull-right">高级</span></h6>
				                    <div class="clearfix"></div>
				                    <hr />
	                  			</li>
	                  			<li>
				                    <h6><a href="#">Kumarasamy</a> <span class="label label-warning pull-right">免费</span></h6>
				                    <div class="clearfix"></div>
				                    <hr />
	                  			</li>                  
	                  			<li>
				                    <div class="drop-foot">
				                      <a href="#">查看所有</a>
				                    </div>
	                  			</li>                                    
	                		</ul>
	            		</li>
	          		</ul>
	        	</div>
	        	<!-- Data section -->
	        	<div class="col-md-4">
	          		<div class="header-data">
	            		<!-- Traffic data -->
	            		<div class="hdata">
	              			<div class="mcol-left">
	                			<!-- Icon with red background -->
	                			<i class="icon-signal bred"></i> 
	              			</div>
	              			<div class="mcol-right">
				                <!-- Number of visitors -->
				                <p><a href="#">7000</a> <em>访问</em></p>
	              			</div>
	              			<div class="clearfix"></div>
	            		</div>
	            		<!-- Members data -->
	            		<div class="hdata">
			              	<div class="mcol-left">
			                	<!-- Icon with blue background -->
			                	<i class="icon-user bblue"></i> 
			              	</div>
			              	<div class="mcol-right">
			                	<!-- Number of visitors -->
			                	<p><a href="#">3000</a> <em>用户</em></p>
			              	</div>
			              	<div class="clearfix"></div>
			            </div>
			            <!-- revenue data -->
			            <div class="hdata">
			              	<div class="mcol-left">
			                	<!-- Icon with green background -->
			                	<i class="icon-money bgreen"></i> 
			              	</div>
			              	<div class="mcol-right">
			                	<!-- Number of visitors -->
			                	<p><a href="#">5000</a><em>订单</em></p>
			              	</div>
			              	<div class="clearfix"></div>
			            </div>
	          		</div>
	        	</div>
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
	        <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
	        <ul id="nav">
				<!-- Main menu with font awesome icon -->
	          	<li>
	          		<a href="index.html"><i class="icon-home"></i> 首页</a>
				</li>
	          	<li>
	          		<a href="record.html"><i class="icon-list-alt"></i> 碎言碎语 </a>
	          	</li>
				<li class="has_sub">
	          		<a href="#"><i class="icon-file-alt"></i> 学无止境 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
		            <ul>
		              	<li><a href="article_new.html">发布文章</a></li>
		              	<li><a href="article_list.html">文章列表</a></li>
		              	<li><a href="sort_list.html">文章分类</a></li>
		            </ul>
	          	</li>
	          	<li class="has_sub">
	          		<a href="#"><i class="icon-file-alt"></i> 评论留言 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
		            <ul>
		              	<li><a href="comment_list.html">文章评论</a></li>
		              	<li><a href="contact_list.html">用户留言</a></li>
		            </ul>
	          	</li>
	          	<li>
	          		<a href="links_list.html"><i class="icon-list-alt"></i> 友情链接 </a>
	          	</li>
				<li class="has_sub">
	          		<a href="#" class="open"><i class="icon-file-alt"></i> 用户管理 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
		            <ul>
		              	<li><a href="member_create.html">添加用户</a></li>
		              	<li><a href="member_list.html">用户列表</a></li>
		            </ul>
	          	</li>
		        <li class="has_sub">
	          		<a href="#"><i class="icon-file-alt"></i> 控制中心 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
		            <ul>
		              	<li><a href="site_web.html">网站设置</a></li>
		              	<li><a href="site_menu.html">导航管理</a></li>
		              	<li><a href="site_templet.html">模板设置</a></li>
						<li><a href="site_statistic.html">信息统计</a></li>
						<li><a href="site_backup.html">数据备份</a></li>
						<li><a href="site_error.html">错误日志</a></li>
		              	<li><a href="site_cache.html">更新缓存</a></li>
		            </ul>
	          	</li>
	        </ul>
		</div>
	    <!-- Sidebar ends -->
	
		<!-- Main bar -->
	  	<div class="mainbar">  
		    <!-- Page heading -->
		    <div class="page-head">
		      	<h2 class="pull-left"><i class="icon-home"></i> 添加用户</h2>
	        	<!-- Breadcrumb -->
	        	<div class="bread-crumb pull-right">
		          	<a href="index.html"><i class="icon-home"></i> 首页</a> 
		          	<!-- Divider -->
		          	<span class="divider">/</span> 
		          	<a href="#" class="bread-current">控制台</a>
	        	</div>
	        	<div class="clearfix"></div>
		    </div>
		    <!-- Page heading ends -->

		    <!-- Matter -->
		    <div class="matter">
	        	<div class="container">
	          		<div class="col-md-7">
              			<div class="widget">
			                <div class="widget-head">
			                  	<div class="pull-left">添加用户</div>
			                  	<div class="widget-icons pull-right">
			                    	<a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
			                    	<a href="#" class="wclose"><i class="icon-remove"></i></a>
			                  	</div>
			                  	<div class="clearfix"></div>
			                </div>
                			<div class="widget-content">
                  				<div class="padd">
                      				<div class="form quick-post">
                                      	<!-- Edit profile form (not working)-->
                                      	<form class="form-horizontal">
                                          	<!-- Title -->
                                          	<div class="form-group">
                                            	<label class="control-label col-lg-3" for="title">用户名</label>
                                            	<div class="col-lg-9"> 
                                              		<input type="text" class="form-control" id="name">
                                            	</div>
                                          	</div>
											<div class="form-group">
												<label class="col-lg-4 control-label">密码</label>
												<div class="col-lg-8">
													<input class="form-control" type="password" placeholder="Password Box">
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-4 control-label">确认密码</label>
												<div class="col-lg-8">
													<input class="form-control" type="password" placeholder="Password Box">
												</div>
											</div>
											<div class="form-group">
                                            	<label class="control-label col-lg-3" for="title">邮箱</label>
                                            	<div class="col-lg-9"> 
                                              		<input type="text" class="form-control" id="alias">
                                            	</div>
                                          	</div>
											<div class="form-group">
												<label class="col-lg-4 control-label">用户身份</label>
												<div class="col-lg-8">
													<select class="form-control">
														<option>管理员</option>
														<option>作者</option>
														<option>游客</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-4 control-label">状态</label>
												<div class="col-lg-8">
													<label>
														<input id="optionsRadios1" type="radio" checked="" value="option1" name="optionsRadios">
														<span class="label label-success">正常</span>
													</label>
													<label>
														<input id="optionsRadios2" type="radio" value="option2" name="optionsRadios">
														<span class="label label-danger">禁止</span>
													</label>
												</div>
											</div>
                                          	<!-- Buttons -->
                                          	<div class="form-group">
                                             	<!-- Buttons -->
											 	<div class="col-lg-offset-2 col-lg-9">
											 		<button type="submit" class="btn btn-success">添加</button>
													<button type="reset" class="btn btn-default">取消</button>
											 	</div>
                                          	</div>
                                      	</form>
                                    </div>
                  				</div>
								<div class="widget-foot">
				                    <!-- Footer goes here -->
				                </div>
                			</div>
              			</div> 
            		</div>
				</div>
			</div>
			<!-- Matter ends -->
		</div>
	   	<!-- Mainbar ends -->
	   	<div class="clearfix"></div>
	</div>
	<!-- Content ends -->
	
	<!-- Footer starts -->
	<footer>
	  	<div class="container">
		    <div class="row">
		      	<div class="col-md-12">
		            <!-- Copyright info -->
		            <p class="copy">Copyright &copy; 2012 | <a href="#">Your Site</a> </p>
		      	</div>
		    </div>
	  	</div>
	</footer> 
	<!-- Footer ends -->
	
	<!-- Scroll to top -->
	<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 
	
	<!-- JS -->
	<script src="js/jquery.js"></script> <!-- jQuery -->
	<script src="js/bootstrap.js"></script> <!-- Bootstrap -->
	<script src="js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
	<script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
	<script src="js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
	<script src="js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->
	
	<!-- jQuery Flot -->
	<script src="js/excanvas.min.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.resize.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	
	<!-- jQuery Notification - Noty -->
	<script src="js/jquery.noty.js"></script> <!-- jQuery Notify -->
	<script src="js/themes/default.js"></script> <!-- jQuery Notify -->
	<script src="js/layouts/bottom.js"></script> <!-- jQuery Notify -->
	<script src="js/layouts/topRight.js"></script> <!-- jQuery Notify -->
	<script src="js/layouts/top.js"></script> <!-- jQuery Notify -->
	<!-- jQuery Notification ends -->
	
	<script src="js/sparklines.js"></script> <!-- Sparklines -->
	<script src="js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
	<script src="js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
	<script src="js/jquery.uniform.min.js"></script> <!-- jQuery Uniform -->
	<script src="js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
	<script src="js/filter.js"></script> <!-- Filter for support page -->
	<script src="js/custom.js"></script> <!-- Custom codes -->
	<script src="js/charts.js"></script> <!-- Charts & Graphs -->
	
	<!-- Script for this page -->
	<script type="text/javascript">
	$(function () {
	    /* Bar Chart starts */
	    var d1 = [];
	    for (var i = 0; i <= 20; i += 1) {
			d1.push([i, parseInt(Math.random() * 30)]);
		}
	    var d2 = [];
	    for (var i = 0; i <= 20; i += 1) {
			d2.push([i, parseInt(Math.random() * 30)]);
		}
	    var stack = 0, bars = true, lines = false, steps = false;
	    function plotWithOptions() {
	        $.plot($("#bar-chart"), [ d1, d2 ], {
	            series: {
	                stack: stack,
	                lines: { show: lines, fill: true, steps: steps },
	                bars: { show: bars, barWidth: 0.8 }
	            },
	            grid: {
	                borderWidth: 0, hoverable: true, color: "#777"
	            },
	            colors: ["#ff6c24", "#ff2424"],
	            bars: {
	                  show: true,
	                  lineWidth: 0,
	                  fill: true,
	                  fillColor: { colors: [ { opacity: 0.9 }, { opacity: 0.8 } ] }
	            }
	        });
	    }
	    plotWithOptions();
	    $(".stackControls input").click(function (e) {
	        e.preventDefault();
	        stack = $(this).val() == "With stacking" ? true : null;
	        plotWithOptions();
	    });
	    $(".graphControls input").click(function (e) {
	        e.preventDefault();
	        bars = $(this).val().indexOf("Bars") != -1;
	        lines = $(this).val().indexOf("Lines") != -1;
	        steps = $(this).val().indexOf("steps") != -1;
	        plotWithOptions();
	    });
	    /* Bar chart ends */
	});
	/* Curve chart starts */
	$(function () {
	    var sin = [], cos = [];
	    for (var i = 0; i < 14; i += 0.5) {
	        sin.push([i, Math.sin(i)]);
	        cos.push([i, Math.cos(i)]);
	    }
	    var plot = $.plot($("#curve-chart"),
	           [ { data: sin, label: "sin(x)"}, { data: cos, label: "cos(x)" } ], {
	               series: {
	                   lines: { show: true, fill: true},
	                   points: { show: true }
	               },
	               grid: { hoverable: true, clickable: true, borderWidth:0 },
	               yaxis: { min: -1.2, max: 1.2 },
	               colors: ["#1eafed", "#1eafed"]
	             });
	    function showTooltip(x, y, contents) {
	        $('<div id="tooltip">' + contents + '</div>').css( {
	            position: 'absolute',
	            display: 'none',
	            top: y + 5,
	            left: x + 5,
	            border: '1px solid #000',
	            padding: '2px 8px',
	            color: '#ccc',
	            'background-color': '#000',
	            opacity: 0.9
	        }).appendTo("body").fadeIn(200);
	    }
	    var previousPoint = null;
	    $("#curve-chart").bind("plothover", function (event, pos, item) {
	        $("#x").text(pos.x.toFixed(2));
	        $("#y").text(pos.y.toFixed(2));
	        if ($("#enableTooltip:checked").length > 0) {
	            if (item) {
	                if (previousPoint != item.dataIndex) {
	                    previousPoint = item.dataIndex;
	                    
	                    $("#tooltip").remove();
	                    var x = item.datapoint[0].toFixed(2),
	                        y = item.datapoint[1].toFixed(2);
	                    
	                    showTooltip(item.pageX, item.pageY, 
	                                item.series.label + " of " + x + " = " + y);
	                }
	            }
	            else {
	                $("#tooltip").remove();
	                previousPoint = null;            
	            }
	        }
	    }); 
	
	    $("#curve-chart").bind("plotclick", function (event, pos, item) {
	        if (item) {
	            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
	            plot.highlight(item.series, item.datapoint);
	        }
	    });
	
	});
	
	/* Curve chart ends */
	</script>
	
	</body>
</html>