<?php 
    class CheckPasswordAction extends CommonAction {
        public function index () {
            $this->display();
            
        }
        
        public function check_user () {
        	$userID = I('userID');
        	$this->assign('userID',$userID);
            $this->display(check);
        }
        
        public function check () {
            
            if (I('oldpassword') != '') {
                $oldpassword = I('oldpassword');
            }else {
                $this->error('请输入您的旧密码');
            }
            
            if (I('newpassword') != '') {
                $newpassword = I('newpassword');
            }else {
                $this->error('请输入您的新密码');
            }
            
            if (I('newpasswordagain') != '') {
                $newpasswordagain = I('newpasswordagain');
            }else {
                $this->error('请再次输入您的新密码');
            }
            
            if ($oldpassword == $newpassword) {
                $this->error('新密码不能与旧密码相同');
            }
            
            if ($newpassword != $newpasswordagain) {
                $this->error('请输入两次相同的密码');
            }
            
            $userID = I('userID');
            $user_information = M('user_information');
            $where['userID'] = $userID;
            $res = $user_information->field('userPassword')->where($where)->find();           
            if (md5($oldpassword) == $res['userPassword']) {
                $res['userPassword'] = md5($newpassword);
                $result = $user_information->where($where)->save($res);
                if ($result) {
                    $this->success("修改密码成功", U('Login/logout'));
                }else {
                    $this->error("修改密码失败", U('CheckPassword/check', array('userID' => $userID)));
                }
            }else {
                $this->error('旧密码错误，请核对旧密码');
            }
        }
        
        public function check_boss () {
        	if (I('newpassword') != '') {
        		$newpassword = I('newpassword');
        	}else {
        		$this->error('请输入您的新密码');
        	}
        
        	if (I('newpasswordagain') != '') {
        		$newpasswordagain = I('newpasswordagain');
        	}else {
        		$this->error('请确认您的新密码');
        	}
        	
        	if ($newpassword == $newpasswordagain) {
        		$user_information = M('user_information');
        		$where['userID'] = I('userID');
        		$res_user = $user_information->where($where)->find();
        		if($res_user){
	        		$res['userPassword'] = md5($newpassword);
	        		$result = $user_information->where($where)->save($res);
	        		if ($result) {
	        			$this->success("修改密码成功", U('Login/logout'));
	        		}else {
	        			$this->error("修改密码失败", U('CheckPassword/search', array('userID' => $userID)));
	        		}
        		}else {
        			$this->error('用户不存在');
        		}
        	}else {
        		$this->error('请输入两次相同的密码');
        	}
        }
    }
?>