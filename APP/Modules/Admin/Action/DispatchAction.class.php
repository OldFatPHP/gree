<?php 
	/*	
	*已接未派工，还没有指派师傅
	*1.index方法，显示安装待派工数据
	*2.editHandle，处理编辑请求
	*3.export,导出excel
	*/
	class DispatchAction extends CommonAction{
	
		
		public function index(){
			
		//	header("Content-Type: text/html; charset=utf-8");
			$salesClientName = trim(I('salesClientName',''));
			$salesClientPhone = trim(I('salesClientPhone',''));

		    $map['installStatus'] = 3;
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
	
	

		public function editHandle(){
			
			$installID = I('installID');
			$salesID  = I('salesID');

			$install['installBranchID'] = I('installBranchID');

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
			array('installBranchName','安装网点'),
			);

			$map['installStatus'] = 3;
			$data = select($map);

			$data = transfer($data);



			$this->exportExcel($xlsName,$xlsCell,$data);
			
	}





	}




 ?>