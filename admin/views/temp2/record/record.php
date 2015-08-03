<script type="text/javascript" src="<?=UEDITOR_PLUGIN;?>ueditor.config.js"></script>
<script type="text/javascript" src="<?=UEDITOR_PLUGIN;?>ueditor.all.js"></script>

<div id="main">
	<div id="record" class="item_edit">
		<div id="record_nor">
			<img src="<?=LinkAvatar($list['id'])?>" class="user-avatar-big" />
			<p><a href=""><?=$list['nickname']?></a></p>
		</div>
		<div id="record_nor">
			<form action="<?=site_url('record/doRecord')?>" method="post">
				<div id="record_con">
					<!-- 载入编辑器 -->
					<?=$uedit?>
				</div>
			    <input type="submit" value="发布" id="sub_record"/>
			</form>
		</div>
	</div>
	<div class="clear"></div>
	<div id="record_list">
		<ul>
			<?php foreach($record as $record):?>
				<li class="record_li">
					<div class="record_left">
						<img src="<?=LinkAvatar($list['id'])?>" class="user-avatar-small" />
					</div>
					<div class="record_right">
						<a href="" class="record_nick" ><?=$list['nickname']?></a>：
						<?=stripcslashes($record['content'])?>
					</div>
					<div class="record_bottom">
						<span class="record_time"><?=$record['datetime']?></span>
						<a class="record_del" href="javascript:void(0);" onclick="doDel(<?=$record['id']?>,'<?=site_url('record/doDel')?>')">删除</a>
						<a class="record_re" id="<?=$record['id']?>" href="javascript:void(0);">评论(<span><?=$record['comnum']?></span>)</a>
					</div>
					<div id="r_<?=$record['id']?>" class="r"></div>
					<div class="huifu" id="rp_<?=$record['id']?>">
						<textarea class="rcon" name="reply"></textarea>
					    <div>
					   		<input class="button_p" type="button" onclick="addComment(<?=$record['id']?>);" value="评论" /> 
					    	<span style="color:#FF0000"></span>
					    </div>
				    </div>
				</li>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="record-page">
		<?php echo $this->pagination->create_links(); ?>
	</div>
</div>