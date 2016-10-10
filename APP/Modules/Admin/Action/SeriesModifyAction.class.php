<?php

//系列修改；
class SeriesModifyAction extends CommonAction {
    public function update(){ 
            $seriesID['id'] = I('id');  
        if($seriesID['id'] !==''){
        $model=M('product');
        $series=$model->where($seriesID)->select();
        //dump($series);die;
      $this ->assign('arr',$series);
      $this -> display('SeriesModify/update');
      }else{
        $this->error('修改失败，请选择具体的系列！',U('SeriesInquiries/index')) ;
      }    
    }
     public function save(){
      //dump($_POST);die;
     $db=M('product');
        $seriesID['id']=$series['id']=I('id');
        $series['seriesID']=I('seriesID');
        $series['name']=I('name');
        if ($series['name']=='') {
            $series['name']=$db->where($seriesID)->getField('name');
        } 
        // dump($series);die;->where($categoryID)
        if($db->save($series)){
          $this->success('修改成功',U('SeriesInquiries/index')) ;
        }else{
          $this->success('修改失败',U('SeriesInquiries/index')) ;
        }
        
    }
    
}