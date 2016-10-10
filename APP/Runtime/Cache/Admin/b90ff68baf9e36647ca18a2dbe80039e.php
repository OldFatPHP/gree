<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 小类修改：这个修改我就想把这个index和update做在同一页面，最好是在原来的表格上就可以修改。 -->
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
</head>
<body>
	<form  action="<?php echo U('save');?>"  method="post"> 	      
		 	<table class='table'>
	          <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><tr>
	          	<th align='right'>小类修改</th>
	          	<td width='90%'>
	          		<input type="hidden" name="id" value="<?php echo ($k["id"]); ?>">
	          		<input type="hidden" name="categoriesID" value="<?php echo ($k["categoryID"]); ?>">
	          		<input type="text" name="name" value="<?php echo ($k["name"]); ?>">
	          		<input type = "submit" value="确认修改" >
	          	</td>
	          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		      
			</table>
	 </form>  
</body>
</html>