<div id="main" role="main" class="clearfix back_white">
	<div class="skin_msg infor_box">
		<div class="part">
			<div class="hd">
				<h3 class="suc">信息提示</h3>
			</div>
			<div class="bd">
				<div class="msgBox">
					<p class="msgCont"><?=$message?></p>
					<p class="msgLink">
					<a href="<?=$reurl?>">如果浏览器没有自动跳转，请点此返回</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	setTimeout("window.opener=null;window.location.href='<?=$reurl?>'",3000);
</script>