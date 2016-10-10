<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
  <link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
  <title><?php echo U('Report/index');?></title>
</head>
<body>
<form action="<?php echo U(expUser1);?>" method="post">
	关闭工单时间:（例：2016年3月）
	<input type="text" name="year" style="width:40px;height:20px">&nbsp&nbsp年&nbsp
	<select name="month">
					<option value='' selected="selected">请选择</option>
					<option value='1' >1月</option>
					<option value='2' >2月</option>
					<option value='3' >3月</option>
					<option value='4' >4月</option>
					<option value='5' >5月</option>
					<option value='6' >6月</option>
					<option value='7' >7月</option>
					<option value='8' >8月</option>
					<option value='9' >9月</option>
					<option value='10' >10月</option>
                    <option value='11' >11月</option>
                    <option value='12' >12月</option>

	</select>				
	<!-- <input type="text" name="month">月, -->
	&nbsp&nbsp&nbsp&nbsp&nbsp销售员手机号：<input type="text" name="salesPersonID" style="width:200px;height:20px">
   <tr>
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<th align='right'>派工状态：</th>
			<td width='90%'>
			<select name="installStatus">
					<option value='' selected="selected">请选择</option>
	<!-- 			<?php if($installStatus == 1): ?><option value='1' selected="selected">未指派网点</option>
				<?php else: ?>
					<option value='1'>未指派网点</option><?php endif; ?>
				<?php if($installStatus == 2): ?><option value='2' selected="selected">未接收</option>
				<?php else: ?>
					<option value='2'>未接收</option><?php endif; ?>
				<?php if($installStatus == 3): ?><option value='3' selected="selected">未指派师傅</option>
				<?php else: ?>
					<option value='3'>未指派师傅</option><?php endif; ?>
				<?php if($installStatus == 4): ?><option value='4' selected="selected">未完成</option>
				<?php else: ?>
					<option value='4'>未完成</option><?php endif; ?>
				<?php if($installStatus == 5): ?><option value='5' selected="selected">报完工</option>
				<?php else: ?>
					<option value='5'>报完工</option><?php endif; ?>-->
				<?php if($installStatus == 7): ?><option value='7' selected="selected">已关闭</option>
				<?php else: ?>
					<option value='7'>已关闭</option><?php endif; ?>
				<?php if($installStatus == 8): ?><option value='8' selected="selected">其他状态</option>
				<?php else: ?>
					<option value='8'>其他状态</option><?php endif; ?> 
<!-- 				<?php if($installStatus == 10): ?><option value='10' selected="selected">未审核</option>	
				<?php else: ?>
					<option value='10'>未审核</option><?php endif; ?>	 -->		
			</select>
			</td>
		</tr>
	<input type="submit" style="cursor:pointer" name="" value="导出">
</form>
</body>
</html>