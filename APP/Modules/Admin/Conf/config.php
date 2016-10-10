<?php 
return array(
	//后台模板路径
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Public',
	),
		
	
	 
	//RBAC权限配置
	'USER_AUTH_ON' => true, 					//是否需要认证
	'USER_AUTH_TYPE' => 1,						//认证类型 1 登录认证 2 实时认证
	'RBAC_SUPERADMIN'=>'admin',    				//RBAC超级管理员名称
	'ADMIN_AUTH_KEY'=>'superadmin',          	//超级管理员识别
	'USER_AUTH_KEY' => 'userID',					//认证识别号(SESSION标记)
	'NOT_AUTH_MODULE' => 'Index,Delet',				//无需认证模块
	'NOT_AUTH_ACTION' => 'exportExcel,export,expUser,exportExcel1,impUser,editSubmit,edit',//无需认证的动作方法		
	'RBAC_ROLE_TABLE' => 'role',			//角色表名称
	'RBAC_USER_TABLE' => 'role_user',		//用户表名称
	'RBAC_ACCESS_TABLE' => 'access',		//权限表名称
	'RBAC_NODE_TABLE' => 'node',			//节点表名称
	
);



?>