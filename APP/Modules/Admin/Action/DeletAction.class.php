<?php 
	/*	
	*删除控制器，通过ID删除
	*/
	class DeletAction extends CommonAction{
	
		
		
		public function index(){

			$where['installID'] = I('id');
			$update['status'] = 0;
			$word = M('install_information')->where($where)->save($update);
			if($word){				
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！');
			}
		}


}


?>


