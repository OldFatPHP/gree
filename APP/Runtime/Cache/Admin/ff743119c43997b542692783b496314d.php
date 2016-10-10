<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 销售网点修改：这个修改我就想把这个index和update做在同一页面，最好是在原来的表格上就可以修改。 -->
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
  <link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
</head>
<body>
	<form  action="<?php echo U('save');?>"  method="post"> 
	          <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><table class='table'>
						<tr>
							<th>网点名</th>
							<th>网点地址</th>
							<th>网点负责人</th>
							<th>网点负责人电话</th>
						</tr>
						<tr>
							<td style="text-align:center;"><input type="text" name="branchName" value="<?php echo ($k["branchName"]); ?>"></td>
							<td style="text-align:center;"><input type="text" name="branchAddress" value="<?php echo ($k["branchAddress"]); ?>"></td>
							<td style="text-align:center;"><input type="text" name="branchPicName" value="<?php echo ($k["branchPicName"]); ?>"></td>
							<td style="text-align:center;"><input type="text" name="branchPicPhone" value="<?php echo ($k["branchPicPhone"]); ?>"></td>
						</tr>
					</table><?php endforeach; endif; else: echo "" ;endif; ?>
		      <input type="hidden" name="branchID" value="<?php echo ($k["branchID"]); ?>">
		      <input type = "submit" value="确认修改" >
	    </form>
</body>
</html>