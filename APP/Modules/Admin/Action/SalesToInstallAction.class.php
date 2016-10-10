<?php
	/*	
	*安装待派工，还没有下派到安装网点
	*1.index方法，显示待审批改派工单数据
	*2.editHandle，处理编辑请求
	*3.handle,处理指派网点请求
	*4.export,导出excel
	*/
	class SalesToInstallAction extends CommonAction{
		
		public function index(){			
		//	header("Content-Type: text/html; charset=utf-8");
			

			$salesClientName = trim(I('salesClientName',''));
			$salesClientPhone = trim(I('salesClientPhone',''));


			
		    
		   
		    //获取安装网点名字
		    $m = M('install_branch');
		    $branchName = $m->field('branchID,branchName')->select();
		    $this->assign('branchName',$branchName);  // 安装网点信息输出



		    $map['status'] = '1';
			$map['installStatus'] = '1';
			if ($salesClientName != '') $map['salesClientName'] = $salesClientName;
			if ($salesClientPhone != '') $map['salesClientPhone'] = $salesClientPhone;

			$model = D('SalesToInstallView'); 



		    import('ORG.Util.Page');// 导入分页类
		    $count = $model->where($map)->count();// 查询满足要求的总记录数 $map表示查询条件
		    $Page  = new Page($count,10);// 实例化分页类 传入总记录数
				   
		    $show       = $Page->show();// 分页显示输出

			$limit = $Page->firstRow.",".$Page->listRows;

			$data = $model->where($map)->limit($limit)->select();

			// dump($data);die();

			if($data ==null){
				echo "暂无数据！";
			}
			else{
				 // dump($data);die;
				$data = transfer($data);
				$this->i = 1;
				$this->salesClientName = $salesClientName;
				$this->salesClientPhone = $salesClientPhone;
				$this->assign('list',$data);
				$this->assign('page',$show);// 赋值分页输出
				$this->display();
			}
			


		}




		public function editHandle(){
			
			$installID = I('installID');
			$salesID  = I('salesID');

			$sales['salesCashback']  = I('salesCashback');
			$sales['salesStand']  = I('salesStand');
			$sales['salesInstallTime']   = I('salesInstallTime');
			$sales['salesClientName']   = I('salesClientName');
			$sales['salesClientPhone']   = I('salesClientPhone');
			$sales['salesPersonAddress']   = I('salesPersonAddress');		

			$this->editSubmit($install,$installID,$sales,$salesID);



		}


		public function edit(){			
		
			$installID = I('id');
			$map['installID'] = $installID;

			$model = D('SalesToInstallView'); 
			$data = $model->where($map)->select();






			for($n=0;$n<count($data);$n++){
					if(empty($data)){
						break;
					}


					switch ($data[$n]['installStatus']) {
						case '2': $data[$n]['installStatus'] ='未接收';
							break;
						case '3': $data[$n]['installStatus'] ='未指派';
							break;
						case '4': $data[$n]['installStatus'] ='未完成';
							break;
						case '5': $data[$n]['installStatus'] ='报完工';
							break;
						case '6': $data[$n]['installStatus'] ='待关闭';
							break;
						case '7': $data[$n]['installStatus'] ='已关闭';
							break;
						case '10': $data[$n]['installStatus'] ='未审核';
							break;
						
						default:
							break;
					}


					switch ($data[$n]['installFeedback']) {
						case '1': $data[$n]['installFeedback'] ='安装完工';
							break;
						case '2': $data[$n]['installFeedback'] ='用户改约';
							break;
						case '3': $data[$n]['installFeedback'] ='无法正常完工';
							break;
						case '4': $data[$n]['installFeedback'] ='请求改派';
							break;
						case '5': $data[$n]['installFeedback'] ='其他';
							break;
						
						default:

							break;
					}

				  }






			$m = M('install_branch');
		    $branchName = $m->field('branchID,branchName')->select();
		    $this->assign('branchName',$branchName);  // 安装网点信息输出


		    
			$this->assign('list',$data);
		//	dump($data);die();
			$this->display();
				
			}

		public function handle(){

			$installID = I('installID');
			if($installID==''){
				$this->error('请选择至少一项',U('index'));die;
			}

			$installBranchID = I('installBranchID');
			if($installBranchID==''){
				$this->error('请选择安装网点',U('index'));die;
			}
			$data['installBranchID'] = $installBranchID;
			$model = M('install_information');
			$data['installDispatchTime'] = date('Y-m-d H:i:s');
			$data['installStatus'] = 2;
			for($i=0;$i<count($installID);$i++){
				$where['installID'] = $installID[$i];
				$word = $model->where($where)->save($data);
			//	echo $model->getLastSql();die;
				if(!$word){
					$this->error('指派失败',U('index'));die;
				}
			}
			$this->success('指派成功',U('index'));

		}



		public function export(){
			$xlsName  = "User";
			$xlsCell  = array(
			array('installID','安装编号'),
			array('salesBuyTime','购买日期'),
			array('salesInstallTime','安装日期'),
			array('installCreateTime','创建时间'),
			array('branchName','购买商场'),
			array('modelName','购买型号'),
			array('salesProductNum','数量'),
			array('salesClientName','顾客姓名'),
			array('salesClientPhone','顾客手机'),
			array('salesPersonTelePhone','顾客固话'),
			array('salesPersonAddress','顾客地址'),
			array('salesRemark','返现金额'),
			array('salesCashback','是否有返现活动'),
			array('salesStand','是否使用支架'),
			array('installStatus','安装状态'),

			);


			
			$map['status'] = '1';
			$map['installStatus'] = '1';

			/*$data = select($map);*/
			$model = D('SalesToInstallView'); 
			$data = $model->where($map)->select();

			$data = transfer($data);
			
/*				  echo  $model->getLastSql(); 
				  dump($data);die;*/

			$this->exportExcel($xlsName,$xlsCell,$data);
			
		}


	}


?>