<?php 
	/*	
	*待审核改派
	*1.index方法，显示待审批改派工单数据
	*2.editHandle，处理编辑请求
	*3.export,导出excel
	*4.PendingShow,显示改派页面
	*5.PendingHandle,处理改派请求
	*/
	class PendingAction extends CommonAction{
	
		public function index(){
			$salesClientName = trim(I('salesClientName',''));
			$salesClientPhone = trim(I('salesClientPhone',''));

			$map['installStatus'] = 10;		
			if ($salesClientName != '') $map['salesClientName'] = $salesClientName;
			if ($salesClientPhone != '') $map['salesClientPhone'] = $salesClientPhone;
	    
		    $Page       =  paging($map,10);
		    $show       = $Page->show();// 分页显示输出

			$limit = $Page->firstRow.",".$Page->listRows;
			$data = select($map,$limit);

			// dump($data);die();

			if($data ==null){
				echo "暂无数据！";
			}
			else{
				$data = transfer($data);
				$this->i = 1;
				$this->salesClientName = $salesClientName;
				$this->salesClientPhone = $salesClientPhone;
				$this->assign('list',$data);
				$this->assign('page',$show);// 赋值分页输出
				$this->display();
			}
			
			


		}
	
/*	public function edit(){			
		
			$installID = I('installID');
			b.installID = $installID 
			$sql = " select a.*,b.*,c.branchName,d.modelName,e.branchName as installBranchName from sales_information as a,install_information as b , sales_branch as c ,product_model as d ,install_branch as e where a.salesID=b.installSalesID and a.salesBranchID=c.branchID and d.modelID = a.salesModelID and e.branchID =b.installBranchID and b.installID = $installID  ";
			$model = new Model();
			$data = $model->query($sql);
			$this->assign('list',$data);
		//	dump($data);die();
			$this->display();
				
			

		}*/

		public function PendingShow(){			
		
			$installID = I('id');	
			$map['installID'] = $installID;
			$data = select($map);
			$this->assign('list',$data);
			
			//获取安装网点名字
			$m = M('install_branch');
			$branchName = $m->field('branchID,branchName')->select();
			$this->assign('branchName',$branchName);  // 安装网点信息输出
			
			$this->display();
				
		}


		public function PendingHandle(){
			if(!$this->isPost()){
				$this->success('请登录',U('Login/Index'));die();
			}

			//更新sales_information表数据
			$where['salesID'] = I('salesID');
			$data['salesInstallTime'] = I('salesInstallTime');
			$data['salesClientName'] = I('salesClientName');
			$data['salesClientPhone'] = I('salesClientPhone');
			$data['salesPersonTelePhone'] = I('salesPersonTelePhone');
			$data['salesPersonAddress'] = I('salesPersonAddress');

			$word = M('sales_information')->where($where)->save($data);

			//更新install_information表数据
			$data2['installBranchID'] = I('installBranchID');
			$data2['installStatus'] = 2;

			$data2['installTransferSettlement'] = NULL;
			$data2['installPersonName'] = NULL;
			$data2['installPersonPhone'] = NULL;
			$data2['installFeedback'] = NULL;
			$data2['installRemark'] = NULL;
			$data2['installTransferSettlementDate'] = NULL;
			$data2['installUserStand'] = NULL;
			$data2['installNewSystem'] = NULL;
			$data2['installFeedbackRemark'] = NULL;


			$where2['installID'] = I('installID');

			$word2 = M('install_information')->where($where2)->save($data2);

			if($word || $word2){
				$this->success('改派成功',U('index'));
			}else{
				$this->error('改派失败',U('index'));
			}





		}


		public function export(){
			$xlsName  = "User";
			$xlsCell  = array(
			array('installID','安装编号'),
			array('salesBuyTime','购买日期'),
			array('salesInstallTime','安装日期'),
			array('installCreateTime','创建时间'),
			array('installDispatchTime','派工时间'),
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
			array('installPersonName','安装人员'),
			array('installPersonPhone','安装人员手机'),
			array('installStatus','安装状态'),
			array('installBranchName','安装网点'),
			array('installFeedback','反馈类型'),
			array('installFeedbackRemark','反馈情况'),


			);

			$map['installStatus'] = 10;		 
			$data = select($map);
			$data = transfer($data);
			
/*				  echo  $model->getLastSql(); 
				  dump($data);die;*/

			$this->exportExcel($xlsName,$xlsCell,$data);
			
		}





	}




 ?>