<?php 
	/*	
	*编辑操作
	*/
	class EditAction extends CommonAction{


			public function index(){			
		
			$installID = I('installID');
			$sql = " select a.*,b.*,c.branchName,d.modelName,e.branchName as installBranchName from sales_information as a,install_information as b , sales_branch as c ,product_model as d ,install_branch as e where a.salesID=b.installSalesID and a.salesBranchID=c.branchID and d.modelID = a.salesModelID and e.branchID =b.installBranchID and b.installID = $installID and status =1  ";
			$model = new Model();
			$data = $model->query($sql);
			$this->assign('list',$data);
		//	dump($data);die();
			$this->display();
				
			}

			public function EditHandle(){
				if(!$this->isPost()){
				$this->error('请登录',U('Login/Index'));die();
				}

				//dump(I());die;





			}

	}