<?php
	/*
	*视图模型
	* 
	 */
class   SalesViewModel  extends ViewModel {
		//视图包含的字段
		public $viewFields = array(

		     'sales_information'=>array('*'),
			
			 'product'=>array('*','_on'=>'product.id=sales_information.salesModelID'),
		     
		     'product_m'=>array('*', '_on'=>'product_m.pid=product.id'),

		     'sales_branch'=>array('*', '_on'=>'sales_information.salesBranchID=sales_branch.branchID'),

		     'user_information'=>array('*','_on'=>'user_information.userID=sales_information.salesPersonID'),
		     
		     'install_information'=>array('*','_on'=>'install_information.installSalesID=sales_information.salesID'),


	   		  );
		}



?>