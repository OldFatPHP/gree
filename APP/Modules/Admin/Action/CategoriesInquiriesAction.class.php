<?php
//小类查询；
class CategoriesInquiriesAction extends CommonAction {
    public function index(){

    $cate=M('product')->order('id')->getField('id,pid,name');

    $this->arr=json_encode(array_values($cate));

    $this->display('index');
  }
public function add(){  

      $db=M('product'); 
      $idx1['id'] = I('x1');
      $idx2['id'] = I('x2');
      if($idx1['id'] !=='' && $idx2['id'] !==''){
      $arr['0']=$db->where($idx1)->Field('name')->find();
      $arr['1']=$db->where($idx2)->Field('name')->find();
      $arr['2']=$db->where($idx2)->Field('id')->find();
          // dump($arr);die;
      $cate=M('product')->order('id')->getField('id,pid,name');
      $this->arr=json_encode(array_values($cate));
      
      $this ->assign('array', $arr);
      $this -> display('index');
     }else{
       $this->error('查询失败，请选择具体的小类！',U('CategoriesInquiries/index')) ;
     }

  }
}
