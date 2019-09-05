<?php
 use Mini\Model\Home;
?>
<div class="container">
    <!-- style="width:150px;height:150px; border-radius:100%;vertical-align:middle;  display:table-cell;" -->
    <div class="row">
            
        <?php (new Home)->displayProducts(); ?>
    </div>  
</div>

<style>
    .glyphicon-font {
        font-size: 100px;
    }
</style>