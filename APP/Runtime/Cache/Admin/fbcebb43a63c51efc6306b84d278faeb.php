<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<title>品类汇总</title>
</head>
<body>
	<form action="<?php echo U('CategoryDetails');?>" method="post">
	  <table class='table'>
	  <tr> 
			 <td class="sum" colspan='100%'> <a href="<?php echo U('CategoryDetails/expUser');?>" ><i class="icon-share-alt"></i> 导出</a></td>
	  </tr>
			<tr>
                <th>品类</th>
			</tr>
		    <?php if(is_array($array)): foreach($array as $key=>$vo): ?><tr>
		            <td style="text-align:center;"> <?php echo ($vo["name"]); ?></td>			   
		       </tr><?php endforeach; endif; ?>
		</table>
          <div class="result page"><?php echo ($page); ?></div>
	</form>
</body>
</html>