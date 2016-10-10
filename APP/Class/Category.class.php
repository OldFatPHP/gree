<?php 
class Category{
	//组合一维数组
	 static public function unlimitedForLevel($cate,$html='---',$pid=0,$level=0){
	 	$arr=array();
	 	foreach ($cate as $v){
	 		if ($v['pid'] == $pid) {
	 			$v['level']=$level+1;
	 			$v['html']=str_repeat($html, $level);
	 			$arr[]=$v;
	 			$arr=array_merge($arr,self::unlimitedForLevel($cate,$html,$v['id'],$level+1));
	 		}
	 	}
	 	return $arr;
	 }
	 
	 //组合多维数组
	 static public function unlimitedForLayer($cate,$pid=0,$name='child'){
	 	 	$arr=array();
	 	foreach ($cate as $v){
	 		if ($v['pid']==$pid) {
	 			$v[$name]=self::unlimitedForLayer($cate,$v['id'],$name);
	 			$arr[]=$v;
	 		}
	 	}
	 	return $arr;
	 }
	 
	 
	 //传递子分类ID获取父级分类
	 static public function getParents($cate,$id){
	 	$arr=array();
	 	foreach ($cate as $v){
	 		if ($v['id']==$id) {
	 			$arr[]=$v;
	 			$arr=array_merge(self::getParents($cate, $v['pid']),$arr);
	 		}
	 	}
	 	return $arr;
	 }
	 
	 
	 //传递父级分类ID获取子分类
	 static public function getChildsId($cate,$pid){
	 	$arr=array();
	 	foreach ($cate as $v){
	 		if ($v['pid']==$pid) {
	 			$arr[]=$v['id'];
	 			$arr=array_merge($arr,self::getChildsId($cate, $v['id']));
	 		}
	 	}
	 	return $arr;
	 }

}




?>