<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
  <link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
  <title><?php echo U('NoInstall/index');?></title>
  <script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/Js/jquery.date_input.pack.js"></script> 
  <script type="text/javascript">
  <!--
  $(function(){
		$('.date_picker').date_input();
		//反馈类型
		$('select').change(function(){ 
			if($("select[name='installFeedback']").val()==1){
				$("textarea[name='installFeedbackRemark']").attr("disabled",true); 
			}else{
				$("textarea[name='installFeedbackRemark']").attr("disabled",false); 
			}
		});
		//是否已转结算
		$("input[name='installTransferSettlement']").change(function(){ 

			if($("input[name='installTransferSettlement']:checked").val()==1){
				$("input[name='installTransferSettlementDate']").attr("disabled",false); 
			}else{
				$("input[name='installTransferSettlementDate']").attr("disabled",true); 
			}
		});

		
		});
  //-->
  </script>
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
				<th>备注</th>
				<td>操作</td>
			</tr>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><form action="<?php echo U('noInstallHandle');?>" method="post">
		       <tr>
		       		<td><?php echo ($i++); ?></td>
		            <td><?php echo ($vo["installID"]); ?></td>
		            <td><?php echo ($vo["salesBuyTime"]); ?> </td>
		            <td>		             
		            <a href="<?php echo U('editTime',array('id' => $vo['installID']));?>" ><?php echo ($vo["salesInstallTime"]); ?></a>
		            </td>
		            <td><?php echo ($vo["installCreateTime"]); ?> </td>
		            <td><?php echo ($vo["branchName"]); ?> </td>
		            <td><?php echo ($vo["modelName"]); ?> </td>
		            <td><?php echo ($vo["salesProductNum"]); ?> </td>
		            <td><?php echo ($vo["salesClientName"]); ?> </td>
		            <td><?php echo ($vo["salesClientPhone"]); ?> </td>
		            <td><?php echo ($vo["salesPersonTelePhone"]); ?> </td>
		            <td><?php echo ($vo["salesPersonAddress"]); ?> </td>
		            <td><?php echo ($vo["salesRemark"]); ?> </td>
		            <td><?php echo ($vo["salesCashback"]); ?> </td>
		            <td><?php echo ($vo["salesStand"]); ?></td>
		            <td><?php echo ($vo["installPersonName"]); ?></td>
		            <td><?php echo ($vo["installPersonPhone"]); ?></td>

					<td>
					<?php if($vo["salesStand"] == 是): ?>是<input type="radio" name="installUserStand" value="1" checked="checked">
						否<input type="radio" name="installUserStand" value="0">
					<?php else: ?>
						是<input type="radio" name="installUserStand" value="1">
						否<input type="radio" name="installUserStand" value="0" checked="checked"><?php endif; ?>
					</td>
					<td>
						<select name="installFeedback">
							<option value='1'>安装完工</option>
							<option value='3'>无法正常完工</option>
							<option value='4'>请求改派（区域错误）</option>
							<option value='5'>其他</option>		
						</select>
					</td>
					<td>
						<textarea name="installFeedbackRemark" style="width:150px;height:50px;" disabled="disabled"></textarea>
					</td>
					<td>
						是<input type="radio" name="installNewSystem" value="1" checked="checked">
						否<input type="radio" name="installNewSystem" value="0">
					</td>

					<td>
						是<input type="radio" name="installTransferSettlement" value="1" checked="checked">
						否<input type="radio" name="installTransferSettlement" value="0">
				    </td>
					<td>
						<input name="installTransferSettlementDate" type="datetime" class="date_picker">
					</td>
					<td>
						<textarea name="installRemark" style="width:150px;height:50px;"></textarea>
					</td> 
		            <td><input type="hidden" name="installID" value="<?php echo ($vo["installID"]); ?>"><input type="submit" style="cursor:pointer" value="反馈"></td>
			   		</tr>
			  </form><?php endforeach; endif; ?>
		      </table>

	<div class="result page"><?php echo ($page); ?></div>
 </body>
</html>