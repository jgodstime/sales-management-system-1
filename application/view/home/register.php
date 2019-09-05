<?php
 $msg = new \Mini\Libs\FlashMessages();
 
?>
<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 panel">
            <?php
                $msg->display();
            ?>
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" role="form" enctype="multipart/form-data">
                <h3>Register Product</h3>
            
                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="text" class="form-control" name="productName" id="" placeholder="Product Name">
                </div>
                
               
                <div class="form-group">
                    <label for="">Unit Price</label>
                    <input type="number" class="form-control" name="unitPrice" min="0" placeholder="Unit Price">
                </div>

                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="number" class="form-control" name="quantity" min="0" placeholder="Quantity">
                </div>
            
                
                <div class="form-group text-center">
                    <button type="submit" name="registerBtn" class="btn btn-primary ">Submit</button>
                </div>
            </form>
            
        </div>
    </div>

</div>