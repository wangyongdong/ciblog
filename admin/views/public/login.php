<!DOCTYPE html>
<html lang="chn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>后台登陆页面</title> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="">
		<!-- Stylesheets -->
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/bootstrap.css">
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/font-awesome.css">
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/style.css">
		<link rel="stylesheet" href="<?=ADMIN_PUBLIC?>style/blog.css">
		<!-- HTML5 Support for IE -->
		<!--[if lt IE 9]>
		<script src="js/html5shim.js"></script>
		<![endif]-->
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?=ADMIN_PUBLIC?>img/favicon/favicon.png">
		<script type="text/javascript">
			var __A = "<?php echo base_url(); ?>";
		</script>
	</head>
	<body>
		<div class="admin-form">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="widget worange">
							<div class="widget-head">
								<i class="icon-lock"></i> Login 
							</div>
							<div class="widget-content">
								<div class="padd">
									<form class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-lg-3" for="inputEmail">Email</label>
											<div class="col-lg-7">
												<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
												<span class="login-warning" id="email"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-lg-3" for="inputPassword">Password</label>
											<div class="col-lg-7">
												<input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
												<span class="login-warning" id="pass"></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-7 col-lg-offset-3">
												<div class="checkbox">
													<label>
														<input type="checkbox"> Remember me
													</label>
												</div>
											</div>
										</div>
										<div class="col-lg-9 col-lg-offset-2">
											<button type="button" class="btn btn-danger" onclick="signIn();">Sign in</button>
											<button type="reset" class="btn btn-default">Reset</button>
										</div>
										<br />
									</form>
								</div>
							</div>
							<div class="widget-foot">
								Not Registred? <a href="#">Register here</a>
							</div>
						</div>  
					</div>
				</div>
			</div>
		</div>
		<!-- JS -->
		<script src="<?=ADMIN_PUBLIC?>js/jquery.js"></script>
		<script src="<?=ADMIN_PUBLIC?>js/bootstrap.js"></script>
		<script src="<?=ADMIN_PUBLIC?>js/blog.js"></script> <!-- My custom -->
	</body>
</html>