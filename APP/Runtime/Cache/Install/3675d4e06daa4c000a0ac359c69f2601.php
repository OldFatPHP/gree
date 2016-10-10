<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
  <link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
  <title><?php echo U('Dispatch/index');?></title>
 </head>
 <body>
<form action="<?php echo U('index');?>" method='post'>
	<table class='table'>
		<tr>
			<th align='right'>顾客姓名</th>
			<td width='90%'><input type='text' name='salesClientName' value='<?php echo ($salesClientName); ?>'/></td>
		</tr>
		<tr>
			<th align='right'>顾客手机号</th>
			<td width='90%'><input type='text' name='salesClientPhone' value='<?php echo ($salesClientPhone); ?>'/></td>
		</tr>
	</table>
	<input type='submit' value='查询'/>姓名和手机号可以只填一个，不填默认查询全部。
</form>
		<table class='table'>
			<tr> 
			 <td class="sum" colspan='100%'> <a href="<?php echo U('export');?>"><i class="icon-share-alt"></i> 导出</a></td>
			</tr>
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
				<td>操作</td>
			</tr>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><form action="<?php echo U('dispatchHandle');?>" method="post">
		       <tr>
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
		            <td><input type="text" name="installPersonName"></td>
		            <td><input type="text" name="installPersonPhone"></td>
		            
		            <td>
			            <input type="hidden" name="installID" value="<?php echo ($vo["installID"]); ?>">
			            <input type="submit" style="cursor:pointer" value="指派">
		            </td>
			   </tr>
			  </form><?php endforeach; endif; ?>
		      </table>

	<div class="result page"><?php echo ($page); ?></div>
 </body>
</html>