<?php
//销售单后台查询；
class SalesInquiriesAction extends CommonAction {
    public function index(){

        $cate=M('product')->order('id')->getField('id,pid,name');

        $this->arr=json_encode(array_values($cate));

        $this->display();
    }
public function add(){         
        $salesID = I('salesID');
        $salesBranchID = I('salesBranchID');
        $salesPersonID = I('salesPersonID');
        $salesClientName = I('salesClientName');
        $salesClientPhone = I('salesClientPhone');
        $salesPersonTelePhone = I('salesPersonTelePhone');
        $salesInvoiceID = I('salesInvoiceID');
        $salesBuyTimeBegin = I('salesBuyTimeBegin');
        $salesBuyTimeEnd = I('salesBuyTimeEnd')." 23:59:59";
        $salesInstallTimeBegin = I('salesInstallTimeBegin');
        $salesInstallTimeEnd = I('salesInstallTimeEnd')." 23:59:59";
        $salesModelID['salesModelID'] = I('x4');
        $salesCommission=M('product_m')->where('pid='.I('x4'))->getField('salesCommission');
        //根据型号选择出对应的提成；
        $salesStand = I('salesStand');
        $salesCashback = I('salesCashback');
        $salesProductNum = I('salesProductNum');
        if($salesID !=''){
          $data['salesID'] = $salesID ;
        }
        if ($salesBranchID!='') {
         $data['branchName'] = $salesBranchID;
        }
         if ($salesPersonID!='') {
         $data['salesPersonID'] = $salesPersonID ;
        }
         if ($salesClientName!='') {
          $data['salesClientName'] = $salesClientName;
        }
         if ($salesClientPhone!='') {
         $data['salesClientPhone'] = $salesClientPhone ;
        }
        if ($salesPersonTelePhone!='') {
         
          $data['salesPersonTelePhone'] = $salesPersonTelePhone ;
        }
         if ($salesInvoiceID!='') {
         $data['salesInvoiceID'] = $salesInvoiceID ;
        }

          if ($salesBuyTimeBegin!='' && $salesBuyTimeEnd!='') {
         $data['salesBuyTime'] = array('between',array($salesBuyTimeBegin,$salesBuyTimeEnd));
        }
          if ($salesInstallTimeBegin!='' && $salesInstallTimeEnd!='') {
         $data['salesInstallTime'] = array('between',array($salesInstallTimeBegin,$salesInstallTimeEnd));
        }         
          if ($salesPersonAddress!='') {
         $data['salesPersonAddress'] = $salesPersonAddress ;
        }
          if ($salesModelID['salesModelID']!='') {
          $data['salesModelID'] = $salesModelID['salesModelID'] ;
        }
         if ($salesCommission['salesCommission']!='') {
         $data['salesCommission'] =  $salesCommission ;
        }
          if ($salesStand!='') {
         $data['salesStand'] = $salesStand ;
        }

          if ($salesCashback!='') {
          $data['salesCashback'] = $salesCashback ;
        }
          if ($salesProductNum!='') {
         $data['salesProductNum'] = $salesProductNum ;
        }

      import('ORG.Util.Page');// 导入分页类
       $data['salesStatus'] = "1";
       $data['status'] = "1";
      $db=D('SalesView');

      
    $count = $db->where($data)->count();// 查询满足要求的总记录数 $map表示查询条件
      //dump( $count);die;
    $Page  = new Page($count,10);// 实例化分页类 传入总记录数
    $show  = $Page->show();// 分页显示输出
                          // 进行分页数据查询
     import('Class.Category',APP_PATH);
    $cate=M('product')->order('id')->getField('id,pid,name');
    $num = $db->where($data)->order('salesID')->limit($Page->firstRow.','.$Page->listRows)->select();
    // dump($num);die;
    
      for($n=0;$n<count($num);$n++){   
          $num[$n]['salesStand']=$num[$n]['salesStand']==1?'是':'否';
          $num[$n]['salesCashback']=$num[$n]['salesCashback']==1?'是':'否';
          $num[$n]['salesModelID']=Category::getParents($cate, $num[$n]['salesModelID']);
          $num[$n]['branchName']=$num[$n]['userTypeID']==3 ? '后台' : $num[$n]['branchName'];
        }
        // dump($num);die;
      $this ->assign('array',$num);
      $this->assign('page',$show);// 赋值分页输出

      // dump($num);die;

        $this->salesID = I('salesID');
        $this->salesBranchID = I('salesBranchID');
        $this->salesPersonID = I('salesPersonID');
        $this->salesClientName = I('salesClientName');
        $this->salesClientPhone = I('salesClientPhone');
        $this->salesInvoiceID = I('salesInvoiceID');
        $this->salesBuyTime = I('salesBuyTime');
        $this->salesInstallTime = I('salesInstallTime');
        // $this->salesModelID = I('salesModelID');
        $this->salesStand = I('salesStand');
        $this->salesCashback = I('salesCashback');
        $this->salesBuyTimeBegin = I('salesBuyTimeBegin');
        $this->salesBuyTimeEnd = I('salesBuyTimeEnd');
        $this->salesInstallTimeBegin = I('salesInstallTimeBegin');
        $this->salesInstallTimeEnd = I('salesInstallTimeEnd');

        $cate=M('product')->order('id')->getField('id,pid,name');


        $this->arr=json_encode(array_values($cate));

      $this -> display('index');
  }



    public function update(){ 
        $salesID = I('salesID'); 
        $model=D('SalesView');
        $arr['salesID']=$salesID;
        $data=$model->where($arr)->select();
        $cate=M('product')->order('id')->getField('id,pid,name');
        import('Class.Category',APP_PATH);
        $parent=Category::getParents($cate,$data[0]['salesModelID']);
        $this->parent=$parent;
     
        $this->arr1=json_encode(array_values($cate));
        // dump($data);die;

      $this ->assign('arr',$data);
      $this -> display('SalesInquiries/update');    
    }



     public function save(){
    $db=M('sales_information'); 
        $data['salesID']= I('salesID');
       // $data['salesBranchID']= I('salesBranchID');
        $data['salesClientName']= I('salesClientName');
        $data['salesClientPhone']= I('salesClientPhone');
        $data['salesInvoiceID'] = I('salesInvoiceID');
        $data['salesClientMail']  = I('salesClientMail');
        $data['salesBuyTime']  = I('salesBuyTime');
        $data['salesInstallTime']  = I('salesInstallTime');
        $data['salesPersonAddress']  = I('salesPersonAddress');
        $data['salesModelID']  = I('x4');
        $data['salesStand']  = I('salesStand');
        $data['salesCashback']  = I('salesCashback');
        $data['salesProductNum']  = I('salesProductNum');
        //$data['salesPersonID']  = I('salesPersonID');
        $data['salesPersonTelePhone']  = I('salesPersonTelePhone');
        $data['salesRemark']  = I('salesRemark');

        $id['salesID']=$data['salesID'];

        if ($data['salesModelID']=='') {
            $data['salesModelID']=$db->where($id)->getField('salesModelID');
        }



      if($db->where($id)->save($data)){
        $this->success('修改成功',U('SalesInquiries/index')) ;
      }else{
        $this->error('修改失败！');
      }

  
    }


public function delete(){
    $db=M('sales_information'); 
     $data['salesID']= I('salesID');
        $data['status']  = "0";
        // dump($data);die;
      $id['salesID']=$data['salesID'];
        if($db->where($id)->save($data)){
          $this->success('删除成功',U('SalesInquiries/index')) ;
        }else
        $this->error('删除失败',U('SalesInquiries/index'));
 
    }

  public function report(){
    $this->display();
  }


  public function exportExcel($expTitle,$expCellName,$expTableData){
            ob_end_clean();//清除缓存防止乱码
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
       // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));  
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]); 
        } 
          // Miscellaneous glyphs, UTF-8   
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
          }             
        }  
        
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
        $objWriter->save('php://output'); 
        exit;   
    }
     


    function expUser(){//导出Excel
       $xlsName  = "User";
        $xlsCell  = array(
        array('salesID','销售单号'),
        array('branchName','销售网点'),
        array('salesPersonID','销售员手机号码'),
        array('userName','销售员'),
        array('salesClientName','顾客'),
        array('salesClientPhone','顾客手机号码'),
        array('salesPersonTelePhone','顾客固定电话'), 
        array('salesPersonAddress','安装地址'),
        array('salesClientMail','客户电子邮箱'),
        array('salesInvoiceID','发票号'),
        array('salesBuyTime','购买时间'),
        array('salesInstallTime','预约安装时间'),
        array('salesModelID','型号'),
        array('salesCommission','销售提成'),
        array('salesProductNum','数量'),
        array('salesStand','是否要支架'),
        array('salesCashback','是否返现'),
        array('salesRemark','销售备注'), 
        );
  $xlsModel = D('SalesView');
        $salesID = I('salesID');
        $salesBranchID = I('salesBranchID');
        $salesPersonID = I('salesPersonID');
        $salesClientName = I('salesClientName');
        $salesClientPhone = I('salesClientPhone');
        $salesPersonTelePhone = I('salesPersonTelePhone');
        $salesInvoiceID = I('salesInvoiceID');
        $salesBuyTimeBegin = I('salesBuyTimeBegin');
        $salesBuyTimeEnd = I('salesBuyTimeEnd');
        $salesInstallTimeBegin = I('salesInstallTimeBegin');
        $salesInstallTimeEnd = I('salesInstallTimeEnd');
        $salesModelID = I('salesModelID');
        $salesCommission = I('salesCommission');
        $salesStand = I('salesStand');
        $salesCashback = I('salesCashback');
        $salesProductNum = I('salesProductNum');
        if($salesID !=''){
          $data['salesID'] = $salesID ;
        }
        if ($salesBranchID!='') {
         $data['salesBranchID'] = $salesBranchID;
        }
         if ($salesPersonID!='') {
         $data['salesPersonID'] = $salesPersonID ;
        }
         if ($salesClientName!='') {
          $data['salesClientName'] = $salesClientName;
        }
         if ($salesClientPhone!='') {
         $data['salesClientPhone'] = $salesClientPhone ;
        }
        if ($salesPersonTelePhone!='') {
         
          $data['salesPersonTelePhone'] = $salesPersonTelePhone ;
        }
         if ($salesInvoiceID!='') {
         $data['salesInvoiceID'] = $salesInvoiceID ;
        }
          if ($salesBuyTimeBegin!='' && $salesBuyTimeEnd!='') {
         $data['salesBuyTime'] = array('between',array($salesBuyTimeBegin,$salesBuyTimeEnd));
        }
          if ($salesInstallTimeBegin!='' && $salesInstallTimeEnd!='') {
         $data['salesInstallTime'] = array('between',array($salesInstallTimeBegin,$salesInstallTimeEnd));
        } 
          
          if ($salesPersonAddress!='') {
         $data['salesPersonAddress'] = $salesPersonAddress ;
        }
          if ($salesModelID!='') {
          $data['salesModelID'] = $salesModelID ;
        }
          if ($salesStand!='') {
         $data['salesStand'] = $salesStand ;
        }
          if ($salesCashback!='') {
          $data['salesCashback'] = $salesCashback ;
        }
          if ($salesProductNum!='') {
         $data['salesProductNum'] = $salesProductNum ;
        }
         $data['salesStatus']=1;
         $data['status']=1;
        // dump($data);die;
         $xlsData =$xlsModel->where($data)->order('salesID')->select();
        // echo $xlsModel->getLastSql();die;
        // $data['salesStatus']=1;
        // $data['status']=1;
        //   $xlsData  = $xlsModel->where($data)->order('salesID')->select();
          // dump($xlsModel->getLastSql());
           // dump($xlsData);die;
         foreach ($xlsData as $a => $b)
        {
          $productID=$xlsData[$a]['salesModelID'];
       // dump($productID);die;           
          $map['a.id']  =  $productID;
          $name = M('product as a')->join('product  as  b  on b.id = a.pid')->join('product  as  c  on c.id = b.pid')->join('product  as  d  on d.id = c.pid')->where($map)->field('a.name as aname,b.name as bname,c.name as cname,d.name as dname')->select();
       // dump($name);die;
          $xlsData[$a]['salesModelID']= $name[0]['dname'].'-'.$name[0]['cname'].'-'.$name[0]['bname'].'-'.$name[0]['aname'] ;
       // dump($xlsData);die;
        }

        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['salesStand']=$v['salesStand']==1?'是':'否';
            $xlsData[$k]['salesCashback']=$v['salesCashback']==1?'是':'否';
            $xlsData[$k]['branchName']=$v['userTypeID']==3?'后台':$xlsData[$k]['branchName'];
            // $num[$n]['branchName']=$num[$n]['userTypeID']==3 ? '后台' : $num[$n]['branchName'];
        }
        $this->exportExcel($xlsName,$xlsCell,$xlsData);        
    }



    //以下是导出销售员报表；


   public function exportExcel1($expTitle,$expCellName,$expTableData,$time,$branchName,$branchID,$userName,$salesStand,$sum,$salesStandNum){
        ob_end_clean();//清除缓存防止乱码
        $xlsTitle = '格力'.$time.'销量汇总表';//文件名称
   //     $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

        $objPHPExcel->getActiveSheet()->setCellValue('A1', '格力 '.$time.'  销量汇总表' );
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('华文行楷');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(25);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

       $objPHPExcel->getActiveSheet()->setCellValue('A2', '   商场：'.$branchName.'       门店及店号： '.$branchID.'         导购员：'.$userName.'' );
       $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
       $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);  
       $objPHPExcel->getActiveSheet()->setCellValue('A3', '支架提成合计（10元/付）：'.$salesStandNum.'  元    （'.$salesStand.' 付） '); 
       $objPHPExcel->getActiveSheet()->setCellValue('A4', '销售提成总合计：'.$sum.'  元');      
        
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->getActiveSheet(0)->mergeCells('A2:'.$cellName[$cellNum-1].'2');//合并单元格
        $objPHPExcel->getActiveSheet(0)->mergeCells('A3:'.$cellName[$cellNum-1].'3');//合并单元格
        $objPHPExcel->getActiveSheet(0)->mergeCells('A4:'.$cellName[$cellNum-1].'4');//合并单元格
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);

       // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));  
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'5', $expCellName[$i][1]); 
        } 
          // Miscellaneous glyphs, UTF-8   
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+6), $expTableData[$i][$expCellName[$j][0]]);
          }             
        }  
        
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=".$xlsTitle.".xls");//attachment新窗口打印inline本窗口打印
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
        $objWriter->save('php://output'); 
        exit;   
    }
     


    function expUser1(){//导出Excel
        //dump($_POST);die;
       $xlsName  = "User";
        $xlsCell  = array(
        array('salesID','销售单号'),
        array('salesModelID','型号'),
        array('salesCommission','提成（元/套）'),
        array('salesProductNum','数量'),
        array('mul','合计金额（元）'),
        array('salesStand','是否要支架'),
        array('installUserStand','是否使用支架'),

        );
        
      $xlsModel = D('SalesView');

      if (I('year')!='' && I('month')!=''&& I('salesPersonID')!=''&& I('installStatus')!='') {
        $salesPersonID = I('salesPersonID');
        $year = I('year');
        $month = I('month');
      if (empty($year) || empty($month)) {
        $this->error('年月份不能为空');
      }
      
      $beginTime = $year.'-'.$month.'-1';

      $bt = $year.'年'.$month;

      if($month == 12){
        $year = $year + 1;
        $endTime = $year.'-1-1';
        $et = '月-'.$year.'年1月';
      }else{
        $month = $month +1;
        $endTime = $year.'-'.$month.'-1';
        $et = '-'.$month.'月';
      }
         $time = $bt.$et; 
        if (I('installStatus')=='7') {
                $data['installEndTime'] = array('between',array($beginTime,$endTime));
        }else{
              $data['installStatus'] = array('neq', 7);
        }
         
          if ($salesPersonID!='') {
          $data['salesPersonID'] = $salesPersonID ;
        }
        //dump($data);die;
          $data['salesStatus']=1; 
          $data['status']=1;           
          $xlsData  = $xlsModel->where($data)->order('salesID')->select();
         // dump($xlsData);die;
          // dump($xlsModel->getLastSql());
          $branchName = $xlsData[0]['branchName'];
          $branchID = $xlsData[0]['branchID'];
          $userName = $xlsData[0]['userName'];
          $salesStand = 0;
          $sum=0;
           
         foreach ($xlsData as $a => $b)
        {
          $productID = $xlsData[$a]['salesModelID'];
          $salesCommission = $xlsData[$a]['salesCommission'];
          $salesProductNum = $xlsData[$a]['salesProductNum'];
          $stand = $xlsData[$a]['salesStand'];
          $installStand = $xlsData[$a]['installUserStand'];
          $xlsData[$a]['mul'] = $salesCommission * $salesProductNum ;
          $sum = $salesCommission * $salesProductNum +$sum;

          if($stand == 1 && $installStand == 1){$salesStand = $salesStand + $xlsData[$a]['salesProductNum'];}
           $salesStandNum = $salesStand * 10 ;
         // dump($xlsData);die;           
          $map['a.id']  =  $productID;
          $name = M('product as a')->join('product  as  b  on b.id = a.pid')->join('product  as  c  on c.id = b.pid')->join('product  as  d  on d.id = c.pid')->where($map)->field('a.name as aname,b.name as bname,c.name as cname,d.name as dname')->select();
       // dump($name);die;
          $xlsData[$a]['salesModelID']= $name[0]['dname'].'-'.$name[0]['cname'].'-'.$name[0]['bname'].'-'.$name[0]['aname'] ;
      //dump($xlsData);die;
        }
        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['salesStand']=$v['salesStand']==1?'是':'否';
            $xlsData[$k]['installUserStand']=$v['installUserStand']==1?'是':'否';
        }

        
        $this->exportExcel1($xlsName,$xlsCell,$xlsData,$time,$branchName,$branchID,$userName,$salesStand,$sum,$salesStandNum);
       } else $this->error('导出报表失败！'); 
    } 

}