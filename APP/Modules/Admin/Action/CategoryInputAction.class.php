<?php

//销售品类新增；
class CategoryInputAction extends CommonAction {
	public function index(){

		$this->display();

	}
   public function add(){
    $db=M('product'); 
    if(I('categoryName') !=''){
        $data['name'] = I('categoryName');
        $data['pid'] = 0;
        $data['categoryID'] = 1;
        $ad=$db->where($data)->Field('name')->find();
        if($ad){$this->error('新增品类重复，请重新输入！',U('CategoryInput/index')) ;
    }else{$db->add($data);
        $this->success('新增成功',U('CategoryInput/index')) ;
    }
        
    }else{
        $this->error('新增失败',U('CategoryInput/index')) ;
    }

  }
}
    