<?php
 $msg = new \Mini\Libs\FlashMessages();
 use Mini\Model\Sales;
 use Mini\Model\Register;

?>

<div class="container">

    <div class="row">
        <?php
                            

        if(!isset($_GET['tDate']) || !isset($_GET['salesId'])){
            ?>
        <div class="col-md-6 col-md-offset-3">
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="GET">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="input-group">
                            <input type="text" required name="tDate" class="form-control" id="productSearch" placeholder="Search by date (e.g 02-12-18)">
                            <span class="input-group-btn">
                                <button type="submit" name="tDateBtn" class="btn btn-default">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <?php
        }

        ?>





        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="get">
                        <?php
                          $msg->display();
                        if(isset($_GET['tDate'])){
                            $transactionDate = trim($_GET['tDate']);
                            (new Sales())->displaySalesSearchDate($transactionDate);
                        }else if(isset($_GET['salesId'])){
                            $salesId = trim($_GET['salesId']);

                            (new Sales())->displaySalesInfo($salesId);
                        }else{
                            (new Sales())->displaySales();
                        } 
                            
                        
                        
                        ?>
                        <!-- <div id="salesDisplay"></div> -->


                    </form>

                </div>

            </div>


        </div>



    </div>



</div>

<script type='text/javascript' src='<?php echo URL; ?>js/sales.js'></script>