<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 系列查询：这个没有什么要注意的，怎么做都行。 -->
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/fontawesome/css/font-awesome.min.css">
	<title>系列查询</title>
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
</head>
<body>
       <form  action="<?php echo U('add');?>"  method="post"> 	    
		    <table class='table'>
		    <tr>
			<th align='right'>系列查询</th>
			<td width='90%'>
				<SELECT ID="x1" NAME="x1"  >
					<OPTION selected></OPTION>
				</SELECT>
				<SELECT ID="x2" NAME="x2"  >
					<OPTION selected></OPTION>
				</SELECT>
				<SELECT ID="x3" NAME="x3"  >
					<OPTION selected></OPTION>
				</SELECT>
				<input type="submit" value="查询"> 
			</td>
			</tr>
			</table>
			
       </form>
	<form action="<?php echo U('add');?>" method="post">
		<table class='table'>
			<thead>
				<th>品类</th>
				<th>小类</th>
				<th>系列</th>
				<th>操作</th>
			</thead>		    
		   <tr>
		       <td style="text-align:center;"> <?php if(is_array($array)): $i = 0; $__LIST__ = array_slice($array,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["name"]); endforeach; endif; else: echo "" ;endif; ?></td>
		     <td style="text-align:center;"> <?php if(is_array($array)): $i = 0; $__LIST__ = array_slice($array,1,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["name"]); endforeach; endif; else: echo "" ;endif; ?></td> 
		     <td style="text-align:center;"> <?php if(is_array($array)): $i = 0; $__LIST__ = array_slice($array,2,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["name"]); endforeach; endif; else: echo "" ;endif; ?></td>  
		       <?php if(is_array($array)): $i = 0; $__LIST__ = array_slice($array,3,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="hidden" name="id" value="vo['id']"/>
		       <td style="text-align:center;"> 
				<a href="<?php echo U('SeriesModify/update',array('id' => $vo['id']));?>" >修改</a>
		     </td><?php endforeach; endif; else: echo "" ;endif; ?>
		</tr>
	</table>
</form>
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