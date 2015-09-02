<!DOCTYPE html>
<html lang="chn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>后台登陆</title> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="王永东">
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
		
	</head>
	<body>
		<div class="admin-form">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="widget worange">
							<div class="widget-head"><i class="icon-lock"></i> Login </div>
							<div class="widget-content">
								<div class="padd">
									<form class="form-horizontal">
										<div class="form-group">
											<label class="control-label col-lg-3" for="inputEmail">Email</label>
											<div class="col-lg-7">
												<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
												<span class="login-warning" id="email_warn"></span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-lg-3" for="inputPassword">Password</label>
											<div class="col-lg-7">
												<input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
												<span class="login-warning" id="pass_warn"></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-7 col-lg-offset-3">
												<div class="checkbox"><label><input type="checkbox"> Remember me</label></div>
											</div>
										</div>
										<div class="col-lg-9 col-lg-offset-2">
											<button type="button" class="btn btn-danger" id="submit">Sign in</button>
											<button type="reset" class="btn btn-default">Reset</button>
										</div><br />
									</form>
								</div>
							</div>
							<div class="widget-foot">
								<!-- Not Registred? <a href="#">Register here</a> -->
							</div>
						</div>  
					</div>
				</div>
			</div>
		</div>
		<!-- JS -->
		<script src="<?=ADMIN_PUBLIC?>js/jquery.js"></script>
		<script src="<?=ADMIN_PUBLIC?>js/bootstrap.js"></script>
		<script type="text/javascript">
			var __A = "<?php echo base_url(); ?>";
			$(function() { 
				$("#submit").click(function() { 
					var email = $("#inputEmail").val();
					var pass = $("#inputPassword").val();
					
					if(email.length == 0) {
						$("#inputEmail").addClass('form-pop');
						return false;
					}
					if ((/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email) == false) && (email.length < 2 || email.length >12) ) {
						$("#inputEmail").addClass('form-pop');
						$("#email_warn").text("请输入邮箱或用户名");
						return false;
					}
					if((pass.length == 0) || (pass.length < 6 || pass.length >16)) {
						$("#inputPassword").addClass('form-pop');
						$("#pass_warn").text("密码长度为6-16个字符");
						return false;
					}
					$.post(
						__A+'login/loginIn',
						{name:email,pass:pass},
						function(data) {
							if(data.success) {
								window.location.href = __A;
							}
							if(data.error) {
								if(data.status == -1) {
									$("#inputEmail").addClass('form-pop');
									$("#email_warn").text(data.error);
									return false;
								}
								if(data.status == -2) {
									$("#inputPassword").addClass('form-pop');
									$("#pass_warn").text(data.error);
									return false;
								}
								if(data.status == -3) {
									$("#inputEmail").addClass('form-pop');
									$("#pass_warn").text(data.error);
									return false;
								}
							}
						},
						"json"
					);
			  	})  
			  	$(document).keydown(function(e){ 
			    	if (!e)  
			      		e = window.event;  
			    	if ((e.keyCode || e.which) == 13) {  
			      		$("#submit").click();  
			    	}  
			  	}) 
			});
			//消除警示
			$(function() {
				$(".form-horizontal input,.form-horizontal textarea").focus(function() {
					$(this).removeClass('form-pop');
				});
				$("#inputEmail").focus(function() {
					$(".login-warning").text("");
				});
				$("#inputPassword").focus(function() {
					$(".login-warning").text("");
				});
			})
		</script>
	</body>
</html>