<?php

//小类修改；
class CategoriesModifyAction extends CommonAction {

    public function update(){ 

        $categoriesID['id'] = I('id');  
        if($categoriesID['id'] !==''){
        $model=M('product');
        $categories=$model->where($categoriesID)->select();
        // dump($categories);die;
      $this ->assign('arr',$categories);
      $this -> display('CategoriesModify/update');
      }else{
        $this->error('修改失败，请选择具体的小类！',U('CategoriesInquiries/index')) ;
      }    
    }
     public function save(){
     $db=M('product');
        $categoryID['id']=$categories['id']=I('id');
        $categories['categoriesID']=I('categoriesID');
        $categories['name']=I('name');
        if ($categories['name']=='') {
            $categories['name']=$db->where($categoryID)->getField('name');
        }
       // dump($categories);die;
        if($db->where($categoryID)->save($categories)){
          $this->success('修改成功',U('CategoriesInquiries/index')) ;
        }else{
          $this->success('修改失败',U('CategoriesInquiries/index')) ;
        }
        
    }
    
}