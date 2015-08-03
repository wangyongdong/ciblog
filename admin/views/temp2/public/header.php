<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?=ADMIN_PUBLIC;?>css/common_style.css" rel="stylesheet" type="text/css">
<link href="<?=ADMIN_PUBLIC;?>css/blog.css" rel="stylesheet" type="text/css">
<script src="<?=ADMIN_PUBLIC;?>scripts/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="<?=ADMIN_PUBLIC;?>scripts/blog.js" type="text/javascript"></script>
<title>blog manage</title>
<script type="text/javascript">
var __A = "<?php echo base_url(); ?>";	//定义_A的目的是在js文件中使用
</script>
</head>
<body>
<script>
function hideActived(){
	$("#point").hide();
}
</script>
<script>
setTimeout(hideActived,2600);
</script>
<div class='containertitle'>
<?php if(isset($_GET['active_s'])){?><span id="point" class="actived"><?php echo $_GET['i'];?></span><?php };?>
<?php if(isset($_GET['error_e'])){?><span id="point" class="error"><?php echo $_GET['i'];?></span><?php };?>
</div>