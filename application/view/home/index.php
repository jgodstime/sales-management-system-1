
<?php
 $msg = new \Mini\Libs\FlashMessages();
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <div class="panel">
                <div class="panel-heading">
                    <?php $msg->display(); ?>   
                    <h2 class="text-primary text-center">Login As Admin</h2>
                </div>
                <div class="panel-body " style="margin-bottom:50px;">
                   
                   <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" role="form">
                   
                       <div class="form-group text-left">
                           <label for="">User Name</label>
                           <input type="text" name="email" class="form-control" id="" placeholder="Enter Admin User Name">
                       </div>
                       <div class="form-group text-left">
                           <label for="">Password</label>
                           <input type="password" name="password" class="form-control" id="" placeholder="Enter Admin Password">
                       </div>
                   
                       
                   
                       <button type="submit" name="loginBtn" class="btn btn-primary btn-block">Login</button>
                   </form>
                   
                </div>
               
            </div>
        </div>
    </div>
</div>
