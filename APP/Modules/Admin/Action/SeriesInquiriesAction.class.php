<?php
//系列查询；
class SeriesInquiriesAction extends CommonAction {
  public function index(){

    $cate=M('product')->order('id')->getField('id,pid,name');
    $this->arr=json_encode(array_values($cate));

    $this->display();
  }


public function add(){  
    // dump($_POST);die; 
      $db=M('product'); 
      $idx1['id'] = I('x1');
      $idx2['id'] = I('x2');
      $idx3['id'] = I('x3');
  if($idx1['id'] !=='' && $idx2['id'] !=='' && $idx3['id'] !=='' ){
      $arr['0']=$db->where($idx1)->Field('name')->find();
      $arr['1']=$db->where($idx2)->Field('name')->find();
      $arr['2']=$db->where($idx3)->Field('name')->find();
      $arr['3']=$db->where($idx3)->Field('id')->find();
         // dump($arr);die;
      $cate=M('product')->order('id')->getField('id,pid,name');
      $this->arr=json_encode(array_values($cate));

      $this ->assign('array', $arr);
      $this -> display('index');
     }else{
       $this->error('查询失败，请选择具体的系列！',U('SeriesInquiries/index')) ;
     }
  }

}