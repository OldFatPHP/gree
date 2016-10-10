<?php 
	class CommonAction extends Action{
	
			function __construct(){
				parent::__construct();
				if(session('userName') == '' || session('userID') == '' || session('userTypeID') != '3'){
					$this->error('请登录！',U('Login/index'));
				}
			
//权限控制
/*			$notAuth=in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')));
				


			if (C('USER_AUTH_ON') && !$notAuth) {
				import('ORG.Util.RBAC');
				RBAC::AccessDecision(GROUP_NAME) || $this->error('没有权限');
			} */
			


		}

		public function exportExcel($expTitle,$expCellName,$expTableData){
		ob_end_clean();//清除缓存防止乱码
		$xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
		$fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
	//	echo $xlsTitle."<br>".$fileName;die();
		//dump($expTableData);die();
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

	/**
	 *
	 * 导出Excel
	 */
	function expUser(){//导出Excel
		$xlsName  = "User";
		$xlsCell  = array(
		array('id','账号序列'),
		array('truename','名字'),
		array('sex','性别'),
		array('res_id','院系'),
		array('sp_id','专业'),
		array('class','班级'),
		array('year','毕业时间'),
		array('city','所在地'),
		array('company','单位'),
		array('zhicheng','职称'),
		array('zhiwu','职务'),
		array('jibie','级别'),
		array('tel','电话'),
		array('qq','qq'),
		array('email','邮箱'),
		array('honor','荣誉'),
		array('remark','备注')
		);
	//	$xlsModel = M('sz_Member');

		$xlsData  = M('Member')->Field('id,truename,sex,res_id,sp_id,class,year,city,company,zhicheng,zhiwu,jibie,tel,qq,email,honor,remark')->select();
	//	$xlsModel->getLastSql();
	//	dump($xlsData);die;

		foreach ($xlsData as $k => $v)
		{
			$xlsData[$k]['sex']=$v['sex']==1?'男':'女';
		}
		$this->exportExcel($xlsName,$xlsCell,$xlsData);
			
	}
	/**
	 *
	 * 显示导入页面 ...
	 */

	/**实现导入excel
	 **/
	function impUser(){
		if (!empty($_FILES)) {
			import("@.ORG.UploadFile");
			$config=array(
                'allowExts'=>array('xlsx','xls'),
                'savePath'=>'./Public/upload/',
                'saveRule'=>'time',
			);
			$upload = new UploadFile($config);
			if (!$upload->upload()) {
				$this->error($upload->getErrorMsg());
			} else {
				$info = $upload->getUploadFileInfo();

			}

			vendor("PHPExcel.PHPExcel");
			$file_name=$info[0]['savepath'].$info[0]['savename'];
			$objReader = PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow(); // 取得总行数
			$highestColumn = $sheet->getHighestColumn(); // 取得总列数
			for($i=3;$i<=$highestRow;$i++)
			{
				$data['account']= $data['truename'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
				$sex = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
				// $data['res_id']    = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
				$data['class'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
				$data['year'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
				$data['city']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
				$data['company']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
				$data['zhicheng']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
				$data['zhiwu']= $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
				$data['jibie']= $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
				$data['honor']= $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();
				$data['tel']= $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();
				$data['qq']= $objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue();
				$data['email']= $objPHPExcel->getActiveSheet()->getCell("O".$i)->getValue();
				$data['remark']= $objPHPExcel->getActiveSheet()->getCell("P".$i)->getValue();
				$data['sex']=$sex=='男'?1:0;
				$data['res_id'] =1;

				$data['last_login_time']=0;
				$data['create_time']=$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];
				$data['login_count']=0;
				$data['join']=0;
				$data['avatar']='';
				$data['password']=md5('123456');
				M('Member')->add($data);
					
			}
			$this->success('导入成功！');
		}else
		{
			$this->error("请选择上传的文件");
		}


	}



	
	public function editSubmit($install,$installID,$sales,$salesID){
		

		$installModel = M('install_information');
		$salesModel = M('sales_information');
		if(!empty($install)){
			//dump($install);

			$wherei['installID'] = $installID;
			$wordi = $installModel->where($wherei)->save($install);
			//echo  $installModel->getLastSql();
		}
		
		if(!empty($sales)){
		//	dump($sales);
			$wheres['salesID'] = $salesID;
			$words = $salesModel->where($wheres)->save($sales);
		//	echo $salesModel->getLastSql();
		}

		if($words || $wordi ){
		//	echo "success";
			$this->success('成功','index');
		}else{
		//	echo "error";
			$this->error('失败','index');
		}



	}

			public function edit(){			
		
			$installID = I('id');
			$map['installID'] = $installID;
			$data = select($map);

			for($n=0;$n<count($data);$n++){
					if(empty($data)){
						break;
					}


					switch ($data[$n]['installStatus']) {
						case '2': $data[$n]['installStatus'] ='未接收';
							break;
						case '3': $data[$n]['installStatus'] ='未指派';
							break;
						case '4': $data[$n]['installStatus'] ='未完成';
							break;
						case '5': $data[$n]['installStatus'] ='报完工';
							break;
						case '6': $data[$n]['installStatus'] ='待关闭';
							break;
						case '7': $data[$n]['installStatus'] ='已关闭';
							break;
						case '10': $data[$n]['installStatus'] ='未审核';
							break;
						
						default:
							break;
					}


					switch ($data[$n]['installFeedback']) {
						case '1': $data[$n]['installFeedback'] ='安装完工';
							break;
						case '2': $data[$n]['installFeedback'] ='用户改约';
							break;
						case '3': $data[$n]['installFeedback'] ='无法正常完工';
							break;
						case '4': $data[$n]['installFeedback'] ='请求改派';
							break;
						case '5': $data[$n]['installFeedback'] ='其他';
							break;
						
						default:

							break;
					}

				  }






			$m = M('install_branch');
		    $branchName = $m->field('branchID,branchName')->select();
		    $this->assign('branchName',$branchName);  // 安装网点信息输出


		    
			$this->assign('list',$data);
		//	dump($data);die();
			$this->display();
				
			}




}
		
	
	

 ?>