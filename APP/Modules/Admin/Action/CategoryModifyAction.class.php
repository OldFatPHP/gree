<?php

//产品品类修改；
class CategoryModifyAction extends Action {
    public function update(){ 
        $categoryID = I('categoryID'); 
        $model=M('product');
        $arr['id']=$categoryID;
        $data=$model->where($arr)->select();
      $this ->assign('arr',$data);
      $this -> display('CategoryModify/update');    
    }
     public function save(){
    $db=M('product');
        $data['id']=I('categoryID'); 
        $data['name'] = I('categoryName');
        $id['id']=$data['id'];
       if ($data['name']=='') {
            $data['name']=$db->where($id)->getField('name');
        }
        //dump($data);die;
       if($db->where($id)->save($data)) {
        $this->success('修改成功',U('CategoryInquiries/index'));
      }else{
        $this->error('修改失败',U('CategoryInquiries/index'));
      }
        
  }
}
    
