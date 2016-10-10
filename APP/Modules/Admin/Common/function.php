<?php
/*	/*分页函数
	*参数1.$map,数组，查询条件数组
	* 参数2.$number变量，每页显示的条数
	*
	* 返回值
	* 1.
	 */
	function paging($map,$number){
			$Data = D('InstallView'); // 实例化Data数据对象
		    import('ORG.Util.Page');// 导入分页类
		    $map['status'] = 1;
		    $count = $Data->where($map)->count();// 查询满足要求的总记录数 $map表示查询条件
		    $Page  = new Page($count,$number);// 实例化分页类 传入总记录数
		    return $Page;
	}

	/*查询函数
	*参数1.$map数组，查询条件
	*参数2.$limit字符串，限制查询的位置和数量
	*参数3.$order字符串，结果集的排序
	* 
	 */
	function select($map='',$limit='',$order='installCreateTime'){
			$model = D('InstallView'); 
			$map['status'] = '1';
			$data = $model->where($map)->limit($limit)->order($order)->select();
			return $data;
	}



	function transfer($data){

		for($n=0;$n<count($data);$n++){
				//	$xlsData[$k]['sex']=$v['sex']==1?'男':'女';
					if(empty($data)){
						break;
					}
					$data[$n]['salesCashback'] = $data[$n]['salesCashback'] ==1 ? '是' : '否' ;
					$data[$n]['salesStand'] = $data[$n]['salesStand'] ==1 ? '是' : '否' ;
					$data[$n]['installUserStand'] = $data[$n]['installUserStand'] ==1 ? '是' : '否' ;
					$data[$n]['installNewSystem'] = $data[$n]['installNewSystem'] ==1 ? '是' : '否' ;
					$data[$n]['installTransferSettlement'] = $data[$n]['installTransferSettlement'] ==1 ? '是' : '否' ;
					$data[$n]['branchName']=$data[$n]['userTypeID']==3 ? '后台' : $data[$n]['branchName'];

					switch ($data[$n]['installStatus']) {
						case '1': $data[$n]['installStatus'] ='安装待派工';
							break;
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

		return $data;
	}
	//递归重组节点信息为多维数组
	function node_merge($node,$access=NULL,$pid=0){
	
		$arr=array();
	
		foreach ($node as $v){
			if (is_array($access)) {
				$v['access']=in_array($v['id'], $access) ? 1 : 0;
			}
			if ($v['pid']==$pid) {
				$v['child']=node_merge($node, $access,$v['id']);
				$arr[]=$v;
			}
	
		}
		return $arr;
	}

	function num2char($num,$mode=true){
			//	$char = array('零','一','二','三','四','五','六','七','八','九');
				$char = array('零','壹','贰','叁','肆','伍','陆','柒','捌','玖');
				// $dw = array('','十','百','千','','万','亿','兆');
				$dw = array('','拾','佰','仟','','萬','億','兆');
				$dec = '点';  //$dec = '點';
				$retval = '';
				if($mode){
					preg_match_all('/^0*(\d*)\.?(\d*)/',$num, $ar);
				}else{
					preg_match_all('/(\d*)\.?(\d*)/',$num, $ar);
				}
				if($ar[2][0] != ''){
					$retval = $dec . ch_num($ar[2][0],false); //如果有小数，先递归处理小数
				}
				if($ar[1][0] != ''){
					$str = strrev($ar[1][0]);
					for($i=0;$i<strlen($str);$i++) {
						$out[$i] = $char[$str[$i]];
						if($mode){
							$out[$i] .= $str[$i] != '0'? $dw[$i%4] : '';
							if($str[$i]+$str[$i-1] == 0){
								$out[$i] = '';
							}
							if($i%4 == 0){
								$out[$i] .= $dw[4+floor($i/4)];
							}
						}
					}
					$retval = join('',array_reverse($out)) . $retval;
				}
				return $retval;
			}
	
	

?>