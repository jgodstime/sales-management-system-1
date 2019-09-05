<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

use Mini\Core\View;

class HomeController
{
    var $View;
    public $msg;
   
    function __construct() {
        $this->View = new View();
        $this->msg = new \Mini\Libs\FlashMessages();
       
        

    }


    public function index()
    {
        if(isset($_POST['loginBtn'])){
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);
         

            if(empty($password)){
                 $this->msg->error('Password is required.');	
            }if(empty($email)){
                $this->msg->error('Email is required.');	
            }
            if ($this->msg->hasErrors()){
                header('location:' . $_SERVER['HTTP_REFERER']);
              
            }else{
               (new \Mini\Model\Home)-> adminLogIn($email,$password);
            }

            
        }else{

         // html data    
     $data["title"] = "Admin"; /* for <title></title> inside header.php in this case */
     // load views
     $this->View->render('home/index', $data);
         
    }
    
      
    }



    public function products()
    {
        // html data
        $data["title"] = "Products"; /* for <title></title> inside header.php in this case */
        // load views
        $this->View->render('home/products', $data);
    }

    
    public function logout()
    {
        unset($_SESSION['adminId']);
        header('location:'. URL.'home');
    }

}
