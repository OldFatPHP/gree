<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>中宏力实业后台管理系统</title>
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
			<a href=""><i class="icon-desktop"></i> 中宏力实业后台管理系统</a>
		</div>
		<div class="exit">
			<a href="<?php echo U('SalesToInstall/index');?>" target="iframe">安装待派工：<?php echo ($SalesToInstall); ?></a>
			<a href="<?php echo U('Receive/index');?>" target="iframe">未接安装工单：<?php echo ($Receive); ?></a>
			<a href="<?php echo U('Dispatch/index');?>" target="iframe">已接未派工：<?php echo ($Dispatch); ?></a>
			<a href="<?php echo U('NoInstall/index');?>" target="iframe">已派工未安装：<?php echo ($NoInstall); ?></a>
			<a href="<?php echo U('Pending/index');?>" target="iframe">待审批改派：<?php echo ($Pending); ?></a>
			<a href="<?php echo U('InstallSucc/index');?>" target="iframe">报完工：<?php echo ($InstallSucc); ?></a>
			<a href="<?php echo U('NoClose/index');?>" target="iframe">待关闭：<?php echo ($NoClose); ?></a>  
			<a href="#" onclick="location.reload();">刷新</a>
			当前登录用户：<?php echo ($user["name"]); ?>
			<a href="<?php echo U('CheckPassword/check_user', array('userID' => $user[id]));?>" target="_self">修改密码</a>
			<a href="<?php echo U('Login/logout');?>" target="_self">退出</a>
		</div>

	</div>
	<div id="left">
		
		<dl>
			<dt class="title"><i class="icon-folder-close"></i> 安装派工管理</dt>
			<dd>
				<a href="<?php echo U('SalesToInstall/index');?>" target="iframe">└ 安装待派工</a>
				<a href="<?php echo U('Receive/index');?>" target="iframe">└ 未接安装工单</a>
				<a href="<?php echo U('Dispatch/index');?>" target="iframe">└ 已接未派工</a>
				<a href="<?php echo U('NoInstall/index');?>" target="iframe">└ 已派工未安装</a>
				<a href="<?php echo U('Pending/index');?>" target="iframe">└ 待审批改派</a>
				<a href="<?php echo U('InstallSucc/index');?>" target="iframe">└ 安装报完工</a>
				<a href="<?php echo U('NoClose/index');?>" target="iframe">└ 待关闭</a>
				<a href="<?php echo U('Close/index');?>" target="iframe">└ 已关闭</a>
				<a href="<?php echo U('Query/index');?>" target="iframe">└ 工单查询</a>
				<a href="<?php echo U('Report/index');?>" target="iframe">└ 导出报表</a>
            </dd>
            
            
            <dt class="title"><i class="icon-folder-close"></i> 网点管理</dt>
			<dd>
			    <a href="<?php echo U('BranchInput/index');?>" target="iframe">└ 网点新增</a>
			    <a href="<?php echo U('BranchInquiries/index');?>" target="iframe">└ 网点查询</a>
			    
			    
            </dd>
            
            <dt class="title"><i class="icon-folder-close"></i> 销售管理</dt>
			<dd>
			    <a href="<?php echo U('SalesInput/index');?>" target="iframe">└ 销售单后台录入</a>
			    <a href="<?php echo U('SalesInquiries/index');?>" target="iframe">└ 销售单查询</a>
			    <a href="<?php echo U('SalesDetails/index');?>" target="iframe">└ 销售单汇总</a>
			    <a href="<?php echo U('SalesInquiries/report');?>" target="iframe">└ 导出报表</a>
            </dd>
            
            <dt class="title"><i class="icon-folder-close"></i> 品类管理</dt>
			<dd>
			    <a href="<?php echo U('CategoryInput/index');?>" target="iframe">└ 品类新增</a>
			    <a href="<?php echo U('CategoryInquiries/index');?>" target="iframe">└ 品类查询</a>

			    <a href="<?php echo U('CategoryDetails/index');?>" target="iframe">└ 品类汇总</a>
            </dd>
            
            <dt class="title"><i class="icon-folder-close"></i> 小类管理</dt>
			<dd>
			    <a href="<?php echo U('CategoriesInput/index');?>" target="iframe">└ 小类新增</a>
			    <a href="<?php echo U('CategoriesInquiries/index');?>" target="iframe">└ 小类查询</a>

			    <a href="<?php echo U('CategoriesDetails/index');?>" target="iframe">└ 小类汇总</a>
            </dd>
            
            <dt class="title"><i class="icon-folder-close"></i> 系列管理</dt>
			<dd>
			    <a href="<?php echo U('SeriesInput/index');?>" target="iframe">└ 系列新增</a>
			    <a href="<?php echo U('SeriesInquiries/index');?>" target="iframe">└ 系列查询</a>

			    <a href="<?php echo U('SeriesDetails/index');?>" target="iframe">└ 系列汇总</a>
            </dd>
            

            
            <dt class="title"><i class="icon-folder-close"></i> 型号管理</dt>
			<dd>
			    <a href="<?php echo U('ModelInput/index');?>" target="iframe">└ 型号新增</a>
			    <a href="<?php echo U('ModelInquiries/index');?>" target="iframe">└ 型号查询</a>

			    <a href="<?php echo U('ModelDetails/index');?>" target="iframe">└ 型号汇总</a>
            </dd>
            
            <dt class="title"><i class="icon-folder-close"></i> 用户管理</dt>
			<dd>
				
				<a href="<?php echo U('Operation/read');?>" target="iframe">└ 查看用户</a>
				<a href="<?php echo U('Operation/create_add');?>" target="iframe">└ 添加用户</a>
<!-- 				<a href="<?php echo U('Admin/Rbac/role');?>" target='iframe'>└ 角色列表</a>
<a href="<?php echo U('Admin/Rbac/addRole');?>" target='iframe'>└ 添加角色</a>
<a href="<?php echo U('Admin/Rbac/node');?>" target='iframe'>└ 节点列表</a>  -->
				<!--<a href="<?php echo U('Admin/Rbac/addNode');?>" target='iframe'>└ 添加节点</a> -->
				<a href="<?php echo U('Admin/CheckPassword/index');?>" target='iframe'>└ 修改密码</a>
			</dd>
		</dl>

		
		
	</div>
	<div id="right">
		<iframe name="iframe" src="<?php echo U('Admin/Index/zhl');?>" frameborder="no" border="0"></iframe>
	</div>
	<script type="text/javascript"> 
	$(document).ready(function(){
		$('.title').click(function(){
		    $(this).next().slideToggle("fast");
		  });

	});
	</script>
</body>

</html>