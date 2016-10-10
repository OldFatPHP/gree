<?php

//销售单提交；
class SalesSubmitAction extends CommonAction {
   public function index(){
  $db=D('SalesView');
    import('ORG.Util.Page');// 导入分页类
    

    $map['salesStatus']=0;
    $map['salesPersonID'] = session('userID');
    $count = $db->where($map)->count();// 查询满足要求的总记录数 $map表示查询条件
    $Page  = new Page($count,20);// 实例化分页类 传入总记录数
    $show  = $Page->show();// 分页显示输出
                          // 进行分页数据查询
    $num = $db->where($map)->order('salesID')->limit($Page->firstRow.','.$Page->listRows)->select();
      if($num==null){
       $this -> error('数据为空',U('SalesDetails/index'));
      }
      else{ 
         foreach ($num as $a => $b)
        {
          $productID=$num[$a]['salesModelID'];

          import('Class.Category',APP_PATH);
          $cate=M('product')->order('id')->getField('id,pid,name');
          $num[$a]['salesModelID']=Category::getParents($cate, $productID);
         
        }
        for($n=0;$n<count($num);$n++){   
          $num[$n]['salesStand']=$num[$n]['salesStand']==1?'是':'否';
          $num[$n]['salesCashback']=$num[$n]['salesCashback']==1?'是':'否';
        }
        //dump($num);die;
      $this->assign('array',$num);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出
      $this -> display();

      }
    }

    public function submit(){  
        $model=M('sales_information');
        $salesID = I('salesID');
 //       $data=$model->where()->field('salesStatus')->select();

        $data['salesStatus'] = '1';

        for ($i=0; $i <count($salesID); $i++) { 
         $where['salesID']= $salesID[$i];
        $model->where($where)->save($data);
        //录入安装工单
        $idb=M('install_information');  

            $idata['installSalesID'] = $salesID[$i];
            $idata['installCreateTime'] = date('Y-m-d H:i:s',time());



            $iid = $idb->add($idata);

            if(!$iid){
              $this->error('生成安装单错误',U('SalesInput/index')); 
            }

        }
        $this -> success('提交成功',U('SalesDetails/index')) ;
      




        
      
       
    }
    
  }


  