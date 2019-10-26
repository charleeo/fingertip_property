<?php
    require_once ("configuration/db_config.php");
    require_once ("controllers/searchcategories.php"); 
?>
    <?php 
     $title ="Categories and Location"; 
     $description ='';
     $keyWords ='';
    include ("includes/head.php") ?>

    <div class="wrapper">
    <?php include ("includes/navbar.php");
        $newad = new SearchCategory();
        $ads= $newad->filteredBackEnd();
        if(!empty($ads)){
        ?>
        <section class="portfolio">
        <?php
        
        foreach($ads as $ad){
            $adsImages = explode(',', $ad['images']);
        ?>

    <div> 
    <a href="singleproduct/<?php echo $ad['id'] ?>/<?php echo $ad['category_id'] ?>/<?php echo $ad['user_id']; ?>">
    <img src="<?php echo $adsImages[0] ?>" class="adjust-image" alt="Port folio logos"></a>
        <div class="product-view-bg">
        <hr>
        <span class="product-view"><?php echo $ad['title'] ?></span> <br>
        <span class="product-view">For:<b class="product-view-purpose">
         <?php echo $ad['purpose'] ?></b></span>  <br>
        <span class="product-view">Location: <?php echo $ad['region_name'] ?></span>, 
        <span class="product-view"><?php echo $ad['state_name'] ?> State </span> <br>
        <span class="product-view">Price:  &#8358 <b class="product-view-price"> 
        <?php echo number_format($ad['price']) ?></b></span> <br>
        <span class="product-view">
            <a href="singleproduct/<?php echo $ad['id'] ?>/<?php echo $ad['category_id'] ?>/<?php echo $ad['user_id'] ?>">View details</a>
        </span> 
        </div>
    </div>
       <?php
    }
    }else{
            echo "No record found";
        }
    
    ?>
</section>
<span id="timer"></span>
    <?php include ("includes/footer.php"); ?>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/mainnavbarjs.js"></script>
