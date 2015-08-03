<script type="text/javascript" src="<?=PATH_PUBLIC;?>qqface/js/jquery.qqFace.js"></script>
<script>
/* qqface start */
function onfac(id) {
	$(function() {
		$('.emotion').qqFace({
			id : 'facebox', 		//表情盒子的ID
			assign:'comment'+id, 	//给那个控件赋值
			path:'../../public/home/qqface/face/'	//表情存放的路径
		});
	});
}
//替换
function replace_em(str){
	str = str.replace(/\</g,'&lt;');
	str = str.replace(/\>/g,'&gt;');
	str = str.replace(/\n/g,'<br/>');
	str = str.replace(/\[em_([0-9]*)\]/g,'<img src="<?=PATH_PUBLIC;?>qqface/face/$1.gif" border="0" />');
	return str;
}
/* qqface end */
$(function () {
	$(".record_re").toggle(
		function() {
        	cid = $(this).attr('id');
        	$(function() {
        		$('.emotion').qqFace({
        			id : 'facebox', 	//表情盒子的ID
        			assign:'comment'+cid, 	//给那个控件赋值
        			path:'../../public/home/qqface/face/'		//表情存放的路径
        		});
        	});
       		$.post(__A+'record/getComment', {id:cid}, function(data) {
           		if(data.comment) {
               		$("#r_"+cid).html(data.comment);
               	}
        		$("#re_reply_"+cid).show();
			},'json');
		},
      	function() {
			cid = $(this).attr('id');
        	$("#r_"+cid).html('');
        	$("#re_reply_"+cid).hide();
    	}
	);
});
function doComment(id) {
	var name = $("#re_reply_"+id+" input[name=name]").val();
	var email = $("#re_reply_"+id+" input[name=email]").val();
	var url = $("#re_reply_"+id+" input[name=url]").val();
	var content = $("#re_reply_"+id+" textarea").val();
	comment = replace_em(content);
	var token = $("#token").val();
	
	if($.trim(name).length < 2 || $.trim(name).length > 16) {
		$("#re_reply_"+id+" .input_name").text('* 用户名由2-16个字符组成');
		return false;
	} else if(email == '') {
		$("#re_reply_"+id+" .input_email").text('* 请填写邮箱地址');
		return false;
	} else if (!email.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {
		$("#re_reply_"+id+" .input_email").text('* 邮箱格式不正确！请重新输入！');
		return false;
	} else if($.trim(comment).length < 2 || $.trim(comment).length > 500) {
		$("#re_reply_"+id+" .input_comment").text('* 内容请控制在2-500字以内');
		return false;
	}
	$.post(__A+'record/doComment', {'id':id,'name':name,'email':email,'url':url,'comment':comment,'token':token}, function(data){
		if(data.comment) {
			$(data.comment).prependTo("#r_"+id);//插入开头
    		var cnum = Number($("#"+id+" span").text());
    		$("#"+id+" span").text(cnum+1);
    		//清空输入框
    		$("#re_reply_"+id+" input[name=name]").val('');
    		$("#re_reply_"+id+" input[name=email]").val('');
    		$("#re_reply_"+id+" input[name=url]").val('');
    		$("#re_reply_"+id+" textarea").val('');
		}
		if (data.error) {
			$("#re_reply_"+id+" .mess").text(data.error);
		}
	},'json');
}
$(function() {
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
	<h1 class="t_nav"><span><?=getPageDesc('record');?></span></h1>
</div>
<div id="main" role="main" class="clearfix">
	<div class="moodlist">
		<div class="bloglist">
			<input type="hidden" id="token" name="token" value="<?=$token?>" />
			<?php foreach($record as $list):?>
			<ul class="arrow_box">
				<div class="sy">
					<div class="re_info">
						<?php if(!empty($list['img'])) { ?>
						<img class="img_pic" src="images/001.png">
						<?php } ?>
						<p> <?=stripcslashes($list['content'])?></p>
						<div class="sy_reply">
							<span class="text-num">
								<a class="record_re" id="<?=$list['id']?>" href="javascript:void(0);" >
									评论(<span><?=$list['comnum']?></span>)
								</a>
							</span>
						</div>
					</div>
					<div id="re_reply_<?=$list['id']?>" class="re_reply">
						<div id="r_<?=$list['id']?>" class="reply_r"></div>
						<?php
						if(getSet('is_treply') == 'y') {
						?>
						<div class="contacts-block white-form" id="rp_<?=$list['id']?>">
				            <form id="form_contact" action="javascript:alert('Was send!');">
				            	<input type="text" name="name" class="name" required placeholder="Your Name" /><span class="input_name"></span>
				                <input type="email" name="email" class="email" required placeholder="Your Email" /><span class="input_email"></span>
				             	<input type="text" name="url" class="url" placeholder="http://" />
				                <textarea name="comment<?=$list['id']?>" id="comment<?=$list['id']?>" class="comment" required placeholder="Type your comments here..."></textarea><span class="input_comment"></span>
				                <div class="face_ico"><span class="emotion"></span></div>
				                <div class="comment_button">
				                	<input type="button" id="subform" class="submit" onclick="doComment(<?=$list['id']?>);" value="评论"/>
				                	<span class="mess"></span>
				                </div>
				            </form>
							<div class="clear"></div>
					    </div>
					    <?php 
					    } else {
					    ?>
					    <div class="contacts-block white-form" id="rp_<?=$list['id']?>" style="display:none;">
					    	<textarea name="comment<?=$list['id']?>" id="comment<?=$list['id']?>" class="comment"></textarea>
					    </div>
					    <?php 
					    }
					    ?>
				    </div>
				</div>
				<span class="dateview"><?=date('Y-m-d',strtotime($list['datetime']))?></span>
			</ul>
			<?php endforeach;?>
		</div>
		<!-- #分页 -->
		<div class="pagination margin-pag">
			<?php 
				echo $this->pagination->create_links();
			?>
		</div>
	</div>
</div>
