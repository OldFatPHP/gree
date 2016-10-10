<?php
    class OperationAction extends CommonAction {
        public function index () {
            $this->display();
        }
        
        /*
         * 新建用户方法 
         * 和前台页面create_add.html相关
         * 实现新建用户
         * */

        public function create_add () {
            $sale=M('sales_branch')->field('branchID,branchName')->select();
            foreach ($sale as $key => $value) {
                $sale[$key]['pid']=1;
            }

            $install=M('install_branch')->field('branchID,branchName')->select();
            foreach ($install as $key => $value) {
                $install[$key]['pid']=2;
            }

            $arr1 = array_merge($sale, $install);

            $i=3;
            foreach ($arr1 as $key => $value) {
                $arr[$i]=$arr1[$key];
                $i++;
            }

            $role=M('role')->select();

            foreach ($role as $key => $value) {
                $arr[$i]['branchID']=$value['id'];
                $arr[$i]['pid']=$value['pid'];
                $arr[$i]['branchName']=$value['remark'];
                $i++;
             }
            $this->arr=json_encode($arr);
            $this->display();
        }

        public function create () {
            $userID = I('userID');
            $userName = I('userName');
            $userPassword = I('userPassword');
            $userSex = I('userSex');
            $userIDCard = I('userIDCard');
            $userEntryTime = I('userEntryTime');
            $userTypeID = I('x1');
            $userBranchID = I('x2');
            $userRemark = I('userRemark');

            if ($userID != "") {
                $id=$data['userID'] = $userID;
            }else {
                $this->error('手机号不能为空');
            }

            if ($userName != "") {
                $data['userName'] = $userName;
            }else {
            	$this->error('用户名不能为空');
            }

            if ($userPassword != "") {
                $data['userPassword'] = md5($userPassword);
            }else {
            	$this->error('密码不能为空');
            }

            if ($userSex != "") {
                $data['userSex'] = $userSex;
            }


            if ($userIDCard != "") {
                $data['userIDCard'] = $userIDCard;
            }else {
            	$data['userIDCard'] = '000000000000000000';
            }

            if ($userEntryTime != "") {
                $data['userEntryTime'] = $userEntryTime;
            }else {
            	$this->error('注册时间不能为空');
            }

            if ($userTypeID != "") {
                $data['userTypeID'] = $userTypeID;
            }else {
                $this->error('请选择用户类型');
            }
            
            if ($userBranchID != "") {
            	$data['userBranchID'] =$userBranchID;
            }else {
				$this->error('请选择用户网点');
            }

            if ($userRemark != "") {
                $data['userRemark'] = $userRemark;
            }else {
            	$data['userRemark'] = '无备注';
            }

            //dump($data);die();

            $data['updateTime']=date("Y-m-d H:i:s",time());



            $user_information = M('user_information');

            if($user_information ->select($id)){
                $data['userStatus'] = '1';
                $map['userID'] = $id;
                $res = $user_information->where($map)->save($data);
            }else{
                $res = $user_information->add($data);  
            }
            if ($userTypeID == 3) {
                    $role['user_id']=$id;
                    $role['role_id']=$userBranchID;
                    if (!M('role_user')->add($role)) {
                        $this->error("添加角色失败", U('Operation/create_add'));
                    }
                }

            if ($res) {
                $this->success("添加用户成功", U('Operation/read'));
            }else {
                $this->error("添加用户失败", U('Operation/create_add'));
            }
        }
        
        /*
         * 删除用户方法
         * 实现对用户的删除
         * 和前台页面read.html里面的<a>删除</a>相关
         * */
        public function delete () {
            $data['userStatus'] = 0;
            $where['userID'] = I('userID');
            $user_information = M('user_information');
            $res = $user_information->where($where)->save($data);
            if ($res) {
            	$this->success("删除用户成功", U('Operation/read'));
            }else {
            	$this->error("删除用户失败", U('Operation/read'));
            }
        }
        
        /*
         * 更新用户方法
         * 实现对用户信息的更改和更新
         * 和前台页面的update.html相关 
         */
        public function update () {
            $userID = I('userID');
            $field='userID,
                    userName,
                    userSex,
                    userIDCard,
                    userEntryTime,
                    userTypeID,
                    userBranchID,
                    userRemark';
            $user_information['userID'] = array('eq',$userID);
            $array = M('user_information')->where($user_information)->field($field)->select();
            
            if ($array == "") {
            	$this->error("数据为空...", U('Operation/read'));
            }else {

                $sale=M('sales_branch')->field('branchID,branchName')->select();
                foreach ($sale as $key => $value) {
                    $sale[$key]['pid']=1;
                }

                $install=M('install_branch')->field('branchID,branchName')->select();
                foreach ($install as $key => $value) {
                    $install[$key]['pid']=2;
                }

                $arr1 = array_merge($sale, $install);

                 $i=3;
                foreach ($arr1 as $key => $value) {
                    $arr[$i]=$arr1[$key];
                    $i++;
                }

                $role=M('role')->select();

                foreach ($role as $key => $value) {
                    $arr[$i]['branchID']=$value['id'];
                    $arr[$i]['pid']=$value['pid'];
                    $arr[$i]['branchName']=$value['remark'];
                    $i++;
                 }
                $this->arr=json_encode($arr);

            	$this->i = 1;
            	$this ->assign('userinfo',$array);
            	$this->display();
            }
        }
        
        /*
         * 查看用户方法
         * 实现对用户全部的查看
         * 里面涉及到对数据的分页处理
         * 和前台页面的read.html有关
         * */
        public function read () {

            $this->display();
        }
        
        /*
         * 用户数据保存方法
         * 实现对用户数据的保存
         * */
        public function save () {
            $oldid = I('oldid');
        	$userID = I('userID');
        	$userName = I('userName');
        	$userPassword = I('userPassword');
        	$userSex = I('userSex');
        	$userIDCard = I('userIDCard');
        	$userEntryTime = I('userEntryTime');
        	$userTypeID = I('x1');
        	$userBranchID = I('x2');
        	$userRemark = I('userRemark');
        	
        	if ($userID != "") {
        		$data['userID'] = $userID;
        	}
        	
        	if ($userName != "") {
        		$data['userName'] = $userName;
        	}
        	
        	if ($userPassword != "") {
        		$data['userPassword'] = $userPassword;
        	}
        	
        	if ($userSex != "") {
        		$data['userSex'] = $userSex;
        	}
        	
        	
        	if ($userIDCard != "") {
        		$data['userIDCard'] = $userIDCard;
        	}
        	
        	if ($userEntryTime != "") {
        		$data['userEntryTime'] = $userEntryTime;
        	}
        	
        	if ($userTypeID != "") {
        		$data['userTypeID'] = $userTypeID;
        	}
        	
        	if ($userBranchID != "") {
        		$data['userBranchID'] = $userBranchID;
        	}
        	
        	if ($userRemark != "") {
        		$data['userRemark'] = $userRemark;
        	}
        	
            $data['updateTime']=date("Y-m-d H:i:s",time());

        	$user_information = M('user_information');
        	$where['userID']= $oldid;
        	$res = $user_information->where($where)->save($data);

            //添加用户角色
            if ($userTypeID == 3) {
                $role['user_id']=$userID;
                $role['role_id']=$userBranchID;
                //清除原先角色
                if (!M('role_user')->where(array('user_id' => $oldid ))->delete()) {
                    $this->error("清除原先角色失败");                
                }
                if (!M('role_user')->add($role)) {
                    $this->error("添加角色失败");
                }
            }

        	if ($res) {
        		$this->success("更新用户成功", U('Operation/read'));
        	}else {
        		$this->error("更新用户失败", U('Operation/update', array('userID' => $oldid)));

        	}
        }
        
        /*
         * 查询用户方法
         * 通过条件查询用户
         * 和前台页面的read.html和update.html有关
         * */
        public function search () {
            $userID = I('userID');
            $userName = I('userName');
            $userTypeID = I('userTypeID');
            
            if ($userID != "") {
                $data['userID'] = $userID; 
            }
            
            if ($userName != "") {
                $data['userName'] = $userName;
            }
            
            if ($userTypeID != "") {
                $data['userTypeID'] = $userTypeID;
            }
            
            $data['userStatus'] = "1";
            
            $user_information = M('user_information');
            
            import('ORG.Util.Page');// 导入分页类
            $count = $user_information->where($data)->count();// 查询满足要求的总记录数 $map表示查询条件
            $Page  = new Page($count,10);// 实例化分页类 传入总记录数      
            $show  = $Page->show();// 分页显示输出
            $limit = $Page->firstRow.",".$Page->listRows;

            $array = $user_information->where($data)->limit($limit)->select();

            $this->userID = I('userID');
            $this->userName = I('userName');
            $this->userTypeID = I('userTypeID');

            foreach ($array as $key => $value) {
    
                if ($array[$key]['userTypeID']==3) {

                    $array[$key]['userBranchID']=M('role')->where(array('id'=>$value['userBranchID']))->getField('remark');

                }
            }


            $this->i = 1;
            $this -> assign('array', $array);
            $this -> assign('page',$show);// 赋值分页输出
            $this -> display();
        }
    }
?>
