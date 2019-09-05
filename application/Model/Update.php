<?php


namespace Mini\Model;

use Mini\Core\Model;
use PDO;
class Update extends Model
{
    

   public function updateSalesInfo($invoiceId,$customerName,$phoneNumber,$productInfo,$totalCost)
   {
        $query = $this->db->prepare("UPDATE sales_tbl SET customername=?, phonenumber=?, productinfo=?,totalcost=? WHERE invoiceid = ?");
        $query->execute(array($customerName,$phoneNumber,$productInfo,$totalCost,$invoiceId));

        if($query){
            $this->msg->success('Sales updated.', URL.'sales/update?invoiceId='.$invoiceId);
        }else{
            $this->msg->error('Uable to update at this time, please try again later', URL.'sales/update?invoiceId='.$invoiceId);
        }
   }
   

   
}