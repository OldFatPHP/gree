<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<title>用户信息</title>
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
		<form action="<?php echo U('Operation/search');?>" method="post">
		<table class='table'>
			<tr><th align='right'>手机号</th><td width='90%'><input type="text" name="userID"  value="<?php echo ($userID); ?>"></td></tr>
			<tr>
			<th align='right'>姓名</th>
			<td width='90%'><input type="text" name="userName" value="<?php echo ($userName); ?>"></td>
			</tr>
			<tr>
			<tr>
			<th align='right'>类别</th>
			<td width='90%'>
			<select name="userTypeID">
				<option value="">请选择</option>
				<?php if($userTypeID == 1): ?><option value=1 selected="selected">销售</option>
				<?php else: ?>
					<option value=1>销售</option><?php endif; ?>
				<?php if($userTypeID == 2): ?><option value=2 selected="selected">安装</option>
				<?php else: ?>
					<option value=2>安装</option><?php endif; ?>
				<?php if($userTypeID == 3): ?><option value=3 selected="selected">后台</option>
				<?php else: ?>
					<option value=3>后台</option><?php endif; ?>
			</select>
			</td>
			</tr>
			<tr>

		</table>
		<input type="submit" value="确认查询">
		</form>
		
		<table class='table'>
			<tr>
				<th> 手机号</th>
				<th> 姓名</th>
				<th> 性别</th>
				<th> 证件号</th>
				<th> 入职时间</th>
				<th> 类别</th>
				<th> 备注</th>
				<td> 操作</td>
			</tr>
			<?php if(is_array($array)): foreach($array as $key=>$v): ?><tr>
					<td> <?php echo ($v["userID"]); ?></td>
					<td> <?php echo ($v["userName"]); ?></td>
					<td> <?php echo ($v["userSex"]); ?></td>
					<td> <?php echo ($v["userIDCard"]); ?></td>
					<td> <?php echo ($v["userEntryTime"]); ?></td>
					<?php if($v['userTypeID']==1): ?><td> 销售</td><?php endif; ?>
					<?php if($v['userTypeID']==2): ?><td> 安装</td><?php endif; ?>
					<?php if($v['userTypeID']==3): ?><td> 后台(<?php echo ($v["userBranchID"]); ?>)</td><?php endif; ?>
					<td> <?php echo ($v["userRemark"]); ?></td>
					<td> <a href="<?php echo U('Operation/delete', array('userID' => $v['userID']));?>" onClick="return rec()">删除</a>
						<a href="<?php echo U('Operation/update', array('userID' => $v['userID']));?>">修改</a></td>
			   </tr><?php endforeach; endif; ?>
		</table>
		<div class="result page"><?php echo ($page); ?></div><br/>

	</body>
</html>