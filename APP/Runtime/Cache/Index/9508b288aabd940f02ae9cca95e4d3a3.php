<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 销售查询：这个没有什么要注意的，怎么做都行。 -->
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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="__PUBLIC__/Css/style.css" />
	<title>销售单查询</title>
	 <script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/Js/jquery.date_input.pack.js"></script> 
    <script type="text/javascript">
  $(function(){
		$('.date_picker').date_input();
		})
  </script>
  <script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/Js/jquery.date_input.pack.js"></script> 
    <script type="text/javascript">
  $(function(){
		$('.date_picker').date_input();
		})
  </script>
  	 <script type="text/javascript">
	  /*  
	 **    ==================================================================================================  
	 **    类名：CLASS_LIANDONG_YAO  
	 **    功能：多级连动菜单  
	 **    
	 **    作者：YAODAYIZI  
	 **    ============================
	 	======================================================================  
	 **/   
	   function CLASS_LIANDONG_YAO(array)
	   {
	    //数组，联动的数据源
	    this.array=array; 
	    this.indexName='';
	    this.obj='';
	    //设置子SELECT
	  // 参数：当前onchange的SELECT ID，要设置的SELECT ID
	       this.subSelectChange=function(selectName1,selectName2)
	    {
	    //try
	    //{
	     var obj1=document.all[selectName1];
	     var obj2=document.all[selectName2];
	     var objName=this.toString();
	     var me=this;
	   
	     obj1.onchange=function()
	     {
	      
	      me.optionChange(this.options[this.selectedIndex].value,obj2.id)
	     }
	    }
	    //设置第一个SELECT
	  // 参数：indexName指选中项,selectName指select的ID
	    this.firstSelectChange=function(indexName,selectName)  
	    {
	    this.obj=document.all[selectName];
	    this.indexName=indexName;
	    this.optionChange(this.indexName,this.obj.id)
	    }
	   
	   // indexName指选中项,selectName指select的ID
	    this.optionChange=function (indexName,selectName)
	    {
	     var obj1=document.all[selectName];
	     var me=this;
	     obj1.length=0;
	     obj1.options[0]=new Option("请选择",'');
	     for(var i=0;i<this.array.length;i++)
	     { 
	     
	      if(this.array[i][1]==indexName)
	      {
	      //alert(this.array[i][1]+" "+indexName);
	       obj1.options[obj1.length]=new Option(this.array[i][2],this.array[i][0]);
	      }
	     }
	    }
	    
	   }

 </script>
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
		#page-wrap td:nth-of-type(12):before { content: "型号"; }
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
        <li class="active"><a href="<?php echo U('SalesInquiries/index');?>">销售单查询</a></li>
        
        <li><a href="<?php echo U('SalesDetails/index');?>">销售单明细</a></li>
      </ul>
    </div>

    <div role="main" class="main">
      <a href="http://www.bootcss.com/p/responsive-nav.js/demo/#nav" id="toggle" aria-hidden="true">Menu</a>

  <form action="<?php echo U(add);?>" method="post" name="query">
  <table class='table'>
       <tr><th align='right'>销售单号</th><td width='70%'><input type="text" name="salesID" value="<?php echo ($salesID); ?>" ></td></tr>
<!--        <tr><th align='right'>销售网点</th><td width='70%'><input type="text" value="<?php echo ($salesBranchID); ?>" name="salesBranchID"></td></tr>
<tr><th align='right'>销售员工号</th><td width='70%'><input type="text" value="<?php echo ($salesPersonID); ?>" name="salesPersonID"></td></tr> -->
       <tr><th align='right'>顾客姓名</th><td width='70%'><input type="text" value="<?php echo ($salesClientName); ?>" name="salesClientName"></td></tr>
       <tr><th align='right'>顾客手机号码</th><td width='70%'><input type="text" value="<?php echo ($salesClientPhone); ?>" name="salesClientPhone"></td></tr>
<!--        <tr><th align='right'>顾客固话号码</th><td width='70%'><input type="text" value="<?php echo ($salesPersonTelePhone); ?>" name="salesPersonTelePhone"></td></tr> -->
       <tr><th align='right'>发票号</th><td width='70%'><input type="text" value="<?php echo ($salesInvoiceID); ?>" name="salesInvoiceID"></td></tr>

       <tr><th align='right'>购买时间</th><td width='70%'><input type="text" value="<?php echo ($salesBuyTimeBegin); ?>" name="salesBuyTimeBegin" value="<?php echo ($salesBuyTimeBegin); ?>" class="date_picker"/>---<input type='text' value="<?php echo ($salesBuyTimeEnd); ?>" name='salesBuyTimeEnd' value="<?php echo ($salesBuyTimeEnd); ?>" class="date_picker"/></td></tr>

       <tr><th align='right'>预约安装时间</th><td width='70%'><input type="text" value="<?php echo ($salesInstallTimeBegin); ?>" name="salesInstallTimeBegin" value="<?php echo ($salesInstallTimeBegin); ?>" class="date_picker"/>---<input type='text' value="<?php echo ($salesInstallTimeEnd); ?>" name='salesInstallTimeEnd' value="<?php echo ($salesInstallTimeEnd); ?>" class="date_picker"/></td></tr>

			<!-- <tr>
			<th align='right'>购买产品型号</th>
			<td width='70%'>
				<SELECT ID="x1" NAME="x1"  >
					<OPTION selected></OPTION>
				</SELECT>
				<SELECT ID="x2" NAME="x2"  >
					<OPTION selected></OPTION>
				</SELECT>
				<SELECT ID="x3" NAME="x3"  >
					<OPTION selected></OPTION>
				</SELECT>
				<SELECT ID="x4" NAME="x4"  >
					<OPTION selected></OPTION>
				</SELECT>
			</td>
			</tr>
			       <tr><th align='right'>是否要支架:</th><td width='70%'>是<input type="radio" value="1" name="salesStand">否<input type="radio" value="0" name="salesStand"></td></tr>
			       <tr><th align='right'>是否返现:</th><td width='70%'>是<input type="radio" value="1" name="salesCashback">否<input type="radio" value="0" name="salesCashback"></td></tr>
			       <tr><th align='right'>数量</th><td width='70%'><input type="text" value="<?php echo ($salesProductNum); ?>" name="salesProductNum"></td></tr> -->
	</table> 	            
		   <!-- <input type="submit" value="查询"><P>单击查询默认查询全部</P> -->
		  <input type='submit' style="margin:10px 0px 10px 30%;cursor:pointer;" value='查询' onclick="query.action='<?php echo U(add);?>';query.submit();"/>
	      <input type='submit' style="cursor:pointer;"  value='导出' onclick="query.action='<?php echo U(expUser);?>';query.submit();"/><br /><span>只查询已提交销售单，不输入则默认查询或者导出全部已提交销售单！</span>
	</form>
<form action="<?php echo U('add');?>" method="post">
<div id="page-wrap">
	<table>
		<thead>
	<!-- 		<tr> 
			 <td class="sum" colspan='100%'> <a href="<?php echo U('SalesInquiries/expUser');?>" ><i class="icon-share-alt"></i> 导出</a></td>
			</tr> -->
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
		            <td> <?php echo ($vo["salesModelID"]["0"]["name"]); ?>-<?php echo ($vo["salesModelID"]["1"]["name"]); ?>-<?php echo ($vo["salesModelID"]["2"]["name"]); ?>-<?php echo ($vo["salesModelID"]["3"]["name"]); ?></td>
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

<script type="text/javascript">
 //数据源 
  var arr=<?php echo ($arr); ?>;
 
  var array2=new Array();//数据格式 ID，父级ID，名称
  
  for(var o in arr){  
		array2[o]=new Array(arr[o].id,arr[o].pid,arr[o].name); 
    } 
  //--------------------------------------------
  //这是调用代码
  //设置数据源
  var liandong2=new CLASS_LIANDONG_YAO(array2);
  //设置第一个选择框
  liandong2.firstSelectChange("0","x1");
  //设置子选择框
  liandong2.subSelectChange("x1","x2")
  liandong2.subSelectChange("x2","x3")
  liandong2.subSelectChange("x3","x4")
  liandong2.subSelectChange("x4","x5")
 </script>
</html>