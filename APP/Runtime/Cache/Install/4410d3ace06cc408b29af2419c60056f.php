<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>	
<head>
<title>登录 - 中宏力实业管理系统--安装网点</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="__PUBLIC__/Css/login.css" rel='stylesheet' type='text/css' />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>

<div class="login-form">
		<div class="head-info">
			中宏力实业管理系统--安装网点
		</div>
			<div class="clear"> </div>

			<form action='<?php echo U("Login/check","","");?>' method='post'>
					<P>手机号: <input name="userName" type="text" class="text"></P>
					<P>密&nbsp;&nbsp;码: <input name="userPassword" type="password"></P>
					<P>验证码: <input name="verify" type="text" class="text"></P>
					<P class="verify"><img src='<?php echo U("Login/verify");?>' /></P>
						
					<div class="signin">
					<input type="submit" value="登录" >
					</div>
			</form>

</div>
 <div class="copy-rights">
					<p>Powered by 拓嵘科技.</p>
			</div>

</body>
</html>