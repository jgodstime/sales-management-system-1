<?php
namespace Mini\Controller;

use Mini\Core\View;
use Mini\Model\Register;


class RegisterController
{
    var $View;
    public $msg;
   
    function __construct() {
        $this->View = new View();
        $this->msg = new \Mini\Libs\FlashMessages();
    }


    public function index()
    {
        if(isset($_POST['registerBtn'])){
            $productName = ucwords($_POST['productName']);
            $unitPrice = $_POST['unitPrice'];
            $quantity = $_POST['quantity'];

           


            if(empty($productName)){
                $this->msg->error('Product Name is required.');
            }if(empty($unitPrice)){
                $this->msg->error('Unit Price is required.');
            }if(empty($quantity)){
                $this->msg->error('Quantity is required.');
            }
            if ($this->msg->hasErrors()){
                header('location:' . $_SERVER['HTTP_REFERER']);
                die();
            }else{
                
                (new Register())->register($productName,$unitPrice,$quantity);
            }






        }
            // html data
            $data["title"] = "Register Product"; /* for <title></title> inside header.php in this case */
            // load views
            $this->View->render('home/register', $data);
    }

   




    public function manage()
    {

        if(isset($_POST['deleteBtn'])){
            $productId  = $_POST['productId'];
            (new Register())->deleteProduct($productId);
        }

        if(isset($_POST['updateProductQuantityBtn'])){
            $productId  = $_POST['productId'];
            $addedQuantity  = $_POST['addedQuantity'];

            if(empty($addedQuantity)){
                $this->msg->error('New quantity value is required.');
            }
            if ($this->msg->hasErrors()){
                header('location:' . $_SERVER['HTTP_REFERER']);
                die();
            }else{
                // die(4);
                (new Register())->updateProductQuantity($addedQuantity,$productId);
            }
            
        }

            // html data
            $data["title"] = "Register Product"; /* for <title></title> inside header.php in this case */
            // load views
            $this->View->render('home/manage', $data);
    }



}
