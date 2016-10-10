<?php
	/*
	*已接未派工 控制器
	*总公司指派下来的安装工单，还没分派到具体师傅的
	* 
	 */
	
	class DispatchAction extends CommonAction{

		/*
		*	已接未派工 首页 ，显示全部未派工信息
		 */

		public function index(){
			$salesClientName = trim(I('salesClientName',''));
			$salesClientPhone = trim(I('salesClientPhone',''));

		    //import('ORG.Util.Page');// 导入分页类
		    $map['installStatus'] = 3;
		    if ($salesClientName != '') $map['salesClientName'] = $salesClientName;
			if ($salesClientPhone != '') $map['salesClientPhone'] = $salesClientPhone;

		    $Page = paging($map,10);
		    $show = $Page->show();// 分页显示输出

			$limit = $Page->firstRow.",".$Page->listRows;
			$data = select($map,$limit);

/*			dump($data);
			die();*/

			if($data ==null){
				echo "暂无数据！";
			}
			else{
				$data = transfer($data);
				$this->i = 1;
				$this->assign('list',$data);
			
			$this->salesClientName = $salesClientName;
			$this->salesClientPhone = $salesClientPhone;
			$this->assign('page',$show);// 赋值分页输出
			$this->display();
			}


		}

		/*
		*	指派安装工人请求处理
		 */
		public function dispatchHandle(){
			header("Content-type: text/html; charset=utf-8"); 
			
			if(!$this->isPost()){
				$this->success('请登录',U('Login/index'));die();
			}
			$installPersonName = I('installPersonName');
			$installPersonPhone= I('installPersonPhone');

			if($installPersonName == null){
				$this->error('安装人员名字不能为空',U(index));die();
			}
			$installID = I('installID');
			$where['installID'] = $installID ;
	//		echo $installID.$installPersonName.$installPersonPhone;die();

			    // 要修改的数据对象属性赋值
			     $data['installPersonName'] = $installPersonName;
			     $data['installStatus'] = 4;

			     if($installPersonPhone !=null){
			     	$data['installPersonPhone'] = $installPersonPhone;
			     }

				 
			     // 根据条件保存修改的数据
				if (M('install_information')->where($where)->save($data) ){
					$this->success('派工成功，请前往安装未完成中查看',U('index'));
				} else{
					$this->error('操作失败，请稍后重试！',U('index'));
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

			);


			$map['installStatus'] = 3;	
			$data = select($map);


			$data = transfer($data);
/*				  echo  $model->getLastSql(); 
				  dump($data);die;*/

			$this->exportExcel($xlsName,$xlsCell,$data);
			
		}

	}

?>