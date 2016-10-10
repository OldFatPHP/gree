<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<title>小类新增</title>
</head>
<body>
       <form  action="<?php echo U('add');?>"  method="post">  
		    <table class='table'>
       		<tr>
			<th align='right'>小类</th>
			<td width='90%'>
			<select name="pid">
				<?php if(is_array($category)): foreach($category as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>	
			</select>
			<input type="text" name="name">
			<input type="hidden" name="categoryID" value="2">
			<input type="submit" value="新增"> 
			</td>
			</tr>
			</table>
       </form>
</body>
</html>