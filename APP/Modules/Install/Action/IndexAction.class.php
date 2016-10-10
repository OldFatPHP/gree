<?php 
class IndexAction extends CommonAction{
	//首页视图
	public function index(){
		$user=array();
		$user['id']=session('userID');
		$user['name']=session('userName');
		

		$this->Receive=M('install_information')->where(array('installStatus' =>2,'installBranchID' => session('branchID'),'status'=>1))->count();
		$this->Dispatch=M('install_information')->where(array('installStatus' =>3,'installBranchID' => session('branchID'),'status'=>1))->count();
		$this->NoInstall=M('install_information')->where(array('installStatus' =>4,'installBranchID' => session('branchID'),'status'=>1))->count();

		$this->user=$user;
		$this->branchName=session('branchName');
		$this->display();
	}
}







?>