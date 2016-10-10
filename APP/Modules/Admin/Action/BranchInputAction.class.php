<?php

//销售网点新增（类似销售单做就可以）；
class BranchInputAction extends CommonAction {
   public function add(){
    $type=I('branchtype');
    if ($type==1) {
        $db=M('sales_branch'); 
    }else{
        $db=M('install_branch'); 
    }
    
    if (I('branchName')=='') {
        $this->error('网点名不能为空！');
    }
    if (I('branchAddress')=='') {
        $this->error('网点地址不能为空！');
    }
    if (I('branchPicName')=='') {
        $this->error('网点负责人不能为空！');
    }
    if (I('branchPicPhone')=='') {
        $this->error('网点负责人电话不能为空！');
    }
        $data['branchName'] = I('branchName');
        $data['branchAddress']  = I('branchAddress');
        $data['branchPicName']  = I('branchPicName');
        $data['branchPicPhone'] = I('branchPicPhone');
        $data['branchCreateDate'] = date('Y-m-d',time());
        $db->add($data);
        $this->success('新增成功',U('BranchInput/index')) ;
    }
}
    