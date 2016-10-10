<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<title>用户信息</title>
</head>

	<body>
		<form action="<?php echo U('Operation/search');?>" method="post">
		<table class='table'>
			<tr><th align='right'>手机号</th><td width='90%'><input type="text" name="userID"></td></tr>
			<tr>
			<th align='right'>姓名</th>
			<td width='90%'><input type="text" name="userName"></td>
			</tr>
			<tr>
			<tr>
			<th align='right'>类别</th>
			<td width='90%'>
			<select name="userTypeID">
				<option value="">请选择</option>
				<option value=1>销售</option>
				<option value=2>安装</option>
				<option value=3>后台</option>
			</select>
			</td>
			</tr>
			<tr>

		</table>
		<input type="submit" value="确认查询">
		</form>

	</body>
</html>