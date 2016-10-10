<?php 
	/*	
	*未接安装工单，总公司派下来的工单，未接
	*/
	class ReceiveAction extends CommonAction{
	

		public function index(){
			$salesClientName = trim(I('salesClientName',''));
			$salesClientPhone = trim(I('salesClientPhone',''));

		   // import('ORG.Util.Page');// 导入分页类
		    $map['installStatus'] = 2;
		    if ($salesClientName != '') $map['salesClientName'] = $salesClientName;
			if ($salesClientPhone != '') $map['salesClientPhone'] = $salesClientPhone;

		    $Page = paging($map,10);
		    $show = $Page->show();// 分页显示输出

			
			$map['installStatus'] = '2';
			$limit = $Page->firstRow.",".$Page->listRows;
			$data = select($map,$limit);


			//根据$data里的salesModelID查询出提成
			// $a = M('product_m');
			// for($i=0;$i<count($data);$i++){
			// 	$where['pid'] = $data[$i]['salesModelID'];
			// 	$data5 = $a->where($where)->field('pid,installCommission')->select();
			// 	$data[$i]['installCommission'] = $data5[0]['installCommission'];
			// }

/*		dump($data);
		die();
*/

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
	
	

		public function receiveHandle(){			
			if(!$this->isPost()){
				$this->success('请登录',U('Login/Index'));die();
			}
			//dump (I('installIDs'));
			$IDs = I('installIDs');
			$update['installStatus'] = 3;
			for($i=0;$i<count($IDs);$i++){
				
				$where['installID'] = $IDs[$i] ;
				$data = M('install_information')->where($where)->save($update);
				if(!$data){
					$this->error('接收失败，请稍后重试！',U('index'));die();
				}

			}
			$this->success('接收成功，请前往未派工中查看',U('index'));
				
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

			);
			
			$map['installStatus'] = '2';
			$data = select($map);
 
 			$data = transfer($data);
			$this->exportExcel($xlsName,$xlsCell,$data);
		}


	}




 ?>