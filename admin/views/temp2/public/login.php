<link href="<?=ADMIN_PUBLIC;?>css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
<form id="login" action="<?=site_url('login/loginIn')?>" method="post">
    <h1>Log In</h1>
    <fieldset id="inputs">
        <input id="username" name="name" type="text" placeholder="Username" autofocus required>   
        <input id="password" name="pass" type="password" placeholder="Password" required>
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="submit" value="Log in">
        <a href="">Forgot your password?</a><a href="">Register</a>
    </fieldset>
</form>
<br><br>
<div style="text-align:center;clear:both">
<p>用户登录</p>
</div>