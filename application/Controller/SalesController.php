<?php
namespace Mini\Controller;

use Mini\Core\View;
use Mini\Model\Register;
use Mini\Model\Sales;
use Mini\Model\update;


class SalesController
{
    var $View;
    public $msg;
   
    function __construct() {
        $this->View = new View();
        $this->msg = new \Mini\Libs\FlashMessages();
    }


    public function index()
    {
        if(isset($_GET['salesBtn'])){
            $productCheckIdArray = $_GET['productCheckId'];
    

            if(empty($productCheckIdArray)){
                $this->msg->error('Select Products to sell.');
            }

            if ($this->msg->hasErrors()){
                header('location:' . $_SERVER['HTTP_REFERER']);
                die();
            }else{
                
            }

        }




        if(isset($_POST['orderBtn'])){
            $transactionDate = $_POST['transactionDate'];
            $invoiceId = $_POST['invoiceId'];
            $customerName = $_POST['customerName'];
            $phoneNumber = $_POST['phoneNumber'];
            $totalCost = $_POST['totalCost'];
            $productCheckedCount = count($_GET['productCheckId']);
            
            $productInfoArray = array();
        
           
                foreach($_GET['productCheckId'] as $productChekedId) { 
        
                    $productQuantity =  $_GET['quantityProductId'.$productChekedId];
                    $unitPrice = (new Sales)->getProductInfo($productChekedId)->unitprice;
                    $total = $unitPrice * $productQuantity;
                    // echo '<br><pre>'.$productChekedId.'</pre>';

                    $currentDBQuantity = (new Sales)->getProductInfo($productChekedId)->quantity;
                    $newQuantity = $currentDBQuantity - $productQuantity;
                    // echo '<pre>'.$newQuantity .'</pre>';
                   

                    $productInfo = array(
                        'productId' => $productChekedId,
                        'productQuantity' => $productQuantity,
                        'unitPrice' => $unitPrice,
                        'total' => $total
                    );
                    


                    (new Sales)->updateProductQuantityAfterSales($newQuantity,$productChekedId);

                    
                    array_push($productInfoArray,$productInfo); //add to array
                }
                // die();

                $productInfo = serialize($productInfoArray);
        
                (new Sales)->recordSalesInfo($invoiceId,$customerName,$phoneNumber,$productInfo,$totalCost,$transactionDate);
        
        
        
            }
        
        
            // html data
            $data["title"] = "Sales"; /* for <title></title> inside header.php in this case */
            // load views
            $this->View->render('home/sales', $data);
    }

    public function ajaxDisplaySalesProducts()
    {
        if(isset($_POST['searchData'])){
             $searchData = trim($_POST['searchData']);
            
            if(empty($searchData)){
                (new Register)->displayProducts();

            }else{
                // (new Register)->displayProducts();

                (new Register)->displayProductsBySearch($searchData);
                
            }
            // echo 'Dtata';
        }
       
    }

    
    public function report()
    {

       // html data
       $data["title"] = "Report";  /* for <title></title> inside header.php in this case */
       // load views
       $this->View->render('home/report', $data);
    }


    public function update()
    {
        if(isset($_GET['updateOrderBtn'])){
            $invoiceId = $_GET['invoiceId'];
            $customerName = $_GET['customerName'];
            $phoneNumber = $_GET['phoneNumber'];
            $salesId = $_GET['salesId'];
            
            // $totalCost = $_GET['totalCost'];

            // $productCheckedCount = count($_GET['productCheckId']);
        
            $productInfoArray = array();
            
                
        //    print_r($_SESSION['productIdArray']);
        //    die();
                foreach($_SESSION['productIdArray'] as $productChekedId) { 
        
                    $productQuantity =  $_GET['quantityProductId'.$productChekedId];
                    $unitPrice = (new Sales)->getProductInfo($productChekedId)->unitprice;
                    $total = $unitPrice * $productQuantity;
                    //  echo '<br><pre>'.$productChekedId.'</pre>';
        
                    $productInfo = array(
                        'productId' => $productChekedId,
                        'productQuantity' => $productQuantity,
                        'unitPrice' => $unitPrice,
                        'total' => $total
                    );
        
                    array_push($productInfoArray,$productInfo); //add to array
                   
                }
                // echo '<br><br><br><br>';
                $totalCost = (new Sales)->calculateProductsPrice($productInfoArray);
                // print_r($productInfoArray);

                $productInfo = serialize($productInfoArray);
        
                (new Update)->updateSalesInfo($invoiceId,$customerName,$phoneNumber,$productInfo,$totalCost);



        }

       // html data
       $data["title"] = "Verify/Update"; /* for <title></title> inside header.php in this case */
       // load views
       $this->View->render('home/update', $data);
    }

   
}
