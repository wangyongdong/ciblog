<script>
$(function() {
	$("#subform").click(function() {  
		var name = $('input[name=name]').val();
		var url = $('input[name=url]').val();
		var email = $('input[name=email]').val();
		var content = $('textarea').val();
		
		if($.trim(name).length < 2 || $.trim(name).length > 30) {
			$("#form_contact .input_name").text('* 网站名称由2-30个字符组成');
			return false;
		} else if(url == '') {
			$("#form_contact .input_url").text('* 请填写网站链接');
			return false;
		} else if (!email.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {
			$("#form_contact .input_email").text('* 邮箱格式不正确！请重新输入！');
			return false;
		} else if($.trim(content).length < 2 || $.trim(content).length > 500) {
			$("#form_contact .input_content").text('* 内容请控制在2-500字以内');
			return false;
		} else {
			$("#form_contact").submit();
		}
	});
	$('#form_contact input[name=name]').focus(function() {
		$('.input_name').text('');
	});
	$('#form_contact input[name=url]').focus(function() {
		$('.input_url').text('');
	});
	$('#form_contact input[name=email]').focus(function() {
		$('.input_email').text('');
	});
	$('#form_contact textarea').focus(function() {
		$('.input_content').text('');
	});
})
</script>
<div id="main" role="main" class="clearfix">
	<div id="left">
		<div class="contacts-block contacts-bg tables_d">
			<div class="contacts-bg-white">
				<p>填写网站信息，待博主审核通过后，即可显示。</p>
	            <fieldset class="info_fieldset">
		            <div id="contacts-form">
			            <form id="form_contact" method="post" action="<?=site_url('links/doLinks')?>">
			            	<input type="hidden" name="token" value="<?=$token?>" />
			            	<input type="text" name="name" required placeholder="Website name" class="required"/><span class="input_name"></span>
			             	<input type="text" name="url" required placeholder="http://" /> <span class="input_url"></span>
							<input type="email" name="email" required  placeholder="Your Email" class="required" /><span class="input_email"></span>			                <div class="clear"></div>
			                <textarea name="desc" required placeholder="Website type description"></textarea>
			                <span class="input_content"></span>
			                <input type="button" id="subform" class="submit" value="提交申请"/>
			            </form>
					</div>
				</fieldset>
			    <div class="clear"></div>
		    </div>
	    </div>
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
		<h3 class="widgettitle">Meta</h3>
		<div class="widget">
			<ul>
				<li><a href="/admin">登录blog</a></li>
				<li><a href="#">分享网址</a></li>
				<li><a href="/contact">给我留言</a></li>
				<li><a href="/links">申请友链</a></li>
			</ul>
		</div>
	</div>
</div>
