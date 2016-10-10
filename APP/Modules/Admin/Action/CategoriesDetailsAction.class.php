<?php

//小类汇总；
class CategoriesDetailsAction extends CommonAction {
  public function index(){
    $db=M('product');
    import('ORG.Util.Page');// 导入分页类
    $count = $db->where('categoryID=2')->count();// 查询满足要求的总记录数 $map表示查询条件
    $Page  = new Page($count,10);// 实例化分页类 传入总记录数
    $show  = $Page->show();// 分页显示输出
                          // 进行分页数据查询
    $num = $db->where('categoryID=2')->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();

    $cate=M('product')->select();
    import('Class.Category',APP_PATH);
    foreach ($num as $key => $value) {
        $num[$key]=Category::getParents($cate,$value['id']);
    }
    // dump($num);
      if($num==null){
       echo "数据为空，请重新选择数据！";
      }
      else{ 
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
         array('bname','品类'),
        array('aname','小类'),
        );
        $xlsModel = M('product');
        $xlsData  = $xlsModel->where('categoryID=2')->select();

         foreach ($xlsData as $a => $b)
        {
          $productID=$xlsData[$a]['id'];
       // dump($productID);die;           
          $map['a.id']  =  $productID;
          $name = M('product as a')->join('product  as  b  on b.id = a.pid')->where($map)->field('a.name as aname,b.name as bname')->select();

          $xlsData[$a]['bname']= $name[0]['bname'];
          $xlsData[$a]['aname']= $name[0]['aname'];
        }
        //dump($xlsData);die;

        $this->exportExcel($xlsName,$xlsCell,$xlsData);
         
    }

  }

