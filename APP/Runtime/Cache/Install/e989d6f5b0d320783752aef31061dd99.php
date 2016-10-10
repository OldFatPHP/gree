<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
  <link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
  <title><?php echo U('Report/index');?></title>
</head>
<body>


<form action="<?php echo U(handle);?>" method="post">
	请填写日期:（例：2016年3月）
	<input type="text" value="<?php echo ($year); ?>" name="year">年
	<input type="text" value="<?php echo ($month); ?>" name="month">月
	<input type="submit" style="cursor:pointer" name="" value="导出">
</form>



</body>
</html>