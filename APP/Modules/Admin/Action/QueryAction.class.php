<?php
	/*	
	*工单查询
	*1.index方法，显示待审批改派工单数据
	*2.queryHandle方法,处理查询请求，返回查询数据
	*3.editHandle，处理编辑请求
	*4.export,导出excel
	*/
class QueryAction extends CommonAction {
	
	function  index(){

		//获取安装网点名字
		    $m = M('install_branch');
		    $branchName = $m->field('branchID,branchName')->select();
		    $this->assign('branchName',$branchName);  // 安装网点信息输出

		$this->display();

	}

	
		public function queryHandle(){
		/*	if(!$this->isPost()){
				$this->error('请登录！',U('Login/index'));dei();
			}*/
			$installID = I('installID');
			$installSalesID =I('saleID');
			$salesClientPhone= I('salesClientPhone');
			$salesClientName= I('salesClientName');
			$installStatus= I('installStatus');
			$installPersonName = I('installPersonName');
			$installBranchID = I('installBranchID');
			$salesInstallTimeBegin= I('salesInstallTimeBegin');
			$salesInstallTimeEnd= I('salesInstallTimeEnd')." 23:59:59";
			$salesCreateTimeBegin= I('salesCreateTimeBegin');
			$salesCreateTimeEnd= I('salesCreateTimeEnd')." 23:59:59";
			$salesDispatchTimeBegin= I('salesDispatchTimeBegin');
			$salesDispatchTimeEnd= I('salesDispatchTimeEnd')." 23:59:59";
			$salesEndTimeBegin= I('salesEndTimeBegin');
			$salesEndTimeEnd= I('salesEndTimeEnd')." 23:59:59";

			$salesBuyTimeBegin= I('salesBuyTimeBegin');
			$salesBuyTimeEnd= I('salesBuyTimeEnd')." 23:59:59";
			
			


			


			if($installID!=''){	
				$map['installID'] = $installID;
			}
			if($installSalesID!=''){
				$map['installSalesID'] = $installSalesID;
			}
			if($salesClientPhone!=''){
				$map['salesClientPhone'] = $salesClientPhone;
			}
			if($salesClientName!=''){
				$map['salesClientName'] = $salesClientName;
			}
			if($installPersonName!=''){
				$map['installPersonName'] = $installPersonName;	
			}		
			if($installBranchID!=''){
				$map['installBranchID'] = $installBranchID;	
			}	
			if($installStatus!=''){
				$map['installStatus'] = $installStatus;	
			}
			if($salesInstallTimeBegin!='' && $salesInstallTimeEnd!=''){
				$map['salesInstallTime'] = array('between',array($salesInstallTimeBegin,$salesInstallTimeEnd));
			}
			if($salesCreateTimeBegin!='' && $salesCreateTimeEnd!=''){
				$map['installCreateTime'] = array('between',array($salesCreateTimeBegin,$salesCreateTimeEnd));
			}
			if($salesDispatchTimeBegin!='' && $salesDispatchTimeEnd!=''){
				$map['installDispatchTime'] = array('between',array($salesDispatchTimeBegin,$salesDispatchTimeEnd));
			}
			if($salesEndTimeBegin!='' && $salesEndTimeEnd!=''){
				$map['installEndTime'] = array('between',array($salesEndTimeBegin,$salesEndTimeEnd));
			}
			if($salesBuyTimeBegin!='' && $salesBuyTimeEnd!=''){
				$map['salesBuyTime'] = array('between',array($salesBuyTimeBegin,$salesBuyTimeEnd));
			}



	    
		    $Page       =  paging($map,10);
		    $show       = $Page->show();// 分页显示输出

		    
			$limit = $Page->firstRow.",".$Page->listRows;
			
			$data = select($map,$limit);

			// dump($data);die();

			if($data ==null){
				echo "暂无数据！";
			}
			else{
				// dump($data);die;
				$data = transfer($data);
				$this->i = 1;
				$this->assign('list',$data);
				$this->assign('page',$show);// 赋值分页输出
			}
			
			

		//	dump($data);die();
		//获取安装网点名字
				  $m = M('install_branch');
				  $branchName = $m->field('branchID,branchName')->select();
				  $this->assign('branchName',$branchName);  // 安装网点信息输出
				  
			$this->i = 1;
			$this->assign('list',$data);
			$this->assign('page',$show);// 赋值分页输出
			$this->installID = I('installID');
			$this->saleID =I('saleID');
			$this->salesClientPhone= I('salesClientPhone');
			$this->salesClientName= I('salesClientName');
			$this->installStatus= I('installStatus');
			$this->installPersonName = I('installPersonName');
			$this->salesInstallTimeBegin= I('salesInstallTimeBegin');
			$this->salesInstallTimeEnd= I('salesInstallTimeEnd');
			$this->salesCreateTimeBegin= I('salesCreateTimeBegin');
			$this->salesCreateTimeEnd= I('salesCreateTimeEnd');
			$this->salesDispatchTimeBegin= I('salesDispatchTimeBegin');
			$this->salesDispatchTimeEnd= I('salesDispatchTimeEnd');
			$this->salesEndTimeBegin= I('salesEndTimeBegin');
			$this->salesEndTimeEnd= I('salesEndTimeEnd');
			$this->installBranchID= I('installBranchID');
			$this->salesBuyTimeBegin= I('salesBuyTimeBegin');
			$this->salesBuyTimeEnd= I('salesBuyTimeEnd');
			$this->display('index');

		}


		public function editHandle(){
			
			$installID = I('installID');
			$salesID  = I('salesID');

			$install['installBranchID'] = I('installBranchID');
			$install['installPersonName'] = I('installPersonName');
			$install['installPersonPhone'] = I('installPersonPhone');

			$install['installFeedback'] = I('installFeedback');
			$install['installFeedbackRemark'] = I('installFeedbackRemark');
			$install['installNewSystem'] = I('installNewSystem');
			$install['installTransferSettlement'] = I('installTransferSettlement');
			$install['installTransferSettlementDate'] = I('installTransferSettlementDate');
			$install['installUserStand'] = I('installUserStand');

			$sales['salesCashback']  = I('salesCashback');
			$sales['salesStand']  = I('salesStand');
			$sales['salesInstallTime']   = I('salesInstallTime');
			$sales['salesClientName']   = I('salesClientName');
			$sales['salesClientPhone']   = I('salesClientPhone');
			$sales['salesPersonAddress']   = I('salesPersonAddress');		

			$this->editSubmit($install,$installID,$sales,$salesID);



		}

		

		
	public function export(){
			$xlsName  = "User";
			$xlsCell  = array(
			array('installID','安装编号'),
			array('salesBuyTime','购买日期'),
			array('salesInstallTime','安装日期'),
			array('installCreateTime','创建时间'),
			array('installDispatchTime','派工时间'),
			array('installEndTime','关闭时间'),
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
			array('installPersonName','安装人员名字'),
			array('installPersonPhone','安装人员手机号'),
			array('installUserStand','是否使用支架'),
			array('installFeedback','反馈类型'),
			array('installFeedbackRemark','反馈情况'),
			array('installNewSystem','是否在新系统体现工单'),
			array('installTransferSettlement','是否已转结算'),
			array('installTransferSettlementDate','转结算日期'),
			array('installStatus','安装状态'),
			array('installBranchName','安装网点'),
			array('installRemark','备注')
			);

			$installID = I('installID');
			$installSalesID =I('saleID');
			$salesClientPhone= I('salesClientPhone');
			$salesClientName= I('salesClientName');
			$installStatus= I('installStatus');
			$installPersonName = I('installPersonName');
			$installBranchID = I('installBranchID');
			$salesInstallTimeBegin= I('salesInstallTimeBegin');
			$salesInstallTimeEnd= I('salesInstallTimeEnd')." 23:59:59";
			$salesCreateTimeBegin= I('salesCreateTimeBegin');
			$salesCreateTimeEnd= I('salesCreateTimeEnd')." 23:59:59";
			$salesDispatchTimeBegin= I('salesDispatchTimeBegin');
			$salesDispatchTimeEnd= I('salesDispatchTimeEnd')." 23:59:59";
			$salesEndTimeBegin= I('salesEndTimeBegin');
			$salesEndTimeEnd= I('salesEndTimeEnd')." 23:59:59";
			$salesBuyTimeBegin= I('salesBuyTimeBegin');
			$salesBuyTimeEnd= I('salesBuyTimeEnd')." 23:59:59";
			


			if($installID!=''){	
				$map['installID'] = $installID;
			}
			if($installSalesID!=''){
				$map['installSalesID'] = $installSalesID;
			}
			if($salesClientPhone!=''){
				$map['salesClientPhone'] = $salesClientPhone;
			}
			if($salesClientName!=''){
				$map['salesClientName'] = $salesClientName;
			}
			if($installPersonName!=''){
				$map['installPersonName'] = $installPersonName;	
			}		
			if($installBranchID!=''){
				$map['installBranchID'] = $installBranchID;	
			}	
			if($installStatus!=''){
				$map['installStatus'] = $installStatus;	
			}
			if($salesInstallTimeBegin!='' && $salesInstallTimeEnd!=''){
				$map['salesInstallTime'] = array('between',array($salesInstallTimeBegin,$salesInstallTimeEnd));
			}
			if($salesCreateTimeBegin!='' && $salesCreateTimeEnd!=''){
				$map['installCreateTime'] = array('between',array($salesCreateTimeBegin,$salesCreateTimeEnd));
			}
			if($salesDispatchTimeBegin!='' && $salesDispatchTimeEnd!=''){
				$map['installDispatchTime'] = array('between',array($salesDispatchTimeBegin,$salesDispatchTimeEnd));
			}
			if($salesEndTimeBegin!='' && $salesEndTimeEnd!=''){
				$map['installEndTime'] = array('between',array($salesEndTimeBegin,$salesEndTimeEnd));
			}
			if($salesBuyTimeBegin!='' && $salesBuyTimeEnd!=''){
				$map['salesBuyTime'] = array('between',array($salesBuyTimeBegin,$salesBuyTimeEnd));
			}


	    
			$data = select($map);
				//  echo  $model->getLastSql(); 
				  //dump($data);die;
			$data = transfer($data);

			$this->exportExcel($xlsName,$xlsCell,$data);
			
	}


}