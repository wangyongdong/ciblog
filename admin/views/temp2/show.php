﻿<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>SCT</title>
	<link type="text/css" href="<?=ADMIN_PUBLIC;?>css/main_css.css" rel="stylesheet"/>
	<link type="text/css" href="<?=ADMIN_PUBLIC;?>css/zTreeStyle.css" rel="stylesheet">
	<script type="text/javascript" src="<?=ADMIN_PUBLIC;?>scripts/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?=ADMIN_PUBLIC;?>scripts/zTree/jquery.ztree.core-3.2.js"></script>
	<script type="text/javascript" src="<?=ADMIN_PUBLIC;?>scripts/commonAll.js"></script>
	<script type="text/javascript">
		var __A = "<?php echo base_url(); ?>";	//定义_A的目的是在js文件中使用
	</script>
	<script type="text/javascript">
		/**退出系统**/
		function logout(){
			if(confirm("您确定要退出本系统吗？")) {
				window.location.href = __A+'login/loginOut';
			}
		}
		/**获得当前日期**/
		function  getDate01(){
			var time = new Date();
			var myYear = time.getFullYear();
			var myMonth = time.getMonth()+1;
			var myDay = time.getDate();
			
			var myHours = time.getHours();
			var myMin = time.getMinutes();
			
			if(myMonth < 10){
				myMonth = "0" + myMonth;
			}
			document.getElementById("yue_fen").innerHTML =  myYear + "." + myMonth;
			document.getElementById("day_day").innerHTML =  myHours + ":" + myMin;
		}
	</script>
	<script type="text/javascript">
		/* zTree插件加载目录的处理  */
		var zTree;
		var setting = {
				view: {
					dblClickExpand: false,
					showLine: false,
					expandSpeed: ($.browser.msie && parseInt($.browser.version)<=6)?"":"fast"
				},
				data: {
					key: {
						name: "resourceName"
					},
					simpleData: {
						enable:true,
						idKey: "resourceID",
						pIdKey: "parentID",
						rootPId: ""
					}
				},
				callback: {
					onClick: zTreeOnClick			
				}
		};
		var curExpandNode = null;
		function beforeExpand(treeId, treeNode) {
			var pNode = curExpandNode ? curExpandNode.getParentNode():null;
			var treeNodeP = treeNode.parentTId ? treeNode.getParentNode():null;
			for(var i=0, l=!treeNodeP ? 0:treeNodeP.children.length; i<l; i++ ) {
				if (treeNode !== treeNodeP.children[i]) {
					zTree.expandNode(treeNodeP.children[i], false);
				}
			}
			while (pNode) {
				if (pNode === treeNode) {
					break;
				}
				pNode = pNode.getParentNode();
			}
			if (!pNode) {
				singlePath(treeNode);
			}
		}
		function singlePath(newNode) {
			if (newNode === curExpandNode) return;
			if (curExpandNode && curExpandNode.open==true) {
				if (newNode.parentTId === curExpandNode.parentTId) {
					zTree.expandNode(curExpandNode, false);
				} else {
					var newParents = [];
					while (newNode) {
						newNode = newNode.getParentNode();
						if (newNode === curExpandNode) {
							newParents = null;
							break;
						} else if (newNode) {
							newParents.push(newNode);
						}
					}
					if (newParents!=null) {
						var oldNode = curExpandNode;
						var oldParents = [];
						while (oldNode) {
							oldNode = oldNode.getParentNode();
							if (oldNode) {
								oldParents.push(oldNode);
							}
						}
						if (newParents.length>0) {
							for (var i = Math.min(newParents.length, oldParents.length)-1; i>=0; i--) {
								if (newParents[i] !== oldParents[i]) {
									zTree.expandNode(oldParents[i], false);
									break;
								}
							}
						}else {
							zTree.expandNode(oldParents[oldParents.length-1], false);
						}
					}
				}
			}
			curExpandNode = newNode;
		}
	
		function onExpand(event, treeId, treeNode) {
			curExpandNode = treeNode;
		}
		
		/** 用于捕获节点被点击的事件回调函数  **/
		function zTreeOnClick(event, treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("dleft_tab1");
			zTree.expandNode(treeNode, null, null, null, true);
			// 规定：如果是父类节点，不允许单击操作
			if(treeNode.isParent){
				return false;
			}
			// 如果节点路径为空或者为"#"，不允许单击操作
			if(treeNode.accessPath=="" || treeNode.accessPath=="#"){
				return false;
			}
		    // 跳到该节点下对应的路径, 把当前资源ID(resourceID)传到后台，写进Session
		    rightMain(treeNode.accessPath);
		    
		    if( treeNode.isParent ){
			    $('#here_area').html('当前位置：'+treeNode.getParentNode().resourceName+'&nbsp;>&nbsp;<span style="color:#1A5CC6">'+treeNode.resourceName+'</span>');
		    }else{
			    $('#here_area').html('当前位置：系统&nbsp;>&nbsp;<span style="color:#1A5CC6">'+treeNode.resourceName+'</span>');
		    }
		};
		
		/* 上方菜单 */
		function switchTab(tabpage,tabid) {
			var oItem = document.getElementById(tabpage).getElementsByTagName("li"); 
		    for(var i=0; i<oItem.length; i++){
		        var x = oItem[i];    
		        x.className = "";
			}
			if('left_tab1' == tabid) {
				$(document).ajaxStart(onStart).ajaxSuccess(onStop);
				// 异步加载"业务模块"下的菜单
			  	loadMenu('YEWUMOKUAI', 'dleft_tab1');
			}else  if('left_tab2' == tabid) {
				$(document).ajaxStart(onStart).ajaxSuccess(onStop);
				// 异步加载"系统管理"下的菜单
				loadMenu('XITONGMOKUAI', 'dleft_tab1');
			}else  if('left_tab3' == tabid) {
				$(document).ajaxStart(onStart).ajaxSuccess(onStop);
				// 异步加载"其他"下的菜单
				loadMenu('QITAMOKUAI', 'dleft_tab1');
			} 
		}
		
		$(document).ready(function() {
			$(document).ajaxStart(onStart).ajaxSuccess(onStop);
			/** 默认异步加载"业务模块"目录  **/
			loadMenu('YEWUMOKUAI', "dleft_tab1");
			// 默认展开所有节点
			if( zTree ){
				// 默认展开所有节点
				zTree.expandAll(true);
			}
		});
		
		function loadMenu(resourceType, treeObj) {
			<?php echo $data;?>
			// 如果返回数据不为空，加载"业务模块"目录
            if(data != null) {
                // 将返回的数据赋给zTree
                $.fn.zTree.init($("#"+treeObj), setting, data);
                zTree = $.fn.zTree.getZTreeObj(treeObj);
                if( zTree ) {
                    // 默认展开所有节点
                    zTree.expandAll(true);
                }
            }
		}
		
		//ajax start function
		function onStart() {
			$("#ajaxDialog").show();
		}
		
		//ajax stop function
		function onStop() {
			$("#ajaxDialog").hide();
		}
	</script>
</head>
<body onload="getDate01()">
	<!-- top menu start -->
    <div id="top">
		<div id="top_logo">
			<a href="<?=site_url()?>"><img alt="logo" src="<?=ADMIN_PUBLIC;?>images/common/logo.jpg" width="274" height="49" style="vertical-align:middle;"></a>
		</div>
		<div id="top_links">
			<div id="top_op">
				<ul>
					<li>
						<img alt="当前用户" src="<?=ADMIN_PUBLIC;?>images/common/user.jpg">：
						<span><?php echo $_SESSION['username'];?></span>
					</li>
					<li>
						<img alt="当前日期" src="<?=ADMIN_PUBLIC;?>images/common/month.jpg">：
						<span id="yue_fen"></span>
					</li>
					<li>
						<img alt="当前时间" src="<?=ADMIN_PUBLIC;?>images/common/date.jpg">：
						<span id="day_day"></span>
					</li>
					<li>
						<img alt="系统消息" src="<?=ADMIN_PUBLIC;?>images/common/message.png">：
						<?php
						if(empty($notices)) {
						?>
						<span id="day_day">系统消息</span>
						<?php
						} else {
						?>
						<span id="day_day">系统消息(<span class="nitc_tit"><?=$notices;?></span>)</span>
						<?php
						}
						?>
					</li>
				</ul> 
			</div>
			<div id="top_close">
				<a href="javascript:void(0);" onclick="logout();" target="_parent">
					<img alt="退出系统" title="退出系统" src="<?=ADMIN_PUBLIC;?>images/common/close.jpg" style="position: relative; top: 10px; left: 25px;">
				</a>
			</div>
		</div>
	</div>
	<!-- top menu end -->
    <!-- side menu start -->
	<div id="side">
		<div id="left_menu">
		 	<ul id="TabPage2" style="height:200px; margin-top:50px;">
				<li id="left_tab1" class="selected" onClick="javascript:switchTab('TabPage2','left_tab1');" title="业务模块">
					<img alt="业务模块" title="业务模块" src="<?=ADMIN_PUBLIC;?>images/common/1_hover.jpg" width="33" height="31">
				</li>
				<li id="left_tab2" onClick="javascript:switchTab('TabPage2','left_tab2');" title="系统管理">
					<img alt="系统管理" title="系统管理" src="<?=ADMIN_PUBLIC;?>images/common/2.jpg" width="33" height="31">
				</li>		
				<li id="left_tab3" onClick="javascript:switchTab('TabPage2','left_tab3');" title="其他">
					<img alt="其他" title="其他" src="<?=ADMIN_PUBLIC;?>images/common/3.jpg" width="33" height="31">
				</li>
			</ul>
			<div id="nav_show" style="position:absolute; bottom:0px; padding:10px;">
				<a href="javascript:;" id="show_hide_btn">
					<img alt="显示/隐藏" title="显示/隐藏" src="<?=ADMIN_PUBLIC;?>images/common/nav_hide.png" width="35" height="35">
				</a>
			</div>
		 </div>
		 <div id="left_menu_cnt">
		 	<div id="nav_module">
		 		<img src="<?=ADMIN_PUBLIC;?>images/common/module_1.png" width="210" height="58"/>
		 	</div>
		 	<div id="nav_resource">
		 		<ul id="dleft_tab1" class="ztree"></ul>
		 	</div>
		 </div>
	</div>
	<!-- side menu end -->
	<script type="text/javascript">
		$(function(){
			$('#TabPage2 li').click(function(){
				var index = $(this).index();
				$(this).find('img').attr('src', '<?=ADMIN_PUBLIC;?>images/common/'+ (index+1) +'_hover.jpg');
				$(this).css({background:'#fff'});
				$('#nav_module').find('img').attr('src', '<?=ADMIN_PUBLIC;?>images/common/module_'+ (index+1) +'.png');
				$('#TabPage2 li').each(function(i, ele){
					if( i!=index ){
						$(ele).find('img').attr('src', '<?=ADMIN_PUBLIC;?>images/common/'+ (i+1) +'.jpg');
						$(ele).css({background:'#044599'});
					}
				});
				// 显示侧边栏
				switchSysBar(true);
			});
			
			// 显示隐藏侧边栏
			$("#show_hide_btn").click(function() {
		        switchSysBar();
		    });
		});
		
		/**隐藏或者显示侧边栏**/
		function switchSysBar(flag){
			var side = $('#side');
	        var left_menu_cnt = $('#left_menu_cnt');
			if( flag==true ){	// flag==true
				left_menu_cnt.show(500, 'linear');
				side.css({width:'280px'});
				$('#top_nav').css({width:'77%', left:'304px'});
	        	$('#main').css({left:'280px'});
			}else{
		        if ( left_menu_cnt.is(":visible") ) {
					left_menu_cnt.hide(10, 'linear');
					side.css({width:'60px'});
		        	$('#top_nav').css({width:'100%', left:'60px', 'padding-left':'28px'});
		        	$('#main').css({left:'60px'});
		        	$("#show_hide_btn").find('img').attr('src', '<?=ADMIN_PUBLIC;?>images/common/nav_show.png');
		        } else {
					left_menu_cnt.show(500, 'linear');
					side.css({width:'280px'});
					$('#top_nav').css({width:'77%', left:'304px', 'padding-left':'0px'});
		        	$('#main').css({left:'280px'});
		        	$("#show_hide_btn").find('img').attr('src', '<?=ADMIN_PUBLIC;?>images/common/nav_hide.png');
		        }
			}
		}
	</script>
    <!-- side menu start -->
    <div id="top_nav">
	 	<span id="here_area">当前位置：系统&nbsp;>&nbsp;系统介绍</span>
	</div>
	<!-- 加载首页主页面  start-->
    <div id="main">
      	<iframe name="right" id="rightMain" src="show/main" frameborder="no" scrolling="auto" width="100%" height="100%" allowtransparency="true"/>
    </div>
	<!-- end -->
	
	<!-- 未知 -->
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
