<?php 
	/*	
	*已关闭工单
	*1.index方法，显示已关闭数据
	*2.editHandle方法，处理编辑请求
	*3.export 导出方法 ，导出excel表格
	*/
	class CloseAction extends CommonAction{
	
		
		public function index(){
			$salesClientName = trim(I('salesClientName',''));
			$salesClientPhone = trim(I('salesClientPhone',''));

		    $map['installStatus'] = 7;
		    if ($salesClientName != '') $map['salesClientName'] = $salesClientName;
			if ($salesClientPhone != '') $map['salesClientPhone'] = $salesClientPhone;

		    $Page       =  paging($map,10);
		    $show       = $Page->show();// 分页显示输出

			$limit = $Page->firstRow.",".$Page->listRows;
			$data = select($map,$limit);

			//dump($map);dump($data);die();

			if($data == null){
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


			$map['installStatus'] = 7;
			$data = select($map);
			$data = transfer($data);

			$this->exportExcel($xlsName,$xlsCell,$data);
			
	}




	}




 ?>