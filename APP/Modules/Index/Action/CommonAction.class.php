<?php 
	class CommonAction extends Action{
	
			function __construct(){
				parent::__construct();
				if(session('userName') == '' || session('userID') == '' || session('userTypeID') != '1'){
					$this->error('请登录！',U('Index/Login/index'));
				}else {
					$user['name'] = session('userName');
					$user['id'] = session('userID');
					$this->user=$user;
				}
					

				
/* 				$notAuth=in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')));
				
				if (C('USER_AUTH_ON') && !$notAuth) {
					import('ORG.Util.RBAC');
					RBAC::AccessDecision(GROUP_NAME) || $this->error('没有权限');
				} */
		}

		
	}
	

 ?>