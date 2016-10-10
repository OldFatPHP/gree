<?php
	/*
	*视图模型
	* 
	 */
class   InstallViewModel  extends ViewModel {
		//视图包含的字段
		public $viewFields = array(

		     'install_information'=>array('*'),
		    
		     'sales_information'=>array('*','_on'=>'sales_information.salesID=install_information.installSalesID'),

		     'sales_branch'=>array('*', '_on'=>'sales_information.salesBranchID=sales_branch.branchID'),

		     'install_branch'=>array('branchName'=>'installBranchName', '_on'=>'install_information.installBranchID=install_branch.branchID'),
		    	  
		     'product'=>array('name'=>'modelName', '_on'=>'sales_information.salesModelID=product.id'),

		      'product_m'=>array('installCommission', '_on'=>'product_m.pid=sales_information.salesModelID'),

		      'user_information'=>array('userTypeID','_on'=>'user_information.userID=sales_information.salesPersonID'),
	   		  );
		}



?>