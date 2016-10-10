<?php

class QueryAction extends CommonAction {
	
	function  index(){
		$this->display();

	}

	
		public function queryHandle(){
		/*	if(!$this->isPost()){
				$this->error('请登录！',U('Login/index'));dei();
			}*/
			$installID = I('installID');
			$saleID =I('saleID');
			$salesClientPhone= I('salesClientPhone');
			$salesClientName= I('salesClientName');
			$installStatus= I('installStatus');
			$installPersonName = I('installPersonName');
			$salesInstallTimeBegin= I('salesInstallTimeBegin');
			$salesInstallTimeEnd= I('salesInstallTimeEnd')." 23:59:59";
			$salesCreateTimeBegin= I('salesCreateTimeBegin');
			$salesCreateTimeEnd= I('salesCreateTimeEnd')." 23:59:59";
			$salesDispatchTimeBegin= I('salesDispatchTimeBegin');
			$salesDispatchTimeEnd= I('salesDispatchTimeEnd')." 23:59:59";
			$salesBuyTimeBegin= I('salesBuyTimeBegin');
			$salesBuyTimeEnd= I('salesBuyTimeEnd')." 23:59:59";



			if($installID!=''){
				$map['installID'] = $installID;
			}
			if($saleID!=''){
				$map['saleID'] = $saleID;
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
			if($salesBuyTimeBegin!='' && $salesBuyTimeEnd!=''){
				$map['salesBuyTime'] = array('between',array($salesBuyTimeBegin,$salesBuyTimeEnd));
			}



		    $Page = paging($map,10);
		    $show = $Page->show();// 分页显示输出


			$limit = $Page->firstRow.",".$Page->listRows;
			$data = select($map,$limit);


			$data = transfer($data);
			
			// //根据$data2里的salesModelID查询出提成
			// $a = M('product_m');
			// for($i=0;$i<count($data);$i++){
			// 	$where['pid'] = $data[$i]['salesModelID'];
			// 	$data5 = $a->where($where)->field('pid,installCommission')->select();
			// 	$data[$i]['installCommission'] = $data5[0]['installCommission'];
			// }


			// dump($data);die();
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
			$this->salesBuyTimeBegin= I('salesBuyTimeBegin');
			$this->salesBuyTimeEnd= I('salesBuyTimeEnd');
			$this->display('index');

		}


	public function export(){
			$xlsName  = "User";
			$xlsCell  = array(
			array('installID','安装编号'),
			array('salesInstallTime','安装日期'),
			array('salesBuyTime','购买日期'),
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
			array('installPersonName','安装人员名字'),
			array('installPersonPhone','安装人员手机号'),
			array('installUserStand','是否使用支架'),
			array('installFeedback','反馈类型'),
			array('installFeedbackRemark','反馈情况'),
			array('installNewSystem','是否在新系统体现工单'),
			array('installTransferSettlement','是否已转结算'),
			array('installTransferSettlementDate','转结算日期'),
			array('installStatus','安装状态'),
			array('installRemark','备注')
			);


			$installID = I('installID');
			$saleID =I('saleID');
			$salesClientPhone= I('salesClientPhone');
			$salesClientName= I('salesClientName');
			$installStatus= I('installStatus');
			$installPersonName = I('installPersonName');
			$salesInstallTimeBegin= I('salesInstallTimeBegin');
			$salesInstallTimeEnd= I('salesInstallTimeEnd')." 23:59:59";
			$salesCreateTimeBegin= I('salesCreateTimeBegin');
			$salesCreateTimeEnd= I('salesCreateTimeEnd')." 23:59:59";
			$salesDispatchTimeBegin= I('salesDispatchTimeBegin');
			$salesDispatchTimeEnd= I('salesDispatchTimeEnd')." 23:59:59";
			$salesBuyTimeBegin= I('salesBuyTimeBegin');
			$salesBuyTimeEnd= I('salesBuyTimeEnd')." 23:59:59";



			if($installID!=''){
				$map['installID'] = $installID;
			}
			if($saleID!=''){
				$map['saleID'] = $saleID;
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
			if($salesBuyTimeBegin!='' && $salesBuyTimeEnd!=''){
				$map['salesBuyTime'] = array('between',array($salesBuyTimeBegin,$salesBuyTimeEnd));
			}





			$data = select($map);


			$data = transfer($data);
				//  echo  $model->getLastSql(); 
				
				//根据$data2里的salesModelID查询出提成
			$a = M('product_m');
			for($i=0;$i<count($data);$i++){
				$where['pid'] = $data[$i]['salesModelID'];
				$data5 = $a->where($where)->field('pid,installCommission')->select();
				$data[$i]['installCommission'] = $data5[0]['installCommission'];
			}

				  // dump($data);die;

			$this->exportExcel($xlsName,$xlsCell,$data);
			
	}


}