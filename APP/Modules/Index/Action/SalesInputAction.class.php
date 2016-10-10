<?php

//销售单录入；
class SalesInputAction extends CommonAction {
 public function index(){

        $cate=M('product')->order('id')->getField('id,pid,name');

        $this->arr=json_encode(array_values($cate));

        $this->display();
    }
public function add(){
 if (I('salesClientName') != "" && I('salesClientPhone') !="" && I('salesBuyTime')!=""&& I('salesInstallTime') !=""&& I('salesPersonAddress') !=""&& I('x4') !=""&& I('salesStand') !=""&& I('salesCashback') !=""&& I('salesProductNum') !=""){
    $db=M('sales_information');  
        $data['salesClientName']  = I('salesClientName');
        $data['salesClientPhone']  = I('salesClientPhone');
        $data['salesBuyTime']  = I('salesBuyTime');
        $data['salesInstallTime']  = I('salesInstallTime');
        $data['salesPersonAddress']  = I('salesPersonAddress');
        $data['salesModelID'] = I('x4');
        $data['salesCommission'] = M('product_m')->where('pid='.I('x4'))->getField('salesCommission');
        //根据型号选择出对应的提成；
        $data['salesStand'] = I('salesStand');
        $data['salesCashback'] = I('salesCashback');
        $data['salesProductNum'] = I('salesProductNum');
    if(I('salesInvoiceID')==""){
            $data['salesInvoiceID'] ="无";
    }else{
        $data['salesInvoiceID'] = I('salesInvoiceID');
    }

    if(I('salesClientMail')==""){
            $data['salesClientMail'] ="无";
    }else{
        $data['salesClientMail'] = I('salesClientMail');
    }

    if(I('salesPersonTelePhone')==""){
            $data['salesPersonTelePhone'] ="无";
    }else{
        $data['salesPersonTelePhone'] = I('salesPersonTelePhone');
    }

    if(I('salesRemark')==""){
            $data['salesRemark'] ="无";
    }else{
        $data['salesRemark'] = I('salesRemark');
    }

        // $data['salesInvoiceID'] = I('salesInvoiceID');//可空；
        // $data['salesClientMail'] = I('salesClientMail');//可空；      
        // $data['salesPersonTelePhone'] = I('salesPersonTelePhone');//可空；
        // $data['salesRemark'] = I('salesRemark');//可空；
        $data['salesStatus'] = "0";//销售网点录入时，默认提交状态为0；
        $data['status'] = "1";//销售网点录入时，默认状态为0；
        $data['salesPersonID'] = session('userID');//登录获取用户ID；
        $data['salesBranchID'] = session('branchID');//销售网点登录获取用户的网点ID；
         // dump($data);die;
        $id = $db->add($data);
        $cate=M('product')->order('id')->getField('id,pid,name');


        $this->salesClientName = I('salesClientName');
        $this->salesClientPhone = I('salesClientPhone');
        $this->salesInvoiceID = I('salesInvoiceID');
        $this->salesBuyTime = I('salesBuyTime');
        $this->salesInstallTime = I('salesInstallTime');
        $this->salesModelID = I('salesModelID');
        $this->salesStand = I('salesStand');
        $this->salesCashback = I('salesCashback');
        $this->salesBuyTime = I('salesBuyTime');
        $this->salesInstallTime = I('salesInstallTime');
        $this->salesPersonTelePhone = I('salesPersonTelePhone');
        $this->salesClientMail = I('salesClientMail');
        $this->salesPersonAddress = I('salesPersonAddress');
        $this->salesProductNum= I('salesProductNum');
        $this->salesRemark= I('salesRemark');

        $this->arr=json_encode(array_values($cate));

        $this -> display('index');
        }else{
         $this->error('请录入完整！',U('SalesInput/index'));
         }

   }
}
    