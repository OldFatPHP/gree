<?php

//系列新增；
class SeriesInputAction extends CommonAction {
	public function index(){

		$cate=M('product')->order('id')->getField('id,pid,name');

		$this->arr=json_encode(array_values($cate));

		$this->display();
	}
   public function add(){
   	// dump($_POST);die;
    $db=M('product'); 
 if (I('x2') != "" && I('name') !="" && I('categoryID')!=""){
        $data['pid'] = I('x2');
        $data['name'] = I('name');
        $data['categoryID'] = I('categoryID');
        // dump($data);die;
      $ad=$db->where($data)->Field('name')->find();
        if($ad){$this->error('新增系列重复，请重新输入！',U('SeriesInput/index')) ;
    }else{
          $db->add($data);
          $this->success('新增成功',U('SeriesInput/index')) ;
         }
    }   
    else{
        $this->error('新增失败',U('SeriesInput/index')) ;
    }    
  }
}
    