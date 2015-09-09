<script type="text/javascript" src="<?=PLUGIN_UEDITOR?>third-party/SyntaxHighlighter/shCore.js"></script>
<script type="text/javascript" src="<?=PLUGIN_UEDITOR?>third-party/SyntaxHighlighter/shCoreDefault.css"></script>
<script>
	SyntaxHighlighter.all();
</script>
<script type="text/javascript" src="<?=PLUGIN_QQFACE?>jquery.qqFace.js"></script>
<script>
function getReply(id,val) {
	if($("#uyan_cmt_"+id+" .rep_box").html()) {
		$("#uyan_cmt_"+id+" .rep_box").html("");
	} else {
		$("#uyan_cmt_"+id+" #r_id").val(id);
		var com_box = $(".com-box").html();
		com_box = com_box.replace('class="ds-replybox"','class="ds-replybox dis sm-box"');
		com_box = com_box.replace('name="r_id" id="r_id" value=""','name="r_id" id="r_id" value="'+id+'"');
		//qqface
		com_box = com_box.replace('box:""','box:"'+id+'"');
		com_box = com_box.replace('id="comment"','id="comment'+id+'"');
		//warn
		com_box = com_box.replace('onclick="formPost();"',"onclick=formPost('dis');");
		$("#uyan_cmt_"+id+" .rep_box").append(com_box);
	}
}
function formPost(val) {
	if(val){
		val = '.'+val+' ';
	} else {
		val = '';
	}
	var name = $(''+val+'#form_contact .name').val();
	var email = $(''+val+'#form_contact .email').val();
	var comment = $(''+val+'.comment').val();
	if($.trim(name).length < 2 || $.trim(name).length > 16) {
		$(''+val+'#form_contact .name').addClass('b_red');
		$(''+val+'#form_contact .input_warn').text('* 用户名为2-16个字符');
		return false;
	} else if(email == '') {
		$(''+val+'#form_contact .email').addClass('b_red');
		$(''+val+'#form_contact .input_warn').text('* 填写邮箱地址');
		return false;
	} else if (!email.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {
		$(''+val+'#form_contact .email').addClass('b_red');
		$(''+val+'#form_contact .input_warn').text('* 邮箱格式不正确！');
		return false;
	} else if($.trim(comment).length < 2 || $.trim(comment).length > 500) {
		$(''+val+'#form_contact .ds-textarea-wrapper').addClass('b_red');
		$(''+val+'#form_contact .input_warn').text('* 内容控制在2-500字');
		return false;
	} else {
		$(''+val+'#form_contact').submit();
	}
}
// load more
function loadMore() {
	$("#uyan_more_cmt span").text("加载评论中");
	var start = $("#start").val();
	var limit = $("#limit").val();
	var id = $("#id").val();
	$.post(
		__A+'article/getComment',
		{id:id,start:start,limit:limit,type:'ajax'},
		function(data) {
			if(!data.comment) {
				setTimeout(function(){$("#uyan_more_cmt").slideUp("slow")},1000);
			}
			$("#comment_list").append(data.comment);
			startq = Number(start) + Number(limit);
			$("#start").val(startq);
			$("#uyan_more_cmt span").text('查看更多评论');
			if(data.num<5) {
				$("#uyan_more_cmt span").text('查看更多评论');
				setTimeout(function(){$("#uyan_more_cmt").slideUp("slow")},1000);
			}
		},
		'json'
	);
}
</script>
<div class="t_title">
	<h1 class="t_nav"><span><?=getPageDesc('article');?></span></h1>
</div>
<div id="main" role="main" class="clearfix">
	<div id="left">
		<article>
			<div class="post">
				<header>
					<h3 class="posttitle"><?=$article['title']?></h3>
				</header>
				<div class="postauths">
					<p class="meta-pos al-views">
						<span class="meta-info author al-views">
							Author: <a class="al-views"><?=getUserInfo($article['uid'],'username')?></a>
						</span>
						<span class="meta-info comments al-views">
							Comments: <a class="al-views"><?=$article['comnum']?></a>
						</span>
						<span class="meta-info category al-views">
							Views: <a class="al-views"><?=$article['views']?></a>
						</span>
					</p>
				</div>
				<div class="postcontent">
					<?=$article['content']?>
				</div>
				<div class="postdetails posttime">
					<p class="postcomments"><time class="entry-date" datetime="" pubdate=""><?=dateFor($article['datetime'])?></time></p>
				</div>
				<div class="vc-copyright">
					本站文章除注明转载外，均为原创文章。
					转载请注明：文章转载自： <a href="http://www.wangyongdong.com">王永东个人博客</a>
				</div>
				<div class="keyfl">
					<p><span>文章分类</span>：<?=getSortField($article['sortid'],'name');?></p>
				</div>
				<div class="keybq">
					<p><span>关键词</span>：<?=$article['keyword'];?></p>
				</div>
				<!-- JiaThis Button BEGIN -->
				<div class="fenxiang">
					<span class="tit_jia">文章分享到：</span>
					<div class="jiathis_style_24x24">
						<a class="jiathis_button_qzone"></a>
						<a class="jiathis_button_tsina"></a>
						<a class="jiathis_button_tqq"></a>
						<a class="jiathis_button_weixin"></a>
						<a class="jiathis_button_renren"></a>
						<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
						<a class="jiathis_counter_style"></a>
					</div>
				</div>
				<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
				<script>
					var contents = $(".posttitle").text();
					var jiathis_config = {
						title:'我找到了一篇好的文章，“'+contents+'”，来自：王永东个人博客 ，博客地址:<?=HOST?>。'
					}
				</script>
				<!-- JiaThis Button END -->
			</div>
			<div class="clear"></div>
			<div class="nextinfo">
				<?php 
				if(!empty($article_near['last'])) {
				?>
				<p> 上一篇：<a href="<?=site_url('article/view/'.$article_near['last']['id'])?>"><?=$article_near['last']['title']?></a></p>
				<?php 
				}
				if(!empty($article_near['next'])) {
				?>
				<p> 下一篇：<a href="<?=site_url('article/view/'.$article_near['next']['id'])?>"><?=$article_near['next']['title']?></a></p>
				<?php } ?>
			</div>
			<div class="otherlink">
				<h2>相关文章</h2>
				<ul>
					<?php foreach($article_related as $list):?>
					<li>
						<a title="<?=$list['title']?>" href="<?=site_url('article/view/'.$list['id'])?>"><?=cutTab($list['title'],18)?></a>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
			<div id="comment_list" class="re_reply">
				<div class="reply_r">
					<h3>用户评论</h3>
					<div class="com_tit">
						<div class="min-comments">
							<p class="i-like">已有 <?=$article['comnum']?> 人发表感言！</p>
						</div>
					</div>
					<?php 
					if(getSet('is_comment') == 'y') {
					?>
					<div class="com-box">
						<div class="ds-replybox">
							<script>
								//qqface
								$(function() {
									$('.emotion').qqFace({
										id : 'facebox', 	//表情盒子的ID
										assign:'comment', 	//给那个控件赋值
										box:"",
										path:'../../public/plugin/qqface/face/'		//表情存放的路径
									});
								});
								//消除警告
								$(function() {
									$('input[name=name]').focus(function() {
										$('.name').removeClass('b_red');
										$('.input_warn').text('');
									});
									$('input[name=email]').focus(function() {
										$('.email').removeClass('b_red');
										$('.input_warn').text('');
									});
									$('textarea').focus(function() {
										$('.ds-textarea-wrapper').removeClass('b_red');	
										$('.input_warn').text('');
									});
								})
							</script>
							<a class="ds-avatar" onclick="return false" href="javascript:void(0);">
								<img src="<?=PATH_PUBLIC?>img/duface.png" >
							</a>
							<form id="form_contact" method="post" action="<?=site_url('comment/doComment')?>">
								<input type="hidden" name="c_id" id="c_id" value="<?=$article['id']?>">
								<input type="hidden" name="r_id" id="r_id" value="">
								<input type="hidden" name="token" value="<?=$token?>">
								<div class="ds-textarea-wrapper ds-rounded-top">
									<textarea placeholder="说点什么吧…" name="comment" id="comment" class="comment"></textarea>
									<pre class="ds-hidden-text"></pre>
								</div>
								<div class="ds-post-toolbar">
									<div class="ds-post-options ds-gradient-bg">
										<span class="ds-sync"></span>
										<div class="ds-toolbar-buttons">
											<div class="face_ico"><span class="emotion"></span></div>
										</div>
									</div>
									<div class="ds-post-basic">
										<span>名字：</span><input type="text" name="name" class="name" required placeholder="Your Name" />
										<span>邮箱：</span><input type="email" name="email" class="email" required  placeholder="Your Email" />
									</div>
									<div class="ds-post-basic ds-bottom">
										<span>链接：</span><input type="text" name="url" class="url" placeholder="http://" />
										<span class="input_warn"></span>
										<button class="ds-post-button" type="button" onclick="formPost();">发布</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php 
					}
					?>
				</div>
				<?php 
				if(!empty($comment)) {
					$i = 1;
					foreach($comment as $comment):
				?>
				<div id="uyan_cmt_<?=$comment['id']?>" class="uyan_cmt_com">
					<div class="uyan_cmt_avatar">
						<a class="uyan_avatar_ab" <?php if(!empty($comment['url'])){echo 'href="'.$comment['url'].'"';}?> target="_blank">
							<?php 
							if(empty($comment['userid'])) {
							?>
							<img src="<?=PATH_PUBLIC?>img/duface.png" >
							<?php 
							} else {
							?>
							<img src="<?=LinkAvatar($comment['userid'])?>">
							<?php 
							}
							?>
						</a>
						<span><a class="uyan_avatar_an" <?php if(!empty($comment['url'])){echo 'href="'.$comment['url'].'"';}?> target="_blank"></a></span>
					</div>
					<div class="uyan_cmt_con">
						<div class="uyan_con_tit">
							<span class="uyan_con_uname">
								<a id="uyan_cmt_uname" <?php if(!empty($comment['url'])){echo 'href="'.$comment['url'].'"';}?> target="_blank"><?=$comment['author']?></a>
							</span>
							<span class="uyan_con_ufromname"><?php echo $comment['userid'] ? '(会员)' : '(游客)';?></span>
						</div>
						<div class="uyan_cmt_txt" ><?=stripcslashes($comment['content'])?></div>
						<div class="uyan_cmt_exp" >
							<a class="uyan_exp_re" id="uyan_exp_rpy" onclick="getReply(<?=$comment['id']?>,'<?=$comment['author']?>');">回复</a>
							<div class="uyan_exp_date"><?=$comment['datetime']?></div>
							<div style="clear: both;"></div>
						</div>
					</div>
					<div style="clear: both;"></div>
					<div class="rep_box"></div>
				</div>
				<?php 
				if(!empty($comment['children'])) {
					foreach ($comment['children'] as $k=>$v) {
				?>
				<div id="uyan_cmt_<?=$v['id']?>" class="uyan_cmt_com uyan_cmt_reply_60" >
					<div class="uyan_cmt_avatar">
						<a class="uyan_avatar_ab" <?php if(!empty($v['url'])){echo 'href="'.$v['url'].'"';}?> target="_blank">
							<?php 
							if(empty($v['userid'])) {
							?>
							<img src="<?=PATH_PUBLIC?>img/duface.png" >
							<?php 
							} else {
							?>
							<img src="<?=LinkAvatar($v['userid'])?>">
							<?php 
							}
							?>
						</a>
						<span><a class="uyan_avatar_an" <?php if(!empty($v['url'])){echo 'href="'.$v['url'].'"';}?> target="_blank"></a></span>
					</div>
					<div class="uyan_cmt_con">
						<div class="uyan_con_tit">
							<span class="uyan_con_uname">
								<a id="uyan_cmt_uname" <?php if(!empty($v['url'])){echo 'href="'.$v['url'].'"';}?> target="_blank"><?=$v['author']?></a>
							</span>
							<span class="uyan_con_ufromname"><?php echo $v['userid'] ? '(会员)' : '(游客)';?></span>
						</div>
						<div class="uyan_cmt_txt" ><?=stripcslashes($v['content'])?></div>
						<div class="uyan_cmt_exp" >
							<a class="uyan_exp_re" id="uyan_exp_rpy" onclick="getReply(<?=$v['id']?>,'<?=$v['author']?>');">回复</a>
							<div class="uyan_exp_date"><?=$v['datetime']?></div>
							<div style="clear: both;"></div>
						</div>
					</div>
					<div style="clear: both;"></div>
					<div class="rep_box"></div>
				</div>
				<?php 
				if(!empty($v['children'])) {
					foreach ($v['children'] as $key=>$value) {
				?>
				<div id="uyan_cmt_<?=$value['id']?>" class="uyan_cmt_com uyan_cmt_reply_120">
					<div class="uyan_cmt_avatar">
						<a class="uyan_avatar_ab" <?php if(!empty($value['url'])){echo 'href="'.$value['url'].'"';}?> target="_blank">
							<?php 
							if(empty($value['userid'])) {
							?>
							<img src="<?=PATH_PUBLIC?>img/duface.png" >
							<?php 
							} else {
							?>
							<img src="<?=LinkAvatar($value['userid'])?>">
							<?php 
							}
							?>
						</a>
						<span><a class="uyan_avatar_an" <?php if(!empty($value['url'])){echo 'href="'.$value['url'].'"';}?> target="_blank" ></a></span>
					</div>
					<div class="uyan_cmt_con">
						<div class="uyan_con_tit">
							<span class="uyan_con_uname">
								<a id="uyan_cmt_uname" <?php if(!empty($value['url'])){echo 'href="'.$value['url'].'"';}?> target="_blank"><?=$value['author']?></a>
							</span>
							<span class="uyan_con_ufromname"><?php echo $value['userid'] ? '(会员)' : '(游客)';?></span>
						</div>
						<div class="uyan_cmt_txt" ><?=stripcslashes($value['content'])?></div>
						<div class="uyan_cmt_exp" >
							<div class="uyan_exp_date"><?=$value['datetime']?></div>
							<div style="clear: both;"></div>
						</div>
					</div>
					<div style="clear: both;"></div>
					<div class="rep_box"></div>
				</div>
				<?php 
						}
					}
					}
				}
				?>
				<?php 
				$i++;
				endforeach;
				}
				?>
			</div>
			<div style="clear: both;"></div>
			<div id="load_more">
				<input type="hidden" name="start" id="start" value="5">
				<input type="hidden" name="limit" id="limit" value="<?=getSet('comment_nums');?>">
				<input type="hidden" name="id" id="id" value="<?=$article['id']?>">
			    <div id="uyan_more_cmt" onclick="loadMore();" <?php if(empty($i) || $i<5) {echo 'style="display:none;"'; }?>>
					<span>查看更多评论</span>
					<img src="<?=PATH_PUBLIC?>img/arrow_up.png">
				</div>
			</div>
		</article>
	</div>
	<div id="right">
		<h3 class="widgettitle">文章归档</h3>
		<div class="widget">
			<ul>
				<?php foreach($archive as $list):?>
				<li><a href="<?=site_url('article/archive/'.$list['datetime'])?>"><?=engDate($list['datetime'],'yd')?></a>&nbsp;(<?=$list['num']?>)</li>
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
		<h3 class="widgettitle">业内新闻</h3>
		<div class="widget">
			<ul>
				<?php foreach($cms_recom as $list):?>
				<li><a href="<?=site_url('cms/view/'.$list['id'])?>"><?=$list['title']?></a></li>
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
					<a href="<?=site_url('article/view/'.$list['id'])?>"><?=cutTab($list['title'],14)?></a>
				</li>
				<?php 
					} else {
				?>
				<li>
					<span><?php echo $i;?></span>
					<a href="<?=site_url('article/view/'.$list['id'])?>"><?=cutTab($list['title'],14)?></a>
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
				<li><a href="/archive">文章归档</a></li>
				<li><a href="/history">博客事件</a></li>
				<li><a href="/contact">给我留言</a></li>
				<li><a href="/links">申请友链</a></li>
			</ul>
		</div>
	</div>
</div>