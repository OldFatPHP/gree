<?php 

class RbacAction extends CommonAction{
	
	
	//角色列表
	public function role(){
		$this->role=M('role')->select();
		$this->display();
	}
	
	//节点列表
	public function node(){
		$field=array('id','name','title','pid');
		$node=M('node')->field($field)->order('sort')->select();
		$this->node=node_merge($node);
		$this->display();
	}
	
	//添加角色
	public function addRole(){
		$this->display();
	}
	//添加角色表单处理
	public function addRoleHandle(){
		if (M('role')->add($_POST)) {
			$this->success('添加成功！',U(GROUP_NAME.'/Rbac/role'));
		}else {
			$this->error('添加失败！请重试');
		}
	}
	
	
	
	
	
	
	//添加节点
	public function addNode(){
		$this->pid=I('pid',0,'int');
		$this->level=I('level',1,'int');
		
		switch ($this->level){
			case 1:
				$this->type='应用';
				break;
			case 2:
				$this->type='控制器';
				break;
			case 3:
				$this->type='方法';
				break;
		}
		$this->display();
	}
	//添加节点表单处理
	public function addNodeHandle(){
		if (M('node')->add($_POST)) {
			$this->success('添加成功！',U(GROUP_NAME.'/Rbac/node'));
		}else {
			$this->error('添加失败！请重试');
		}
	
	}
	
	
	
	
	//配置权限视图
	public function access(){
		$rid=I('rid','','int');
		$node=M('node')->order('sort')->select();
		//原有权限
		$access=M('access')->where(array('role_id' => $rid))->getField('node_id',true);

		$this->node=node_merge($node,$access);
		$this->rid=$rid;

		$this->display();
	}
	//配置权限表单处理
	public function setAccess(){

		$rid=I('rid','','int');
		//清空原权限
		M('access')->where(array('role_id' => $rid))->delete();
		//组合新权限
		$data=array();
		foreach (I('access') as $v){
			$temp=explode('_', $v);
			$data[]=array(
				'role_id' => $rid,
				'node_id' => $temp[0],
				'level' => $temp[1],
			);
		}
		//插入新权限
		if (M('access')->addAll($data)) {
			$this->success('配置成功',U(GROUP_NAME.'/Rbac/role'));
		}else {
			$this->error('配置失败！请重试');
		}
	}
	
	

}










?>