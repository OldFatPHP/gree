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
			$map['installBranchID'] = session('branchID');

			//查询工单总数量
			$num = $model->where($map)->sum('salesProductNum');
			$maps = $map;
			$maps['installUserStand'] = '1';
			$standNum = $model->where($maps)->sum('salesProductNum');

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

			$branchID = session('branchID');
			$branch = M('install_branch')->find($branchID);
	//		dump($branch);die;


/*			dump($branch);	
			dump($time);	
		echo"数量：";	dump($num);	
		echo"支架数量：";	dump($standNum);	
			dump($data2);die;	*/

		//	$money = $standNum*2;dump($money);die;

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


	
				

				$objPHPExcel->getActiveSheet()->setCellValue('A1', '深圳中永安信商贸有限公司' );
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
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, '单价/付：50元' );
				$moneys = $standNum*50;
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

		



	}

?>