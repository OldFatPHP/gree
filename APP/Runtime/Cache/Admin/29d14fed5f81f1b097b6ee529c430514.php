<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 产品品类查询：这个没有什么要注意的，怎么做都行。 -->
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<title>品类查询</title>
</head>
<body>
  <form  action="<?php echo U('add');?>"  method="post"> 
  <table class='table'>
        <tr><th align='right'>品类查询</th><td width='90%'><input type="text" name="categoryName" value="<?php echo ($categoryName); ?>"><input type="submit" value="查询"><p>输入为空，默认查询全部！</p></td></tr>          
	</table>
	
	</form>
<form action="<?php echo U('add');?>" method="post">
		<table class='table'>
			<thead>
				<th>品类</th>
				<th>操作</th>
			</thead>
		    <?php if(is_array($array)): foreach($array as $key=>$vo): ?><tr>
		            <td style="text-align:center;"> <?php echo ($vo["name"]); ?></td>
		             <td style="text-align:center;"> <a href="<?php echo U('CategoryModify/update',array('categoryID' => $vo['id']));?>" >修改</a></td>
			   </tr><?php endforeach; endif; ?>

		</table>
		<div class="result page"><?php echo ($page); ?></div>
	</form>
</body>
</html>