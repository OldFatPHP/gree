<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
  <link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
      <script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
  <title>未接安装工单</title>
  	<script>
  $(function(){
	  $("input[name='allcheck']").change(function(){ 
			if($("input[name='allcheck']").is(':checked')){
				$("input[name^='installID']").attr("checked",true); 
			}else{
				$("input[name^='installID']").attr("checked",false); 
			}
		});
  });
  
  </script>
       <script type="text/javascript">
  function rec(){
    var mymessage=confirm("你确定删除吗？");
    if(mymessage==true)
    {
    	return true;
    }
    else
    {
        return false;
    }
  }    
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
<form action="<?php echo U(NoCloseHandle);?>" method="post">
		<table class='table'>
			<tr> 
			 <td class="sum" colspan='100%'> <a href="<?php echo U('export');?>"><i class="icon-share-alt"></i> 导出全部</a></td>
			</tr>
			<tr>
				<th>序号</th>
				<th>选择</th>
				<td>安装编号</td>
				<td>销售单号</td>
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
				<td>安装人员</td>
				<td>安装人员号码</td>
				<td>是否使用支架</td>
				<td>安装网点</td>
				<td>反馈类型</td>
				<td>反馈情况</td>
				<th>是否在新系统体现工单</th>
				<th>是否已转结算</th>
				<th>转结算日期</th>
				<th>备注</th>
				<th>操作</th>


			</tr>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
		       		<td><?php echo ($i++); ?></td>
		       		<td><input type="checkbox" name="installID[]" value="<?php echo ($vo["installID"]); ?>"></td>
		            <td><?php echo ($vo["installID"]); ?></td>
		            <td>
		            <a href="<?php echo U('SalesInquiries/update',array('salesID' => $vo['installSalesID']));?>" ><?php echo ($vo["installSalesID"]); ?></a>
		            </td>
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
		            <td><?php echo ($vo["installPersonName"]); ?> </td>
		            <td><?php echo ($vo["installPersonPhone"]); ?> </td>
		            <td><?php echo ($vo["installUserStand"]); ?> </td>
		            <td><?php echo ($vo["installBranchName"]); ?> </td>
		            <td><?php echo ($vo["installFeedback"]); ?> </td>
		            <td><?php echo ($vo["installFeedbackRemark"]); ?> </td>
		            <td><?php echo ($vo["installNewSystem"]); ?></td>
					<td><?php echo ($vo["installTransferSettlement"]); ?></td>
					<td><?php echo ($vo["installTransferSettlementDate"]); ?></td>
					<td><?php echo ($vo["installRemark"]); ?></td>
					<td><a href="<?php echo U('edit',array('id' => $vo['installID']));?>">编辑</a>
					<a href="<?php echo U('Delet/index',array('id' => $vo['installID']));?>" onClick="return rec()">   删除</a></td>
			   </tr><?php endforeach; endif; ?>

		</table>
		</br><P>&nbsp;全选&nbsp; <input type="checkbox" name="allcheck" value='1'></P>
		<input type="submit" value="关闭">
		</form>
	<div class="result page"><?php echo ($page); ?></div>
 </body>
</html>