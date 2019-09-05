<?php
 $msg = new \Mini\Libs\FlashMessages();
 use Mini\Model\Sales;
 use Mini\Model\Register;
//  echo password_hash('admin', PASSWORD_DEFAULT);
?>

<div class="container">

    <div class="row">
      
        <!-- <div class="col-md-6 col-md-offset-3">

            <div class="panel">
                <div class="panel-heading">
                    <div class="input-group">
                        <input type="text" class="form-control" id="productSearch" placeholder="Search Product">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default">Go!</button>
                        </span>
                    </div>

                </div>
            </div>

        </div> -->
      




        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    
                        <?php
                            
                            $msg->display();

                            if(isset($_GET['productCheckId'])){
                                    
                                $productCheckIdArray = $_GET['productCheckId'];
                                (new Sales())->processSales($productCheckIdArray);
                            }else{
            ?>
            
                                <?php  (new Register())->manageProducts(); ?>
                    
            <?php
                              
                            }
             ?>

                    

                </div>

            </div>


        </div>



    </div>



</div>

<script type='text/javascript' src='<?php echo URL; ?>js/sales.js'></script>