<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 销售网点查询：这个没有什么要注意的，怎么做都行。 -->
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<title>网点查询</title>
</head>
<body>
  <form  action="<?php echo U('add');?>"  method="post"  name="query">         		    
		 <table class='table'>

		 	<tr>
			<th align='right'>网点类型</th>
			<td width='90%'>
					<select name="branchtype">
						<option value="">请选择</option>
						<?php if($branchtype == 1): ?><option value="1" selected="selected">销售网点</option>
						<?php else: ?>
							<option value="1">销售网点</option><?php endif; ?>
						<?php if($branchtype == 2): ?><option value="2" selected="selected">安装网点</option>
						<?php else: ?>
							<option value="2">安装网点</option><?php endif; ?>
					</select>
			</td>
			</tr>
			<tr>
			<th align='right'>网点名</th>
			<td width='90%'><input type="text" name="branchName" value="<?php echo ($branchName); ?>"></td>
			</tr>
			<tr>
			<th align='right'>网点地址</th>
			<td width='90%'><input type="text" name="branchAddress" value="<?php echo ($branchAddress); ?>"></td>
			</tr>
			<tr>
			<th align='right'>网点负责人</th>
			<td width='90%'><input type="text" name="branchPicName" value="<?php echo ($branchPicName); ?>"></td>
			</tr>
			<tr>
			<th align='right'>网点负责人电话</th>
			<td width='90%'><input type="text" name="branchPicPhone" value="<?php echo ($branchPicPhone); ?>"></td>
			</tr>
			
		</table>
		<input type='submit' style="cursor:pointer"  value='查询' onclick="query.action='<?php echo U(add);?>';query.submit();"/>
	    <input type='submit' style="cursor:pointer"  value='导出' onclick="query.action='<?php echo U(expUser);?>';query.submit();"/>
		<p>单击查询或导出，默认查询或导出全部</p>
	</form>
<form action="<?php echo U('add');?>" method="post">
		<table class='table'>
			<tr>
				<th>网点类型</th>
				<th>网点名</th>
				<th>网点地址</th>
				<th>网点负责人</th>
				<th>网点负责人电话</th>
				<th>网点创建时间</th>
				<th>操作</th>
			</tr>

		    <?php if(is_array($array)): foreach($array as $key=>$vo): ?><tr>
		       		<td style="text-align:center;"> 
		       			<?php if($vo['branchType'] == 1): ?>销售网点
						<?php else: ?>
							安装网点<?php endif; ?>
		       		</td>
		            <td style="text-align:center;"> <?php echo ($vo["branchName"]); ?></td>
		            <td style="text-align:center;"> <?php echo ($vo["branchAddress"]); ?></td>
		            <td style="text-align:center;"> <?php echo ($vo["branchPicName"]); ?></td>
		            <td style="text-align:center;"> <?php echo ($vo["branchPicPhone"]); ?></td>
		            <td style="text-align:center;"> <?php echo ($vo["branchCreateDate"]); ?></td>
		            <td><a href="<?php echo U('BranchInquiries/update',array('branchID' => $vo['branchID']));?>" >修改</a></td>
		            
			   </tr><?php endforeach; endif; ?>
		</table>
		<div class="result page"><?php echo ($page); ?></div>
	</form>
</body>
</html>