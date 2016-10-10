<?php

//小类新增；
class CategoriesInputAction extends CommonAction {
    public function index(){

    $cate=M('product')->where('categoryID=1')->order('id')->getField('id,pid,name');

    $this->category=$cate;

    $this->display();
  }

  
   public function add(){
    // dump($_POST);die;
    $db=M('product'); 
      if (I('pid') != "" && I('name') !="" && I('categoryID')!=""){
        $data['pid'] = I('pid');
        $data['name'] = I('name');
        $data['categoryID'] = I('categoryID');
      $ad=$db->where($data)->Field('name')->find();
        if($ad){$this->error('新增小类重复，请重新输入！',U('CategoriesInput/index')) ;
    }else{
        $db->add($data);
        $this->success('新增成功',U('CategoriesInput/index')) ;
    }
        
      }else{
      $this->error('新增失败',U('CategoriesInput/index')) ;
      }
  }
}
    