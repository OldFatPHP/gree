<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
	  <meta charset="UTF-8">
  <link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
		<title>
			修改密码
		</title>
	</head>
	
	<body>
		<form action="<?php echo U('CheckPassword/check_boss');?>" method="post">
		<table class='table'>
			<tr><th align='right'>用户账号</th><td width='90%'><input type="text" name="userID"></td></tr>	
			<tr><th align='right'>请输入新密码</th><td width='90%'><input type="text" name="newpassword"></td></tr>	
			<tr><th align='right'>再次输入新密码</th><td width='90%'><input type="text" name="newpasswordagain"></td></tr>
		</table>
		 	<input type="submit" value="确认修改"/>　　<input type="reset" value="重新填写"/>
		</form>
	</body>
</html>