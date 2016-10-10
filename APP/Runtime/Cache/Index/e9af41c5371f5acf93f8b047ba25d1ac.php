<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 已提交销售单记录：这个也是没什么特别的，也是怎么好做就怎么做吧。 -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>中宏力实业管理系统--销售前台</title>
    <!--[if lte IE 8]><link rel="stylesheet" href="__PUBLIC__/Css/responsive-nav.css"><![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="__PUBLIC__/Css/navstyles.css"><!--<![endif]-->
    <script type="text/javascript" async="" src="__PUBLIC__/Js/ga.js"></script>
    <script>
      var doc = document, docEl = doc.documentElement;
      docEl.className = docEl.className.replace(/(^|\s)no-js(\s|$)/, " js ");
    </script>
    <script src="__PUBLIC__/Js/responsive-nav.js"></script>

	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="__PUBLIC__/Css/style.css" />
	<title>已提交销售单明细</title>
	<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/Js/jquery.date_input.pack.js"></script> 
    <script type="text/javascript">
  $(function(){
		$('.date_picker').date_input();
		})
  </script>
	<!--[if !IE]><!-->

	<style>
	
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
	
		/* Force table to not be like tables anymore */
		#page-wrap table,#page-wrap thead, #page-wrap tbody, #page-wrap th, #page-wrap td, #page-wrap tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		#page-wrap thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		#page-wrap tr { border: 1px solid #ccc; }
		
		#page-wrap td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee; 
			position: relative;
			padding-left: 50%; 
		}
		
		#page-wrap td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		#page-wrap td:nth-of-type(1):before { content: "销售单号"; }
		#page-wrap td:nth-of-type(2):before { content: "销售网点"; }
		#page-wrap td:nth-of-type(3):before { content: "销售员"; }
		#page-wrap td:nth-of-type(4):before { content: "顾客姓名"; }
		#page-wrap td:nth-of-type(5):before { content: "顾客手机号码"; }
		#page-wrap td:nth-of-type(6):before { content: "顾客固定电话"; }
		#page-wrap td:nth-of-type(7):before { content: "发票号"; }
		#page-wrap td:nth-of-type(8):before { content: "邮箱"; }
		#page-wrap td:nth-of-type(9):before { content: "购买时间"; }
		#page-wrap td:nth-of-type(10):before { content: "预约安装时间"; }
		#page-wrap td:nth-of-type(11):before { content: "安装地址"; }
		#page-wrap td:nth-of-type(12):before { content: "购买产品型号"; }
		#page-wrap td:nth-of-type(13):before { content: "销售提成"; }
		#page-wrap td:nth-of-type(14):before { content: "是否要支架"; }
		#page-wrap td:nth-of-type(15):before { content: "是否返现"; }
		#page-wrap td:nth-of-type(16):before { content: "购买数量"; }
		#page-wrap td:nth-of-type(17):before { content: "销售备注"; }
		
	}
	
	/* Smartphones (portrait and landscape) ----------- */
	@media only screen
	and (min-device-width : 320px)
	and (max-device-width : 480px) {
		body { 
			padding: 0; 
			margin: 0;  }
		}
	
	/* iPads (portrait and landscape) ----------- */
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		body { 
			width: 100%; 
		}
	}
	
	</style>
	<!--<![endif]-->
	<!--[if lt IE 9]>
	<script src="__PUBLIC__/Js/css3-mediaqueries.js"></script>
	<script src="__PUBLIC__/Js/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div id="top">
    <div class="exit">
<!--      <a href="table.html" target="_self">维修待派工：1</a>
      <a href="table.html" target="_self">维修新子信息：2</a>
      <a href="table.html" target="_self">维修被驳回：3</a>
      <a href="table.html" target="_self">维修已超时：4</a>
      <a href="table.html" target="_self">维修待关闭：5</a> -->
      你好！<?php echo ($user["name"]); ?>
      <a href="<?php echo U('CheckPassword/check_user', array('userID' => $user[id]));?>" target="_self">修改密码</a>
      <a href="<?php echo U('Login/logout');?>" target="_self">退出</a>
    </div>

  </div>

    <div role="navigation" id="nav" class="closed" aria-hidden="false" style="transition: max-height 400ms; position: relative;">
      <ul>
        <li><a href="<?php echo U('SalesInput/index');?>">销售单录入</a></li>
        <li><a href="<?php echo U('SalesSubmit/index');?>">销售单提交</a></li>
        <li><a href="<?php echo U('SalesInquiries/index');?>">销售单查询</a></li>
        
        <li class="active"><a href="<?php echo U('SalesDetails/index');?>">销售单明细</a></li>
      </ul>
    </div>

    <div role="main" class="main">
      <a href="http://www.bootcss.com/p/responsive-nav.js/demo/#nav" id="toggle" aria-hidden="true">Menu</a>
	<form action="<?php echo U('SalesDetailsAction');?>" method="post">
	<P><a href="<?php echo U('SalesDetails/expUser');?>" ><i class="icon-share-alt"></i> 导出数据并生成excel</a></P>
<div id="page-wrap">
	<table>
		<thead>
		<tr>
				<th>销售单号</th>
				<th>销售网点</th>
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
		</thead>
		<tbody>
		    <?php if(is_array($array)): foreach($array as $key=>$vo): ?><tr>
		            <td> <?php echo ($vo["salesID"]); ?></td>
		            <td> <?php echo ($vo["branchName"]); ?></td>
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
		</tbody>
	</table>
</div>
          <div class="result page"><?php echo ($page); ?></div>
	</form>
	</div>

    <script>
      var navigation = responsiveNav("#nav", {customToggle: "#toggle"});
    </script>
    
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-39967427-1']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  
</body>
</html>