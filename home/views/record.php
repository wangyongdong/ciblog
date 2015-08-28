<div class="t_title">
	<h1 class="t_nav"><span><?=getPageDesc('record');?></span></h1>
</div>
<div id="main" role="main" class="clearfix">
	<div class="moodlist">
		<div class="bloglist">
			<?php foreach($record as $list):?>
			<ul class="arrow_box">
				<div class="re_info">
					<?php if(!empty($list['img'])) { ?>
					<img class="img_pic" src="images/001.png" width="80px" height="80px">
					<?php } ?>
					<p> <?=stripcslashes($list['content'])?></p>
				</div>
				<span class="dateview"><?=dateFor($list['datetime'])?></span>
			</ul>
			<?php endforeach;?>
		</div>
		<div class="pagination margin-pag">
			<?php 
				echo $this->pagination->create_links();
			?>
		</div>
	</div>
</div>
