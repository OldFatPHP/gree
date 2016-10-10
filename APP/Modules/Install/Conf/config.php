<?php 
return array(
	//后台模板路径
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Public',
	),
		
	
	/*  
	//RBAC权限配置
	'USER_AUTH_ON' => true, 					//是否需要认证
	'USER_AUTH_TYPE' => 1,						//认证类型 1 登录认证 2 实时认证
	'RBAC_SUPERADMIN'=>'Smiles',    				//RBAC超级管理员名称
	'ADMIN_AUTH_KEY'=>'superadmin',          	//超级管理员识别
	'USER_AUTH_KEY' => 'uid',					//认证识别号(SESSION标记)
	'NOT_AUTH_MODULE' => 'Index',				//无需认证模块
	'NOT_AUTH_ACTION' => 'changeSchHandle,addSchHandle,addUserHandle,addRoleHandle,addNodeHandle,setAccess,runAddCate',					
												//无需认证的动作方法
	'RBAC_ROLE_TABLE' => 'two_role',			//角色表名称
	'RBAC_USER_TABLE' => 'two_role_user',		//用户表名称
	'RBAC_ACCESS_TABLE' => 'two_access',		//权限表名称
	'RBAC_NODE_TABLE' => 'two_node',			//节点表名称
	*/
);



?>