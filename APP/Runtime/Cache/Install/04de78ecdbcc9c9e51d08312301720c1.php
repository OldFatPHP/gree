<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>中宏力实业管理系统--安装网点</title>
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/index.js"></script>
<link rel="stylesheet" href="__PUBLIC__/Css/Public.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/index.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>

<body>
	<div id="top">
		<div class="menu">
			<a href=""><i class="icon-desktop"></i> 中宏力实业管理系统--安装网点</a>
		</div>
		<div class="exit">
			<a href="<?php echo U('Receive/index');?>" target="iframe">未接安装工单：<?php echo ($Receive); ?></a>
			<a href="<?php echo U('Dispatch/index');?>" target="iframe">已接未派工：<?php echo ($Dispatch); ?></a>
			<a href="<?php echo U('NoInstall/index');?>" target="iframe">已派工未安装：<?php echo ($NoInstall); ?></a>
		
			<a href="#" onclick="location.reload();">刷新</a>
			当前登录用户：<?php echo ($user["name"]); ?>[<?php echo ($branchName); ?>]
			<a href="<?php echo U('CheckPassword/check_user', array('userID' => $user[id]));?>" target="_self">修改密码</a>
			<a href="<?php echo U('Login/logout');?>" target="_self">退出</a>
		</div>

	</div>
	<div id="left">
		
		<dl>
			<dt class="title"><i class="icon-folder-close"></i> 安装派工管理</dt>
			<dd>
			<a href="<?php echo U('Receive/index');?>" target="iframe">└ 未接安装工单</a>
			<a href="<?php echo U('Dispatch/index');?>" target="iframe">└ 已接未派工</a>
			<a href="<?php echo U('NoInstall/index');?>" target="iframe">└ 已派工未安装</a>
			<a href="<?php echo U('InstallSucc/index');?>" target="iframe">└ 安装完成工单</a>
			<a href="<?php echo U('Query/index');?>" target="iframe">└ 工单查询</a>
			<a href="<?php echo U('Report/index');?>" target="iframe">└ 导出报表</a>
            </dd>
		</dl>

		
		
	</div>
	<div id="right">
		<iframe name="iframe"  id='iframe' src="<?php echo U('Receive/index');?>" frameborder="no" border="0"></iframe>
	</div>
	<script type="text/javascript"> 
	$(document).ready(function(){
		/* $('.title').click(function(){
		    $(this).next().slideToggle("fast");
		  });
       */
       $('#iframe').load(function(){
    	   $('#left a').each(function(){
    		   if($(this).attr('href')==document.getElementById('iframe').contentWindow.document.title){
    			   $(this).addClass('ahover');
    		   }else{
    			   $(this).removeClass('ahover');
    		   }
    	   });
    	   
       });
       
       
	});
	</script>
</body>

</html>