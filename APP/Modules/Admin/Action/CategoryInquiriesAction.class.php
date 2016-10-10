<?php
//产品品类查询；
class CategoryInquiriesAction extends Action {
public function add(){         
      $db=M('product'); 
      $data['name'] = I('categoryName');
      import('ORG.Util.Page');// 导入分页类
    $count = $db->where(array('name' => array('like','%'.$data['name'].'%'),'categoryID'=>1))->count();// 查询满足要求的总记录数 $map表示查询条件
    $Page  = new Page($count,10);// 实例化分页类 传入总记录数
    $show  = $Page->show();// 分页显示输出
                          // 进行分页数据查询
    $num = $db->where(array('name' => array('like','%'.$data['name'].'%'),'categoryID'=>1))->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
    // dump($num);die;
      $this ->categoryName = I('categoryName');
      $this ->assign('array',$num);
      $this->assign('page',$show);// 赋值分页输出
      $this -> display('index');
  }
}