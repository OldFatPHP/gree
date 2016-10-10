<?php
    class LoginAction extends Action{
    	public function index(){
    		$this->display();
    	}

    	public function verify(){
            ob_clean();
    		import('ORG.Util.Image');
    		Image::buildImageVerify(4,1,'png',80,25);
    	}

        public function check(){
            if(!$this->isPost()){
                $this->error('用户名或者是密码错误',U('index'));
            }
            if(md5(I('verify')) == session('verify')){          	
                $userID = I('userName');
                $userPassword = I('userPassword');
                if($userID =='' || $userPassword ==''){
                    $this->error('用户名或者密码不能为空',U('index'));
                }
                $model = M('user_information');
                $condition['userID'] = $userID;
                $data = $model->where($condition)->select();
				
/*                 dump($data[0]['userTypeID']);die; */
                if((!empty($data) && $data[0]['userTypeID'] == '1') && $data[0]['userStatus'] == '1' && ($data[0]['userPassword'] == md5($userPassword))){
                    session('userID',$data[0]['userID']);
                    session('userName',$data[0]['userName']);
                    session('userTypeID',$data[0]['userTypeID']);//用户类型，1为销售前台
                    session('branchID',$data[0]['userBranchID']);
                    //根据网点ID去sales_branch表查询网点名字
                    $branch = M('sales_branch')->field('branchName')->find($data[0]['userBranchID']);
                    session('branchName',$branch['branchName']);

                    $url = U('Index/Index');
                    $this->success('登录成功',U('SalesInput/index'));
                } else {
                    $this->error('用户名或者是密码错误',U('index'));
                }
                
            }
            else
                $this->error('验证码错误',U('index'));
            
            
        }
        public function logout(){
        	session('userID',null);
        	session('userName',null);
            session('userTypeID',null);
            session('branchID',null);
        	session('branchName',null);
        	$this->success('退出成功！');
        }


    }