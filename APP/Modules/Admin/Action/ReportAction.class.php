<?php
	

	class ReportAction extends CommonAction{
		public function index(){
			
			$time=date("Y-m-d",time());
			$v=explode('-',$time); 

			$year = intval($v[0]);
			$month = intval($v[1]);

			if($month == 1){
				$month = 12;
				$year = $year -1;
			}else{
				$month = $month -1;
			}

			$this->year= $year ;
			$this->month= $month ;
			
			$m = M('install_branch');
		    $branchName = $m->field('branchID,branchName')->select();
		    $this->assign('branchName',$branchName);  // 安装网点信息输出

			$this->display();
		}


		public function handle(){
			header("Content-Type: text/html; charset=utf-8");
			$month = I('month');
			$year = I('year');
			if (empty($year) || empty($month)) {
				$this->error('年月份不能为空');
			}
			
			$beginTime = $year.'-'.$month.'-1';

			$bt = $year.'年'.$month;

			if($month == 12){
				$et = 
				$year = $year + 1;
				$endTime = $year.'-1-1';
				$et = '月-'.$year.'年1月';
			}else{
				$month = $month +1;
				$endTime = $year.'-'.$month.'-1';
				$et = '-'.$month.'月';
			}

			$time = $bt.$et;


/*			dump($beginTime);
			dump($endTime);die;*/
			//$map['installEndTime'] = $time;
			
			


			$model = D('InstallView'); 
			
			$map['installEndTime'] = array('between',array($beginTime,$endTime));
			$map['status'] = '1';
			$map['installStatus'] = '7';
			$map['installBranchID'] = I('branchID');

			$maps = $map;
			$maps['installUserStand'] = '1';
			$standNum = $model->where($maps)->sum('salesProductNum');

			//查询工单总数量
			$num = $model->where($map)->sum('salesProductNum');
	//		echo "num:";dump($num);

			//查询出符合条件的型号ID和型号名字
			$data2 = $model->where($map)->distinct(true)->field('salesModelID,modelName')->select();

			//遍历查询每个型号所对应的数量
			for($i=0;$i<count($data2);$i++){
				$map['salesModelID'] = $data2[$i]['salesModelID'];
				$data4 = $model->where($map)->sum('salesProductNum');
				$data2[$i]['salesProductNum'] = $data4;
			}
			//根据$data2里的salesModelID查询出提成
			$a = M('product_m');
			for($i=0;$i<count($data2);$i++){
				$where['pid'] = $data2[$i]['salesModelID'];
				$data5 = $a->where($where)->field('pid,installCommission')->select();
				$data2[$i]['installCommission'] = $data5[0]['installCommission'];
			}

/*			$time=date("Y-m-d",time());
			$v=explode('-',$time); 
			$time = $v[0].'年'.$v[1].'月'.$v[2].'日';*/

		//	echo "data2:";dump($data2);

			$branchID = I('branchID');
			$branch = M('install_branch')->find($branchID);
	//		dump($branch);die;


			
			$this->export($branch,$time,$num,$standNum,$data2);

			}


		private function export($branch,$time,$num,$standNum,$data){

			$cellName = array('A','B','C','D','E','F','G');

			  vendor("PHPExcel.PHPExcel");//如果这里提示类不存在，肯定是你文件夹名字不对。
	          $objPHPExcel = new \PHPExcel();//这里要注意‘\’ 要有这个。因为版本是3.1.2了。
	          $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);//设置保存版本格式
			// 加图片
	          $objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Logo');
				$objDrawing->setDescription('Logo');
				$objDrawing->setPath("./images/gree.png");
				$objDrawing->setHeight(46);
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

				//设置字体
				$objPHPExcel->getDefaultStyle()->getFont()->setName( '宋体');
				$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
				$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(30);


				


				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(11);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(21);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(11.5);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14.5);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(11.5);

				

		//		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setWidth(20);


	
				

				$objPHPExcel->getActiveSheet()->setCellValue('A1', '深圳中宏力实业限公司' );
				$objPHPExcel->getActiveSheet()->mergeCells( 'A1:G1'); 
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('华文行楷');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(28);
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);



				$objPHPExcel->getActiveSheet()->setCellValue('A2', '空调安装、维修费用审核确认单' );
				$objPHPExcel->getActiveSheet()->mergeCells( 'A2:G2'); 
				$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('华文行楷');
				$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(22);
				$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
				$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);

				$objPHPExcel->getActiveSheet()->setCellValue('A3', '安装单位名称 ：'.$branch['branchName'].'     电话：'.$branch['branchPicPhone'] );

				$objPHPExcel->getActiveSheet()->setCellValue('A4', '贵单位交来'.$time.'安装结算单共计 '.$num.' 份，经审核不合格    份，其他    份，假单    份。' );

				$objPHPExcel->getActiveSheet()->setCellValue('A5', '一、安装项目' );
				$objPHPExcel->getActiveSheet()->mergeCells( 'A5:G5'); 
				$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setName('华文新魏');
				$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(20);
				$objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
				$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);

				$objPHPExcel->getActiveSheet()->setCellValue('A6', '品牌' );

				$objPHPExcel->getActiveSheet()->setCellValue('B6', '机器型号/项目' );
				$objPHPExcel->getActiveSheet()->mergeCells( 'B6:C6'); 

				$objPHPExcel->getActiveSheet()->setCellValue('D6', '数量' );

				$objPHPExcel->getActiveSheet()->setCellValue('E6', '单价/元' );

				$objPHPExcel->getActiveSheet()->setCellValue('F6', '金额/元' );

				for($i=0;$i<count($cellName);$i++){
				$objPHPExcel->getActiveSheet()->getStyle($cellName[$i].'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
				}

				$objPHPExcel->getActiveSheet()->setCellValue('G6', '备注' );

				$objPHPExcel->getActiveSheet()->setCellValue('A7', '格力' );


				$money = 0;


			  foreach ($data as $key => $value) {
                  $i=$key+7;//表格是从1开始的
                  $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,  $value['modelName']);
                  $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,  $value['salesProductNum']);
                  $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,  $value['installCommission']);
                  $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,  '=D'.$i.'*E'.$i);
                  $objPHPExcel->getActiveSheet()->mergeCells( 'B'.$i.':C'.$i);
                  $money =$money + $value['salesProductNum'] * $value['installCommission'];            
				}
				$objPHPExcel->getActiveSheet()->mergeCells( 'A7:A'.$i); 
				$objPHPExcel->getActiveSheet()->mergeCells( 'A'.($i+1).':C'.($i+1)); 
				$objPHPExcel->getActiveSheet()->getStyle('A'.($i+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
				


				$CapitalMoney = num2char($money);

				$n = $i;
				$objPHPExcel->getActiveSheet()->setCellValue('F'.++$i, '=SUM(F7:F'.$n.')' );
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, '小计' );
				//设置边框
				$styleArray = array(  
									    'borders' => array(  
									        'allborders' => array(  
									            //'style' => PHPExcel_Style_Border::BORDER_THICK,//边框是粗的  
									            'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框  
									            //'color' => array('argb' => 'FFFF0000'),  
									        ),  
									    ),  
									);  

				$objPHPExcel->getActiveSheet()->getStyle('A5:G'.$i)->applyFromArray($styleArray);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.++$i, '支架：'.$standNum.'付' );
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '单价/付：10元' );
				$moneys = $standNum*10;
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, '金额：'.$moneys.'元' );

				$count = $money - $moneys;
				$CapitalMoney = num2char($count);

				$objPHPExcel->getActiveSheet()->setCellValue('A'.++$i, '本月（次）应结金额：'.$money.'元，不合格单据扣款金额：    元，其他原因扣罚金额：     元' );
				$objPHPExcel->getActiveSheet()->setCellValue('A'.++$i, '合计扣款金额：'.$moneys.'        元。' );
				$objPHPExcel->getActiveSheet()->setCellValue('A'.++$i, '本月（次）实结金额：'.$count.'元，（大写）人民币：'.$CapitalMoney );

				


				$time1=date("Y-m-d",time());
				$v=explode('-',$time1); 
				$time1 = $v[0].'年'.$v[1].'月'.$v[2].'日';

				$objPHPExcel->getActiveSheet()->setCellValue('A'.++$i, '日期：'.$time1 );



				//设置垂直居中
				$cellName = array('A','B','C','D','E','F','G');
				for($n=1;$n<$i;$n++){
					for($j=0;$j<count($cellName);$j++){
						$objPHPExcel->getActiveSheet()->getStyle( $cellName[$j].$n)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

					}
				}
				 
			  $fileName = $branch['branchName'].$time.'安装确认单';
			  
			  ob_end_clean();
			  
	          header("Pragma: public");
	          header("Expires: 0");
	          header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	          header("Content-Type:application/force-download");
	          header("Content-Type:application/vnd.ms-execl");
	          header("Content-Type:application/octet-stream");
	          header("Content-Type:application/download");;
	          header('Content-Disposition:attachment;filename='.$fileName.'.xls');
	          header("Content-Transfer-Encoding:binary");
	          $objWriter->save('php://output');


			
		}

//导出销售报表
  public function report(){
    $this->display();
  }

   public function exportExcel1($expTitle,$expCellName,$expTableData,$time,$branchName,$branchID,$userName,$salesStand,$sum){
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
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

       $objPHPExcel->getActiveSheet()->setCellValue('A2', '商场：'.$branchName.'  门店及店号： '.$branchID.'         导购员：'.$userName.'' );  
       $objPHPExcel->getActiveSheet()->setCellValue('A3', '支架合计：'.$salesStand.'个 '); 
       $objPHPExcel->getActiveSheet()->setCellValue('A4', '销售提成总合计：'.$sum.' 元');      
        
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->getActiveSheet(0)->mergeCells('A2:'.$cellName[$cellNum-1].'2');//合并单元格
        $objPHPExcel->getActiveSheet(0)->mergeCells('A3:'.$cellName[$cellNum-1].'3');//合并单元格
        $objPHPExcel->getActiveSheet(0)->mergeCells('A4:'.$cellName[$cellNum-1].'4');//合并单元格
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

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
       // dump($_POST);die;
       $xlsName  = "User";
        $xlsCell  = array(
        array('salesID','销售单号'),
        array('salesModelID','型号'),
        array('salesCommission','提成（元/套）'),
        array('salesProductNum','数量'),
        array('mul','合计金额（元）'),  
        );
        
      $xlsModel = D('SalesView');

      if (I('year')!='' && I('month')!=''&& I('salesPersonID')!='') {
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
         $data['salesBuyTime'] = array('between',array($beginTime,$endTime));
          if ($salesPersonID!='') {
          $data['salesPersonID'] = $salesPersonID ;
        }

          $data['salesStatus']=1; 
          $data['status']=1;           
          $xlsData  = $xlsModel->where($data)->order('salesID')->select();
          //dump($xlsData);die;
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
          $xlsData[$a]['mul'] = $salesCommission * $salesProductNum ;
          $sum = $salesCommission * $salesProductNum +$sum;

          if($stand == 1){$salesStand = $salesStand+1;}

         //dump($xlsData);die;           
          $map['a.id']  =  $productID;
          $name = M('product as a')->join('product  as  b  on b.id = a.pid')->join('product  as  c  on c.id = b.pid')->join('product  as  d  on d.id = c.pid')->where($map)->field('a.name as aname,b.name as bname,c.name as cname,d.name as dname')->select();
       // dump($name);die;
          $xlsData[$a]['salesModelID']= $name[0]['dname'].'-'.$name[0]['cname'].'-'.$name[0]['bname'].'-'.$name[0]['aname'] ;
      //dump($xlsData);die;
        }
        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['salesStand']=$v['salesStand']==1?'是':'否';
            $xlsData[$k]['salesCashback']=$v['salesCashback']==1?'是':'否';
        }

        
        $this->exportExcel1($xlsName,$xlsCell,$xlsData,$time,$branchName,$branchID,$userName,$salesStand,$sum);
       } else $this->error('导出报表失败！'); 
    } 


	}

?>