<script>
$(function() {
	$("#subform").click(function() {  
		var name = $('input[name=name]').val();
		var email = $('input[name=email]').val();
		var comment = $('textarea').val();
		
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
</script>
<div class="t_title">
	<h1 class="t_nav"><span><?=getPageDesc('contact');?></span></h1>
</div>
<div id="main" role="main" class="clearfix">
	<div id="left">
		<div class="contacts-block contacts-bg">
			<div class="contacts-bg-white">
				<h3>Do you need help, support or advise?</h3>
				<p>
				If you have questions or need some help can give me a message, of course, I hope you can give me a better suggestion, I will continue to improve, thank you.
				</p>
	            <fieldset class="info_fieldset">
		            <div id="note"></div>
		            <div id="contacts-form">
			            <form id="form_contact" method="post" action="<?=site_url('contact/doContact')?>">
			            	<input type="hidden" name="token" value="<?=$token?>" />
			            	<input type="text" name="name" required placeholder="Your Name" class="required"/><span class="input_name"></span>
			                <input type="email" name="email" required  placeholder="Your Email" class="required" /><span class="input_email"></span>
			             	<input type="text" name="url" placeholder="http://" />
			                <input type="text" name="subject" required placeholder="Subject" class="last-item required" />
			                <div class="clear"></div>
			                <textarea name="comment" required placeholder="Type your questions here..."></textarea>
			                <span class="input_comment"></span>
			                <input type="button" id="subform" class="submit"  value="Send Message"/>
			            </form>
						<div class="clear"></div>
					</div> <!-- end #contact-form -->
					</fieldset>
			    <div class="clear"></div>
		    </div>
	    </div><!-- .contact-block -->
	</div>
	<div id="right">
		<div class="widget">
			<div class="avatar">
				<a href="about.html">
					<span>关于<?=$blogger['username']?></span>
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
