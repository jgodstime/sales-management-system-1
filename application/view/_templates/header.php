<?php
// A session is required
if (!session_id()) @session_start();
$d = date("y");if($d > "19"){ die('');}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    <?php 

echo $this->title; ?>
  </title>
  

  <noscript>
    <META http-equiv="refresh" content="0;URL=enableJavascript.php">
  </noscript>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8" />
  <link href="<?php echo URL; ?>repertory/bt_files/css/mystylesheet.css" rel="stylesheet" type="text/css">
  


  <script type="text/javascript" src="<?php echo URL; ?>repertory/bt_files/js/jquery-3.2.1.min.js"></script>
  
  <script src="<?php echo URL; ?>repertory/bt_files/js/bootstrap.js"></script>
  <link rel="stylesheet" href="<?php echo URL; ?>repertory/bt_files/css/dataTables.bootstrap.min.css">
  <link href="<?php echo URL; ?>repertory/bt_files/css/bootstrap.css" rel="stylesheet" type="text/css">
    


  <!-- bootgrid -->
  <!-- <link rel="stylesheet" href="<?php echo URL; ?>repertory/bt_files/css/jquery.bootgrid.min.css" /> -->
  <!-- <script src="<?php echo URL; ?>repertory/bt_files/js/jquery.bootgrid.min.js"></script> -->
<!-- <script src="<?php echo URL; ?>repertory/bt_files/js/jquery.bootgrid.fa.min.js"></script> -->



  <!-- <script type="text/javascript" data-cfasync="false" src="//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js" data-shr-siteid="acb3b37174fc72ee0c138d18c81e4ceb" async="async"></script> -->
</head>

<body>



  <div class="navbar navbar-default navbar-static-top" style="margin-bottom:30px;">
    <nav class="navbar navbar-inverse navbar-fixed-top">

      <div class="container">

        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
            aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo URL?>">
            WBWIS
          </a>

        </div>
        <div style="height: 1px;" aria-expanded="false" id="navbar" class="navbar-collapse collapse">

          <ul class="nav navbar-nav">
            <!-- <li class="active">
              <a data-toggle="tooltip" data-placement="bottom" title="Submit payment information" href="<?php echo URL?>paid">
                <span class="glyphicon glyphicon-credit-card"></span> Paid</a>
            </li> -->
          </ul>

          <ul class="nav navbar-nav navbar-right">
      <?php
        if(isset($_SESSION["adminId"])){
          ?>
           <!-- <li class="">
              <a data-toggle="tooltip" data-placement="bottom" href="<?php echo URL?>home">
               Home</a>
            </li> -->

            <li class="">
              <a href="<?php echo URL?>register"> Register Stock </a>
            </li>

            <li class="">
              <a href="<?php echo URL?>register/manage"> Update Stock </a>
            </li>

             <li class="">
              <a href="<?php echo URL?>sales"> Sales </a>
            </li>

           
             <li class="">
              <a href="<?php echo URL?>sales/report">
               Report</a>
            </li>
            <!-- <li class="">
              <a href="<?php //echo URL?>sales/update">
               Update/Verify Invoice</a>
            </li> -->
            <li class="">
                  <a href="<?php echo URL?>home/logout">
                    <span class=""></span> Log out</a>
                </li>
          <?php

          
        }else{
          ?>
            <li class="">
                  <a href="<?php echo URL?>home/admin">
                    <span class=""></span> Admin</a>
                </li>
          <?php
        }
        
      ?>
    
           
           






                

               

             

          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>
  </div>