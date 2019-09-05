<?php



namespace Mini\Controller;

use Mini\Core\View;
use Mini\Model\Evaluate;

class EvaluateController
{
    var $View;
    public $msg;
   
    function __construct() {
        $this->View = new View();
        $this->msg = new \Mini\Libs\FlashMessages();

    }
    
    public function rate()
    {
        if(isset($_POST['rateBtn'])){
            // $this->msg->error('Your last name is required.');

            $rate = $_POST['idea'];
            $fullName = $_POST['fullName'];
            $comment = $_POST['comment'];
            $productId = basename($_SERVER['REQUEST_URI']);


            if(empty($rate)){
                $this->msg->error('Rating is required.');
            }if(empty($fullName)){
                $this->msg->error('Your name is required.');
            }if(empty($comment)){
                $this->msg->error('Your comment is required.');
            }
            if ($this->msg->hasErrors()){
                header('location:' . $_SERVER['HTTP_REFERER']);
                die();
            }else{
                (new Evaluate)->saveRatedInfo($productId,$rate,$fullName,$comment);
            }


            

            
        }                

        
             // html data
            $data["title"] = "Rate Product"; /* for <title></title> inside header.php in this case */
            // load views
            $this->View->render('home/rate', $data);
       
       
    }


    public function record()
    {
          // html data
          $data["title"] = "Appraisal Record"; /* for <title></title> inside header.php in this case */
          // load views
          $this->View->render('home/record', $data);
     
    }

   
}
