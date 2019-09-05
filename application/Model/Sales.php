<?php

/**
 * Class Songs
 * This is a demo Model class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Model;

use Mini\Core\Model;
use PDO;


class Sales extends Model
{

    public function processArray($array)
    {
        foreach($array as $quantityNumber) {
            return $quantityNumber;
        }
    }

 public function updateProductQuantityAfterSales($quantity,$productId)
 {
    $queryUpdate = $this->db->prepare("UPDATE product_tbl SET quantity = ? WHERE id = ?");
    $queryUpdate->execute(array($quantity,$productId));
    if($queryUpdate){
        return true;
    }else{
        return false;
    }
 }   

    
public function recordSalesInfo($invoiceId,$customerName,$phoneNumber,$productInfo,$totalCost,$transactionDate)
{
            // echo die($transactionDate.' '.$invoiceId.' '.$customerName.' '.$phoneNumber.' '.$productInfo.' '.$totalCost);
    $staffInChargeId = $this->getAdminInfo()->id;

    $queryInsert = $this->db -> prepare("INSERT INTO sales_tbl (id,invoiceid,staffid,customername,phonenumber,productinfo,totalcost,transactiondate) 
    VALUES(?,?,?,?,?,?,?,?)");
    $queryInsert->execute(array('',$invoiceId,$staffInChargeId,$customerName,$phoneNumber,$productInfo,$totalCost,$transactionDate));

    if($queryInsert){
        return $this->msg->success('Sales successfully recorded .', URL.'sales');
    }else{
        $this->msg->error('Unable to record sales at this time, try again later.', URL.'sales');

    }

}

public function getProductInfo($productId){
    $query = $this->db -> prepare("SELECT * FROM product_tbl WHERE id = ? LIMIT 1");
    $query -> execute(array($productId));
    $result = $query->fetch();
    return $result;
}

public function getAdminInfo(){
    $query = $this->db -> prepare("SELECT * FROM admin_tbl WHERE id = ? LIMIT 1");
    $query -> execute(array($_SESSION['adminId']));
    $result = $query->fetch();
    return $result;
}
 
public function getLastSalesId(){
    $query = $this->db -> prepare("SELECT * FROM sales_tbl  ORDER BY id DESC LIMIT 1");
    $query -> execute();

    if($query->rowCount()>0){
        return $query->fetch(PDO::FETCH_ASSOC)['id'] +1;
    }else{
        return '1';
    }

}
    
    public function processSales($productCheckIdArray)
    {
        $sn = 1;
        $totalcost = 0;
        ?>
    <form action="<?php $_SERVER['REQUEST_URI'];?>" method="POST" class="form-inline" role="form">

<div class="row">
    <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px;margin-top:20px;">
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="">Transaction Date</label>
                <input type="text" class="" readonly name="transactionDate" value="<?php echo date('d-m-y');?>">
            </div>

        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="">Invoice ID</label>
                <input type="text" class="" name="invoiceId" readonly value="<?php echo 'PRC-'. $this->getLastSalesId();?>">
            </div>

        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="">Customers Name</label>
                <input type="text" required class="" name="customerName">
            </div>

        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="">Phone Number</label>
                <input type="number" class="" required name="phoneNumber">
            </div>

        </div>
        </div>
   
</div>
<div class="table-responsive">


    <table class="table table-hover table-bordered ">

        <thead>
            <tr>
                <th>Sn</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <!-- <tbody> -->
        <?php
                
        foreach($productCheckIdArray as $productChekedId) {
            // echo '<pre>'.$productChekedId.'</pre>';
            $quesrySelect = $this->db -> prepare("SELECT * FROM  product_tbl WHERE id = ?");
            $quesrySelect->execute(array($productChekedId));
            while ($row = $quesrySelect->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $totalunit = $row['unitprice'] * $_GET['quantityProductId'.$id] ;
                $totalcost += $totalunit;
                ?>

           
                <tr>
                    <td>
                        <?php echo $sn++; ?>
                    </td>
                    <td>
                        <?php echo $row['productname']; ?>
                    </td>

                    <td>
                        <?php echo $row['unitprice']; ?>
                    </td>

                    <td>
                        <?php echo $_GET['quantityProductId'.$id];?>
                    </td>
                    <td>
                        <?php echo $totalunit;
                    
                        ?>
                    </td>
                </tr>

                <?php
            } //while end

        }//for end
 ?>
         </tbody>
         <tbody>
                <tr>
                
                    <th colspan="4" style="text-align:right"> 
                                
                        <span style="font-size:  24px; float:left;" class="text-primary">Staff Incharge: 
                            <?php echo $this->getAdminInfo()->email; ?>
                        <input type="hidden" name="totalCost" value="<?php echo $totalcost;?>" >
                        </span>
                        
                  
                     <span style="font-size: 24px" class="text-primary"> Grand Total : </span></th>
                    <th>
                        <p id="totalcost" class="text-primary"  style="font-size: 24px">
                            <?php echo $totalcost; ?>
                        </p>
   
                        
                    </th>
                    
                </tr>

            </tbody>
    </table>

    <div class="text-center">
        <button type="button" onclick="window.print();return false;" class="btn btn-primary text-left" name="">Print Order Info</button>
   
        <button type="submit" class="btn btn-primary text-right" name="orderBtn">Place Order</button>
    </div>
</div>
</form>


<?php
    }
    








    public function displaySales()
    {
        $totalCost = 0;
     
        $query = $this->db->prepare("SELECT * FROM sales_tbl ORDER BY id DESC");
        $query->execute();
        if ($query->rowCount() > 0) {
            

            ?>
<div class="table-responsive">
<h2 class="text-center">All Sales</h2>
    <table class="table table-hover table-bordered">

        <thead>
            <tr>
                <th>Transaction Date</th>
                <th>Invoice Id</th>
                <th>Staff Name</th>
                <th>Customer Name</th>
                <th>Phone Number</th>
                <th>Product Info</th>
                <th>Total Cost </th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $totalCost += $row['totalcost'];
                ?> 
            
        
            <tr>
                <td> 
                <?php echo $row['transactiondate']; ?>
                </td>
                
                
                <td>
                    <?php echo $row['invoiceid']; ?>
                </td>

                  <td>
                    <?php echo $this->getAdminInfo($row['staffid'])->email ; ?>
                </td>
               
                <td>
                    <?php echo $row['customername']; ?>
                </td>
                <td>
                    <?php echo $row['phonenumber']; ?>
                </td>
                <td>
                   
                    <a href="<?php echo URL.'sales/report?salesId='.$id;?>">View Info</a>
                </td>
                <td>
                    <?php echo  $row['totalcost']; ?>
                </td>

    
            </tr>

<?php
        }
        
            ?>
        </tbody>

        <tbody>
            <tr>
                <td colspan="6" style="text-align:right;font-size:20px; color:red;">
                    <span>Total Sales</span>
                </td>
                <td >
                <span style="font-size:20px; color:red;">
                    <?php echo  $totalCost; ?>
                    </span>
                </td>
               </tr>
        </tbody>
              
            
            </table>
            
            <div class="text-center">
            
            
            <button type="button" onclick="window.print();return false;" class="btn btn-primary text-left" name="">Print Sales Info</button>
            </div>
           
</div>

<?php

        } else {
            echo '<div>
			<a class="list-group-item">Not Found.</a>
		</div>';
        }


    }






    public function displaySalesSearchDate($transactionDate)
    {
        $totalCost = 0;
     
        $query = $this->db->prepare("SELECT * FROM sales_tbl WHERE transactiondate=? ORDER BY id DESC");
        $query->execute(array($transactionDate));
        if ($query->rowCount() > 0) {
            

            ?>
<div class="table-responsive">
<h3 class=""> Sales for <?php echo $transactionDate; ?></h3>
    <table class="table table-hover table-bordered">

        <thead>
            <tr>
                <th>Transaction Date</th>
                <th>Invoice Id</th>
                <th>Staff Name</th>
                <th>Customer Name</th>
                <th>Phone Number</th>
                <th>Product Info</th>
                <th>Total Cost </th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $totalCost += $row['totalcost'];
                ?> 
            
        
            <tr>
                <td> 
                <?php echo $row['transactiondate']; ?>
                </td>
                
                
                <td>
                    <?php echo $row['invoiceid']; ?>
                </td>

                  <td>
                    <?php echo $this->getAdminInfo($row['staffid'])->email ; ?>
                </td>
               
                <td>
                    <?php echo $row['customername']; ?>
                </td>
                <td>
                    <?php echo $row['phonenumber']; ?>
                </td>
                <td>
                   
                <a href="<?php echo URL.'sales/report?salesId='.$id;?>">View Info</a>
                </td>
                <td>
                    <?php echo  $row['totalcost']; ?>
                </td>

    
            </tr>

<?php
        }
        
            ?>
             </tbody>
             <tbody>
            <tr>
                <td colspan="6" style="text-align:right;font-size:20px; color:red;">
                    <span>Total Sales</span>
                </td>
                <td >
                <span style="font-size:20px; color:red;">
                    <?php echo  $totalCost; ?>
                    </span>
                </td>
               </tr>
        </tbody>
              
            
            </table>
            
            <div class="text-center">
            
            
            <button type="button" onclick="window.print();return false;" class="btn btn-primary text-left" name="">Print Sales Info</button>
            </div>
           
</div>

<?php

        } else {
            echo '<div>
			<a class="list-group-item">Not Found.</a>
		</div>';
        }


    }

    
    



    public function displaySalesInfo($salesId)
    {
        $totalCost = 0;
     
        $query = $this->db->prepare("SELECT * FROM sales_tbl WHERE id=? ORDER BY id DESC");
        $query->execute(array($salesId));
        if ($query->rowCount() > 0) {
            

            ?>
<div class="table-responsive">
<!-- <h2 class="">Sales fo</h2> -->
    <table class="table table-hover table-bordered">

<thead>
    <tr>
        <th>Transaction Date</th>
        <th>Invoice Id</th>
        <th>Staff Name</th>
        <th>Customer Name</th>
        <th>Phone Number</th>
    </tr>
</thead>
<tbody>
        <?php
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $totalCost = $row['totalcost'];
            $productInfo = unserialize($row['productinfo']);
            // $totalCost += $row['totalcost'];
                ?> 
            
       
            <tr>
                <td> 
                <?php echo $row['transactiondate']; ?>
                </td>
                
                
                <td>
                    <?php echo $row['invoiceid']; ?>
                </td>

                  <td>
                    <?php echo $this->getAdminInfo($row['staffid'])->email ; ?>
                </td>
               
                <td>
                    <?php echo $row['customername']; ?>
                </td>
                <td>
                    <?php echo $row['phonenumber']; ?>
                </td>
             
    
            </tr>
           

           
            

<?php
        }

        ?>
        </tbody>
              
            
        </table>
       
        <?php
        
        // print_r($productInfo);
        foreach($productInfo as $row){
            ?>    
                <div class="col-md-4" style="background-color:#EFEFEF; margin:10px; padding:10px;"> 
                    <p>Product Name : <?php echo $this->getProductInfo($row['productId'])->productname;  ?></p> 
                    <p>Product Quantity : <?php echo $row['productQuantity'];  ?></p> 
                    <p>Unit Price : <?php echo $row['unitPrice'];  ?></p> 
                    <p>Total Price : <?php echo $row['total'];  ?></p> 
                </div>
            <?php

        }
            ?>
          
         
        
            <div class="col-md-12">

            <h4> Total Cost: <?php echo $totalCost; ?></h4>
            
            
            <button type="button" onclick="window.print();return false;" class="btn btn-primary text-left" name="">Print Sales Info</button>
            </div>
           
</div>

<?php

        } else {
            echo '<div>
			<a class="list-group-item">Not Found.</a>
		</div>';
        }


    }












    public function displayForUpdate($invoiceId)
    {
        $sn = 1;
        $totalCost = 0;

        
            // echo '<pre>'.$productChekedId.'</pre>';
            $quesrySelect = $this->db -> prepare("SELECT * FROM  sales_tbl WHERE invoiceid = ?");
            $quesrySelect->execute(array($invoiceId));
            if($quesrySelect->rowCount()>0){
                ?>



                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <?php
            while ($row = $quesrySelect->fetch(PDO::FETCH_ASSOC)) {
                $salesId = $row['id'];
                $transactionDate = $row['transactiondate'];
                $customerName = $row['customername'];
                $phoneNumber = $row['phonenumber'];
                $invoiceId = $row['invoiceid'];
                $productInfoArray = unserialize($row['productinfo']);
              
            } //while end
            
            // print_r($productInfoArray);
            ?>
            <input type="hidden" name="salesId" value="<?php echo $salesId?>">
            <div class="">
                <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px;margin-top:20px;">
                <form action="<?php $_SERVER['REQUEST_URI'];?>" method="GET" class="form-inline" role="form">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Transaction Date</label>
                            <input type="text" class="" readonly name="transactionDate" value="<?php echo $transactionDate;?>">
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Invoice ID</label>
                            <input type="text" class="" name="invoiceId" readonly value="<?php echo $invoiceId; ?>">
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Customers Name</label>
                            <input type="text" required class="" name="customerName" value="<?php echo $customerName; ?>">
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Phone Number</label>
                            <input type="number" class="" required name="phoneNumber"  value="<?php echo $phoneNumber; ?>">
                        </div>

                    </div>
                    </div>
            
            </div>
            <?php
             $productIds = array();
         foreach($productInfoArray as $productInfo) {
             $total = $productInfo['total'];
            //  $totalunit = $row['unitprice'] * $_GET['quantityProductId'.$id];
            array_push($productIds,$productInfo['productId']); //put products ids in an array
             $totalCost += $total;
           
            ?>
            <tbody>
                <tr>
                    <td>
                        <?php echo $sn++; ?>
                    </td>
                    <td>
                        <?php echo $this->getProductInfo($productInfo['productId'])->productname ; ?>
                    </td>

                    <td>
                        <?php echo $productInfo['unitPrice']; ?>
                    </td>

                    <td>
                        
                        <input type="number" required min="0" name="quantityProductId<?php echo $productInfo['productId'];?>" value="<?php echo $productInfo['productQuantity'];?>" id="">

                    </td>
                    <td>
                        <?php echo $productInfo['total'];?>
                    </td>
                </tr>
            <?php
            
            
        }//for end
// print_r($productIds);
$_SESSION['productIdArray'] = array();

$_SESSION['productIdArray'] = $productIds;

        
        
 ?>

                        <!-- <input type="hidden" name="productIdArray[]" value="<?php// print_r($productIds); ?>" > -->
                        <input type="hidden" name="salesId" value="<?php echo $_GET['salesId']; ?>" >


                <tr>
                
                    <th colspan="4" style="text-align:right"> 
                                
                        <span style="font-size:  24px; float:left;" class="text-primary">Staff Incharge: 
                            <?php echo $this->getAdminInfo()->email; ?>
                        <input type="hidden" name="totalCost" value="<?php echo $totalCost; ?>" >
                        </span>
                        
                  
                     <span style="font-size: 24px" class="text-primary"> Grand Total : </span></th>
                    <th>
                        <p id="totalcost" class="text-primary"  style="font-size: 24px">
                            <?php echo $totalCost; ?>
                        </p>
   
                        
                    </th>
                    
                </tr>

            </tbody>
    </table>

    <div class="text-center">
        <!-- <button type="button" onclick="window.print();return false;" class="btn btn-primary text-left" name="">Print Order Info</button> -->
   
        <button type="submit" class="btn btn-primary text-right" name="updateOrderBtn">Update Order</button>
    </div>
    </form>
</div>

<?php
}else{
    echo 'No record match that invoice id';
}
    }
    




    public function calculateProductsPrice($productInfo){
        $total = 0;
        foreach($productInfo as $row):
            $total += $row['total']; 
            
        endforeach;
        
        return $total;  
    }
     



}

