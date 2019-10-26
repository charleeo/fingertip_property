<?php 
      require_once ("configuration/db_config.php");
      require_once ("controllers/displayads.php"); 
      require_once ("controllers/location.php"); 
      require_once ("controllers/searchcategories.php"); 
     require_once ("controllers/categoryclass.php"); 
            $description ="This is fingertip, a place where you can
            buy and sell all landed and non landed property: Hpuses, cars, lands";
            $keyWords = "cars in lagos, cars in abuja, cars in porthacourt, 
            cars in kaduna, cars in Nigeria, cars for sale in Lagos, cars for sales in Nigeria, cars near me, affordable cars, houses for rent, 
            houses for lease, houses for sale, houses for sales in Nigeria, houses for rent in Nigeria, houses for rent
             in Lagos, two bed room flats, 
            flats, duplexes, lands for sale in Nigeria, land for rent in Nigeria, 
            land for lease in Nigeria, lands closest to me,
            property in my neihgbourhood, property near me ";
        $title = "Sell All Your Property at a Glance";
     include ("includes/head.php");
    ?>

    <div class="wrapper">
        <!-- Navigation -->
       <?php
        include ("includes/navbar.php");
       ?>
        <!-- Top container -->

    <section>
        <?php include("includes/categories.php") ?>
    </section>
        <?php  include ("includes/main_heading.php");?>

            <p class="featured">Featured Property</p>

       <?php include ("includes/products.php") ?>
       
       
        <!-- Boxes Section -->
    
        <!-- Info Section -->
    <?php include("includes/footer.php") ?>
    <!-- Wrapper ends -->
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/mainnavbarjs.js"></script>    
    <script src="js/main.js"></script>
    <script src="js/categorysearch.js"></script>
   