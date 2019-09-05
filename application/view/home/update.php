<?php
 $msg = new \Mini\Libs\FlashMessages();
 use Mini\Model\Update;
 use Mini\Model\Sales;


?>
            
<div class="container">
    <div class="row">

        <div class="col-md-6 col-md-offset-3">
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="GET">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="input-group">
                            <input type="text" required name="invoiceId" class="form-control" id="productSearch" placeholder="Search by invoiceid">
                            <span class="input-group-btn">
                                <button type="submit" name="tDateBtn" class="btn btn-default">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    
        <div class="col-md-12 " style="background-color:white">
            <?php
            $msg->display();
                if(isset($_GET['invoiceId'])){
                    $invoiceId = $_GET['invoiceId'];
                    (new Sales)->displayForUpdate($invoiceId);
                }else{

                }
            ?>
        </div>

    </div>
</div>