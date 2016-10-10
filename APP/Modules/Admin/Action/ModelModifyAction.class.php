<?php

//型号修改；
class ModelModifyAction extends CommonAction {
    public function update(){ 
       // dump($_GET);die;
      $modelID['pid'] = I('id');  
        $model=M('product_m');
        $arr['pid']=$modelID['pid'];
        $data=$model->where($arr)->select();
         // dump($data);die;
      $this ->assign('arr',$data);
      $this -> display('ModelModify/update');    
    }
     public function save(){
       // dump($_POST);die;
    if (I('pid') != "" && I('modelName') !="" && I('price')!=""&& I('salesCommission')!="" && I('installCommission')!=""){
      $id1['pid']=$data['pid']=I('pid');
    $db=M('product_m');
        $data['modelName']=I('modelName');
        $data['price']=I('price'); 
        $data['salesCommission'] = I('salesCommission');
        $data['installCommission'] = I('installCommission');
        if ($data['modelName']=='') {
            $data['modelName']=$db->where($id1)->getField('modelName');
        }
    $bd=M('product');
        $dat['id']=I('pid');
        $dat['name']=$data['modelName'];
          if( $db->where($id1)->save($data)&& $bd->save($dat)){
           $this->success('修改成功',U('ModelInquiries/index')) ;
           }else
          { $this->success('修改失败',U('ModelInquiries/index')) ;}    
    }else{

      $this->error('不能有空',U('ModelInquiries/index')) ;
      
      }
    }
  }