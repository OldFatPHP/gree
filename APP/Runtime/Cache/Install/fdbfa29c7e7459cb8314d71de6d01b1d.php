<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
  <link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
  <title><?php echo U('Query/index');?></title>
    <script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/Js/jquery.date_input.pack.js"></script> 
  <script type="text/javascript">
  <!--
  $(function(){
		$('.date_picker').date_input();
		})
  //-->
  </script>
 </head>
 <body>
 	<form action="<?php echo U(queryHandle);?>" method='post' name="query">
	<table class='table'>
		<tr>
			<th align='right'>安装编号</th>
			<td width='90%'><input type='text' name='installID' value='<?php echo ($installID); ?>'/></td>
		</tr>
		<tr>
			<th align='right'>销售编号</th>
			<td width='90%'><input type='text' name='saleID' value='<?php echo ($saleID); ?>'/></td>
		</tr>
		<tr>
			<th align='right'>购买人</th>
			<td width='90%'><input type='text' name='salesClientName' value='<?php echo ($salesClientName); ?>'/></td>
		</tr>
		<tr>
			<th align='right'>购买人手机号</th>
			<td width='90%'><input type='text' name='salesClientPhone' value='<?php echo ($salesClientPhone); ?>'/></td>
		</tr>
		<tr>
			<th align='right'>安装人名字</th>
			<td width='90%'><input type='text' name='installPersonName' value='<?php echo ($installPersonName); ?>'/></td>
		</tr>
		<tr>
			<th align='right'>派工状态</th>
			<td width='90%'>
			<select name="installStatus">
					<option value='' selected="selected">全部</option>
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
					<option value='5'>报完工</option><?php endif; ?>
				<?php if($installStatus == 6): ?><option value='6' selected="selected">待关闭</option>
				<?php else: ?>
					<option value='6'>待关闭</option><?php endif; ?>
				<?php if($installStatus == 7): ?><option value='7' selected="selected">已关闭</option>
				<?php else: ?>
					<option value='7'>已关闭</option><?php endif; ?>
				<?php if($installStatus == 10): ?><option value='10' selected="selected">未审核</option>	
				<?php else: ?>
					<option value='10'>未审核</option><?php endif; ?>
				
				
				
				
					
				
				
			</select>
			</td>
		</tr>
		<tr>
			<th align='right'>购买时间</th>
			<td width='90%'><input type='text' name='salesBuyTimeBegin' value='<?php echo ($salesBuyTimeBegin); ?>' class="date_picker"/>---<input type='text' name='salesBuyTimeEnd' value='<?php echo ($salesBuyTimeEnd); ?>' class="date_picker"/></td>
		</tr>
		<tr>
			<th align='right'>安装时间</th>
			<td width='90%'><input type='text' name='salesInstallTimeBegin' value='<?php echo ($salesInstallTimeBegin); ?>' class="date_picker"/>---<input type='text' name='salesInstallTimeEnd' value='<?php echo ($salesInstallTimeEnd); ?>' class="date_picker"/></td>
		</tr>
		<tr>
			<th align='right'>创建时间</th>
			<td width='90%'><input type='text' name='salesCreateTimeBegin' value='<?php echo ($salesCreateTimeBegin); ?>' class="date_picker"/>---<input type='text' name='salesCreateTimeEnd' value='<?php echo ($salesCreateTimeEnd); ?>' class="date_picker"/></td>
		</tr>
		<tr>
			<th align='right'>派工时间</th>
			<td width='90%'><input type='text' name='salesDispatchTimeBegin' value='<?php echo ($salesDispatchTimeBegin); ?>' class="date_picker"/>---<input type='text' name='salesDispatchTimeEnd' value='<?php echo ($salesDispatchTimeEnd); ?>' class="date_picker"/></td>
		</tr>
		

	</table>
	<input type='submit' style="cursor:pointer"  value='查询' onclick="query.action='<?php echo U(queryHandle);?>';query.submit();"/>
	<input type='submit' style="cursor:pointer"  value='导出' onclick="query.action='<?php echo U(export);?>';query.submit();"/>
	</form>

		<table class='table'>
			<tr>
				<th>序号</th>
				<td>安装编号</td>
				<td>购买日期</td>
				<td>安装日期</td>
				<td>创建时间</td>
				<td>派工时间</td>
				<td>购买商场</td>
				<td>购买型号</td>
				<td>数量</td>
				<td>顾客姓名</td>
				<td>顾客手机</td>
				<td>顾客固话</td>
				<td>顾客地址</td>
				<td>返现金额</td>
				<td>是否有返现活动</td>
				<td>是否需要支架</td>
				<td>安装人员名字</td>
				<td>安装人员手机号</td>
				<th>是否使用支架</th>
				<th>反馈类型</th>
				<th>反馈情况</th>
				<th>是否在新系统体现工单</th>
				<th>是否已转结算</th>
				<th>转结算日期</th>
				<th>安装状态</th>
				<th>备注</th>
			</tr>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
		       		<td><?php echo ($i++); ?></td>
		            <td><?php echo ($vo["installID"]); ?></td>
		            <td><?php echo ($vo["salesBuyTime"]); ?> </td>
		            <td><?php echo ($vo["salesInstallTime"]); ?> </td>
		            <td><?php echo ($vo["installCreateTime"]); ?> </td>
		            <td><?php echo ($vo["installDispatchTime"]); ?> </td>
		            <td><?php echo ($vo["branchName"]); ?> </td>
		            <td><?php echo ($vo["modelName"]); ?> </td>
		            <td><?php echo ($vo["salesProductNum"]); ?> </td>
		            <td><?php echo ($vo["salesClientName"]); ?> </td>
		            <td><?php echo ($vo["salesClientPhone"]); ?> </td>
		            <td><?php echo ($vo["salesPersonTelePhone"]); ?> </td>
		            <td><?php echo ($vo["salesPersonAddress"]); ?> </td>
		            <td><?php echo ($vo["salesRemark"]); ?> </td>
		            <td><?php echo ($vo["salesCashback"]); ?> </td>
		            <td><?php echo ($vo["salesStand"]); ?> </td>
		            <td><?php echo ($vo["installPersonName"]); ?></td>
		            <td><?php echo ($vo["installPersonPhone"]); ?></td>
					<td><?php echo ($vo["installUserStand"]); ?></td>
					<td><?php echo ($vo["installFeedback"]); ?></td>
					<td><?php echo ($vo["installFeedbackRemark"]); ?></td>
					<td><?php echo ($vo["installNewSystem"]); ?></td>
					<td><?php echo ($vo["installTransferSettlement"]); ?></td>
					<td><?php echo ($vo["installTransferSettlementDate"]); ?></td>
					<td><?php echo ($vo["installStatus"]); ?></td>
					<td><?php echo ($vo["installRemark"]); ?></td>
			   	</tr><?php endforeach; endif; ?>
		    </table>

	<div class="result page"><?php echo ($page); ?></div>
 </body>
</html>