<?php 
	/*	
	*未完成，但是已派安装工单
	*/
	class NoInstallAction extends CommonAction{
	
		/*
		*未完成安装工单首页
		* index（）显示未完成安装工单
		 */
		public function index(){
			$salesClientName = trim(I('salesClientName',''));
			$salesClientPhone = trim(I('salesClientPhone',''));
			
		   // import('ORG.Util.Page');// 导入分页类
		    $map['installStatus'] = 4;
		    if ($salesClientName != '') $map['salesClientName'] = $salesClientName;
			if ($salesClientPhone != '') $map['salesClientPhone'] = $salesClientPhone;

		    $Page = paging($map,10);
		    $show = $Page->show();// 分页显示输出


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
	
	

		public function noInstallHandle(){	
			header("Content-Type: text/html; charset=utf-8");		
			if(!$this->isPost()){
				$this->success('请登录',U('Login/Index'));
			}
			//dump (I('installIDs'));
		//	dump(I());die;
			$installID = I('installID');
			$installUserStand = I('installUserStand');
			$installFeedback = I('installFeedback');
			$installFeedbackRemark = I('installFeedbackRemark');
			$installNewSystem = I('installNewSystem');
			$installTransferSettlement = I('installTransferSettlement');
			if(I('installTransferSettlementDate')){
				$installTransferSettlementDate = I('installTransferSettlementDate');
			}			
			if($installTransferSettlement && !$installTransferSettlementDate){
				$this->error('转结算日期不能为空！');
			}
			
			$installRemark = I('installRemark');

			if($installFeedback ==''){
				$this->error('请填写反馈类型',U('index'));die();
			}else if($installFeedback!='1' &&$installFeedbackRemark == ''){
				$this->error('请填写反馈情况',U('index'));die();
			}

			if($installFeedback == 1){
				$update['installStatus'] = 5;
			}else{
				$update['installStatus'] = 10;
			}

			
			$update['installUserStand'] = $installUserStand;
			$update['installFeedback'] = $installFeedback;
			$update['installFeedbackRemark'] = $installFeedbackRemark;
			$update['installNewSystem'] = $installNewSystem;
			$update['installTransferSettlement'] = $installTransferSettlement;
			$update['installTransferSettlementDate'] = $installTransferSettlementDate;
			$update['installRemark'] = $installRemark;

				$where['installID'] = $installID ;
				$data = M('install_information')->where($where)->save($update);
				if(!$data){
					$this->error('反馈失败，请稍后重试！',U('index'));die();
				}


			$this->success('反馈成功，请安装完成中查看',U('index'));
				
		}

		public function editTime(){
			$map['installBranchID'] = session('branchID');
			$map['installID'] = I('id');
			$map['installStatus'] = 4;
		//	dump($map);die;
			$data = select($map,$limit);
		//	dump($data);die;
			$this->assign('list',$data);
			$this->display();
		}

		public function editHandle(){
			
			$installID = I('installID');
			
			$install['installPersonName'] = I('installPersonName');
			$install['installPersonPhone'] = I('installPersonPhone');
			$map['installID'] = $installID;
			
			$installModel = M('install_information');
			$wordi = $installModel->where($map)->save($install);

			
			$salesID  = I('salesID');
			$sales['salesInstallTime']   = I('salesInstallTime');

			$salesModel = M('sales_information');
			$where['salesID'] = $salesID;
			$word = $salesModel->where($where)->save($sales);
				
						
			if($wordi || $word){
				$this->success('成功','index');die;
			}
			else{
				$this->error('失败','index');die;
			}
			

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
			);


			$model = new Model();
			$data=$model->query($sql);

			$map['installStatus'] = 4;
			$data = select($map);


			$data = transfer($data);
/*				  echo  $model->getLastSql(); 
				  dump($data);die;*/

			$this->exportExcel($xlsName,$xlsCell,$data);
			
		}

	}

 ?>