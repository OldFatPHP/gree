<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 已提交销售单记录：这个也是没什么特别的，也是怎么好做就怎么做吧。 -->
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<title>销售单明细</title>
</head>
<body>
	<form action="<?php echo U('SalesDetails');?>" method="post">
	<P><a href="<?php echo U('SalesDetails/expUser');?>" ><i class="icon-share-alt"></i>导出</a></P>

	<table class="table">

		<tr>
				<th>销售单号</th>
				<th>销售网点</th>
				<th>销售员手机号</th>
				<th>销售员</th>
				<th>顾客姓名</th>
				<th>顾客手机号码</th>
				<th>顾客固定电话</th>
				<th>发票号</th>
				<th>邮箱</th>
				<th>购买时间</th>
				<th>预约安装时间</th>
				<th>安装地址</th>
				<th>购买产品型号</th>
				<th>销售提成</th>
				<th>是否要支架</th>
				<th>是否返现</th>
				<th>购买数量</th>
				<th>销售备注</th>
		</tr>

		    <?php if(is_array($array)): foreach($array as $key=>$vo): ?><tr>
		            <td> <?php echo ($vo["salesID"]); ?></td>
		            <td> <?php echo ($vo["branchName"]); ?></td>
		            <td> <?php echo ($vo["salesPersonID"]); ?></td>
		            <td> <?php echo ($vo["userName"]); ?></td>
		            <td> <?php echo ($vo["salesClientName"]); ?></td>
		            <td> <?php echo ($vo["salesClientPhone"]); ?></td>
		            <td> <?php echo ($vo["salesPersonTelePhone"]); ?> </td>
		            <td> <?php echo ($vo["salesInvoiceID"]); ?></td>
		            <td> <?php echo ($vo["salesClientMail"]); ?></td>
		            <td> <?php echo ($vo["salesBuyTime"]); ?></td>
		            <td> <?php echo ($vo["salesInstallTime"]); ?></td>
		            <td> <?php echo ($vo["salesPersonAddress"]); ?></td>
		            <td> <?php echo ($vo["salesModelID"]); ?></td>
		            <td> <?php echo ($vo["salesCommission"]); ?></td>
		            <td> <?php echo ($vo["salesStand"]); ?></td>
		            <td> <?php echo ($vo["salesCashback"]); ?></td>
		            <td> <?php echo ($vo["salesProductNum"]); ?></td>
		            <td> <?php echo ($vo["salesRemark"]); ?></td>
		</tr><?php endforeach; endif; ?>

	</table>

          <div class="result page"><?php echo ($page); ?></div>
	</form>
</body>
</html>