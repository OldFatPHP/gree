<?php

//型号新增；
class ModelInputAction extends CommonAction {
		public function index(){

		$cate=M('product')->order('id')->getField('id,pid,name');

		$this->arr=json_encode(array_values($cate));

		$this->display();
	}

   public function add(){
     // dump($_POST);die;
 if (I('x3') != "" && I('name') !="" && I('categoryID')!=""&& I('price') !=""&& I('salesCommission') !=""&& I('installCommission') !=""){
    $db=M('product'); 
        $db=M('product'); 
        $modelPID=$data['pid'] = I('x3');
        $data['name'] = I('name');
        $data['categoryID'] = I('categoryID');
        // dump($data);die;
        $ad=$db->where($data)->Field('name')->find();
        if($ad){$this->error('新增型号重复，请重新输入！',U('ModelInput/index')) ;
    }else{
        $db->add($data);
        $modelID=$db->where($data)->getField('id');
    }
        
        // dump($modelID);die;
    $bd=M('product_m');
        $da['pid'] = $modelID;
        $da['modelName'] = I('name');
        $da['price'] =I('price');
        $da['salesCommission'] =I('salesCommission');
        $da['installCommission'] =I('installCommission');
        // dump($da);die;
           $ad=$db->where($da)->Field('name')->find();
        if($ad){$this->error('新增型号重复，请重新输入！',U('ModelInput/index')) ;
    }else{
        $bd->add($da);
        $this->success('新增成功',U('ModelInput/index')) ;
    }
       
      }else{
        $this->error('新增失败',U('ModelInput/index')) ;
       }
    }
}

        