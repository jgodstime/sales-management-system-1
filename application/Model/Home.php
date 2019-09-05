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


class Home extends Model
{

     
public function adminLogIn($email,$password){
    if(!empty($email) or !empty($password)){
        $query = $this->db->prepare("SELECT * FROM admin_tbl WHERE email=? LIMIT 1");
        $query -> execute(array($email));
        if ($query->rowCount()>0){
            $result = $query->fetch(PDO::FETCH_ASSOC); 
             $email= $result["email"];
             $adminId = $result["id"];
             $adminId = $result["id"];
             $passwordDb = $result["password"];
             

        
        $verify = password_verify($password,$passwordDb);
       
            if ($verify){
            
            $_SESSION["adminId"] = $adminId;

            
            header('location:'.URL.'sales');
           
       
           
            }else{
                return $this->msg->error('Invalid user name and password combination.', URL);
            }
      
        
        
    }else{
        return $this->msg->error('Invalid user name and password combination.', URL);

    }
        
    }else{
        return $this->msg->error('Invalid user name and password combination.', URL);
        
    }
    

}

    
}