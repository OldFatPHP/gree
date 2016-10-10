<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 小类汇总：这个也是没什么特别的，也是怎么好做就怎么做吧。 -->
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<title>小类汇总</title>
</head>
<body>
	<form action="<?php echo U('CategoriesDetails');?>" method="post">
		<table class='table'>
	  <tr> 
			 <td class="sum" colspan='100%'> <a href="<?php echo U('CategoriesDetails/expUser');?>" ><i class="icon-share-alt"></i> 导出</a></td>
	  </tr>
			<tr>
				<th>品类</th>
                <th>小类</th>
			</tr>
		    <?php if(is_array($array)): foreach($array as $key=>$vo): ?><tr>
		            <td style="text-align:center;"> <?php echo ($vo["0"]["name"]); ?></td>
		            <td style="text-align:center;"> <?php echo ($vo["1"]["name"]); ?></td>			   
		       </tr><?php endforeach; endif; ?>
		</table>
          <div class="result page"><?php echo ($page); ?></div>
	</form>
</body>
</html>