<script type="text/javascript" src="<?=PATH_PUBLIC;?>qqface/js/jquery.qqFace.js"></script>
<script>
$(function() {
	$('.emotion').qqFace({
		id : 'facebox', 	//表情盒子的ID
		assign:'comment', 	//给那个控件赋值
		path:'../../public/home/qqface/face/'		//表情存放的路径
	});
});
//查看结果
function replace_em(str){
	str = str.replace(/\</g,'&lt;');
	str = str.replace(/\>/g,'&gt;');
	str = str.replace(/\n/g,'<br/>');
	str = str.replace(/\[em_([0-9]*)\]/g,'<img src="<?=PATH_PUBLIC;?>qqface/face/$1.gif" border="0" />');
	return str;
}
$(function () {
	$(".i-coms").toggle(
		function() {
			$(".contacts-block").show();
		},
      	function() {
			$(".contacts-block").hide();
    	}
	);
});
$(function() {
	$("#subform").click(function() {
		var name = $('input[name=name]').val();
		var email = $('input[name=email]').val();
		var content = $('textarea').val();
		comment = replace_em(content);
		$('textarea').val('');
		$('textarea').val(comment);
		
		if($.trim(name).length < 2 || $.trim(name).length > 16) {
			$("#form_contact .input_name").text('* 用户名由2-16个字符组成');
			return false;
		} else if(email == '') {
			$("#form_contact .input_email").text('* 请填写邮箱地址');
			return false;
		} else if (!email.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {
			$("#form_contact .input_email").text('* 邮箱格式不正确！请重新输入！');
			return false;
		} else if($.trim(comment).length < 2 || $.trim(comment).length > 500) {
			$("#form_contact .input_comment").text('* 内容请控制在2-500字以内');
			return false;
		} else {
			$("#form_contact").submit();
		}
	});
	$('#form_contact input[name=name]').focus(function() {
		$('.input_name').text('');
	});
	$('#form_contact input[name=email]').focus(function() {
		$('.input_email').text('');
	});
	$('#form_contact textarea').focus(function() {
		$('.input_comment').text('');
	});
})
//加载更多
function loadMore() {
	$(".part_btn").html("");
	var start = $("input[name=start]").val();
	var limit = $("input[name=limit]").val();
	var id = $("input[name=id]").val();
	$.post(
		__A+'article/getComment',
		{id:id,start:start,limit:limit,type:'ajax'},
		function(data) {
			if(!data.comment) {
				setTimeout(function(){$("#a-load").slideUp("slow")},1000);
			}
			$(".ds-comments").append(data.comment);
			startq = Number(start) + Number(limit);
			$("#start").attr("value",startq);
			if(data.num>=5) {
				$(".part_btn").html('<a id="a-load" href="javascript:void(0);" onclick="loadMore();">查看更多</a>');
			}
		},'json');
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
					本站文章除注明转载外，均为原创文章。转载请注明：文章转载自： 王永东个人博客（
					<a href="http://www.itlipeng.cn"> http://www.itlipeng.cn </a>
					）
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
					<?php 
					}
					?>
				</div>
				<div class="otherlink">
					<h2>相关文章</h2>
					<ul>
						<?php foreach($article_related as $list):?>
						<li>
							<a title="<?=$list['title']?>" href="<?=site_url('article/view/'.$list['id'])?>"><?=cutStr($list['title'],18)?></a>
						</li>
						<?php endforeach;?>
					</ul>
				</div>
				<div id="comment_list" class="re_reply">
					<div id="<?=$article['id']?>" class="reply_r">
						<h3>用户评论</h3>
						<ul class="ds-comments">
							<?php 
							$i = 1;
							foreach($comment as $comment):
							?>
							<li>
								<div class="com_top">
									<a class="author" href="<?=$comment['url']?>">
										<?=$comment['author']?>：
									</a>
								</div>
								<div class="cont">
									<?=stripcslashes($comment['comment'])?>
								</div>
								<div class="time">
									<?=$comment['datetime']?>
								</div>
							</li>
							<?php 
							$i++;
							endforeach;
							?>
						</ul>
						<div id="load_more">
							<input type="hidden" value="5" name="start" id="start">
							<input type="hidden" value="<?=getSet('comment_nums');?>" name="limit" id="limit">
							<input type="hidden" value="<?=$article['id']?>" name="id" id="id">
						    <div class="part_btn" <?php if(empty($i) || $i<5) {echo 'style="display:none;"'; }?>>
						    	<a id="a-load" href="javascript:void(0);" onclick="loadMore();">查看更多</a>
						    </div>
						</div>
					</div>
					<div class="comment_pro">
						<div class="min-comments">
							<p class="i-like">已有 <?=$article['comnum']?> 人发表感言！</p>
						</div>
						<?php 
						if(getSet('is_comment') == 'y') {
						?>
						<div class="action flex">
							<span id="btnrepost" class="btn i-coms">评论</span>
						</div>
						<?php 
						}
						?>
					</div>
					<div class="contacts-block white-form" id="re_reply_<?=$article['id']?>">
			            <form id="form_contact" method="post" action="<?=site_url('comment/doComment')?>">
			            	<input type="hidden" name="id" value="<?=$article['id']?>" />
			            	<input type="text" name="name" class="name" required placeholder="Your Name" /><span class="input_name"></span>
			                <input type="email" name="email" class="email" required  placeholder="Your Email" /><span class="input_email"></span>
			             	<input type="text" name="url" class="url" placeholder="http://" />
			                <textarea name="comment" id="comment" class="comment" required placeholder="Type your comments here..."></textarea>
			                <div class="face_ico"><span class="emotion"></span></div>
			                <span class="input_comment"></span>
			                <div class="comment_button">
			                	<input type="button" id="subform" class="submit" value="评论"/>
			                </div>
			            </form>
						<div class="clear"></div>
				    </div>
			    </div>
		</article><!-- #post-188 -->
	</div>
	<div id="right">
		<h3 class="widgettitle">栏目导航</h3>
		<div class="rnav">
			<ul>
				<?php foreach($sort as $list):?>
				<li><a href="<?=site_url('article/sort/'.$list['id'])?>"><?=$list['name']?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<h3 class="widgettitle">文章归档</h3>
		<div class="widget">
			<ul>
				<?php foreach($archive as $list):?>
				<li><a href="<?=site_url('article/archive/'.$list['datetime'])?>"><?=engDate($list['datetime'])?></a>&nbsp;(<?=$list['num']?>)</li>
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
					<a href="<?=site_url('article/view/'.$list['id'])?>"><?=cutStr($list['title'],14,'...')?></a>
				</li>
				<?php 
					} else {
				?>
				<li>
					<span><?php echo $i;?></span>
					<a href="<?=site_url('article/view/'.$list['id'])?>"><?=cutStr($list['title'],14,'...')?></a>
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
				<li><a href="#">分享网址</a></li>
				<li><a href="/contact">留言评论</a></li>
				<li><a href="/common/links">申请友链</a></li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript" src="/public/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
<script type="text/javascript" src="/public/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css"></script>
<script>
SyntaxHighlighter.all();
</script>