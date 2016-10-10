<?php
//型号查询；
class ModelInquiriesAction extends CommonAction {

  public function index(){

    $cate=M('product')->order('id')->getField('id,pid,name');

    $this->arr=json_encode(array_values($cate));

    $this->display();
  }

  public function add(){  
// dump($_POST);die; 
 if (I('x1') != "" && I('x2') !="" && I('x3')!=""&& I('x4') !="" ){
      $db=M('product'); 
      $idx1['id'] = I('x1');
      $idx2['id'] = I('x2');
      $idx3['id'] = I('x3');
      $idx4['id'] = I('x4');
      $arr['0']=$db->where($idx1)->Field('name')->find();
      $arr['1']=$db->where($idx2)->Field('name')->find();
      $arr['2']=$db->where($idx3)->Field('name')->find();
      $arr['3']=$db->where($idx4)->Field('name')->find();
      $arr['4']=$db->where($idx4)->Field('id')->find();
   // dump($arr);die;
      $cate=M('product')->order('id')->getField('id,pid,name');
      $this->arr=json_encode(array_values($cate));
      
      $this ->assign('array', $arr);
      $this -> display('index');
     }else{
       $this->error('查询失败，请选择具体的型号！',U('ModelInquiries/index')) ;
     }
  }

}


