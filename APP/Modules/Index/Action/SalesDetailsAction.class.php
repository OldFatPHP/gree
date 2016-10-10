<?php

//销售单明细；
class SalesDetailsAction extends CommonAction {
  public function index(){
    $db=D('SalesView');
    import('ORG.Util.Page');// 导入分页类
    $abc['salesStatus']=1;
    $abc['salesPersonID']=session('userID');
    $count = $db->where($abc)->count();// 查询满足要求的总记录数 $map表示查询条件
    $Page  = new Page($count,20);// 实例化分页类 传入总记录数
    $show  = $Page->show();// 分页显示输出
                          // 进行分页数据查询
    $num = $db->where($abc)->order('salesID')->limit($Page->firstRow.','.$Page->listRows)->select();

      if($num==null){
       $this -> error('数据为空',U('SalesInput/index'));
      }
      else{ 

        foreach ($num as $a => $b)
        {
          $productID=$num[$a]['salesModelID'];
       // dump($productID);die;           
          $map['a.id']  =  $productID;
          $name = M('product as a')->join('product  as  b  on b.id = a.pid')->join('product  as  c  on c.id = b.pid')->join('product  as  d  on d.id = c.pid')->where($map)->field('a.name as aname,b.name as bname,c.name as cname,d.name as dname')->select();
       // dump($name);die;
          $num[$a]['salesModelID']= $name[0]['dname'].'-'.$name[0]['cname'].'-'.$name[0]['bname'].'-'.$name[0]['aname'] ;
       // dump($num);die;
        }

        for($n=0;$n<count($num);$n++){   
          $num[$n]['salesStand']=$num[$n]['salesStand']==1?'是':'否';
          $num[$n]['salesCashback']=$num[$n]['salesCashback']==1?'是':'否';
        }
      $this->assign('array',$num);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出
      $this -> display();
      }
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
          $abc['salesStatus']=1;
          $abc['salesPersonID']=session('userID');
          $xlsData  = $xlsModel->where($abc)->select();
         foreach ($xlsData as $a => $b)
        {
          $productID=$xlsData[$a]['salesModelID'];
       // dump($productID);die;           
          $map['a.id']  =  $productID;
          $name = M('product as a')->join('product  as  b  on b.id = a.pid')->join('product  as  c  on c.id = b.pid')->join('product  as  d  on d.id = c.pid')->where($map)->field('a.name as aname,b.name as bname,c.name as cname,d.name as dname')->select();
      // dump($abc);die;
          $xlsData[$a]['salesModelID']= $name[0]['dname'].'-'.$name[0]['cname'].'-'.$name[0]['bname'].'-'.$name[0]['aname'] ;
      // dump($xlsData);die;
        }

        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['salesStand']=$v['salesStand']==1?'是':'否';
            $xlsData[$k]['salesCashback']=$v['salesCashback']==1?'是':'否';
        }
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
    }

  }

        // $salesModelID= I('x4');
        // $salesCommission=M('product_m')->where('pid='.I('x4'))->getField('salesCommission');
        // $salesCommission['salesCommission'] = "$salesCommission";//根据型号选择出对应的提成；