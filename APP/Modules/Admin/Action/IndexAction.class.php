<?php 
class IndexAction extends CommonAction{
	//首页视图
	public function index(){
		$user=array();
		$user['id']=session('userID');
		$user['name']=session('userName');

		$this->SalesToInstall=M('install_information')->where(array('installStatus'=>1,'status'=>1))->count();
		$this->Receive=M('install_information')->where(array('installStatus'=>2,'status'=>1))->count();
		$this->Dispatch=M('install_information')->where(array('installStatus'=>3,'status'=>1))->count();
		$this->NoInstall=M('install_information')->where(array('installStatus'=>4,'status'=>1))->count();
		$this->Pending=M('install_information')->where(array('installStatus'=>10,'status'=>1))->count();
		$this->InstallSucc=M('install_information')->where(array('installStatus'=>5,'status'=>1))->count();
		$this->NoClose=M('install_information')->where(array('installStatus'=>6,'status'=>1))->count();
		
		$this->user=$user;
		$this->display();
	}
	public function zhl(){
		$this->display();
	}
}







?>