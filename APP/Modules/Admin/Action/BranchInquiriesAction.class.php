<?php
//销售网点查询；
class BranchInquiriesAction extends CommonAction {
public function add(){
    $type=I('branchtype');
    if ($type==1) {
        $db=M('sales_branch'); 
    }else if ($type==2){
        $db=M('install_branch'); 
    }         

        $branchName = I('branchName');
        $branchAddress = I('branchAddress');
        $branchPicName = I('branchPicName');
        $branchPicPhone = I('branchPicPhone');
/*        $branchCreateDate = I('branchCreateDate');*/
        if($branchName !=''){
          $data['branchName'] = $branchName ;
        }
        if ($branchAddress!='') {
         $data['branchAddress'] = $branchAddress;
        }
         if ($branchPicName!='') {
          $data['branchPicName'] = $branchPicName;
        }
         if ($branchPicPhone!='') {
         $data['branchPicPhone'] = $branchPicPhone ;
        }
/*         if ($branchCreateDate!='') {
         $data['branchCreateDate'] = $branchCreateDate ;
        }*/

        import('ORG.Util.Page');// 导入分页类

        if (!$type) {
            $db = new Model();
            $sql = "select * from sales_branch union all select * from install_branch";
            $result = $db->query($sql);
            $count = count($result);// 查询满足要求的总记录数 $map表示查询条件
            $Page  = new Page($count,10);// 实例化分页类 传入总记录数
            $show  = $Page->show();// 分页显示输出
            $sql = "select * from sales_branch union all select * from install_branch limit {$Page->firstRow},{$Page->listRows}";
            $num = $db->query($sql);
             
        }else{

          $count = $db->where($data)->count();// 查询满足要求的总记录数 $map表示查询条件
          $Page  = new Page($count,10);// 实例化分页类 传入总记录数
          $show  = $Page->show();// 分页显示输出
          //进行分页数据查询
          $num = $db->where($data)->order('branchID')->limit($Page->firstRow.','.$Page->listRows)->select();

        }
      
    

        $this->branchtype = I('branchtype');
        $this->branchName = I('branchName');
        $this->branchAddress = I('branchAddress');
        $this->branchPicName = I('branchPicName');
        $this->branchPicPhone = I('branchPicPhone');

      $this ->assign('array',$num);
      $this->assign('page',$show);// 赋值分页输出
      $this -> display('index');
          

  }
  public function update(){ 
        $branchID = I('branchID'); 
        $model=M('sales_branch');
        $arr['branchID']=$branchID;
        $data=$model->where($arr)->select();
      $this ->assign('arr',$data);
      $this -> display('BranchInquiries/update');    
    }
     public function save(){
    $db=M('sales_branch');
        $data['branchID']=I('branchID'); 
        $data['branchName'] = I('branchName');
        $data['branchAddress']  = I('branchAddress');
        $data['branchPicName']  = I('branchPicName');
        $data['branchPicPhone'] = I('branchPicPhone');
      $id['branchID']=$data['branchID'];
        $db->where($id)->save($data);
        $this->success('修改成功',U('BranchInquiries/index')) ;
    }


   public function expUser(){//导出Excel
        $xlsName  = "User";
        $xlsCell  = array(
        array('branchType','网点类型'),
        array('branchName','网点名'),
        array('branchAddress','网点地址'),
        array('branchPicName','网点负责人'),
        array('branchPicPhone','网点负责人电话'),
        array('branchCreateDate','网点创建时间'),
        );

        $type=I('branchtype');
        if ($type==1) {
            $db=M('sales_branch'); 
        }else if ($type==2){
            $db=M('install_branch'); 
        }         

        $branchName = I('branchName');
        $branchAddress = I('branchAddress');
        $branchPicName = I('branchPicName');
        $branchPicPhone = I('branchPicPhone');
/*        $branchCreateDate = I('branchCreateDate');*/
        if($branchName !=''){
          $data['branchName'] = $branchName ;
        }
        if ($branchAddress!='') {
         $data['branchAddress'] = $branchAddress;
        }
         if ($branchPicName!='') {
          $data['branchPicName'] = $branchPicName;
        }
         if ($branchPicPhone!='') {
         $data['branchPicPhone'] = $branchPicPhone ;
        }
/*         if ($branchCreateDate!='') {
         $data['branchCreateDate'] = $branchCreateDate ;
        }*/


        if (!$type) {
            $db = new Model();
            /*$sql = "select * from sales_branch union all select * from install_branch";
            $result = $db->query($sql);
            $count = count($result);// 查询满足要求的总记录数 $map表示查询条件
            $Page  = new Page($count,10);// 实例化分页类 传入总记录数
            $show  = $Page->show();// 分页显示输出*/
            $sql = "select * from sales_branch union all select * from install_branch";
            $num = $db->query($sql);
            foreach ($num as $key => $value) {
              if($num[$key]['branchType']==1){
                    $num[$key]['branchType']='销售网点';
              }else{
                    $num[$key]['branchType']='安装网点';
                  }
            }
             
        }else{

          /*$count = $db->where($data)->count();// 查询满足要求的总记录数 $map表示查询条件
          $Page  = new Page($count,10);// 实例化分页类 传入总记录数
          $show  = $Page->show();// 分页显示输出*/
          //进行分页数据查询
          $num = $db->where($data)->order('branchID')->limit($Page->firstRow.','.$Page->listRows)->select();
            foreach ($num as $key => $value) {
              if($num[$key]['branchType']==1){
                    $num[$key]['branchType']='销售网点';
              }else{
                    $num[$key]['branchType']='安装网点';
                  }
            }

        }
        // dump($num);die();
      


        $this->exportExcel($xlsName,$xlsCell,$num);
            }
         
    
}